<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::paginate(1);
        
        return view('admin.about.index',[
            'abouts' => $abouts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageFile = $request->file('image');
        $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs(
            'public/about',
            $imageName
        );

        About::create([
            'description' => $request['description'],
            'path' => $path,
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.about.edit',[
            'about' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($about->path) {
                Storage::delete($about->path);
            }
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
            $path = $imageFile->storeAs(
                'public/about',
                $imageName
            );
            $about->path = $path;
        }

        $about->description = $request['description'];
        $about->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        Storage::delete($about->path);
        $about->delete();

        return redirect()->route('admin.index');
    }
}
