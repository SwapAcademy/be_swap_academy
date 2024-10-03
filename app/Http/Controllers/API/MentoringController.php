<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
}
