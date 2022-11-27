<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth");
    // }
    //
    public function getCustomer()
    {
        $customers = Customer::all();
        // $customers = Customer::orderBy("age")->get();
        // $customers = Customer::where("age", 44)->where("name", "customer three")->get();
        // $customers = Customer::latest()->get();

        return view('customer.all', [
            "customers" => $customers,
        ]);
    }

    public function getCustomerById($id)
    {
        // $customer = Customer::find($id);
        $customer = Customer::findOrFail($id);

        return view("customer.each", [
            "customer" => $customer,
            "id" => $id,
        ]);
    }
    public function toCreate()
    {
        return view("customer.add");
    }

    public function create()
    {
        $customer = new Customer();
        $customer->name = request("name");
        $customer->age = request("age");
        $customer->country = request("country");
        $customer->password = request("password");
        $customer->hobbies = request("hobbies");

        $customer->save();
        $id = $customer->id;
        return redirect('/customer')->with('message', "$id Customer added");
    }
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('/customer')->with('message', "Customer deleted");
    }
}
