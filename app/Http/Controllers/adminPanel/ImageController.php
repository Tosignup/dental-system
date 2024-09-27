<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_type' => 'required|in:xray,background,contract,profile_picture,proof_of_payment',
        ]);
        
        $path = $request->file('image')->store('images', 'public');
       
        Image::create([
            'patient_id' => $request->input('patient_id'),
            'image_type' => $request->input('image_type'),
            'image_path' => $path,
        ]);


        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }
}
