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
        return view('admin.procedure.procedure', compact('procedures'));
    }

    public function addProcedure()
    {
        return view('admin.procedure.add-procedure');
    }

    public function storeProcedure(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ]);

        Procedure::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('procedure')->with('success', 'Procedure successfully added!');
        session()->flash('success', 'Procedure successfully added!');
    }

    public function editProcedure($id)
    {
        $procedure = Procedure::findOrFail($id);

        return view('admin.procedure.edit-procedure', compact('procedure'));
    }

    public function updateProcedure(Request $request, $id)
    {
        $procedure = Procedure::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ]);

        $procedure->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect()->route('procedure')->with('success', 'Procedure updated successfully!');
        session()->flash('success', 'Procedure updated added!');
    }

    public function deleteProcedure(Request $request, $id)
    {
        $procedure = Procedure::findOrFail($id);

        $procedure->delete();

        return redirect()->route('procedure')->with('success', 'Procedure deleted successfully!');
        session()->flash('success', 'Procedure deleted added!');
    }
}
