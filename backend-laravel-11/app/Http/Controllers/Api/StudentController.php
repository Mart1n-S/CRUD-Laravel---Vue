<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Aucun résultat'
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $cleanPhoneNumber = str_replace(['+33 ', ' '], ['0', ''], $request->phoneNumber);

        // Mettre à jour la requête avec le numéro de téléphone nettoyé
        $request->merge(['phoneNumber' => $cleanPhoneNumber]);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'email' => 'required|email|max:180',
            'phoneNumber' => 'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            try {
                Student::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                ]);
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Étudiant créé avec succès'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Une erreur s\'est produite!'
                ], 500);
            }
        }
    }

    public function show(int $id)
    {
        try {
            $student = Student::findOrFail($id);
    
            // Si l'étudiant est trouvé, retourner les détails de l'étudiant
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } catch (\Exception $e) {
            // En cas d'exception, retourner une réponse d'erreur
            return response()->json([
                'status' => 404,
                'message' => 'Étudiant non trouvé'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            // Nettoyer le numéro de téléphone
            $cleanPhoneNumber = str_replace(['+33 ', ' '], ['0', ''], $request->phoneNumber);

            // Mettre à jour la requête avec le numéro de téléphone nettoyé
            $request->merge(['phoneNumber' => $cleanPhoneNumber]);

            // Valider les données
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:30',
                'lastname' => 'required|string|max:30',
                'email' => 'required|email|max:180',
                'phoneNumber' => 'required|digits:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            } else {
                // Trouver l'étudiant
                $student = Student::find($id);

                if ($student) {
                    // Mettre à jour l'étudiant avec les données validées
                    $student->update([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'email' => $request->email,
                        'phoneNumber' => $request->phoneNumber,
                    ]);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Étudiant mis à jour avec succès'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Étudiant non trouvé'
                    ], 404);
                }
            }
        } catch (\Exception $e) {
            // En cas d'exception, retourner une réponse d'erreur
            return response()->json([
                'status' => 500,
                'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'étudiant'
            ], 500);
        }
    }

    public function delete(int $id)
    {
        try {
            // Trouver l'étudiant
            $student = Student::find($id);

            if ($student) {
                // Mettre à jour l'étudiant avec les données validées
                $student->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Étudiant supprimé avec succès'
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Étudiant non trouvé'
                ], 404);
            }
        } catch (\Exception $e) {
            // En cas d'exception, retourner une réponse d'erreur
            return response()->json([
                'status' => 500,
                'message' => 'Une erreur s\'est produite lors de la suppression de l\'étudiant'
            ], 500);
        }
    }

}
