<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBankRequest;

class BankController extends Controller
{
    function index()
    {
        return view('bank.index', [
            'banks' => Bank::all()
        ]);
    }

    function create()
    {
        return view('bank.create');
    }

    function edit(Bank $bank)
    {
        return view('bank.edit', ['bank' => $bank]);
    }

    function update(StoreBankRequest $request, Bank $bank)
    {
        $bank->fill( $request->validated() );
        $bank->save();
        
        return redirect()->route('banks.index')->with('success', 'Registro actualizado');
    }

    function store(StoreBankRequest $request)
    {
        Bank::create( $request->validated() );
        
        return redirect()->route('banks.index')->with('success', 'Registro creado');
    }
}
