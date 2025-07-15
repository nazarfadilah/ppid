<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicInformation;

class PublicInformationController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $data = PublicInformation::all();
        return response()->json($data);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $info = PublicInformation::create($request->all());
        return response()->json($info, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $info = PublicInformation::findOrFail($id);
        return response()->json($info);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $info = PublicInformation::findOrFail($id);
        $info->update($request->all());
        return response()->json($info);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $info = PublicInformation::findOrFail($id);
        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
