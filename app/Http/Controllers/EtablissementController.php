<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Throwable;

class EtablissementController extends Controller
{


    public function statistiqueselements()
    {
        try {
            $etablissements = Etablissement::count();
            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEtablissements(Request $request)
    {
        try {
            $query = Etablissement::query();
            // ajout were pour la recuperation des etablissement
            // de l'utilisateur connecter avec where user_id=auth()->user()->id
            $query->where('user_id', auth()->user()->id);
            // Récupération du mot-clé de recherche depuis la requête
            $search = $request->input('search');

            if ($search) {
                $query->where('direction_regionale', 'LIKE', "%{$search}%")
                    ->orWhere('district_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('etablissement_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('categorie_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('code_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('responsable', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            }

            $etablissements = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function saveEtablissement(Request $request)
    {
        try {
            $validated = $request->validate([
                'direction_regionale' => 'required|string|max:255',
                'district_sanitaire' => 'required|string|max:255',
                'etablissement_sanitaire' => 'required|string|max:255',
                'categorie_etablissement' => 'required|string',
                'code_etablissement' => 'required|string|unique:etablissements,code_etablissement',
                'periode' => 'required|string|max:255',
                'periodicite' => 'required|string|max:255',
                'date_debut' => 'required|',
                'date_fin' => 'required|',
                'responsable' => 'required|string|max:255',
                'telephone' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
            //  Log::info('User ID:', ['user_id' => auth()->user()]);

            // ajout de user_id pour la relation avec l'utilisateur
            $validated['user_id'] = auth()->user()->id;
            $etablissement = Etablissement::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Établissement enregistré avec succès',
                'data' => $etablissement
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de l\'enregistrement de l\'établissement.', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de l\'enregistrement de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'enregistrement de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEtablissement($id)
    {
        try {
            $etablissement = Etablissement::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $etablissement->delete();

            Log::info('Établissement supprimé avec succès', ['id' => $id]);
            return response()->json([
                'success' => true,
                'message' => 'Établissement supprimé avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Établissement introuvable ou vous n\'avez pas les droits pour le supprimer.'
            ], 404);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la suppression de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function updateEtablissement(Request $request, $id)
    {
        try {
            $etablissement = Etablissement::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $validated = $request->validate([
                'direction_regionale' => 'required|string|max:255',
                'district_sanitaire' => 'required|string|max:255',
                'etablissement_sanitaire' => 'required|string|max:255',
                'categorie_etablissement' => 'required|string',
                'code_etablissement' => 'required|string|unique:etablissements,code_etablissement,' . $etablissement->id,
                'periode' => 'required|string|max:255',
                'periodicite' => 'required|string|max:255',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
                'responsable' => 'required|string|max:255',
                'telephone' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Mise à jour des données de l'établissement
            $etablissement->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Établissement mis à jour avec succès',
                'data' => $etablissement
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Établissement introuvable ou vous n\'avez pas les droits pour le modifier.'
            ], 404);
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la mise à jour de l\'établissement.', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la mise à jour de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getEtablissementById($id)
    {
        try {
            $etablissement = Etablissement::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $etablissement
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Établissement introuvable ou vous n\'avez pas les droits pour y accéder.'
            ], 404);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la récupération de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getEtablissementsByUserId($userId)
    {
        try {
            $etablissements = Etablissement::where('user_id', $userId)->get();

            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la récupération des établissements par utilisateur.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function countEtablissement()
    {
        try {
            $count = Etablissement::where('user_id', auth()->user()->id)->count();

            Log::info('Nombre d\'établissements:', ['count' => $count]);
            return response()->json([
                'success' => true,
                'data' => $count
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors du comptage des établissements.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du comptage des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportToExcel(Request $request)
    {
        try {
            $query = Etablissement::query();
            $query->where('user_id', auth()->user()->id);
            
            $search = $request->input('search');
            if ($search) {
                $query->where('direction_regionale', 'LIKE', "%{$search}%")
                    ->orWhere('district_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('etablissement_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('categorie_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('code_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('responsable', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            }

            $etablissements = $query->orderBy('id', 'desc')->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Établissements');

            // En-têtes
            $headers = ['N°', 'Direction Régionale', 'District Sanitaire', 'Établissement', 'Catégorie', 'Code', 'Période', 'Périodicité', 'Date début', 'Date fin', 'Responsable', 'Téléphone', 'E-mail', 'Date de création'];
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
            $sheet->getStyle('A1:N1')->applyFromArray($headerStyle);

            // Données
            $row = 2;
            foreach ($etablissements as $index => $etablissement) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $etablissement->direction_regionale ?? '');
                $sheet->setCellValue('C' . $row, $etablissement->district_sanitaire ?? '');
                $sheet->setCellValue('D' . $row, $etablissement->etablissement_sanitaire ?? '');
                $sheet->setCellValue('E' . $row, $etablissement->categorie_etablissement ?? '');
                $sheet->setCellValue('F' . $row, $etablissement->code_etablissement ?? '');
                $sheet->setCellValue('G' . $row, $etablissement->periode ?? '');
                $sheet->setCellValue('H' . $row, $etablissement->periodicite ?? '');
                $sheet->setCellValue('I' . $row, $etablissement->date_debut ? date('Y-m-d', strtotime($etablissement->date_debut)) : '');
                $sheet->setCellValue('J' . $row, $etablissement->date_fin ? date('Y-m-d', strtotime($etablissement->date_fin)) : '');
                $sheet->setCellValue('K' . $row, $etablissement->responsable ?? '');
                $sheet->setCellValue('L' . $row, $etablissement->telephone ?? '');
                $sheet->setCellValue('M' . $row, $etablissement->email ?? '');
                $sheet->setCellValue('N' . $row, $etablissement->created_at ? $etablissement->created_at->format('Y-m-d H:i:s') : '');
                $row++;
            }

            // Ajuster la largeur des colonnes
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(20);
            $sheet->getColumnDimension('C')->setWidth(20);
            $sheet->getColumnDimension('D')->setWidth(30);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(12);
            $sheet->getColumnDimension('J')->setWidth(12);
            $sheet->getColumnDimension('K')->setWidth(25);
            $sheet->getColumnDimension('L')->setWidth(15);
            $sheet->getColumnDimension('M')->setWidth(25);
            $sheet->getColumnDimension('N')->setWidth(18);

            // Bordures pour toutes les cellules
            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:N' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'etablissements_sanitaires_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des établissements:', [
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
