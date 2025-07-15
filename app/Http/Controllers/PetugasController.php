<?php

namespace App\Http\Controllers;
use App\Models\Galleries;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use App\Models\PublicInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // Dashboard
    public function index(){
        $totalPublicInformationRequest = PublicInformationRequest::count();
        $totalObjection = Objection::count();
        $totalWhistle = Whistle::count();
        $totalRequest = PublicInformationRequest::count() + Objection::count() + Whistle::count();
        return view('petugas.dashboard.index', compact('totalPublicInformationRequest', 'totalObjection', 'totalWhistle', 'totalRequest'));
    }
// Galleries
    public function galleries(){
        $totalGalleries = Galleries::count();
        $galleries = Galleries::all();
        return view('petugas.gallery.index', compact('galleries', 'totalGalleries'));
    }
    public function galleriesCreate(){
        return view('petugas.gallery.create');
    }
    public function galleriesEdit(string $id){
        $galleries = Galleries::findOrFail($id);
        return view('petugas.gallery.edit', compact('galleries'));
    }

    // Public Information Request
    public function publicInformation(){
        $totalPublicInformationRequest = PublicInformationRequest::count();
        $requests = PublicInformationRequest::all();
        return view('petugas.informasi.index', compact('requests', 'totalPublicInformationRequest'));
    }
    public function publicInformationDetail(string $id){
        $request = PublicInformationRequest::findOrFail($id);
        return view('petugas.informasi.detail', compact('request'));
    }
    public function publicInformationEdit(string $id){
        $request = PublicInformationRequest::findOrFail($id);
        return view('petugas.informasi.edit', compact('request'));
    }

    // Objection
    public function objection(){
        $totalObjection = Objection::count();
        $objection = Objection::all();
        return view('petugas.keberatan.index', compact('objection', 'totalObjection'));
    }
    public function objectionDetail(string $id){
        $objection = Objection::findOrFail($id);
        return view('petugas.keberatan.detail', compact('objection'));
    }
    public function objectionEdit(string $id){
        $objection = Objection::findOrFail($id);
        return view('petugas.keberatan.edit', compact('objection'));
    }

    // Whistle Bowling

    public function whistleBowling(){
        $totalWhistle = Whistle::count();
        $whistles = Whistle::all();
        return view('petugas.whistle.index', compact('whistles', 'totalWhistle'));
    }
    public function whistleBowlingDetail(string $id){
        $whistle = Whistle::findOrFail($id);
        return view('petugas.whistle.detail', compact('whistle'));
    }
    public function whistleBowlingEdit(string $id){
        $whistle = Whistle::findOrFail($id);
        return view('petugas.whistle.edit', compact('whistle'));
    }
}
