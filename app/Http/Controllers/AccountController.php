<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{
    function index()
    {
        return view('account.index', [
            'accounts' => Account::all(),
        ]);
    }

    function create()
    {
        return view('account.create', [
            'banks' => Bank::orderBy('name')->get(),
        ]);
    }

    function edit(Account $account)
    {
        return view('account.edit', [
            'account' => $account,
            'banks' => Bank::orderBy('name')->get(),
        ]);
    }

    function update(StoreAccountRequest $request, Account $account)
    {
        $account->fill( $request->validated() );
        $account->save();
        
        return redirect()->route('accounts.index')->with('success', 'Registro actualizado');
    }

    function store(StoreAccountRequest $request)
    {
        Account::create( $request->validated() );
        
        return redirect()->route('accounts.index')->with('success', 'Registro creado');
    }
}
