<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Participant;
use App\Models\Round;
use App\Models\User;
use Response;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        $users = User::all();
        return view('home')->with('competitions', $competitions)->with('users', $users);
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
        if (!$round) {
            return redirect()->route('home');
        }
        return view('participants')->with('round', $round);
    }

    public function storeRoundParticipant(Request $request)
    {
        $data = $request->validate([
            'fordulo_id' => 'required',
            'felhasznalo_id' => 'required'
        ]);

        $participant = Participant::create($data);
        return Response::json($participant);
    }

    public function deleteParticipant(Request $request)
    {

        $data = $request->validate([
            'id' => 'required|integer', // Ensure that 'id' is an integer
        ]);

        $participant = Participant::find($data['id']);

        if (!$participant) {
            return Response::json(['error' => 'Participant not found'], 404);
        }

        $participant->delete();
        return Response::json($participant);
    }

}
