<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;

class UploadController extends Controller
{ 
    public function avatarDoctor(Request $r, $id) {

        $data = Doctor::where('id', $id)->first();
        
        $validator = Validator::make(['image' => $r['image']], [
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
        ]);

        if($validator->fails()) {
            return redirect()->route('doctorProfile', ['id' => $id ]);
        } 

        $extension = $r['image']->extension();

        $imageName = time().'.'.$extension;

        $r['image']->move(public_path('/assets/avatars'), $imageName);

        Doctor::where('id', $id)->update(['avatar' => $imageName]);

        return redirect()->route('doctorProfile', ['id' => $data['id']]);
    }
}
