<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentFinishController extends Controller
{
    public function __invoke(Request $request)
    {
        $status = $request->query('error') ? 'error' : 'success';
        return view('payment.finish', compact('status'));
    }
}
