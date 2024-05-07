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

        // Pests Data
        // Time Current
        $today = date('Y-m-d');
        $yearCurrent = date('Y', strtotime($today));
        $monthCurrent = date('m', strtotime($today));
        $dayCurrent = date('d', strtotime($today));
        // Time A Week Ago
        $aWeekAgo = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $monthAwekAgo = date('m', strtotime($aWeekAgo));
        $dayAwekAgo = date('d', strtotime($aWeekAgo));
        // Pest Month
        $pestCurrentMonth = $this->database
                                    ->getReference('pests')
                                    ->getChild($yearCurrent.'/'.$monthCurrent)
                                    ->getValue();
        // Chart Month
        $chartForMonth = array();
        foreach ($pestCurrentMonth as $day => $timePests) {
            $totalPest = 0;
            foreach ($timePests as $time => $pest) {
                $totalPest += $pest;
            }
            $chartForMonth[$day] = $totalPest;
        }

        // Time Week
        $timeForWeek = array();
        // It's past the 7th
        if ($monthCurrent === $monthAwekAgo) {
            foreach ($pestCurrentMonth as $day => $timePests) {
                if ($day > $dayAwekAgo) {
                    foreach ($timePests as $time => $pest) {
                        if (!in_array($time, $timeForWeek)) $timeForWeek[] = $time;
                    }
                }
            }
        } else {
            // Pest A Month Ago
            $pestAmonthAgo = $this->database
                                    ->getReference('pests')
                                    ->getChild($yearCurrent.'/'.$monthAwekAgo)
                                    ->getValue();
            foreach ($pestCurrentMonth as $day => $timePests) {
                if ($day < $dayAwekAgo) {
                    foreach ($timePests as $time => $pest) {
                        if (!in_array($time, $timeForWeek)) $timeForWeek[] = $time;
                    }
                }
            }
            foreach ($pestAmonthAgo as $day => $timePests) {
                if ($day > $dayAwekAgo) {
                    foreach ($timePests as $time => $pest) {
                        if (!in_array($time, $timeForWeek)) $timeForWeek[] = $time;
                    }
                }
            }
        }
        // Chart Week
        sort($timeForWeek);
        $chartForWeek = array();
        // It's past the 7th
        if ($monthCurrent === $monthAwekAgo) {
            foreach ($pestCurrentMonth as $day => $timePests) {
                if ($day > $dayAwekAgo) {
                    $pests = array();
                    foreach ($timeForWeek as $time) {
                        if (isset($timePests[$time])){
                            $pests[$time] = $timePests[$time];
                        } else {
                            $pests[$time] = 0;
                        }
                    }
                    $chartForWeek[$day] = $pests;
                }
            }
        } else {
            // Pest A Month Ago
            $pestAmonthAgo = $this->database
                                    ->getReference('pests')
                                    ->getChild($yearCurrent.'/'.$monthAwekAgo)
                                    ->getValue();
            foreach ($pestAmonthAgo as $day => $timePests) {
                if ($day > $dayAwekAgo) {
                    $pests = array();
                    foreach ($timeForWeek as $time) {
                        if (isset($timePests[$time])){
                            $pests[$time] = $timePests[$time];
                        } else {
                            $pests[$time] = 0;
                        }
                    }
                    $chartForWeek[$day] = $pests;
                }
            }
            foreach ($pestCurrentMonth as $day => $timePests) {
                if ($day < $dayAwekAgo) {
                    $pests = array();
                    foreach ($timeForWeek as $time) {
                        if (isset($timePests[$time])){
                            $pests[$time] = $timePests[$time];
                        } else {
                            $pests[$time] = 0;
                        }
                    }
                    $chartForWeek[$day] = $pests;
                }
            }
        }
        

        return view('monitor',[
            'battery' => $battery,
            'operations' => $operations,
            'chartForMonth' => $chartForMonth,
            'chartForWeek' => $chartForWeek,
            'timeForWeek' => $timeForWeek,
            'today' => $today,
            'aWeekAgo' => $aWeekAgo,
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
