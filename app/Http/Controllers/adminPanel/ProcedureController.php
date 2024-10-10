<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Procedure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcedureController extends Controller
{
    public function procedure()
    {
        $procedures = Procedure::all();
        return view('procedure.contents.procedure', compact('procedures'));
    }

    public function addProcedure()
    {
        return view('procedure.contents.add-procedure');
    }

    public function storeProcedure(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'visit_type' => 'required',
            'description' => 'required',
        ]);

        Procedure::create([
            'name' => $request->name,
            'price' => $request->price,
            'visit_type' => $request->visit_type,
            'description' => $request->description,
        ]);

        return redirect()->route('procedure')->with('Procedure successfully added!');

    }
}
