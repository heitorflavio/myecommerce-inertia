<?php

namespace App\Http\Controllers;

use App\Models\Pagseguro;
use App\Http\Requests\StorePagseguroRequest;
use App\Http\Requests\UpdatePagseguroRequest;
use Illuminate\Http\Request;

class PagseguroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function boleto(Request $request)
    {

        $pag = Pagseguro::where('id', 1)->first();
        $token = $pag->token;
        $email = $pag->email;
        $date = mktime(0, 0, 0, date("Y"), date("m"),  date("d") + 1);;



        // $curl = curl_init();
        // curl_setopt_array($curl, [
        //     CURLOPT_URL => "https://ws.pagseguro.uol.com.br/recurring-payment/boletos?email=" . $email . "&token=" . $token . "",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => "{\n\t\"reference\": \"teste\",\n\t\"firstDueDate\": \"2022-12-20\",\n\t\"numberOfPayments\": 1,\n\t\"periodicity\": \"monthly\",\n\t\"amount\": \"10.00\",\n\t\"description\": \"teste\",\n\t\"customer\": {\n\t\t\"document\": {\n\t\t\t\"type\": \"CPF\",\n\t\t\t\"value\": \"03552036695\"\n\n\t\t},\n\t\t\t\"email\": \"keila.lelis@yahoo.com\",\n\t\t\t\"name\": \"keila lelis flavio\",\n\t\t\t\"phone\": {\n\t\t\t\t\"areaCode\": \"38\",\n\t\t\t\t\"number\": \"999727769\"\n\t\t\t}\n\t\t\n\t\t\n\t}\n}",
        //     CURLOPT_HTTPHEADER => [
        //         "Content-Type: application/json"
        //     ],
        // ]);

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
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
     * @param  \App\Http\Requests\StorePagseguroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagseguroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagseguro  $pagseguro
     * @return \Illuminate\Http\Response
     */
    public function show(Pagseguro $pagseguro)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagseguro  $pagseguro
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagseguro $pagseguro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagseguroRequest  $request
     * @param  \App\Models\Pagseguro  $pagseguro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagseguroRequest $request, Pagseguro $pagseguro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagseguro  $pagseguro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagseguro $pagseguro)
    {
        //
    }
}
