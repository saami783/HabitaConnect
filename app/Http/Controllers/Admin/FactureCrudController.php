<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;

class FactureCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::paginate(10);
        return view('admin.factures.index', compact('factures'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        return view('admin.factures.show', compact('facture'));
    }

}
