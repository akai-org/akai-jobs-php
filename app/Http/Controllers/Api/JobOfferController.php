<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Requests\JobOfferIndexRequest;
use App\Http\Requests\StoreNewJobOfferRequest;
use App\Http\Requests\UpdateJobOfferRequest;
use App\JobOffer;
use App\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Auth;

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
     * @param StoreNewJobOfferRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreNewJobOfferRequest $request)
    {
        $user    = auth('api')->user();
        $newModelData = $request->toArray();
        $newModelData['company_id'] = $user->company_id;

        $jobOffer = JobOffer::createWithData($newModelData);

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
                'jobOffer' => $jobOffer->with(['position', 'company', 'address', 'area', 'degree'])
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobOfferRequest $request
     * @param  \App\JobOffer $jobOffer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateJobOfferRequest $request, JobOffer $jobOffer)
    {
        $user = auth('api')->user();
        $jobOffer = $jobOffer->fillWithData($request->toArray());
        dd($request->toArray());
        return response([
            'message' => __('Pomyślnie zaktualizowano ofertę pracy'),
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
