<?php

namespace Tests\Feature\Api;

use App\JobOffer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Queue\Jobs\Job;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobOfferControllerTest extends TestCase
{
    /**
     * Test if job offers display correctly.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('apiv1.jobOffers.index'))
            ->assertStatus(200)
            ->assertJsonStructure($this->standardJsonFormat);
    }

    public function testStore()
    {
        // Wygeneruj dane dla oferty pracy
        $factoryData = factory(JobOffer::class)->raw();

        // Zapisz wygenerowane dane w osobnej zmiennej
        $data = [
            'name'          => $factoryData['name'],
            'description'   => $factoryData['description'],
            'salary'        => $factoryData['salary'],
            'start_date'    => $factoryData['start_date'],
            'end_date'      => $factoryData['end_date'],
            'area_id'       => $factoryData['area_id'],
            'position_id'   => $factoryData['position_id'],
            'degree_id'     => $factoryData['degree_id'],
            'address_id'    => $factoryData['address_id'],
        ];

        // Prześlij wygenerowane dane na odpowiedni route
        $this->post(route('apiv1.jobOffers.store'), $data)
            ->assertJsonStructure($this->standardJsonFormat);

        // Sprawdź czy dane zostały zawarte w bazie
        $this->assertDatabaseHas('job_offers', [
            'name' => $factoryData['name']
        ]);
    }

    public function testUpdate()
    {
        $this->assertTrue(true);
//        $this->post(route('apiv1.jobOffers.store'), $data)
    }

    public function testDestroy()
    {
        // Utwórz testowy model
        factory(JobOffer::class)->create();

        // Połącz się przez metodę delete na odpowiedniego route i sprawdź zwrotkę
        $this->delete(route('apiv1.jobOffers.destroy',  1))
            ->assertJsonStructure([
                'message'
            ]);

        // Sprawdź, czy odpowiedni rekord został usunięty
        $this->assertSoftDeleted('job_offers', [
            'id' => 1
        ]);
    }
}
