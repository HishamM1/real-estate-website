<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('view', $listing);
        $request->validate([
            'amount' => 'required|integer|min:1|max:1000000000',
        ]);

        $offer = $listing->offers()->create([
            'amount' => $request->amount,
            'bidder_id' => $request->user()->id,
        ]);

        $listing->user->notify(new OfferMade($offer));

        return redirect()->back()->with('success', 'Offer sent!');
    }
}
