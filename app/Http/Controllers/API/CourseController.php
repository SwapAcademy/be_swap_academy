<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Video;
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
     *     path="/api/course/upload-course",
     *     summary="Upload a new course",
     *     tags={"Course"},
     *     security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "title", "description", "category", "skill_level", "credits_required"},
     *             @OA\Property(property="user_id", type="integer", example=1, description="ID of the mentor uploading the course"),
     *             @OA\Property(property="title", type="string", maxLength=255, example="Introduction to Web Development", description="Title of the course"),
     *             @OA\Property(property="description", type="string", maxLength=1000, example="This course will teach you the basics of web development.", description="Brief description of the course"),
     *             @OA\Property(property="category", type="string", enum={"technology", "design", "management"}, example="technology", description="Category of the course"),
     *             @OA\Property(property="skill_level", type="string", enum={"beginner", "intermediate", "advanced"}, example="beginner", description="Difficulty level of the course"),
     *             @OA\Property(property="credits_required", type="integer", example=5, description="The number of credits required to enroll in the course")
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
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="user_id", type="array", @OA\Items(type="string", example="The user id field is required.")),
     *                 @OA\Property(property="title", type="array", @OA\Items(type="string", example="The title field is required.")),
     *                 @OA\Property(property="description", type="array", @OA\Items(type="string", example="The description field is required.")),
     *                 @OA\Property(property="category", type="array", @OA\Items(type="string", example="The category field is required.")),
     *                 @OA\Property(property="skill_level", type="array", @OA\Items(type="string", example="The skill level field is required.")),
     *                 @OA\Property(property="credits_required", type="array", @OA\Items(type="string", example="The credits required field is required."))
     *             )
     *         )
     *     )
     * )
     */
    public function uploadCourse(Request $request)
    {
        // Mendefinisikan validasi untuk semua inputan
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
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
        $course->mentor_id = $request->user_id;
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

    /**
     * @OA\Post(
     *     path="/api/course/uploadVideoByCourse",
     *     tags={"Course"},
     *     security={{"Bearer": {}}},
     *     summary="Upload a video for a specific course",
     *     description="This endpoint allows you to upload a video file associated with a course.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="video",
     *                     type="string",
     *                     format="binary",
     *                     description="The video file to be uploaded"
     *                 ),
     *                 @OA\Property(
     *                     property="course_id",
     *                     type="integer",
     *                     description="The ID of the course to which the video belongs"
     *                 ),
     *                 required={"video", "course_id"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Video uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Video uploaded successfully!"),
     *             @OA\Property(property="video_path", type="string", example="videos/1624362337_video.mp4")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error or no video uploaded",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object"),
     *             @OA\Property(property="message", type="string", example="No video file uploaded.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object"),
     *             @OA\Property(property="message", type="string", example="The selected course_id is invalid.")
     *         )
     *     )
     * )
     */
    public function uploadVideoByCourse(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:10240', // batas maksimal ukuran 10 MB
            'course_id' => 'required|exists:course,id',
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Memeriksa apakah file video diunggah
        if ($request->hasFile('video')) {
            // Mengambil file video dan menyimpan dengan nama yang unik
            $video = $request->file('video');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $videoPath = $video->storeAs('videos', $videoName, 'public');

            // Menyimpan data video ke database
            $videoModel = new Video();
            $videoModel->course_id = $request->course_id;
            $videoModel->path = $videoPath;
            $videoModel->publish_at = now();
            $videoModel->save();

            // Mengembalikan respons sukses dengan path video
            return response()->json([
                'message' => 'Video uploaded successfully!',
                'video_path' => $videoPath,
            ], 200);
        }

        // Mengembalikan pesan error jika file video tidak ditemukan
        return response()->json(['message' => 'No video file uploaded.'], 400);
    }
    /**
     * @OA\Post(
     *     path="/api/course/takeCourse",
     *     summary="Purchase a course",
     *     security={{"Bearer": {}}},
     *     description="Allows a user to purchase a course using their credits.",
     *     operationId="takeCourse",
     *     tags={"Course"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1, description="The ID of the user purchasing the course."),
     *             @OA\Property(property="course_id", type="integer", example=1, description="The ID of the course to be purchased.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Course purchased successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Course purchased successfully!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", @OA\AdditionalProperties(type="array", @OA\Items(type="string")))
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Insufficient credits to purchase this course",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Insufficient credits to purchase this course.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Course already purchased",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="You have already purchased this course.")
     *         )
     *     )
     * )
     */

    public function takeCourse(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);


        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Ambil data user
        $user = User::where('id', $request->user_id)->first();

        // Ambil data course
        $course = Course::where('id', $request->course_id)->first();

        // Cek apakah user sudah membeli kursus ini sebelumnya
        $existingPurchase = Enrollment::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->first();

        if ($existingPurchase) {
            return response()->json(['message' => 'You have already purchased this course.'], 409);
        }


        // cek apakah course yang dibeli mencukupi credit dari user
        if ($user->credits < $course->credits_required) {
            return response()->json(['message' => 'Insufficient credits to purchase this course.'], 403);
        }

        // Buat entri baru di tabel purchases
        $Enrollment = new Enrollment();
        $Enrollment->user_id = $request->user_id;
        $Enrollment->course_id = $request->course_id;
        $Enrollment->enrollment_at = now();
        $Enrollment->progress = 0;
        $Enrollment->status = 'not started';

        $Enrollment->save();

        // Mengembalikan respons sukses
        return response()->json(['message' => 'Course purchased successfully!'], 201);
    }
}
