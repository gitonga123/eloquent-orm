<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageFormRequest;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function store(ImageFormRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/images/', $name);
            return redirect('/')->with('status', 'Your image has been uploaded successfully');
        }
    }
}
