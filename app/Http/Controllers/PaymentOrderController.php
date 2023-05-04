<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentOrderRequest;
use App\Models\Account;
use App\Models\Concept;
use App\Models\Currency;
use App\Models\Establishment;
use App\Models\PaymentOrder;
use App\Models\To;
use Illuminate\Http\Request;
use DataTables;

class PaymentOrderController extends Controller
{
    function index()
    {
        if (!request()->ajax()) {
            return view('payment_orders.index');
        }

        $query = PaymentOrder::query()
            ->with(['to', 'concept', 'establishment', 'account.bank'])
            ->select(['payment_orders.*'])
        ;
        
        return DataTables::eloquent($query)
            ->addColumn('urls', fn(PaymentOrder $payment_order) => [
                'edit' => route('payment_orders.edit', $payment_order),
                'show' => route('payment_orders.show', $payment_order),
            ])
            ->make(true)
        ;
    }

    function show(PaymentOrder $payment_order)
    {
        $payment_order->load(['to', 'concept', 'establishment']);

        return view('payment_orders.show', ['payment_order' => $payment_order]);
    }

    function create()
    {
        return view('payment_orders.create', [
            'tos' => To::orderBy('name')->get(),
            'concepts' => Concept::where('type', 'PaymentOrder')->orderBy('name')->get(),
            'accounts' => Account::all(),
            'establishments' => Establishment::all(),
            'currencies' => Currency::all(),
        ]);
    }

    function store(StorePaymentOrderRequest $request)
    {
        PaymentOrder::create( $request->validated() );

        return redirect()->route('payment_orders.index');
    }

    function update(StorePaymentOrderRequest $request, PaymentOrder $payment_order)
    {
        $this->authorize('edit-payment_order', $payment_order);

        $payment_order->fill( $request->validated() );

        $payment_order->save();

        return to_route('payment_orders.index')->with('success', 'Orden de pago actualizada');
    }

    function edit(PaymentOrder $payment_order)
    {
        $this->authorize('edit-payment_order', $payment_order);

        return view('payment_orders.edit', [
            'payment_order' => $payment_order,
            'tos' => To::orderBy('name')->get(),
            'concepts' => Concept::where('type', 'PaymentOrder')->orderBy('name')->get(),
            'accounts' => Account::all(),
            'establishments' => Establishment::all(),
            'currencies' => Currency::all(),
        ]);
    }

    function print(Request $request)
    {
        $payment_orders = PaymentOrder::with(['to', 'concept', 'establishment', 'currency'])->find( explode(',', $request->ids) );

        return view('payment_orders.show', ['payment_orders' => $payment_orders]);
    }
}
