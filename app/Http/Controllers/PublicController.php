<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $publicInformationRequests = PublicInformationRequest::where('user_id', $user->id)->count();
        $objections = Objection::where('user_id', $user->id)->count();
        $whistles = Whistle::where('user_id', $user->id)->count();

        return view('public.dashboard.index', compact('publicInformationRequests', 'objections', 'whistles'));
    }
    public function showPublicInformationRequests()
    {
        $user = Auth::user();
        $requests = PublicInformationRequest::where('user_id', $user->id)->get();
        return view('public.informasi.index', compact('requests'));
    }
    public function showPublicInformationRequest(PublicInformationRequest $request)
    {
        return view('public.informasi.detail', compact('request'));
    }
    public function showObjections()
    {
        $user = Auth::user();
        $objections = Objection::where('user_id', $user->id)->get();
        return view('public.keberatan.index', compact('objections'));
    }
    public function showObjection(Objection $objection)
    {
        return view('public.keberatan.detail', compact('objection'));
    }
    public function showWhistles()
    {
        $user = Auth::user();
        $whistles = Whistle::where('user_id', $user->id)->get();
        return view('public.whistle.index', compact('whistles'));
    }
    public function showWhistle(Whistle $whistle)
    {
        return view('public.whistle.detail', compact('whistle'));
    }
    public function fromStoreRequest(Request $request)
    {
        return view('public.informasi.create');
    }
    public function fromStoreObjection(Request $request)
    {
        return view('public.keberatan.create');
    }
    public function fromStoreWhistle(Request $request)
    {
        return view('public.whistle.create');
    }    
}
