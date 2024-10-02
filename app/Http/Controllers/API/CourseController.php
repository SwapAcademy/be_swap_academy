<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/course",
     *     tags={"Course"},
     *     summary="Get list of Course",
     *     description="Returns a list of Course",
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
    public function getAllCourse(Request $request)
    {
        $course = Course::all();
        return response()->json(['data' => $course], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/course/{userId}",
     *     tags={"Course"},
     *     summary="Get courses by user ID",
     *     description="Returns a list of courses associated with a user",
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
     *                     description="Course details"
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
     *                     description="Date when the user enrolled"
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
    public function getCourseByUser(Request $request, $userId)
    {
        // Ambil semua kursus yang terkait dengan pengguna berdasarkan ID
        $courses = Enrollment::where('users_id', $userId)
            ->with('course') // Asumsikan relasi 'course' ada di model Enrollment
            ->get();

        // Return response dalam bentuk JSON atau view, tergantung kebutuhan
        return response()->json(['data' => $courses]);
    }
}
