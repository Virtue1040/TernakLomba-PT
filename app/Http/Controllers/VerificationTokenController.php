<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreverificationTokenRequest;
use App\Http\Requests\UpdateverificationTokenRequest;
use App\Models\verificationToken;

class VerificationTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreverificationTokenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(verificationToken $verificationToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(verificationToken $verificationToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateverificationTokenRequest $request, verificationToken $verificationToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(verificationToken $verificationToken)
    {
        //
    }
}
