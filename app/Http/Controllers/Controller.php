<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="TernakLomba API Documentation", version="1.0")
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     type="http",
 *     in="header",
 *     name="Authorization",
 *     description="Enter token in format (Bearer <token>)"
 * )
 */
abstract class Controller
{
    
}
