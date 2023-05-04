<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Models\Account;
use App\Models\Concept;
use App\Models\From;
use App\Models\Receipt;
use Illuminate\Http\Request;
use DataTables;

class ReceiptController extends Controller
{
    function index()
    {
        if (!request()->ajax()) {
            return view('receipts.index');
        }

        $query = Receipt::query()
            ->with(['from', 'concept', 'account.bank'])
            ->select(['receipts.*'])
        ;
        
        return DataTables::eloquent($query)
            ->addColumn('urls', fn(Receipt $receipt) => [
                'edit' => route('receipts.edit', $receipt),
                'show' => route('receipts.show', $receipt),
            ])
            ->addColumn('email_text', fn(Receipt $receipt) => $receipt->email_text)
            ->make(true)
        ;
    }

    function show(Receipt $receipt)
    {
        $receipt->load(['from', 'concept']);
        
        return view('receipts.show', ['receipt' => $receipt]);
    } 

    function create()
    {
        return view('receipts.create', [
            'froms' => From::orderBy('name')->get(),
            'concepts' => Concept::orderBy('name')->get(),
            'accounts' => Account::all(),
        ]);
    }

    function store(StoreReceiptRequest $request)
    {
        Receipt::create( $request->validated() );

        return redirect()->route('receipts.index');
    }

    function update(StoreReceiptRequest $request, Receipt $receipt)
    {
        $this->authorize('edit-receipt', $receipt);

        $receipt->fill( $request->validated() );

        $receipt->save();
        
        return redirect()->route('receipts.index')->with('success', 'Registro actualizado');
    }

    function edit(Receipt $receipt)
    {
        $this->authorize('edit-receipt', $receipt);
        
        return view('receipts.edit', [
            'receipt' => $receipt,
            'froms' => From::orderBy('name')->get(),
            'concepts' => Concept::orderBy('name')->get(),
            'accounts' => Account::all(),
        ]);
    }

    function print(Request $request)
    {
        $receipts = Receipt::with(['from', 'concept'])->find( explode(',', $request->ids) );
        
        return view('receipts.show', ['receipts' => $receipts]);
    }
}
