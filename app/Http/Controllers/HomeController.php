<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Models\Etablissement;
use App\Models\Supervision;
use App\Models\Superviseur;
use App\Models\Superviser;
use App\Models\Probleme;

class HomeController extends Controller
{

    public function getpage($page)
    {
        try {
            switch ($page) {
                
                case 'index':
                    return view('welcome');
                case 'supervision':
                    return view('pages.supervision');
                case 'outildesupervision':
                    return view('pages.outildesupervision');

                case 'lessupervisee':
                    return view('pages.lessupervisee');

                case 'synthesesupervision':
                    return view('pages.synthesesupervision');
            }
        } catch (Throwable $t) {
            Log::info($t);
        }
    }

    public function pageviews($page)
    {
        try {
            switch ($page) {
                case 'register':
                    return view('auth.register');
                case 'login':
                    return view('auth.login');
                case 'dashboard':
                    return view('dashboard');

                case 'created':
                    return view('newpages.creationdesupervision');

                case 'etablissementsanitaire':
                    return view('newpages.etablissementsanitaire');

                case 'identifiantsuperviser':
                    return view('newpages.identifiantsuperviser');

                case 'identifiantsuperviseurs':
                    return view('newpages.idenfiantsuperviseurs');

                case 'synthesesupervision':
                    return view('newpages.synthesesupervision');

                case 'problemeprioritaire':
                    return view('newpages.problemeprioritaire');
                case 'environnementElement':
                    return view('newpages.environnementElement');

                case 'conpetanceElement':
                    return view('newpages.conpetanceElement');
            }
        } catch (Throwable $t) {
            Log::info($t);
        }
    }

    // Fonction pour le nombre d'établissements sanitaires
    public function getEtablissementCount()
    {
        $count = Etablissement::count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre de supervisions réalisées
    public function getSupervisionCount()
    {
        $count = Supervision::count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre de superviseurs
    public function getSuperviseurCount()
    {
        $count = Superviseur::count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre de supervisés
    public function getSuperviserCount()
    {
        $count = Superviser::count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre de problèmes prioritaires
    public function getProblemeCount()
    {
        $count = Probleme::count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre d'éléments de compétence (type=2)
    public function getCompetanceElementCount()
    {
        $count = Supervision::where('type', 2)->count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour le nombre d'éléments d'environnement (type=1)
    public function getEnvironnementElementCount()
    {
        $count = Supervision::where('type', 1)->count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    // Fonction pour les statistiques de supervisions par mois (année en cours)
    public function getSupervisionStatsByMonth()
    {
        $year = date('Y');
        $currentMonth = date('n');
        $moisNoms = [
            1 => 'janvier',
            2 => 'février',
            3 => 'mars',
            4 => 'avril',
            5 => 'mai',
            6 => 'juin',
            7 => 'juillet',
            8 => 'août',
            9 => 'septembre',
            10 => 'octobre',
            11 => 'novembre',
            12 => 'décembre',
        ];
        $stats = Supervision::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $result = [];
        for ($i = 1; $i <= $currentMonth; $i++) {
            $result[$moisNoms[$i]] = 0;
        }
        foreach ($stats as $stat) {
            if ($stat->month <= $currentMonth) {
                $result[$moisNoms[$stat->month]] = $stat->count;
            }
        }
        return response()->json(['success' => true, 'data' => $result]);
    }

    // Fonction pour les statistiques de supervisions par semaine (année en cours)
    public function getSupervisionStatsByWeek()
    {
        $year = date('Y');
        $stats = Supervision::selectRaw('WEEK(created_at, 1) as week, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $currentWeek = (int)date('W');
        $result = [];
        for ($i = 1; $i <= $currentWeek; $i++) {
            $result['S' . $i] = 0;
        }
        foreach ($stats as $stat) {
            if ($stat->week <= $currentWeek) {
                $result['S' . (int)$stat->week] = $stat->count;
            }
        }
        return response()->json(['success' => true, 'data' => $result]);
    }

    // Fonction pour les statistiques de supervisions par jour de la semaine en cours
    public function getSupervisionStatsCurrentWeekByDay()
    {
        // Début et fin de la semaine en cours (lundi à dimanche)
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $jours = [
            1 => 'lundi',
            2 => 'mardi',
            3 => 'mercredi',
            4 => 'jeudi',
            5 => 'vendredi',
            6 => 'samedi',
            7 => 'dimanche',
        ];
        $stats = Supervision::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $result = [];
        for ($i = 1; $i <= 7; $i++) {
            $result[$jours[$i]] = 0;
        }
        foreach ($stats as $stat) {
            // DAYOFWEEK: 1=dimanche, 2=lundi, ..., 7=samedi
            $jourIndex = $stat->day == 1 ? 7 : $stat->day - 1; // Pour avoir 1=lundi, 7=dimanche
            $result[$jours[$jourIndex]] = $stat->count;
        }
        return response()->json(['success' => true, 'data' => $result]);
    }
}
