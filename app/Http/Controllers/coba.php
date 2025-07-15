<?php

namespace App\Http\Controllers;
use App\Mail\cobaemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class coba extends Controller
{
    public function index()
    {
        Mail::to('nazarfadil111@gmail.com')->send(new cobaemail());
        return response()->json([
            'message' => 'Email sent successfully!'
        ]);
    }
}
