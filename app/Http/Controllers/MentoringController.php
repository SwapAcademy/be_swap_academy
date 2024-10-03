<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use Illuminate\Http\Request;

class MentoringController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/mentoring",
     *     tags={"Mentoring"},
     *     summary="Get list of Mentoring",
     *     description="Returns a list of Mentoring",
     *     security={{"Bearer": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     * )
     */
    public function showAllMentoring()
    {
        $mentoring = Mentoring::all();
        return response()->json(['data' => $mentoring], 200);
    }

    public function getMentoringByUser(Request $request, $userId)
    {
        // Ambil semua kursus yang terkait dengan pengguna berdasarkan ID
        $courses = Enrollment::where('users_id', $userId)
            ->with('course') // Asumsikan relasi 'course' ada di model Enrollment
            ->get();

        // Return response dalam bentuk JSON atau view, tergantung kebutuhan
        return response()->json(['data' => $courses]);
    }
}
