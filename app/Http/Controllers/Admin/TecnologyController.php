<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tecnology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.index', compact('tecnologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_tecnology = $request->validate([
            'name'=>'required|unique:types'
        ]);
        $slug = Str::slug($validate_tecnology['name']);
        $validate_tecnology['slug'] = $slug;

        Tecnology::create($validate_tecnology);

        return redirect()->back()->with('message', "Tipo $request->name creato correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tecnology $tecnology)
    {
        $validate_tecnology = $request->validate([
            'name'=>'required|unique:tecnologies'
        ]);
        $slug = Str::slug($validate_tecnology['name']);
        $validate_tecnology['slug'] = $slug;

        $tecnology->update($validate_tecnology);

        return redirect()->back()->with('message', "Tecnologia aggiornato $request->name correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();
        return redirect()->back()->with('message', "Tecnologia $tecnology->name eliminato correttamente");
    }
}
