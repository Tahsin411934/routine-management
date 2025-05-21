<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedOfferList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offer_list_id',
        'priority',
    ];

    public function offerList()
    {
        return $this->belongsTo(OfferList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
