<?php

namespace App\Http\Controllers;

use App\Models\Probleme;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Throwable;

class ProblemeController extends Controller
{
    // Récupérer tous les problèmes
    // public function getProbleme()
    // {
    //     try {

    //         $probleme = Probleme::orderBy('id', 'desc')->get();
    //         return response()->json(['success' => true, 'problemes' => $probleme]);
    //     } catch (Throwable $t) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue',
    //             'error' => $t->getMessage()
    //         ], 500);
    //     }
    // }

    public function getProbleme(Request $request)
{
    try {
        // Récupération des paramètres de recherche et de pagination
        $search = $request->input('search', ''); // Le terme de recherche

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

        $query = Probleme::query();
        $perPage = $request->input('per_page', 10); // Nombre d'éléments par page, valeur par défaut = 10

        // Appliquer les conditions de recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('probleme', 'LIKE', "%{$search}%")
                    ->orWhere('causes', 'LIKE', "%{$search}%")
                    ->orWhere('actions', 'LIKE', "%{$search}%")
                    ->orWhere('sources', 'LIKE', "%{$search}%")
                    ->orWhere('acteurs', 'LIKE', "%{$search}%")
                    ->orWhere('ressources', 'LIKE', "%{$search}%")
                    ->orWhere('delai', 'like', "%$search%");
            });
        }

        // Filtrer par user_id
        $query->where('user_id', $userId);

        // Exécuter la requête
        $probleme = $query->orderBy('id', 'desc')->paginate(5);

        // Retourner les résultats paginés
        return response()->json([
            'success' => true,
            'problemes' => $probleme
        ]);
    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}


    // Enregistrer un nouveau problème
    public function saveProbleme(Request $request)
    {
        try {
            $validated = $request->validate([
                'probleme' => 'required|string',
                'causes' => 'required|string',
                'actions' => 'required|string',
                'sources' => 'required|string',
                'acteurs' => 'required|string',
                'ressources' => 'required|string',
                'delai' => 'required|string',
            ]);

            $validated['user_id'] = auth()->user()->id;
            $probleme = Probleme::create($validated);
            Log::info('Nouveau problème ajouté', ['probleme' => $probleme]);

            return response()->json([
                'success' => true,
                'message' => 'Problème ajouté avec succès',
                'data' => $probleme,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteProbleme($id)
    {
        try {
            $probleme = Probleme::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $probleme->delete();

            return response()->json([
                'success' => true,
                'message' => 'Problème supprimé avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Problème introuvable ou vous n\'avez pas les droits pour le supprimer.'
            ], 404);
        } catch (Throwable $e) {
            Log::error('Erreur lors de la suppression du problème:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du problème.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportToExcel(Request $request)
    {
        try {
            $search = $request->input('search', '');
            $userId = auth()->id();

            $query = Probleme::query();
            
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('probleme', 'LIKE', "%{$search}%")
                        ->orWhere('causes', 'LIKE', "%{$search}%")
                        ->orWhere('actions', 'LIKE', "%{$search}%")
                        ->orWhere('sources', 'LIKE', "%{$search}%")
                        ->orWhere('acteurs', 'LIKE', "%{$search}%")
                        ->orWhere('ressources', 'LIKE', "%{$search}%")
                        ->orWhere('delai', 'LIKE', "%{$search}%");
                });
            }

            $query->where('user_id', $userId);
            $problemes = $query->orderBy('id', 'desc')->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Problèmes prioritaires');

            // En-têtes
            $headers = ['N°', 'Date de création', 'Problème', 'Causes', 'Actions', 'Sources', 'Acteurs', 'Ressources', 'Délai', 'Date de modification'];
            $sheet->fromArray($headers, null, 'A1');

            // Style des en-têtes
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

            // Données
            $row = 2;
            foreach ($problemes as $index => $probleme) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $probleme->created_at ? $probleme->created_at->format('Y-m-d H:i:s') : '');
                $sheet->setCellValue('C' . $row, $probleme->probleme ?? '');
                $sheet->setCellValue('D' . $row, $probleme->causes ?? '');
                $sheet->setCellValue('E' . $row, $probleme->actions ?? '');
                $sheet->setCellValue('F' . $row, $probleme->sources ?? '');
                $sheet->setCellValue('G' . $row, $probleme->acteurs ?? '');
                $sheet->setCellValue('H' . $row, $probleme->ressources ?? '');
                $sheet->setCellValue('I' . $row, $probleme->delai ?? '');
                $sheet->setCellValue('J' . $row, $probleme->updated_at ? $probleme->updated_at->format('Y-m-d H:i:s') : '');
                $row++;
            }

            // Ajuster la largeur des colonnes
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(30);
            $sheet->getColumnDimension('E')->setWidth(30);
            $sheet->getColumnDimension('F')->setWidth(20);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(20);
            $sheet->getColumnDimension('I')->setWidth(15);
            $sheet->getColumnDimension('J')->setWidth(18);

            // Bordures pour toutes les cellules
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
            $fileName = 'problemes_prioritaires_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des problèmes:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'export Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
