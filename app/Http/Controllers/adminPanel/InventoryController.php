<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Branch;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{

    public function inventory()
    {
        $items = Inventory::all();

        return view('admin.inventory.inventory', compact('items'));
    }

    public function addItem()
    {
        $branches = Branch::all();
        return view('admin.inventory.add-item', compact('branches'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|numeric',
            'minimum_stock' => 'required|numeric',
            'maximum_stock' => 'required|numeric',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'availability' => 'required|string',
            'condition' => 'required|string',
            'notes' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
        ]);

        Inventory::create([
            'item_name' => $request->item_name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'minimum_stock' => $request->minimum_stock,
            'maximum_stock' => $request->maximum_stock,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'discount' => $request->discount,
            'availability' => $request->availability,
            'condition' => $request->condition,
            'notes' => $request->notes,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('inventory')->with('success', 'Item added successfully!');
        session()->flash('success', 'Item added successfully!');
    }

    public function editItem($id)
    {
        $item = Inventory::findOrFail($id);

        $branches = Branch::all();
        return view('admin.inventory.edit-item', compact('item', 'branches'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = Inventory::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|numeric',
            'minimum_stock' => 'required|numeric',
            'maximum_stock' => 'required|numeric',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'availability' => 'required|string',
            'condition' => 'required|string',
            'notes' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $item->update($validated);

        return redirect()->route('inventory')->with('success', 'Item updated successfully!');
        session()->flash('success', 'Item updated successfully!');
    }

    public function deleteItem($id)
    {
        $item = Inventory::findOrFail($id);

        $item->delete();

        return redirect()->route('inventory')->with('success', 'Item deleted successfully!');
        session()->flash('success', 'Item deleted successfully!');
    }


}
