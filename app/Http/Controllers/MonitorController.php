<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    private $database;

    public function __construct()
    {
       $this->database = \App\Services\FirebaseService::connect();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $battery = $this->database->getReference('battery')->getValue();
        $operations = $this->database->getReference('operations')->getSnapshot()->getValue();
        return view('monitor',[
            'battery' => $battery,
            'operations' => $operations,
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
        $id = uniqid();
        $this->database
            ->getReference('operations/'.$id)
            ->set([
                'id' => $id,
                'started' => $request['started'],
                'duration' => $request['duration'],
            ]);
        
        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request['id'];
        $this->database
            ->getReference('operations')
            ->getChild($id)
            ->update([
                'started' => $request['started'],
                'duration' => $request['duration'],
            ]);
        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $this->database
            ->getReference('operations')
            ->getChild($id)
            ->remove();
        return redirect()->route('dashboard.index');
    }
}
