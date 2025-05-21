<?php

namespace App\Http\Controllers;

use App\Models\OfferList;
use App\Models\SelectedOfferList;
use App\Models\Semester;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function profile(Request $request): View
    {
        return view('panel.pages.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->confirm_password);
            $user->save();

            return back()->with('success', 'Password Updated Successfully.');
        } else {
            return back()->withErrors(['msg' => 'Current Password Incorrect.']);
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dashboard(Request $request)
    {
        $selectedSession = $request->query('session', null);
        $sessions = Session::latest()->get();

        if (auth()->user()->role == 'admin') {
            $sessionsCount = Session::count();
            $semesters = Semester::count();
            $teachers = User::where('role', 'teacher')->count();
            $offers = OfferList::count();
            $selectedOffers = SelectedOfferList::with(['user', 'offerList.session', 'offerList.semester'])
                ->when($selectedSession != null, function ($q) use ($selectedSession) {
                    $q->whereHas('offerList.session', function ($q) use ($selectedSession) {
                        $q->where('name', $selectedSession);
                    });
                })->get()
                ->sortBy(function ($offer) {
                    return $offer->user->priority;
                }, descending : true);

            return view('panel.pages.dashboard', compact(['sessionsCount', 'semesters', 'teachers', 'offers', 'selectedOffers', 'sessions', 'selectedSession']));
        } else {
            $selectedOffers = SelectedOfferList::where('user_id', Auth::user()->id)
                ->when($selectedSession != null, function ($q) use ($selectedSession) {
                    $q->whereHas('offerList.session', function ($q) use ($selectedSession) {
                        $q->where('name', $selectedSession);
                    });
                })->with(['offerList.session', 'offerList.semester'])
                ->latest()->get();

            $totalCredit = $selectedOffers->sum(function ($selectedOffer) {
                return $selectedOffer->offerList->course_credit ?? 0;
            });

            return view('panel.pages.dashboard', compact(['selectedOffers', 'sessions', 'selectedSession', 'totalCredit']));
        }
    }
}
