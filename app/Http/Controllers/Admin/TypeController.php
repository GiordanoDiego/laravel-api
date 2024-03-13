<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import helper
use Illuminate\Support\Str;

//model
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|max:1024'
            ],
            //posso aggiungere un array per personalizzare i messaggi di errore e magari metterli in italiano
            [
                'name.required' => 'Devi inserire un titolo',
                'name.max' => 'Non puoi inserire un titolo più lungo di 1024 caratteri '
            ]);
    
            // Genera lo slug dal titolo
            $slug = Str::slug($validatedData['name']);
    
            // Aggiungi lo slug ai dati validati
            $validatedData['slug'] = $slug;
            
            $type = Type::create($validatedData);
            return redirect()->route('admin.type.show', ['type' => $type->slug]);
        }
        //gestico l'errore dell'eventuale non unicità dello slug
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Chiave unica duplicata
                return back()->withInput()->withErrors(['name' => 'Esiste già un tipo con questo nome.']);
            } else {
                // Altro errore SQL
                // Puoi gestire diversi tipi di errori SQL qui
                return back()->withInput()->withErrors(['name' => 'Si è verificato un errore durante la creazione del nuovo tipo.']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $type = Type::where('slug', $slug)->with('projects')->firstOrFail();

        return view('admin.type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();

        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // Verifica che il tipo esista
        if (!$type) {
            return redirect()->route('admin.type.index')->withErrors(['message' => 'Il tipo specificato non esiste.']);
        }
    
        try {
            // Validazione dei dati
            $validatedData = $request->validate([
                'name' => 'required|max:1024'
            ], [
                'name.required' => 'Devi inserire un titolo',
                'name.max' => 'Non puoi inserire un titolo più lungo di 1024 caratteri '
            ]);
    
            // Genera lo slug dal titolo
            $slug = Str::slug($validatedData['name']);
    
            // Aggiungi lo slug ai dati validati
            $validatedData['slug'] = $slug;
    
            // Aggiorna i dati del tipo
            $type->update($validatedData);
    
            return redirect()->route('admin.type.show', ['type' => $type->slug]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Chiave unica duplicata
                return back()->withInput()->withErrors(['name' => 'Esiste già un tipo con questo nome.']);
            } else {
                // Altro errore SQL
                return back()->withInput()->withErrors(['name' => 'Si è verificato un errore durante l\'aggiornamento del nome.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
{
    // Cerca il tipo per slug
    $type = Type::where('slug', $slug)->first();

    // Verifica che il tipo esista
    if (!$type) {
        return redirect()->route('admin.type.index')->withErrors(['message' => 'Il tipo specificato non esiste.']);
    }

    // Elimina il tipo
    $type->delete();

    return redirect()->route('admin.type.index');
}

}
