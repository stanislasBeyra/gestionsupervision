<?php

namespace App\Http\Controllers;

use App\Models\ContenuSelect;
use App\Models\DomaineSelect;
use App\Models\MethodeSelect;
use App\Models\NoteSelect;
use App\Models\QuestionSelect;
use Illuminate\Http\Request;
use Throwable;

class FormSelectedController extends Controller
{

    // Récupérer les domaines
    public function getDomaines()
    {
       try{
        $domaines = DomaineSelect::where('active', true)
        ->orderBy('name')
        ->get();

    return response()->json(['domaine'=>$domaines]);
       }catch(Throwable $t){
        return response()->json(['error'=>$t],500);
       }
    }

    // Récupérer les contenus
    public function getContenus()
    {
        $contenus = ContenuSelect::where('active', true)
            ->orderBy('name')
            ->get();

        return response()->json(['contenus'=>$contenus]);
    }

    // Récupérer les questions
    public function getQuestions()
    {
        $questions = QuestionSelect::where('active', true)
            ->orderBy('name')
            ->get();

        return response()->json(['questions'=>$questions]);
    }

    // Récupérer les méthodes
    public function getMethodes()
    {
        $methodes = MethodeSelect::where('active', true)
            ->orderBy('name')
            ->get();

        return response()->json(['methodes'=>$methodes]);
    }

    // Récupérer les notes
    public function getNotes()
    {
        $notes = NoteSelect::where('active', true)
            ->orderBy('value')
            ->get();

        return response()->json(['notes'=>$notes]);
    }

    // Récupérer toutes les données en une seule fois
    public function getAllSelects()
    {
        $data = [
            'domaines' => DomaineSelect::where('active', true)->orderBy('name')->get(),
            'contenus' => ContenuSelect::where('active', true)->orderBy('name')->get(),
            'questions' => QuestionSelect::where('active', true)->orderBy('name')->get(),
            'methodes' => MethodeSelect::where('active', true)->orderBy('name')->get(),
            'notes' => NoteSelect::where('active', true)->orderBy('value')->get(),
        ];

        return response()->json($data);
    }
}
