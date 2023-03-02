<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom',
            'priceTo',
            'beds',
            'baths',
            'areaFrom',
            'areaTo'
        ]);

        return inertia('Listings/Index', [
            'filters' => $filters,
            'listings' => Listing::orderByDesc('created_at')
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
        ]);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->where('bidder_id', Auth::user()->id)->first();
        return inertia('Listings/Show', [
            'listing' => $listing,
            'offerMade' => $offer,
        ]);
    }
}
