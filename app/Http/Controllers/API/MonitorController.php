<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class MonitorController extends BaseController
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
        try {
            // Ambil data dari database
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

            // Data berhasil diambil, kirim respons sukses
            return $this->sendResponse([
                'battery' => $battery,
                'operations' => $operations,
                'chartForMonth' => $chartForMonth,
                'chartForWeek' => $chartForWeek,
                'timeForWeek' => $timeForWeek,
                'today' => $today,
                'aWeekAgo' => $aWeekAgo,
            ], 'Data retrieved successfully.');
        } catch (\Exception $e) {
            // Terjadi kesalahan, kirim respons error
            return $this->sendError('Failed to retrieve data', ['error' => $e->getMessage()], 500);
        }
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
            'started' => 'required',
            'duration' => 'required|integer|max:120',
        ]);
        try {
            // Ambil data operasi sebelum penambahan
            $beforeAddition = $this->database->getReference('operations')->getValue();

            // Tambahkan data operasi baru
            $id = uniqid();
            $this->database
                ->getReference('operations/'.$id)
                ->set([
                    'id' => $id,
                    'started' => $request['started'],
                    'duration' => $request['duration'],
                ]);

            // Ambil data operasi setelah penambahan
            $afterAddition = $this->database->getReference('operations')->getValue();

            return $this->sendResponse([
                'Jadwal Sebelumnya' => $beforeAddition,
                'Jadwal Saat Ini' => $afterAddition,
            ], 'Data operation berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->sendError('Gagal menambahkan data operation.', ['error' => $e->getMessage()], 500);
        }
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
        $request->validate([
            'id' => 'required',
            'started' => 'required',
            'duration' => 'required|integer|max:120',
        ]);

        try {
            $id = $request['id'];
            // Ambil data operasi sebelum penambahan
            $beforeAddition = $this->database->getReference('operations')->getChild($id)->getValue();

            // Perbarui data operasi baru
            $this->database
                ->getReference('operations')
                ->getChild($id)
                ->update([
                    'started' => $request['started'],
                    'duration' => $request['duration'],
                ]);

            // Ambil data operasi setelah penambahan
            $afterAddition = $this->database->getReference('operations')->getChild($id)->getValue();

            return $this->sendResponse([
                'Jadwal Sebelumnya' => $beforeAddition,
                'Jadwal Saat Ini' => $afterAddition,
            ], 'Data operation berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->sendError('Gagal menambahkan data operation.', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        try {
            $id = $request['id'];
            // Ambil data operasi sebelum penambahan
            $beforeAddition = $this->database->getReference('operations')->getValue();

            // Hapus data operasi
            $this->database
                ->getReference('operations')
                ->getChild($id)
                ->remove();

            // Ambil data operasi setelah penambahan
            $afterAddition = $this->database->getReference('operations')->getValue();

            return $this->sendResponse([
                'Jadwal Sebelumnya' => $beforeAddition,
                'Jadwal Saat Ini' => $afterAddition,
            ], 'Data operation berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->sendError('Gagal menambahkan data operation.', ['error' => $e->getMessage()], 500);
        }
    }
}
