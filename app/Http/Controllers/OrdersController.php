<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $customer =  DB::table('customers')->where('user_id', $user->id)->first();
        $payments = DB::table('payments')->where('status', 1)->get();
        // print_r($customer);
        // exit;
        return Inertia::render('FinishOrder', [
            'payment' => $payments,
            'user' => $customer,
            'products' => $request->products,
            'cep' => $request->cep,
            'frete' => $request->frete,
        ]);
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
     * @param  \App\Http\Requests\StoreOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $customer =  DB::table('customers')->where('user_id', $user->id)->first();
        $cart = DB::table('carts')->where('hash', $customer->cart)->first();
        $cart_products = DB::table('cart_products')->where('cart_id', $cart->id)->get();

        $total = 0;
        foreach ($cart_products as $key => $value) {
            $total += $value->price * $value->quantity;
        }

        $orders = Orders::create([
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => $customer->phone,
            'customer_address' => $customer->address,
            'customer_city' => $customer->city,
            'customer_state' => $customer->state,
            'customer_zip' => $customer->zip,
            'customer_country' => $customer->district,
            'customer_notes' => "teste",
            'total' => $total,
            'valor_frete'   => $request->valor_frete,
            'frete_status'  => 1,
            'frete' => $request->frete,
            'payment_method' => $request->payment_method,
            'payment_status' => 1,
            
        ]);

        foreach ($cart_products as $key => $value) {
            $this->downsInventories($value->product_id, $value->quantity);
            $ordersProducts = DB::table('orders_products')->insert([
                'order_id' => $orders->id,
                'product_id' => $value->product_id,
                'description' => 'teste',
                'price' => $value->price,
                'quantity' => $value->quantity,
                'image' => $value->image,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return response()->json($orders);
    }

   public function downsInventories($id, $value){
        $product = DB::table('products')->where('id', $id)->first();
        $product->stock = $product->stock - $value;
        DB::table('products')->where('id', $id)->update(['stock' => $product->stock]);
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersRequest  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
