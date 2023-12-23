<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Round;
use Response;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        return view('home')->with('competitions', $competitions);
    }

    public function storeCompetition(Request $request)
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

    public function storeRound(Request $request)
    {
        $data = $request->validate([
            'verseny_id' => 'required',
            'nev' => 'required',
            'datum' => 'required',
        ]);

        $round = Round::create($data);
        return Response::json($round);
    }

    public function showParticipant($id){

        $round = Round::find($id);
        ddd($round->participants[0]->user);
        return view('participants')->with('round', $round);
    }


}
