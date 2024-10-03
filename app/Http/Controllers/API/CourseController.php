<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    /**
     * @OA\Get(
     *     path="/api/course/category",
     *     tags={"Course"},
     *     summary="Get courses by category",
     *     description="Returns a list of courses based on a given category",
     *     security={{"Bearer": {}}},
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Category name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     description="Course ID"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Course title"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Course description"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string",
     *                     description="Course category"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 description="Validation error messages"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function getCourseByCategory(Request $request)
    {

        $credentials = $request->only('category');

        $validator = Validator::make($credentials, [
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }

        // Mengambil kursus berdasarkan kategori yang diberikan
        $courses = Course::where('category', $request->category)->get();

        // Mengembalikan respons JSON dari data kursus
        return response()->json(['data' => $courses], 200);
    }
    /**
     * @OA\Post(
     *     path="/api/courses/{userId}/upload",
     *     summary="Upload a new course",
     *     tags={"Courses"},
     *     description="Endpoint to upload a new course with title, description, category, skill level, and credits required.",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of the user (mentor) who is uploading the course",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "category", "skill_level", "credits_required"},
     *             @OA\Property(property="title", type="string", maxLength=255, example="Introduction to Web Development"),
     *             @OA\Property(property="description", type="string", maxLength=1000, example="This course covers the basics of web development using HTML, CSS, and JavaScript."),
     *             @OA\Property(property="category", type="string", enum={"technology", "design", "management"}, example="technology"),
     *             @OA\Property(property="skill_level", type="string", enum={"beginner", "intermediate", "advanced"}, example="beginner"),
     *             @OA\Property(property="credits_required", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Course uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Course uploaded successfully!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"title": {"The title field is required."}})
     *         )
     *     )
     * )
     */
    public function uploadCourse(Request $request, $userId)
    {
        // Mendefinisikan validasi untuk semua inputan
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'category' => 'required|in:technology,design,management',
            'skill_level' => 'required|in:beginner,intermediate,advanced',
            'credits_required' => 'required|numeric|min:0',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Insert data ke database (misalnya ke tabel courses)
        $course = new Course();
        $course->mentor_id = $userId;
        $course->course_name = $request->title;
        $course->description = $request->description;
        $course->category = $request->category;
        $course->difficulty_level = $request->skill_level;
        $course->duration = 0;
        $course->credits_required = $request->credits_required;
        $course->redemtions = 0;
        $course->point_earn = 0;
        $course->created_at = now();

        $course->save();

        return response()->json(['message' => 'Course uploaded successfully!']);
    }
}
