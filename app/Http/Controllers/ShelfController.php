<?php

namespace App\Http\Controllers;
use App\Shelf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ShelfController extends Controller
{

    // manage shelf
    public function manageShelf()
    {
        $datashelf = Shelf::paginate(15);

        return view('shelf.manage-shelf', ['shelves' => $datashelf]);
    }
    // add shelf

    public function addshelf(Request $request)
    {
        $shelf= Shelf::all();
        /*Validator form penambahan shelf*/
        $rules = [

            'name' => 'required|unique:shelves'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("add-shelf")->withErrors($validator)->withInput();
        }

        $newShelves = new Shelf();
        $newShelves->name = $request['name'];

        $newShelves->save();

        return redirect("manage-shelf")->with('info', 'New Shelf has been created.');
    }
    // delete shelf

    public function deleteShelf($id)
    {
        $shelf = Shelf::find($id);
        $shelf->delete();
        return redirect("manage-shelf")->with('danger', 'Shelf has been deleted.');
    }
    // ini untuk search shelf manage (Admin)
    public function searchshelf(Request $request)
    {

        $shelves = Shelf::selectRaw('shelves.id, shelves.name')
            ->whereRaw(
                'shelves.name = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('shelf.manage-shelf', compact('shelves', 'search'));
    }
    // ini untuk edit shelf (admin)
    public function editshelf($id)
    {
        $editshelf = Shelf::find($id);
        return view('shelf.edit-shelf', ['shelves' => $editshelf]);
    }

    public function doeditshelf(Request $request, $id)
    {

        /*Validator update shelf */
        $rules = [
            'name' => 'required|unique:shelves',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-shelf/$id")->withErrors($validator)->withInput();
        }

        
        $shelf = Shelf::find($id);
        // ini untuk validasi
        $shelf->name = $request['name'];

        $shelf->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("manage-shelf")->with('success', 'Shelf has been updated.');
    }

}
