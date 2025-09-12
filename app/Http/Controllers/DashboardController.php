<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.super-admin.index');
    }
}
