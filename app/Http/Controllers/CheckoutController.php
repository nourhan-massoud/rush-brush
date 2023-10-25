<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\product;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
        ]);

        // Create a new order in the database
        $order = Order::create([
            'customer_name' => $request->input('customer_name'),
            'total_amount' => $request->input('total_amount'),
            'status' => 'pending',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Return a response
        return response()->json(['message' => 'Checkout successful',"order" => $order]);
    }

    public function listorders(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        /// List the products logic
        $orders = Order::all();

        // Return a response
        return response()->json(['message' => 'successful',"orders" => $orders]);
    }

    public function productlist(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        /// List the products logic
        $products = product::all();


        // Return a response
        return response()->json(['message' => 'successful',"products" => $products]);
    }

}