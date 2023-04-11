<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\member;
use App\Models\group;


class indexController extends Controller
{
    
    public function oneToone()
    {
        return member::with('group')->get();
    }
    
    public function oneTomany()
    {
       // echo "One to many";
        return group::with('member')->get();
    }
}
