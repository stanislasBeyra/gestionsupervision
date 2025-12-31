<?php

namespace App\Http\Controllers;

use App\Models\Supervision;
use App\Models\Domaine;
use App\Models\Contenu;
use App\Models\Alluquestion;
use App\Models\Methode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Throwable;

class SupervisionsController extends Controller
{

    public function getSupervision(Request $request)
    {
        try {
            $query = Supervision::query();

        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            Log::error('Utilisateur non authentifié');
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        $userId = auth()->id();
        Log::info('User ID:', ['user_id' => $userId]);

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%");
                });
            }

            $query->where('user_id', $userId);
            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function getEnvironnementElement(Request $request)
    {
        try {
            $query = Supervision::query();

            // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            Log::error('Utilisateur non authentifié');
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        $userId = auth()->id();
        Log::info('User ID:', ['user_id' => $userId]);

            // Charger les relations pour récupérer les noms
            $query->with(['domaines', 'contenu', 'question', 'methode']);
            // Filtrer par type = 1
            $query->where('type', 1);

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%")
                        // Recherche dans les noms des relations
                        ->orWhereHas('domaines', function($q) use ($search) {
                            $q->where('name_domaine', 'like', "%$search%");
                        })
                        ->orWhereHas('contenu', function($q) use ($search) {
                            $q->where('name_contenu', 'like', "%$search%");
                        })
                        ->orWhereHas('question', function($q) use ($search) {
                            $q->where('name_question', 'like', "%$search%");
                        })
                        ->orWhereHas('methode', function($q) use ($search) {
                            $q->where('methode_name', 'like', "%$search%");
                        });
                });
            }

            $query->where('user_id', $userId);
            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }


    public function getCompetanceElement(Request $request)
    {
        try {
            $query = Supervision::query();
            // Vérifier si l'utilisateur est authentifié// Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            Log::error('Utilisateur non authentifié');
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        $userId = auth()->id();
        Log::info('User ID:', ['user_id' => $userId]);

            // Charger les relations pour récupérer les noms
            $query->with(['domaines', 'contenu', 'question', 'methode']);

            // Filtrer par type = 2
            $query->where('type', 2);

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%")
                        // Recherche dans les noms des relations
                        ->orWhereHas('domaines', function($q) use ($search) {
                            $q->where('name_domaine', 'like', "%$search%");
                        })
                        ->orWhereHas('contenu', function($q) use ($search) {
                            $q->where('name_contenu', 'like', "%$search%");
                        })
                        ->orWhereHas('question', function($q) use ($search) {
                            $q->where('name_question', 'like', "%$search%");
                        })
                        ->orWhereHas('methode', function($q) use ($search) {
                            $q->where('methode_name', 'like', "%$search%");
                        });
                });
            }

            $query->where('user_id', $userId);
            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }




    public function saveSupervision(Request $request)
    {
        $validated = $request->validate([
            'domaine' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'methode' => 'required|string|max:255',
            'reponse' => 'nullable|string|max:255',
            'note' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'etablissements' => 'required|string|max:255',
            'type' => 'required|integer'
        ]);



        try {
            $supervision = Supervision::create([
                'user_id' => auth()->id(),
                'domaine' => $validated['domaine'],
                'contenu' => $validated['contenu'],
                'question' => $validated['question'],
                'methode' => $validated['methode'],
                'reponse' => $validated['reponse'] ?? null,
                'note' => $validated['note'],
                'type' => $validated['type'],
                'commentaire' => $validated['commentaire'] ?? null,
                'etablissements' => $validated['etablissements'],
                'active' => $request->has('active') ? $request->active : true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supervision créée avec succès',
                'data' => $supervision
            ], 201);
        } catch (\Throwable $t) {
            Log::error('Erreur lors de la création de la supervision : ' . $t->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }



    public function updateSupervision(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:supervisions,id',
            'domaine' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'methode' => 'required|string|max:255',
            'reponse' => 'required|string|max:255',
            'note' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'etablissements' => 'required|string|max:255',
        ]);

        try {
            $supervision = Supervision::where('id', $validated['id'])
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $supervision->update([
                'domaine' => $validated['domaine'],
                'contenu' => $validated['contenu'],
                'question' => $validated['question'],
                'methode' => $validated['methode'],
                'reponse' => $validated['reponse'],
                'note' => $validated['note'],
                'commentaire' => $validated['commentaire'] ?? $supervision->commentaire,
                'etablissements' => $validated['etablissements'],
                'active' => $request->has('active') ? $request->active : $supervision->active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supervision mise à jour avec succès',
                'data' => $supervision
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supervision introuvable ou vous n\'avez pas les droits pour la modifier.'
            ], 404);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteSupervision(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:supervisions,id',
        ]);

        try {
            $supervision = Supervision::where('id', $validated['id'])
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $supervision->delete();

            return response()->json([
                'success' => true,
                'message' => 'Supervision supprimée avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supervision introuvable ou vous n\'avez pas les droits pour la supprimer.'
            ], 404);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }
    public function getsynthese()
{
    try {
        $userId = auth()->id();
        
        // Récupération des données avec les relations, filtrées par user_id
        $data = Supervision::where('user_id', $userId)
            ->with(['domaines:id,name_domaine'])
            ->select('points_disponible', 'note', 'domaine')
            ->get();

        // Grouper les données par domaine
        $grouped = $data->groupBy(function ($item) {
            return $item->domaines->name_domaine ?? 'Non défini';
        });

        // Calculer les synthèses par domaine
        $synthese = $grouped->map(function ($items, $domaine) {
            $points_disponibles = $items->sum('points_disponible');
            $points_obtenus = $items->sum('note');

            return [
                'domaine' => $domaine,
                'points_disponibles' => (float) $points_disponibles,
                'points_obtenus' => (float) $points_obtenus,
                'percentage' => $points_disponibles > 0 ?
                    round(($points_obtenus / $points_disponibles) * 100, 2) : 0
            ];
        })->values();

        // Calculer le total
        $total_points_disponibles = $synthese->sum('points_disponibles');
        $total_points_obtenus = $synthese->sum('points_obtenus');

        // Ajouter le total à la synthèse
        $synthese->push([
            'domaine' => 'TOTAL',
            'points_disponibles' => (float) $total_points_disponibles,
            'points_obtenus' => (float) $total_points_obtenus,
            'percentage' => $total_points_disponibles > 0 ?
                round(($total_points_obtenus / $total_points_disponibles) * 100, 2) : 0
        ]);

        return response()->json([
            'success' => true,
            'synthese' => $synthese
        ]);

    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}


    public function getsyntheses()
{
    try {
        $query = Supervision::query();

        // Récupérer les domaines uniques avec leurs relations
        $domaines = $query->with('domaines')->distinct()->pluck('domaine');

        // Initialiser le tableau de résultats
        $synthese = [];

        foreach ($domaines as $domaine) {
            // Récupérer les supervisions pour le domaine actuel
            $supervisions = $query->where('domaine', $domaine)
                                ->with('domaines')
                                ->get();

            if ($supervisions->isNotEmpty()) {
                // Calculer les points disponibles et obtenus pour le domaine
                $points_disponibles = $supervisions->sum('points_disponibles');
                $points_obtenus = $supervisions->sum('points_obtenus');

                // Calculer le pourcentage pour le domaine avec vérification de division par zéro
                $percentage = $points_disponibles > 0 ? ($points_obtenus / $points_disponibles) * 100 : 0;

                // Récupérer le nom du domaine depuis la relation
                $nomDomaine = $supervisions->first()->domaines ?
                             $supervisions->first()->domaines->name_domaine :
                             $domaine;

                // Ajouter les résultats au tableau de synthèse
                $synthese[] = [
                    'domaine' => $nomDomaine,
                    'points_disponibles' => $points_disponibles,
                    'points_obtenus' => $points_obtenus,
                    'percentage' => round($percentage, 2)
                ];
            }
        }

        if (!empty($synthese)) {
            // Calculer le total des points disponibles et obtenus
            $total_points_disponibles = array_sum(array_column($synthese, 'points_disponibles'));
            $total_points_obtenus = array_sum(array_column($synthese, 'points_obtenus'));

            // Calculer le pourcentage total avec vérification de division par zéro
            $total_percentage = $total_points_disponibles > 0 ?
                              ($total_points_obtenus / $total_points_disponibles) * 100 :
                              0;

            // Ajouter les totaux à la synthèse
            $synthese[] = [
                'domaine' => 'TOTAL',
                'points_disponibles' => $total_points_disponibles,
                'points_obtenus' => $total_points_obtenus,
                'percentage' => round($total_percentage, 2)
            ];
        }

        return response()->json([
            'success' => true,
            'synthese' => $synthese
        ]);

    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}

    public function exportToExcel(Request $request)
    {
        try {
            $query = Supervision::query();
            $userId = auth()->id();
            $query->where('user_id', $userId);

            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%")
                        // Recherche dans les noms des relations
                        ->orWhereHas('domaines', function($q) use ($search) {
                            $q->where('name_domaine', 'like', "%$search%");
                        })
                        ->orWhereHas('contenu', function($q) use ($search) {
                            $q->where('name_contenu', 'like', "%$search%");
                        })
                        ->orWhereHas('question', function($q) use ($search) {
                            $q->where('name_question', 'like', "%$search%");
                        })
                        ->orWhereHas('methode', function($q) use ($search) {
                            $q->where('methode_name', 'like', "%$search%");
                        });
                });
            }

            // Récupérer les supervisions
            $supervisions = $query->orderBy('id', 'desc')->get();

            // Précharger tous les domaines, contenus, questions et méthodes pour éviter les requêtes N+1
            $domaines = Domaine::pluck('name_domaine', 'id')->toArray();
            $contenus = Contenu::pluck('name_contenu', 'id')->toArray();
            $questions = Alluquestion::pluck('name_question', 'id')->toArray();
            $methodes = Methode::pluck('methode_name', 'id')->toArray();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Supervisions');

            $headers = ['N°', 'Date création', 'Établissement', 'Domaine', 'Contenu', 'Question', 'Méthode', 'Réponse', 'Note', 'Commentaire', 'Type', 'Actif'];
            $sheet->fromArray($headers, null, 'A1');

            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563eb']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);

            $row = 2;
            foreach ($supervisions as $index => $supervision) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $supervision->created_at ? $supervision->created_at->format('Y-m-d H:i:s') : '');
                $sheet->setCellValue('C' . $row, $supervision->etablissements ?? '');
                
                // Récupérer les noms depuis les tableaux préchargés en utilisant les IDs
                $domaineId = $supervision->domaine;
                $domaineName = isset($domaines[$domaineId]) ? $domaines[$domaineId] : ($domaineId ?? '');
                
                $contenuId = $supervision->contenu;
                $contenuName = isset($contenus[$contenuId]) ? $contenus[$contenuId] : ($contenuId ?? '');
                
                $questionId = $supervision->question;
                $questionName = isset($questions[$questionId]) ? $questions[$questionId] : ($questionId ?? '');
                
                $methodeId = $supervision->methode;
                // Gérer le cas où methode peut être une chaîne avec virgules (ex: "2,9,10")
                if (strpos($methodeId, ',') !== false) {
                    $methodeIds = explode(',', $methodeId);
                    $methodeNames = [];
                    foreach ($methodeIds as $mid) {
                        $mid = trim($mid);
                        if (isset($methodes[$mid])) {
                            $methodeNames[] = $methodes[$mid];
                        }
                    }
                    $methodeName = !empty($methodeNames) ? implode(', ', $methodeNames) : $methodeId;
                } else {
                    $methodeName = isset($methodes[$methodeId]) ? $methodes[$methodeId] : ($methodeId ?? '');
                }
                
                $sheet->setCellValue('D' . $row, $domaineName);
                $sheet->setCellValue('E' . $row, $contenuName);
                $sheet->setCellValue('F' . $row, $questionName);
                $sheet->setCellValue('G' . $row, $methodeName);
                $sheet->setCellValue('H' . $row, $supervision->reponse ?? '');
                $sheet->setCellValue('I' . $row, $supervision->note ?? '');
                $sheet->setCellValue('J' . $row, $supervision->commentaire ?? '');
                $sheet->setCellValue('K' . $row, $supervision->type == 1 ? 'Environnement' : ($supervision->type == 2 ? 'Compétence' : ''));
                $sheet->setCellValue('L' . $row, $supervision->active ? 'Oui' : 'Non');
                $row++;
            }

            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(30);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(40);
            $sheet->getColumnDimension('K')->setWidth(15);
            $sheet->getColumnDimension('L')->setWidth(10);

            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:L' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'supervisions_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des supervisions:', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'export Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportEnvironnementElement(Request $request)
    {
        try {
            $query = Supervision::query();
            $userId = auth()->id();
            $query->where('user_id', $userId);
            $query->where('type', 1);

            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%")
                        // Recherche dans les noms des relations
                        ->orWhereHas('domaines', function($q) use ($search) {
                            $q->where('name_domaine', 'like', "%$search%");
                        })
                        ->orWhereHas('contenu', function($q) use ($search) {
                            $q->where('name_contenu', 'like', "%$search%");
                        })
                        ->orWhereHas('question', function($q) use ($search) {
                            $q->where('name_question', 'like', "%$search%");
                        })
                        ->orWhereHas('methode', function($q) use ($search) {
                            $q->where('methode_name', 'like', "%$search%");
                        });
                });
            }

            // Récupérer les supervisions
            $supervisions = $query->orderBy('id', 'desc')->get();

            // Précharger tous les domaines, contenus, questions et méthodes pour éviter les requêtes N+1
            $domaines = Domaine::pluck('name_domaine', 'id')->toArray();
            $contenus = Contenu::pluck('name_contenu', 'id')->toArray();
            $questions = Alluquestion::pluck('name_question', 'id')->toArray();
            $methodes = Methode::pluck('methode_name', 'id')->toArray();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Éléments d\'environnement');

            $headers = ['N°', 'Date création', 'Établissement', 'Domaine', 'Contenu', 'Question', 'Méthode', 'Réponse', 'Note', 'Commentaire'];
            $sheet->fromArray($headers, null, 'A1');

            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563eb']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

            $row = 2;
            foreach ($supervisions as $index => $supervision) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $supervision->created_at ? $supervision->created_at->format('Y-m-d H:i:s') : '');
                $sheet->setCellValue('C' . $row, $supervision->etablissements ?? '');
                
                // Récupérer les noms depuis les tableaux préchargés en utilisant les IDs
                $domaineId = $supervision->domaine;
                $domaineName = isset($domaines[$domaineId]) ? $domaines[$domaineId] : ($domaineId ?? '');
                
                $contenuId = $supervision->contenu;
                $contenuName = isset($contenus[$contenuId]) ? $contenus[$contenuId] : ($contenuId ?? '');
                
                $questionId = $supervision->question;
                $questionName = isset($questions[$questionId]) ? $questions[$questionId] : ($questionId ?? '');
                
                $methodeId = $supervision->methode;
                // Gérer le cas où methode peut être une chaîne avec virgules (ex: "2,9,10")
                if (strpos($methodeId, ',') !== false) {
                    $methodeIds = explode(',', $methodeId);
                    $methodeNames = [];
                    foreach ($methodeIds as $mid) {
                        $mid = trim($mid);
                        if (isset($methodes[$mid])) {
                            $methodeNames[] = $methodes[$mid];
                        }
                    }
                    $methodeName = !empty($methodeNames) ? implode(', ', $methodeNames) : $methodeId;
                } else {
                    $methodeName = isset($methodes[$methodeId]) ? $methodes[$methodeId] : ($methodeId ?? '');
                }
                
                $sheet->setCellValue('D' . $row, $domaineName);
                $sheet->setCellValue('E' . $row, $contenuName);
                $sheet->setCellValue('F' . $row, $questionName);
                $sheet->setCellValue('G' . $row, $methodeName);
                $sheet->setCellValue('H' . $row, $supervision->reponse ?? '');
                $sheet->setCellValue('I' . $row, $supervision->note ?? '');
                $sheet->setCellValue('J' . $row, $supervision->commentaire ?? '');
                $row++;
            }

            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(30);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(40);

            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:J' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'elements_environnement_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des éléments d\'environnement:', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'export Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportCompetanceElement(Request $request)
    {
        try {
            $query = Supervision::query();
            $userId = auth()->id();
            $query->where('user_id', $userId);
            $query->where('type', 2);

            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%")
                        // Recherche dans les noms des relations
                        ->orWhereHas('domaines', function($q) use ($search) {
                            $q->where('name_domaine', 'like', "%$search%");
                        })
                        ->orWhereHas('contenu', function($q) use ($search) {
                            $q->where('name_contenu', 'like', "%$search%");
                        })
                        ->orWhereHas('question', function($q) use ($search) {
                            $q->where('name_question', 'like', "%$search%");
                        })
                        ->orWhereHas('methode', function($q) use ($search) {
                            $q->where('methode_name', 'like', "%$search%");
                        });
                });
            }

            // Récupérer les supervisions
            $supervisions = $query->orderBy('id', 'desc')->get();

            // Précharger tous les domaines, contenus, questions et méthodes pour éviter les requêtes N+1
            $domaines = Domaine::pluck('name_domaine', 'id')->toArray();
            $contenus = Contenu::pluck('name_contenu', 'id')->toArray();
            $questions = Alluquestion::pluck('name_question', 'id')->toArray();
            $methodes = Methode::pluck('methode_name', 'id')->toArray();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Éléments de compétence');

            $headers = ['N°', 'Date création', 'Établissement', 'Domaine', 'Contenu', 'Question', 'Méthode', 'Réponse', 'Note', 'Commentaire'];
            $sheet->fromArray($headers, null, 'A1');

            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563eb']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

            $row = 2;
            foreach ($supervisions as $index => $supervision) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $supervision->created_at ? $supervision->created_at->format('Y-m-d H:i:s') : '');
                $sheet->setCellValue('C' . $row, $supervision->etablissements ?? '');
                
                // Récupérer les noms depuis les tableaux préchargés en utilisant les IDs
                $domaineId = $supervision->domaine;
                $domaineName = isset($domaines[$domaineId]) ? $domaines[$domaineId] : ($domaineId ?? '');
                
                $contenuId = $supervision->contenu;
                $contenuName = isset($contenus[$contenuId]) ? $contenus[$contenuId] : ($contenuId ?? '');
                
                $questionId = $supervision->question;
                $questionName = isset($questions[$questionId]) ? $questions[$questionId] : ($questionId ?? '');
                
                $methodeId = $supervision->methode;
                // Gérer le cas où methode peut être une chaîne avec virgules (ex: "2,9,10")
                if (strpos($methodeId, ',') !== false) {
                    $methodeIds = explode(',', $methodeId);
                    $methodeNames = [];
                    foreach ($methodeIds as $mid) {
                        $mid = trim($mid);
                        if (isset($methodes[$mid])) {
                            $methodeNames[] = $methodes[$mid];
                        }
                    }
                    $methodeName = !empty($methodeNames) ? implode(', ', $methodeNames) : $methodeId;
                } else {
                    $methodeName = isset($methodes[$methodeId]) ? $methodes[$methodeId] : ($methodeId ?? '');
                }
                
                $sheet->setCellValue('D' . $row, $domaineName);
                $sheet->setCellValue('E' . $row, $contenuName);
                $sheet->setCellValue('F' . $row, $questionName);
                $sheet->setCellValue('G' . $row, $methodeName);
                $sheet->setCellValue('H' . $row, $supervision->reponse ?? '');
                $sheet->setCellValue('I' . $row, $supervision->note ?? '');
                $sheet->setCellValue('J' . $row, $supervision->commentaire ?? '');
                $row++;
            }

            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(30);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(40);

            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:J' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'elements_competance_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des éléments de compétence:', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'export Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportSynthese()
    {
        try {
            $userId = auth()->id();
            
            $data = Supervision::where('user_id', $userId)
                ->with(['domaines:id,name_domaine'])
                ->select('points_disponible', 'note', 'domaine')
                ->get();

            $grouped = $data->groupBy(function ($item) {
                return $item->domaines->name_domaine ?? 'Non défini';
            });

            $synthese = $grouped->map(function ($items, $domaine) {
                $points_disponibles = $items->sum('points_disponible');
                $points_obtenus = $items->sum('note');

                return [
                    'domaine' => $domaine,
                    'points_disponibles' => (float) $points_disponibles,
                    'points_obtenus' => (float) $points_obtenus,
                    'percentage' => $points_disponibles > 0 ?
                        round(($points_obtenus / $points_disponibles) * 100, 2) : 0
                ];
            })->values();

            $total_points_disponibles = $synthese->sum('points_disponibles');
            $total_points_obtenus = $synthese->sum('points_obtenus');

            $synthese->push([
                'domaine' => 'TOTAL',
                'points_disponibles' => (float) $total_points_disponibles,
                'points_obtenus' => (float) $total_points_obtenus,
                'percentage' => $total_points_disponibles > 0 ?
                    round(($total_points_obtenus / $total_points_disponibles) * 100, 2) : 0
            ]);

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Synthèse supervision');

            $headers = ['Domaine', 'Points disponibles', 'Points obtenus', '%'];
            $sheet->fromArray($headers, null, 'A1');

            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563eb']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

            $row = 2;
            foreach ($synthese as $item) {
                $sheet->setCellValue('A' . $row, $item['domaine']);
                $sheet->setCellValue('B' . $row, $item['points_disponibles']);
                $sheet->setCellValue('C' . $row, $item['points_obtenus']);
                $sheet->setCellValue('D' . $row, $item['percentage'] . '%');
                $row++;
            }

            $sheet->getColumnDimension('A')->setWidth(30);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(18);
            $sheet->getColumnDimension('D')->setWidth(10);

            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:D' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'synthese_supervision_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel de la synthèse:', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'export Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
