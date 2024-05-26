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
            $student = Student::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Student created Successfully'
                ], 200);
            }else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong!'
                ], 500);
            }
        }
    }
}
