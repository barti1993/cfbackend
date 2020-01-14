<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exchanges Request Showcase</title>
   
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

</head>
<body>
    <h1>List of exchanges request</h1>
    @foreach($exchanges as $exchange)
    <p>{{$exchange->id}}. Request created at {{$exchange->created_at}}</p> 
    <table>
        <tr>
          <th>Param name</th>
          <th>Value</th>
        </tr>
        <tr>
            <td>userId</td>
            <td>{{$exchange->userId}}</td>
        </tr>
        <tr>
            <td>currencyFrom</td>
            <td>{{$exchange->currencyFrom}}</td>
        </tr>
        <tr>
            <td>currencyTo</td>
            <td>{{$exchange->currencyTo}}</td>
        </tr>
        <tr>
            <td>amountSell</td>
            <td>{{$exchange->amountSell}}</td>
        </tr>
        <tr>
            <td>amountBuy</td>
            <td>{{$exchange->amountBuy}}</td>
        </tr>
        <tr>
            <td>rate</td>
            <td>{{$exchange->rate}}</td>
        </tr>
        <tr>
            <td>timePlaced</td>
            <td>{{strtoupper(Carbon\Carbon::parse($exchange->timePlaced)->format('d-M-y H:i:s'))}}</td>
        </tr>
        <tr>
            <td>originatingCountry</td>
            <td>{{$exchange->originatingCountry}}</td>
        </tr>
    </table>
    </br>
    @endforeach
  
</body>