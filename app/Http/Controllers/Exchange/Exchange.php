<?php

namespace App\Http\Controllers\Exchange;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ExchangeModel;
use Validator;





class Exchange extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return the view which contains list of successful POSTed requests
        $exchanges = ExchangeModel::all();

        if(is_null($exchanges)){
             return response()->json(["message" => 'No exchanges posted!'], 404);
        }

        return view('exchange.exchange', compact('exchanges'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json(["message" => 'Method not defined!'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $request['timePlaced'] = $this->capitalizeDateFormat($request['timePlaced']);

        // Request's Validation rules 
        $rules = [
           'userId'=>'bail|required|integer|gt:0',
           'currencyFrom' =>'bail|required|string|regex:/^[A-Z]+$/|max:3',
           'currencyTo'=>'bail|required|string|regex:/^[A-Z]+$/|max:3',
           'amountSell'=>'bail|required|regex:/^(?!0\d)\d+(?:\.\d{1,2})?$/|numeric|gt:0',
           'amountBuy'=>'bail|required|regex:/^(?!0\d)\d+(?:\.\d{1,2})?$/|numeric|gt:0',
           'rate'=>'bail|required|regex:/^\d*(\.\d{1,4})?$/|lt:1|gt:0',
           'timePlaced'=>'bail|required|date_format:d-M-y H:i:s',
           'originatingCountry'=>'required|string|regex:/^[A-Z]+$/|max:2',
        ];

        // Validate data that comes from the request
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            // Returns json response 400 (Bad request)
            return response()->json($validator->errors(), 400);
        }

        // Dealing with uppercase month format
        $request['timePlaced'] = strtoupper(Carbon::createFromFormat('d-M-y H:i:s', $request['timePlaced']));

        // Save validated request to database
        $request = ExchangeModel::create($request->all());
        // Returns json response - 201 (Created)
        return response()->json($request, 201);
    }



    public function capitalizeDateFormat($dateToCapitalize){
        $dateToCapitalize = explode('-',$dateToCapitalize);
        $dateToCapitalize[1] = ucfirst(strtolower($dateToCapitalize[1]));
        $dateToCapitalize = implode('-',$dateToCapitalize);
        return $dateToCapitalize;
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         return response()->json(["message" => 'Method not defined!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return response()->json(["message" => 'Method not defined!'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return response()->json(["message" => 'Method not defined!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return response()->json(["message" => 'Method not defined!'], 404);
    }
}
