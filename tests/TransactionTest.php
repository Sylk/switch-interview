<?php

use Illuminate\Http\Response;

class TransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_handles_correct_cash()
    {
        $response = $this->json('POST','/api/transaction', ['checkout' => 50, 'tendered' => 103.50])
            ->seeJsonEquals([
                "hundreds" => 1,
                "fifties" => 0,
                "twenties" => 0,
                "tens" => 0,
                "fives" => 0,
                "ones" => 3,
                "quarters" => 2,
                "dimes" => 0,
                "nickles" => 0,
                "pennies" => 0
            ]);

        $response->assertResponseStatus(Response::HTTP_OK);
    }

    /**
     * Checks to make sure when the improper amount of cash is given that it returns a 400.
     *
     * @return void
     */
    public function test_handles_incorrect_cash()
    {
        $response = $this->json('POST','/api/transaction', ['checkout' => 50, 'tendered' => 3.50]);

        $response->assertResponseStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * Checks to make sure when the passing through nulls that it returns a 400.
     *
     * @return void
     */
    public function test_handles_null_values()
    {
        $response = $this->json('POST','/api/transaction', ['checkout' => null, 'tendered' => null]);

        $response->assertResponseStatus(Response::HTTP_BAD_REQUEST);
    }
}
