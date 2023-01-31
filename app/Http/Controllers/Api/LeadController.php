<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $success = true;

        //verificare i dati
        $validator = Validator::make($data,
            [

                "object" => "required|min:3|max:255",
                "email" => "required|email|max:255",
                "subject" => "required|min:5",

            ],
            [
                //secondo oggetto per i dati personalizzati
            ]
        );
        if($validator->fails()){

            $errors = $validator->errors();
            $success = false;

            return response()->json(compact('errors', 'success'));

        }
        //salvare nel db

        //inviare email


        return response()->json($data);
    }
}
