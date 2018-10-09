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

        $query = JobOffer::query();

        // Stosowanie filtrów
        if(isset($request['min_salary']))
            $query->where('salary', '>', $request['min_salary']);

        if(isset($request['max_salary']))
            $query->where('salary', '<', $request['max_salary']);

        if(isset($request['positions']))
            $query->whereIn('position_id', $request['positions']);

        if(isset($request['degrees']))
            $query->whereIn('degree_id', $request['degrees']);

        if(isset($request['min_start_date']))
            $query->where('start_date', '>',$request['min_start_date']);

        if(isset($request['max_start_date']))
            $query->where('start_date', '<', $request['max_start_date']);

        if(isset($request['min_end_date']))
            $query->where('end_date', $request['min_end_date']);

        if(isset($request['max_end_date']))
            $query->where('end_date', $request['max_end_date']);

        if(isset($request['keyword']))
            $query->where('name', 'like', '%'.$request['keyword'].'%')->orWhere('description', 'like', '%'.$request['description'].'%');

        // Pobranie tabeli, paginacja i zwrotka
        $pagination = $request['pagination'] ?? 15;
        $query = $query->orderBy('created_at', 'desc')->with(['eventType'])->paginate($pagination);
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
    public function store(Request $request)
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
     * @return void
     */
    public function show(JobOffer $jobOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\JobOffer $jobOffer
     * @return void
     */
    public function update(Request $request, JobOffer $jobOffer)
    {
        //
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
