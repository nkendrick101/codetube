<?php

namespace App\Http\Controllers;

use Braintree\Customer;
use App\Models\Card;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    public static function findOrCreate($customer)
    {
        $customersIds = Card::select('customer_id')->get();

        if ($customersIds->count()) {
            foreach($customersIds as $result) {
                if ($customer = Customer::find($result->customer_id)) {
                    return $customer;
                }
            }
        }

        return Customer::create([
            'firstName' => $customer['firstName'],
            'lastName' => $customer['lastName'],
            'email' => $customer['email'],
        ])->customer;
    }
}
