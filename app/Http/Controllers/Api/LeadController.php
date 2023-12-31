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
    public function store(Request $request)
    {
        $data = $request->all();

        // validazione dei dati inseriti
        $validator = Validator::make($data, [
            'name' => ['required', 'max:150'],
            'email' => ['required', 'email', 'max:200'],
            'messaggio' => ['required']
        ]);

        // se i dati non sono validi restitusco gli errori con success false 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to('francescoasdf3124@gmail.com')->send(new NewContact($new_lead));

        return response()->json([
            'success' => true,
            'respose' => $request
        ]);
    }
}
