<?php

namespace App\Http\Controllers\API;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Policies\ParcelPolicy;
use App\Http\Controllers\Api\ApiController;

class ParcelController extends ApiController
{
  protected $policyClass = ParcelPolicy::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcel $parcel)
    {
        //
    }
}
