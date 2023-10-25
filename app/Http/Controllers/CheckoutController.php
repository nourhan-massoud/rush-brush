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
        $validatedData = $request->validate([
            'customer_name' => 'required|string',
            'product_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
            'price' => 'required|numeric',
            'total_amount' => 'required|numeric',
            // Add other validation rules as per your requirements
        ]);

        // Store the order in the session
        $order = [
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['product_id'],
            'customer_name' => $validatedData['customer_name'],
            'price' => $validatedData['price'],
            'total_amount' => $validatedData['total_amount'],
            // Set other fields as needed
        ];

        $request->session()->put('order', $order);

        // Retrieve the order from the session
        $order = $request->session()->get('order');

        // // Create a new order in the database
        Order::create([
            'customer_name' => $request->input('customer_name'),
            'total_amount' => $request->input('total_amount'),
            'price' => $request->input('price'),
            'product_id' => $request->input('product_id'),
            'customer_id' => $request->input('customer_id'),
            'status' => 'pending',
        ]);

        // if ($validatedData->fails()) {
        //     return response()->json(['error' => $validatedData->errors()], 400);
        // }

        // Return a response
        return response()->json(['message' => 'Checkout successful',"order" => $order]);
    }

    public function getOrder(Request $request)
    {
        // Retrieve the order from the session
        $order = $request->session()->get('order');

        // Return the order in the response
        return response()->json(['order' => $order]);
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