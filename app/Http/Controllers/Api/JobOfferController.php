<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JobOfferIndexRequest;
use App\Http\Requests\StoreNewJobOfferRequest;
use App\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param JobOfferIndexRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(JobOfferIndexRequest $request)
    {
        $query = JobOffer::applyFilters($request);

        // Pobranie tabeli, paginacja i zwrotka
        $pagination = $request['pagination'] ?? 15;
        $query = $query->orderBy('created_at', 'desc')->paginate($pagination);
        $query = collect($query->toArray());

        return response([
            'message' => __('Pomyślnie pobrano wszystkie oferty pracy'),
            'data' => [
                'jobOffers' => $query['data']
            ],
            'pagination' => $query->except(['data'])
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreNewJobOfferRequest $request)
    {
        // TODO walidacja całego store job offers, również składowych adresu

        return response([
            'message' => __('Pomyślnie utworzono nową ofertę pracy'),
            'data' => [
                'jobOffer' => $jobOffer
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobOffer $jobOffer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(JobOffer $jobOffer)
    {

        return response([
            'message' => __('Pomyślnie utworzono nową ofertę pracy'),
            'data' => [
                'jobOffer' => $jobOffer
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\JobOffer $jobOffer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request, JobOffer $jobOffer)
    {

        return response([
            'message' => __('Pomyślnie utworzono nową ofertę pracy'),
            'data' => [
                'jobOffer' => $jobOffer
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobOffer $jobOffer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();
        return response([
            'message' => __('Pomyslnie usunięto wskazaną ofertę pracy')
        ]);
    }
}
