<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstablishmentRequest;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    function index()
    {
        return view('establishments.index', [
            'establishments' => Establishment::all()
        ]);
    }

    function create()
    {
        return view('establishments.create');
    }

    function store(StoreEstablishmentRequest $request)
    {
        Establishment::create( $request->validated() );

        return to_route('establishments.index')->with('success', 'Establecimiento creado');
    }

    function edit(Establishment $establishment)
    {
        return view('establishments.edit', ['establishment' => $establishment]);
    }

    function update(StoreEstablishmentRequest $request, Establishment $establishment)
    {
        $establishment->fill( $request->validated() );
        $establishment->save();
        
        return redirect()->route('establishments.index')->with('success', 'Establecimiento actualizado');
    }
}
