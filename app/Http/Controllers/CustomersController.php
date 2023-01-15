<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Http\Requests\StoreCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomersRequest $request)
    {
        //
        $pass = bcrypt($request->password);
        // $user = DB::table('users')->create([
        //     'name' => $request->name.' '.$request->lastname,
        //     'email' => $request->email,
        //     'email_verified_at' => null,
        //     'password' => $pass,
        //     'two_factor_secret' => null,
        //     'two_factor_recovery_codes' => null,
        //     'two_factor_confirmed_at' => null,
        //     'remember_token' => null,
        // ]);

        $user = DB::table('users')->insert([
            'name' => $request->name . ' ' . $request->lastname,
            'email' => $request->email,
            'email_verified_at' => null,
            'password' => $pass,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'remember_token' => null,
        ]);

        $customers = Customers::create([
            'name' => $request->name . ' ' . $request->lastname,
            'email' => $request->email,
            'document' => $request->document,
            'phone' => $request->phone,
            'address' => $request->st,
            'number' => $request->number,
            'district' => $request->district,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        
       return Inertia::location('/login');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomersRequest  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomersRequest $request, Customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers)
    {
        //
    }
}
