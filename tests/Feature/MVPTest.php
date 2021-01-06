<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MVPTest extends TestCase
{

    public function testMVP()
    {
        $endPoint = 'api/winner';
        $response = $this->callApi($endPoint);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                    "MVP" => [
                        "Basketball" => [
                                "Name",
                                "NickName",
                                "ScoredPoints",
                                "Rebound",
                                "TotalPoints"
                        ],
                        "Handball" => [
                                "Name",
                                "NickName",
                                "GoalsMade",
                                "GoalsReceived",
                                "TotalPoints"
                        ],
                ]
            ]
        ]);
    }

    /**
     * Simulate call api
     *
     * @param string $endpoint
     * @param array $params
     * @param string $userMail
     *
     * @return mixed
     */
    protected function callApi($endpoint, $params = [], $userMail = null)
    {
        $headers = [];

        if (!is_null($userMail)) {
            $token = auth()->guard('api')
                ->login(User::whereEmail($userMail)->first());
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        return $this->getJson(
            $endpoint,
            $headers
        );
    }
}
