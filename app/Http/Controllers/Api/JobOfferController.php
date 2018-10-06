<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JobOfferIndexRequest;
use App\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobOfferIndexRequest $request)
    {

        // TODO zrób JobOffer validation
        // TODO sortowanie

        $jobOffers = JobOffer::query();

        if(isset($request['min_salary']))
            $jobOffers->where('salary', '>', $request['min_salary']);

        if(isset($request['max_salary']))
            $jobOffers->where('salary', '<', $request['max_salary']);

        if(isset($request['positions']))
            $jobOffers->whereIn('position_id', $request['positions']);

        if(isset($request['degrees']))
            $jobOffers->whereIn('degree_id', $request['degrees']);

        if(isset($request['min_start_date']))
            $jobOffers->where('start_date', '>',$request['min_start_date']);

        if(isset($request['max_start_date']))
            $jobOffers->where('start_date', '<', $request['max_start_date']);

        if(isset($request['min_end_date']))
            $jobOffers->where('end_date', $request['min_end_date']);

        if(isset($request['max_end_date']))
            $jobOffers->where('end_date', $request['max_end_date']);

        if(isset($request['keyword']))
            $jobOffers->where('name', 'like', '%'.$request['keyword'].'%')->orWhere('description', 'like', '%'.$request['description'].'%');

        $jobOffers->paginate(30);

        // TODO forma response - zgapić z Geberita
        return response([
            'message' => __('Pomyślnie pobrano wszystkie oferty pracy'),
            'data' => [
                'jobOffers' => $jobOffers
            ]
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function show(JobOffer $jobOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOffer $jobOffer)
    {
        //
    }
}
