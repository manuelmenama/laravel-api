<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $success = true;

        //verificare i dati
        $validator = Validator::make($data,
            [

                "name" => "required|min:3|max:255",
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
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        //inviare email
        Mail::to('manuel@info.com')->send(new NewContact($new_lead));


        return response()->json(compact('success'));
    }
}
