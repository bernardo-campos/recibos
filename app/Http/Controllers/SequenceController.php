<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SequenceController extends Controller
{
    public function edit()
    {
        $query = DB::table("information_schema.TABLES")
                    ->selectRaw('AUTO_INCREMENT')
                    ->whereRaw('TABLE_SCHEMA = "recibos" AND TABLE_NAME = "receipts"')
                    ->first();

        return view('sequence.edit', [
            'autoincrement_number' => $query->AUTO_INCREMENT
        ]);
    }

    public function update(Request $request)
    {
        DB::update("ALTER TABLE receipts AUTO_INCREMENT = {$request->autoincrement_number};");
        
        return redirect()->back();
    }
}
