<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\OfferList;
use App\Models\SelectedOfferList;
use App\Models\Session;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        $userPriority = Auth::user()->priority;
        $selectedSession = $request->query('session', null);

        $chosenOffersListIds = SelectedOfferList::where('user_id', Auth::user()->id)
            ->pluck('offer_list_id');

        $highestUnchosenPriority = User::whereDoesntHave('selectedOfferLists', function ($query) {
            $query->select('offer_list_id');
        })->max('priority');

        $isCurrentPriorityAllowed = $userPriority >= $highestUnchosenPriority;

        $offerList = OfferList::when($selectedSession != null, function ($q) use ($selectedSession) {
            $q->whereHas('session', function ($q) use ($selectedSession) {
                $q->where('name', $selectedSession);
            });
        })->whereHas('session', function ($q) {
            $q->where('status', 'running');
        })->whereNotIn('id', $chosenOffersListIds)->latest()->get()
            ->map(function ($offer) use ($isCurrentPriorityAllowed) {
                $offer->disabled = ! $isCurrentPriorityAllowed;

                return $offer;
            });

        $sessions = Session::where('status', 'Running')->get();

        return view('panel.pages.teacher.offers', compact(['offerList', 'sessions', 'selectedSession']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'offerlist_id' => 'required|array',
            'offerlist_id.*' => 'required|integer|min:1',
        ], [
            'offerlist_id.required' => 'Please select at-least one offer.',
        ]);
        try {
            $offerlistIds = $request->input('offerlist_id');

            $creditSum = OfferList::whereIn('id', $offerlistIds)->sum('course_credit');
            if ($creditSum < 15) {
                return back()->with('error', 'Please choose at-least 15 credits.');
            }

            foreach ($offerlistIds as $index => $offerlistId) {
                SelectedOfferList::create([
                    'user_id' => Auth::id(),
                    'offer_list_id' => $offerlistId,
                ]);
            }

            return redirect()->to('dashboard')->with('success', 'Selected offers saved successfully.');

        } catch (UniqueConstraintViolationException) {
            return back()->with('error', 'You have already choose some offer from selected list before.');
        }
    }
}
