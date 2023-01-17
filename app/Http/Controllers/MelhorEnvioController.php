<?php

namespace App\Http\Controllers;

use App\Models\MelhorEnvio;
use App\Http\Requests\StoreMelhorEnvioRequest;
use App\Http\Requests\UpdateMelhorEnvioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MelhorEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMelhorEnvioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMelhorEnvioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MelhorEnvio  $melhorEnvio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


        $setup = MelhorEnvio::find(1);
        $token = $setup->token;
        $cep_origem = $setup->cep_origem;
        $products = [];

        foreach ($request->products as $key => $value) {
            # code...
            // $products[$key] = json_decode($value);
            array_push($products, json_decode($value));
        }


        $products = json_encode($products);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://melhorenvio.com.br/api/v2/me/shipment/calculate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"from\": {\n        \"postal_code\": \"" . $cep_origem . "\"\n    },\n    \"to\": {\n        \"postal_code\": \"" . $request->cep . "\"\n    },\n    \"products\": " . $products . " }",
            // CURLOPT_COOKIE => "SSO-IDENTIFIER=eyJpdiI6InJcL2ljZ3ZIdVIxT1ZHT1pvV3BUeUtRPT0iLCJ2YWx1ZSI6IkpERGZWSFpBUWRuV2hGbXFpcnVidDlUSHlKdVZ5c0ZoQ0srd3F0d1l5bjVtNFk5MGxIV0JGXC8wdEZpbWFJK0tHTWlnc015c2czMHVZcHhMOTl3UFJValZld2ZuVE5DV29oemt5UFhSWm5aaz0iLCJtYWMiOiIwOGExMmUzNjAwNzA2MTY3NmE5YjBiNWY5NmIzNDk3YzZlZDBkMjk2MWZmN2VmMDAyOTY3ODZjMTZiMTVlMjU1In0%253D; AUTH_TOKEN=eyJpdiI6InBqUnM5b0o1YWd2ZGhNTVNBc0NDZ0E9PSIsInZhbHVlIjoiUExMNWFpWnh6Rys5NE5JXC82ZjlYUk1iMWRFNWdMM1doVmk0ckFXMGRac3FrRnNGT1dINkdpZ3VZcXZ0WlFwSnFyNHFaSmRCN09XMmxDMWlFQ21pb0N0NXE0eU5DSVk1aWJBYlVEaDJwcDhNcHFIeGtNSlhYelFrWVAzM0JJZkYxODVMVmIyYzdLY3pXNWdoXC9PY3M3XC9OTyttcFZweUN4ZFhWTkZKbVFCOEkwTGJGeGpsVE9ZcStZMGlKa09sUzR4IiwibWFjIjoiZDk4YjVjNjkyYjEzMDFkYjBiOGE4ZjQxZmZmODU1NjhlMzk3YWRlNjQ1ZmM1ZTdhMDIzMGZhNmE4Zjk2ODk3NSJ9; XSRF-TOKEN=eyJpdiI6ImdTYzlxRkExY0dQbmVJcEtKK21DUGc9PSIsInZhbHVlIjoiWDJEWWN1emxIdFl0MEdcL29ZZGRCc3k3VU9mV2Nqb1wvVzBNNytXbjBTNEJIajIxa3NFVzlUSzZaazE1NkFJbGlZIiwibWFjIjoiMTFmNDJiNGE0MTJjNDA4MDk2OThiY2YxNjQwNGYyMjU3MzkzNDhhY2IwMmE1YjU4ZmRjNzhjMDY5MzM1YmQyOCJ9; ME-AUTH-WEB=eyJpdiI6ImtScG5xd0pYNlllbTZNZmtwZjdCN1E9PSIsInZhbHVlIjoiWGtPbkFoNlZsRU1CNFltOHJpOFRjOHNjMGpaa3orZHFhZWt6OXFNNFp1OXBsOHYxQjJERGtmaTFcL3hQXC9KeFZFIiwibWFjIjoiZDcwNDQ4MWM2NzM4YzBkNzkzOWQxYzg3NTg2Y2JiNDlhMjZmNTA4ZDcxNDYxMDY1Y2RjYTg1ODQ4NDhmOGIyMyJ9",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $token
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json($err, 500);
        } else {
            // $response = str_replace("\u0000", "", $response);
            return response()->json($response, 200);
        }
    }

    public function product(Request $request)
    {
      
        //  print_r($request->all());
        //  exit;
        $setup = MelhorEnvio::find(1);
        $token = $setup->token;
        $cep_origem = $setup->cep_origem;
        $products = json_encode($request->products);
    // print_r($products);
    //      exit;
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://melhorenvio.com.br/api/v2/me/shipment/calculate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"from\": {\n        \"postal_code\": \"" . $cep_origem . "\"\n    },\n    \"to\": {\n        \"postal_code\": \"" . $request->cep . "\"\n    },\n    \"products\": [" . $products . "] }",
            // CURLOPT_COOKIE => "SSO-IDENTIFIER=eyJpdiI6InJcL2ljZ3ZIdVIxT1ZHT1pvV3BUeUtRPT0iLCJ2YWx1ZSI6IkpERGZWSFpBUWRuV2hGbXFpcnVidDlUSHlKdVZ5c0ZoQ0srd3F0d1l5bjVtNFk5MGxIV0JGXC8wdEZpbWFJK0tHTWlnc015c2czMHVZcHhMOTl3UFJValZld2ZuVE5DV29oemt5UFhSWm5aaz0iLCJtYWMiOiIwOGExMmUzNjAwNzA2MTY3NmE5YjBiNWY5NmIzNDk3YzZlZDBkMjk2MWZmN2VmMDAyOTY3ODZjMTZiMTVlMjU1In0%253D; AUTH_TOKEN=eyJpdiI6InBqUnM5b0o1YWd2ZGhNTVNBc0NDZ0E9PSIsInZhbHVlIjoiUExMNWFpWnh6Rys5NE5JXC82ZjlYUk1iMWRFNWdMM1doVmk0ckFXMGRac3FrRnNGT1dINkdpZ3VZcXZ0WlFwSnFyNHFaSmRCN09XMmxDMWlFQ21pb0N0NXE0eU5DSVk1aWJBYlVEaDJwcDhNcHFIeGtNSlhYelFrWVAzM0JJZkYxODVMVmIyYzdLY3pXNWdoXC9PY3M3XC9OTyttcFZweUN4ZFhWTkZKbVFCOEkwTGJGeGpsVE9ZcStZMGlKa09sUzR4IiwibWFjIjoiZDk4YjVjNjkyYjEzMDFkYjBiOGE4ZjQxZmZmODU1NjhlMzk3YWRlNjQ1ZmM1ZTdhMDIzMGZhNmE4Zjk2ODk3NSJ9; XSRF-TOKEN=eyJpdiI6ImdTYzlxRkExY0dQbmVJcEtKK21DUGc9PSIsInZhbHVlIjoiWDJEWWN1emxIdFl0MEdcL29ZZGRCc3k3VU9mV2Nqb1wvVzBNNytXbjBTNEJIajIxa3NFVzlUSzZaazE1NkFJbGlZIiwibWFjIjoiMTFmNDJiNGE0MTJjNDA4MDk2OThiY2YxNjQwNGYyMjU3MzkzNDhhY2IwMmE1YjU4ZmRjNzhjMDY5MzM1YmQyOCJ9; ME-AUTH-WEB=eyJpdiI6ImtScG5xd0pYNlllbTZNZmtwZjdCN1E9PSIsInZhbHVlIjoiWGtPbkFoNlZsRU1CNFltOHJpOFRjOHNjMGpaa3orZHFhZWt6OXFNNFp1OXBsOHYxQjJERGtmaTFcL3hQXC9KeFZFIiwibWFjIjoiZDcwNDQ4MWM2NzM4YzBkNzkzOWQxYzg3NTg2Y2JiNDlhMjZmNTA4ZDcxNDYxMDY1Y2RjYTg1ODQ4NDhmOGIyMyJ9",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $token
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json($err, 500);
        } else {
            // $response = str_replace("\u0000", "", $response);
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MelhorEnvio  $melhorEnvio
     * @return \Illuminate\Http\Response
     */
    public function edit(MelhorEnvio $melhorEnvio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMelhorEnvioRequest  $request
     * @param  \App\Models\MelhorEnvio  $melhorEnvio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMelhorEnvioRequest $request, MelhorEnvio $melhorEnvio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MelhorEnvio  $melhorEnvio
     * @return \Illuminate\Http\Response
     */
    public function destroy(MelhorEnvio $melhorEnvio)
    {
        //
    }
}
