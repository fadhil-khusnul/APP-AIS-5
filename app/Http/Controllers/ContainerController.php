<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
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

            'jenis_container' => 'required',
            'size_container' => 'required',
            'type_container' => 'required',

        ]);
        Container::create($validatedData);
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Container $container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Container = Container::find($id);

        return response()->json([
            'result' => $Container,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'jenis_container' => 'required',
            'size_container' => 'required',
            'type_container' => 'required',

        ]);

        $container = Container::findOrFail($id);

        $data = [
            "jenis_container" =>$request->jenis_container,
            "size_container" =>$request->size_container,
            "type_container" =>$request->type_container,
        ];
        $container->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Container = Container::find($id);
        $Container->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
