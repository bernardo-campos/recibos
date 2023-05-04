<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConceptRequest;

class ConceptController extends Controller
{
    private $base_view = '';
    private $base_route = '';
    private $type = '';

    function __construct()
    {
        $route_name = \Route::current()->getName();

        $this->base_view = str($route_name)->contains('receipt')
            ? 'concept.receipts.'
            : 'concept.payment_orders.';

        $this->base_route = str($route_name)->contains('receipt')
            ? 'receipts.concepts.'
            : 'payment_orders.concepts.';

        $this->type = str($route_name)->contains('receipt')
            ? 'Receipt'
            : 'PaymentOrder';
    }

    function index()
    {
        return view($this->base_view . 'index', [
            'concepts' => Concept::where('type', $this->type)->get(),
        ]);
    }

    function create()
    {
        return view($this->base_view . 'create');
    }

    function edit(Concept $concept)
    {
        return view($this->base_view . 'edit', ['concept' => $concept]);
    }

    function update(StoreConceptRequest $request, Concept $concept)
    {
        $concept->fill( $request->validated() );
        $concept->save();
        
        return to_route($this->base_route.'index')->with('success', 'Concepto actualizado');
    }

    function store(StoreConceptRequest $request)
    {
        Concept::create( $request->validated() );
        
        return to_route($this->base_route.'index')->with('success', 'Concepto creado');
    }
}
