<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function getCustomer()
    {
        // $customers = Customer::all();
        // $customers = Customer::orderBy("age")->get();
        $customers = Customer::where("age", 44)->where("name", "customer three")->get();
        // $customers = Customer::latest()->get();

        return view('customer', [
            "customers" => $customers
        ]);
    }
}
