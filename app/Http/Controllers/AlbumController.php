<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $album_val = $request->validate([
            'titre' => 'required',
            'description' => 'required'
        ]);
        $album = Album::create([
            'titre' => $request -> titre,
            'description' => $request -> description
        ]);
        return redirect() -> route('albums.index') -> with('success', 'Album ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);
    return view('albums.edit', compact('album')); // Transmet $album à la vue
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $album_val = $request ->validate([
            'titre' => 'required',
            'description' => 'required'
        ]);
        $album ->update($album_val);
        return redirect() -> route('albums.index') -> with('success', 'Album modifié avec succès');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect()->route('albums.index')->with('success','Album supprimé avec succès');
    }
}
