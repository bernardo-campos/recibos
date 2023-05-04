<?php

namespace App\Http\Controllers;

use App\Models\From;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFromRequest;

class FromController extends Controller
{
    function index()
    {
        return view('from.index', [
            'froms' => From::all()
        ]);
    }

    function create()
    {
        return view('from.create');
    }

    function edit(From $from)
    {
        return view('from.edit', ['from' => $from]);
    }

    function update(StoreFromRequest $request, From $from)
    {
        $from->fill( $request->validated() );
        $from->save();
        
        return redirect()->route('froms.index')->with('success', 'Registro actualizado');
    }

    function store(StoreFromRequest $request)
    {
        From::create( $request->validated() );
        
        return redirect()->route('froms.index')->with('success', 'Registro creado');
    }
}
