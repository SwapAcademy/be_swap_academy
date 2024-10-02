<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *     @OA\Info(title="Swap Academy API Documentation", version="1.0"),
 *     @OA\Server(url="https://be-swap-academy.nioke-studio.my.id"),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             securityScheme="Bearer",
 *             type="http",
 *             scheme="bearer",
 *             description="Enter your bearer token below. Example: `Bearer your.jwt.token`"
 *         )
 *     )
 * )
 */
abstract class Controller
{
    //
}
