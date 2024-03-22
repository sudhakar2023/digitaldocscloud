<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAwsSubscriptionRequest;
use App\Http\Requests\UpdateAwsSubscriptionRequest;
use App\Models\AwsSubscription;

class AwsSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAwsSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAwsSubscriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AwsSubscription  $awsSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(AwsSubscription $awsSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AwsSubscription  $awsSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(AwsSubscription $awsSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAwsSubscriptionRequest  $request
     * @param  \App\Models\AwsSubscription  $awsSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAwsSubscriptionRequest $request, AwsSubscription $awsSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AwsSubscription  $awsSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwsSubscription $awsSubscription)
    {
        //
    }
}
