<?php

namespace App\Http\Controllers;
use App\Models\Galleries;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use App\Models\PublicInformation;
use App\Models\User;
use App\Http\Resource\PublicInformationRequestResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalPublicInformationRequest = PublicInformationRequest::count();
        $totalObjection = Objection::count();
        $totalWhistle = Whistle::count();
        $totalRequest = PublicInformationRequest::count() + Objection::count() + Whistle::count();
        return view('admin.Dashboard.index', compact('totalPublicInformationRequest', 'totalObjection', 'totalWhistle', 'totalRequest'));
    }
    public function galleries(){
        $totalGalleries = Galleries::count();
        $galleries = Galleries::all();
        return view('admin.Gallery.index', compact('galleries', 'totalGalleries'));
    }
    public function publicInformation(){
        $totalPublicInformationRequest = PublicInformationRequest::count();
        $requests = PublicInformationRequest::all();
        return view('admin.Informasi.index', compact('requests','totalPublicInformationRequest'));
    }
    public function publicInformationDetail( $id ){
        $request = PublicInformationRequest::find($id);
        return view('admin.Informasi.detail', compact('request'));
    }
    public function objection(){
        $totalObjection = Objection::count();
        $objection = Objection::all();
        return view('admin.Keberatan.index', compact('objection', 'totalObjection'));
    }
    public function objectionDetail( $id ){
        $objection = Objection::find($id);
        return view('admin.Keberatan.detail', compact('objection'));
    }
    public function whistleBowling(){
        $totalWhistle = Whistle::count();
        $whistles = Whistle::all();
        return view('admin.Whistle.index', compact('whistles', 'totalWhistle'));
    }
    public function whistleDetail( $id ){
        $whistle = Whistle::find($id);
        return view('admin.Whistle.detail', compact('whistle'));
    }
    public function userManagement(){
        $users = User::all();
        // return view('admin.UserManagement.index', compact('users'));
    }
}
