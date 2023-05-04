<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

class LogController extends Controller
{
    function index()
    {
        if (!request()->ajax()) {
            return view('admin.log.index');
        }

        $query = DB::table('activity_log');

        return DataTables::query($query)
            ->toJson();
    }
}
