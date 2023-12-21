<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        return view('home')->with('competitions', $competitions);
    }


}
