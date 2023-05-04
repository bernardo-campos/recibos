<?php

namespace App\Http\Controllers;

use App\Models\To;
use Illuminate\Http\Request;
use App\Http\Requests\StoreToRequest;

class ToController extends Controller
{
    function index()
    {
        return view('to.index', [
            'tos' => To::all()
        ]);
    }

    function create()
    {
        return view('to.create');
    }

    function edit(To $to)
    {
        return view('to.edit', ['to' => $to]);
    }

    function update(StoreToRequest $request, To $to)
    {
        $to->fill( $request->validated() );
        $to->save();

        return redirect()->route('tos.index')->with('success', 'Registro actualizado');
    }

    function store(StoreToRequest $request)
    {
        To::create( $request->validated() );

        return redirect()->route('tos.index')->with('success', 'Registro creado');
    }
}
