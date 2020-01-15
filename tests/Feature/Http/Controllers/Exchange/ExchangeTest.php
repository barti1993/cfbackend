<?php

namespace Tests\Feature\Http\Controllers\Exchange;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExchangeTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function users_can_access_the_endpoint_for_the_exchange_requests_list()
    {
        $response = $this->withHeaders([
            'api-key' => 'ABC'           
        ])->json('GET', '/showexchanges', [             
             
        ])->assertStatus(200);
    }  
    
  
    
    /**
     * @test
     */
    public function userId_cannot_be_string()
    {
        
        $response = $this->withHeaders([
            'api-key' => 'ABC'           
        ])->json('POST', '/api/exchange', [
             'userId'=>'dsdsadsa',
             'currencyFrom' => 'PLN',
             'currencyTo' => 'EUR',
             'amountSell' => 3000.35,
             'amountBuy' => 2000.34,
             'rate' => 0.232,
             'timePlaced' => '24-JAN-18 10:27:44',
             'originatingCountry' => 'FR'
             
        ])->assertStatus(400)->assertExactJson([
                'userId' => [
                        'The user id must be an integer.'
                ]                
      ]);
    }
        
        
        
    /**
    * @test
    */
    public function can_request_userId_be_negative()
    {
        
        $response = $this->withHeaders([
            'api-key' => 'ABC'           
        ])->json('POST', '/api/exchange', [
             'userId'=>'-200',
             'currencyFrom' => 'PLN',
             'currencyTo' => 'EUR',
             'amountSell' => 3000.35,
             'amountBuy' => 2000.34,
             'rate' => 0.232,
             'timePlaced' => '24-JAN-18 10:27:44',
             'originatingCountry' => 'FR'
             
        ])->assertStatus(400)->assertExactJson([
                    'userId' => [
                        'The user id must be greater than 0.'
                    ]                
      ]);
        

    }
    
    /**
     * @test
     */
    public function can_create_a_request_in_database()
    {
        
        $response = $this->withHeaders([
            'api-key' => 'ABC'           
        ])->json('POST', '/api/exchange', [
             'userId' => $userid = random_int(1,100),
             'currencyFrom' => 'PLN',
             'currencyTo' => 'EUR',
             'amountSell' => 3000.35,
             'amountBuy' => 2000.34,
             'rate' => 0.232,
             'timePlaced' => '24-JAN-18 10:27:44',
             'originatingCountry' => 'FR'
             
        ])->assertStatus(201)->assertJsonStructure([
            'userId',
            'currencyFrom',
            'currencyTo',
            'amountSell',
            'amountBuy',
            'rate',
            'timePlaced',
            'originatingCountry'
        ]);
        
    }
        
    /**
    * @test
    */
    public function not_able_to_access_api_without_token()
    {
        
        $response = $this->json('POST', '/api/exchange', [
             'userId' => $userid = random_int(1,100),
             'currencyFrom' => 'PLN',
             'currencyTo' => 'EUR',
             'amountSell' => 3000.35,
             'amountBuy' => 2000.34,
             'rate' => 0.232,
             'timePlaced' => '24-JAN-18 10:27:44',
             'originatingCountry' => 'FR'
             
        ])->assertStatus(401);
        
    }
    
    
    
    
    
    /**
    * @test
    */
    public function not_able_to_access_api_with_incorrect_token()
    {
        
        $response = $this->withHeaders([
            'api-key' => 'ABCdsadsadsada'           
        ])->json('POST', '/api/exchange', [
             'userId' => $userid = random_int(1,100),
             'currencyFrom' => 'PLN',
             'currencyTo' => 'EUR',
             'amountSell' => 3000.35,
             'amountBuy' => 2000.34,
             'rate' => 0.232,
             'timePlaced' => '24-JAN-18 10:27:44',
             'originatingCountry' => 'FR'
             
        ])->assertStatus(401);
        
    }
}
