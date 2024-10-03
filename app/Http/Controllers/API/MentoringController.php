<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
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
    /**
     * @OA\Get(
     *     path="/api/mentoring/{userId}",
     *     tags={"Mentoring"},
     *     summary="Get mentoring by user ID",
     *     description="Returns a list of Mentoring sessions associated with a user based on their enrollment in courses.",
     *     security={{"Bearer": {}}},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="course",
     *                     type="object",
     *                     description="Details of the course the user is enrolled in",
     *                     @OA\Property(
     *                         property="course_name",
     *                         type="string",
     *                         description="Name of the course"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                         description="Category of the course"
     *                     ),
     *                     @OA\Property(
     *                         property="difficulty_level",
     *                         type="string",
     *                         description="Difficulty level of the course"
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="mentoring",
     *                     type="object",
     *                     description="Mentoring details",
     *                     @OA\Property(
     *                         property="mentor_name",
     *                         type="string",
     *                         description="Name of the mentor"
     *                     ),
     *                     @OA\Property(
     *                         property="mentor_specialization",
     *                         type="string",
     *                         description="Specialization of the mentor"
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="progress",
     *                     type="integer",
     *                     description="User's progress in the course"
     *                 ),
     *                 @OA\Property(
     *                     property="enrollment_at",
     *                     type="string",
     *                     format="date",
     *                     description="Date when the user enrolled in the course"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function getMentoringByUser(Request $request, $userId)
    {
        // Ambil semua mentoring yang terkait dengan pengguna berdasarkan ID
        $Mentoring = Enrollment::where('mentor_id', $userId)
            ->with('mentoring') // Asumsikan relasi 'mentoring' ada di model Enrollment
            ->get();

        // Return response dalam bentuk JSON atau view, tergantung kebutuhan
        return response()->json(['data' => $Mentoring]);
    }
}
