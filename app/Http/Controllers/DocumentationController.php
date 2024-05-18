<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = Documentation::orderBy('date')->paginate(1);
        
        return view('admin.documentation.index',[
            'documentations' => $documentations,
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
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageFile = $request->file('image');
        $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs(
            'public/documentation',
            $imageName
        );

        Documentation::create([
            'name' => $request['name'],
            'date' => $request['date'],
            'description' => $request['description'],
            'path' => $path,
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documentation $documentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentation $documentation)
    {
        return view('admin.documentation.edit',[
            'documentation' => $documentation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documentation $documentation)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($documentation->path) {
                Storage::delete($documentation->path);
            }
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
            $path = $imageFile->storeAs(
                'public/documentation',
                $imageName
            );
            $documentation->path = $path;
        }

        $documentation->name = $request['name'];
        $documentation->date = $request['date'];
        $documentation->description = $request['description'];
        $documentation->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        Storage::delete($documentation->path);
        $documentation->delete();

        return redirect()->route('admin.index');
    }
}
