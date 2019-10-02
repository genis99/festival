<?php

namespace App\Http\Controllers;

use App\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function index()
    {
        return Festival::all();
    }
}
