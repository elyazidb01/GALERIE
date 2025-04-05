<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vérification de l'authentification et des variables de session
        if (!session('authentification')) {
            return redirect()->route('auth.login')->withErrors([
                'access_denied' => 'Vous devez être connecté pour accéder à cette page.',
            ]);
        }
        return view('photos.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photo_val = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string|max:255',
        ]);

        // Création de l'enregistrement dans la base de données
        $photo = Photo::create([
            'description' => $request->description,
        ]);

        // Vérification si une image a été uploadée
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->getClientOriginalExtension(); // Récupérer l'extension
            $photoName = 'photo_' . $photo->id . '.' . $extension; // Générer un nom unique basé sur l'ID
            $photoPath = $uploadedFile->storeAs('photos', $photoName, 'public'); // Sauvegarde dans le disque public
    
            // Mise à jour de l'enregistrement avec le chemin de l'image
            $photo->update(['image' => $photoPath]);
        }

        // Redirection avec un message de succès
        return redirect()
            ->route('photos.index')
            ->with('success', 'Photo ajoutée avec succès');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo_val = $request ->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required'
        ]);
        $photo ->update($photo_val);
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension(); 
            $photoName = 'photo_' . $photo['id']  ->getClientOriginalName() . '.' . $extension; 
            $photoPath = $photo->storeAs('photos', $photoName, 'public'); 

            $photo->update(['image' => $photoPath]);
        }
        return redirect() -> route('photos.index') -> with('success', 'Photo modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return redirect()->route('photos.index')->with('success','Photo supprimée avec succès');

    }
}
