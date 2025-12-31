<?php

namespace App\Http\Controllers;

use App\Models\Superviseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Throwable;

class SuperviseurController extends Controller
{


    // public function getSuperviseurs()
    // {
    //     try {
    //         $superviseurs = Superviseur::orderBy('id', 'desc')->get();
    //         return response()->json(['success' => true, 'superviseur' => $superviseurs]);
    //     } catch (Throwable $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue lors de la récupération des superviseurs.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getSuperviseurs(Request $request)
{
    try {
        $search = $request->input('search', '');

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

            $query = Superviseur::query();

            // Appliquer les conditions de recherche
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('firstname', 'LIKE', "%{$search}%")
                        ->orWhere('fonction', 'LIKE', "%{$search}%")
                        ->orWhere('service', 'LIKE', "%{$search}%")
                        ->orWhere('profession', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            // Filtrer par user_id
            $query->where('user_id', $userId);

            // Exécuter la requête
            $superviseurs = $query->orderBy('id', 'desc')->paginate(8);

            Log::info('Requête SQL:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);
            Log::info('Superviseurs trouvés:', ['count' => $superviseurs->total()]);

        return response()->json([
            'success' => true,
            'superviseur' => $superviseurs
        ]);
    } catch (Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la récupération des superviseurs.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function saveSuperviseur(Request $request)
    {
        try {
            $id = $request->input('id');
            
            // Règles de validation
            $rules = [
                'firstname' => 'required|string|max:255',
                'fonction' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
            ];


            // Si c'est une mise à jour, exclure l'email et le téléphone actuels de la validation unique
            if ($id) {
                $rules['email'] = 'required|email|max:255|unique:superviseurs,email,' . $id;
                $rules['phone'] = 'required|string|max:15|unique:superviseurs,phone,' . $id;
            } else {
                $rules['email'] = 'required|email|max:255|unique:superviseurs,email';
                $rules['phone'] = 'required|string|max:15|unique:superviseurs,phone';
            }

            $messages = [
                'firstname.required' => 'Le champ nom et prénom est obligatoire.',
                'fonction.required' => 'Le champ fonction est obligatoire.',
                'service.required' => 'Le champ service est obligatoire.',
                'profession.required' => 'Le champ profession est obligatoire.',
                'phone.required' => 'Le numéro de téléphone est obligatoire.',
                'phone.unique' => 'Ce numéro de téléphone est déjà utilisé. Veuillez en choisir un autre.',
                'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 15 caractères.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.unique' => 'Cet email est déjà utilisé. Veuillez en choisir un autre.',
                'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
            ];

            $validated = $request->validate($rules, $messages);

            if ($id) {
                // Mise à jour
                $superviseur = Superviseur::where('id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->firstOrFail();
                
                $superviseur->update($validated);

                return response()->json([
                    'success' => true,
                    'message' => 'Superviseur mis à jour avec succès',
                    'data' => $superviseur
                ], 200);
            } else {
                // Création
            $validated['user_id'] = auth()->user()->id;
            $superviseur = Superviseur::create($validated);

            return response()->json([
                    'success' => true,
                'message' => 'Superviseur enregistré avec succès',
                'data' => $superviseur
                ], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Les messages sont déjà traduits via le paramètre $messages de validate()
            $errors = $e->errors();
            $errorMessages = [];
            
            // Extraire tous les messages d'erreur
            foreach ($errors as $field => $messages) {
                $errorMessages = array_merge($errorMessages, $messages);
            }

            return response()->json([
                'success' => false,
                'message' => !empty($errorMessages) ? implode(' ', $errorMessages) : 'Erreur de validation',
                'errors' => $errors
            ], 422);
        } catch (Throwable $e) {
            Log::error('Erreur lors de la sauvegarde du superviseur:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du superviseur.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSuperviseur($id)
    {
        try {
            $superviseur = Superviseur::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $superviseur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Superviseur supprimé avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Superviseur introuvable ou vous n\'avez pas les droits pour le supprimer.'
            ], 404);
        } catch (Throwable $e) {
            Log::error('Erreur lors de la suppression du superviseur:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du superviseur.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportToExcel(Request $request)
    {
        try {
            $search = $request->input('search', '');
            $userId = auth()->id();

            $query = Superviseur::query();
            
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('firstname', 'LIKE', "%{$search}%")
                        ->orWhere('fonction', 'LIKE', "%{$search}%")
                        ->orWhere('service', 'LIKE', "%{$search}%")
                        ->orWhere('profession', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            $query->where('user_id', $userId);
            $superviseurs = $query->orderBy('id', 'desc')->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Superviseurs');

            // En-têtes
            $headers = ['N°', 'Nom', 'Prénom', 'Fonction', 'Service', 'Profession', 'Téléphone', 'E-mail', 'Date de création'];
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
            $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

            // Données
            $row = 2;
            foreach ($superviseurs as $index => $superviseur) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $superviseur->firstname ?? '');
                $sheet->setCellValue('C' . $row, $superviseur->lastname ?? '');
                $sheet->setCellValue('D' . $row, $superviseur->fonction ?? '');
                $sheet->setCellValue('E' . $row, $superviseur->service ?? '');
                $sheet->setCellValue('F' . $row, $superviseur->profession ?? '');
                $sheet->setCellValue('G' . $row, $superviseur->phone ?? '');
                $sheet->setCellValue('H' . $row, $superviseur->email ?? '');
                $sheet->setCellValue('I' . $row, $superviseur->created_at ? $superviseur->created_at->format('Y-m-d H:i:s') : '');
                $row++;
            }

            // Ajuster la largeur des colonnes
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(20);
            $sheet->getColumnDimension('C')->setWidth(20);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(20);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(25);
            $sheet->getColumnDimension('I')->setWidth(18);

            // Bordures pour toutes les cellules
            $lastRow = $row - 1;
            if ($lastRow > 0) {
                $sheet->getStyle('A1:I' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'superviseurs_' . date('Y-m-d') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (Throwable $e) {
            Log::error('Erreur lors de l\'export Excel des superviseurs:', [
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
