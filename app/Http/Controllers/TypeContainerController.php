<?php

namespace App\Http\Controllers;

use App\Models\TypeContainer;
use Illuminate\Http\Request;

class TypeContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([

            'type_container' => 'required',

        ]);
        TypeContainer::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeContainer $typeContainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $typeContainer = TypeContainer::find($id);

        return response()->json([
            'result' => $typeContainer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([

            'type_container' => 'required',

        ]);

        $types = TypeContainer::findOrFail($id);

        $data = [
            "type_container" =>$request->type_container,
        ];
        $types->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $types = TypeContainer::find($id);
        $types->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
