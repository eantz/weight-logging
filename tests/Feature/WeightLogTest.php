<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\WeightLog;
use DB;

class WeightLogTest extends TestCase
{
    use RefreshDatabase;

    protected $currentUser;

    public function setUp()
    {
        parent::setUp();

        $this->currentUser = factory(User::class)->create();
    }

    public function testWeightLogList()
    {
        $weightLogs = factory(WeightLog::class, 4)->create([
            'user_id' => $this->currentUser->id
        ]);

        $response = $this->actingAs($this->currentUser)
                        ->get('/weight-log');

        $response->assertStatus(200)
            ->assertSee('Average');
    }

    public function testInsertWeightLog()
    {
        $data = [
            'log_date'  => date('Y-m-d'),
            'min'   => 49,
            'max'   => 52
        ];

        $response = $this->actingAs($this->currentUser)
            ->post(route('weight-log.store'), $data);

        $weightLog = WeightLog::where('user_id', $this->currentUser->id)
            ->where('log_date', $data['log_date'])
            ->first();

        $this->assertEquals($data['min'], $weightLog->min);
        $this->assertEquals($data['max'], $weightLog->max);
        $this->assertEquals($data['max']-$data['min'], $weightLog->variance);

        $response->assertRedirect(route('weight-log.index'));
    }

    public function testUpdateWeightLog()
    {
        $weightLogFake = factory(WeightLog::class)->create([
            'user_id' => $this->currentUser->id
        ]);

        $data = [
            '_method'   => 'PUT',
            'min'       => 49,
            'max'       => 52 
        ];

        $response = $this->actingAs($this->currentUser)
            ->post(route('weight-log.update', $weightLogFake), $data);

        $response->assertRedirect(route('weight-log.index'))
            ->assertSessionHas('message', 'Data updated successfully');
    }

    public function testDeleteWeightLog()
    {
        $weightLogFake = factory(WeightLog::class)->create([
            'user_id' => $this->currentUser->id
        ]);

        $response = $this->actingAs($this->currentUser)
            ->post(route('weight-log.destroy', $weightLogFake), ['_method'=>'DELETE']);

        $weightLog = WeightLog::find($weightLogFake->id);

        $this->assertNull($weightLog);

        $response->assertRedirect(route('weight-log.index'))
            ->assertSessionHas('message', 'Data deleted successfully');
    }
}
