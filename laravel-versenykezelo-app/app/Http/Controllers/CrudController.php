<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Response;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        return view('home')->with('competitions', $competitions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nev' => 'required',
            'ev' => 'required',
            'elerheto_nyelvek' => 'nullable', // Példa nyelvek
            'pontok_jo' => 'required',
            'pontok_rossz' => 'required',
            'pontok_ures' => 'required',
        ]);

        $data['elerheto_nyelvek'] = $data['elerheto_nyelvek'] ?? 'nincs_megadva';

        $competition = Competition::create($data);
        return Response::json($competition);
    }


}
