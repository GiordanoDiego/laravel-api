<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import helper
use Illuminate\Support\Str;

//model
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
      

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|max:1024',
            'content' => 'required|max:4096',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array', 
        ],
        [
            'title.required' => 'Devi inserire un titolo',
            'title.max' => 'Non puoi inserire un titolo più lungo di 1024 caratteri ',
            'content.required' => 'Devi necessariamente inserire una descrizione del progetto ',
            'content.max' => 'Non puoi inserire una descrizione più lunga di 4096 caratteri ',
            'type_id.required' => 'Devi selezionare un tipo per il progetto',
            'type_id.exists' => 'Il tipo selezionato non è valido',
        ]);

      
        $slug = Str::slug($validatedData['title']);

        
        $validatedData['slug'] = $slug;

        $type = Type::findOrFail($validatedData['type_id']);

      
        $project = new Project($validatedData);
        $project->type()->associate($type);
        $project->save();

       
        if (isset($validatedData['technologies'])) {
            $technologies = Technology::findOrFail($validatedData['technologies']);
            $project->technologies()->attach($technologies);
        }

        return redirect()->route('admin.project.show', ['project' => $project->slug]);
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            // Chiave unica duplicata
            return back()->withInput()->withErrors(['title' => 'Esiste già un progetto con questo titolo.']);
        } else {
            return back()->withInput()->withErrors(['title' => 'Si è verificato un errore durante la creazione del progetto.']);
        }
    }
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('technologies')->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types = Type::all();
        $allTechnologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'allTechnologies'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|max:1024',
            'content' => 'required|max:4096',
            'type_id' => 'required|exists:types,id', 
            'technologies' => 'array', 
        ], [
            // Regole di validazione...
        ]);

        // Genera lo slug dal titolo
        $slug = Str::slug($validatedData['title']);

        // Aggiungi lo slug ai dati validati
        $validatedData['slug'] = $slug;

        // Aggiorna i dati del progetto con i dati validati
        $project->update($validatedData);

        // Aggiorna le relazioni con le tecnologie
        if (isset($validatedData['technologies'])) {
            // Recupera le istanze delle tecnologie corrispondenti agli ID forniti
            $technologies = Technology::find($validatedData['technologies']);

            // Sincronizza le tecnologie associate al progetto
            $project->technologies()->sync($technologies);
        } else {
            // Se non sono state fornite nuove tecnologie, stacca tutte le tecnologie associate al progetto
            $project->technologies()->detach();
        }

        return redirect()->route('admin.project.show', ['project' => $project->slug]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Chiave unica duplicata
                return back()->withInput()->withErrors(['title' => 'Esiste già un progetto con questo titolo.']);
            } else {
                return back()->withInput()->withErrors(['title' => 'Si è verificato un errore durante l\'aggiornamento del progetto.']);
            }
        }
    }

    




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
       
        $project->delete();

        return redirect()->route('admin.project.index');
    }
}
