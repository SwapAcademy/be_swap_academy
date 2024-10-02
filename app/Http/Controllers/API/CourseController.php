<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
}
