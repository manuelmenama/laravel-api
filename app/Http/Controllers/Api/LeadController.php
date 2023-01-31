<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        //verificare i dati

        //salvare nel db

        //inviare email


        return response()->json($data);
    }
}
