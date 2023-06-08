<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;


class DashboardController extends Controller
{
    public function index()
    {
        return view('Backend.Dasboard.index');
    }

}
