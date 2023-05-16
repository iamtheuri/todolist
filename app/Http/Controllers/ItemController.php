<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('position', 'asc')->orderBy('id', 'asc')->get();
        return view('home', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        Item::create($data);
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        $item = Item::findOrFail($id);
        $item->update($data);

        return redirect()->route('index');
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'position' => 'required|array'
        ]);
        $positions = $data['position'];
        $upsert = [];
        if (!empty($positions )) {
            foreach ($positions as $key => $value) {
                 $upsert[]=['id' => (int) $value, 'position' => $key];
            }
        }
        Item::query()->upsert($upsert, 'position');
        return Response::json([
            'success'=>true,
            'data'=>$positions,
        ]);

    }

    // public function update(Request $request, string $id)
    // {
    //     // $existingItem = Item::find( $id );

    //     // if($existingItem) {
    //     //     $existingItem->completed = $request->item['completed'] ? true : false;
    //     //     $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
    //     //     $existingItem->save();
    //     //     return $existingItem;
    //     // }

    //     // return "Item not found.";
    // }

    public function edit ($id) {
        $item = Item::find($id);
        
        if (!$item) {
        abort(404);
        }
        return view('edit', compact('item'));
    }


    public function destroy(string $id)
    {
        
        // Retrieve the item from the database based on the provided ID
        $item = Item::find($id);
        
        if (!$item) {
        abort(404);
        }
        $item->delete();
        return back();
    }
}
