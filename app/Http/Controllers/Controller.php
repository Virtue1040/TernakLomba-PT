<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(title="TernakLomba API Documentation", 
 * description="The **TernakLomba API** is a robust and scalable solution for managing competitive events, participants, scores, and results. 
 *   It is designed to support a wide range of competitions, from small local events to large-scale tournaments. 
 *  Key features include:
 *  - **Competition Management**: Create, update, and manage competitions with details such as name, description, start/end dates, and status.
 *  - **Participant Management**: Register and manage participants, including their details and competition assignments.
 *  - **Score Management**: Submit and manage scores for participants, with support for multiple judges and scoring criteria.
 *  - **Results and Leaderboards**: Automatically calculate and display competition results, including rankings and leaderboards.
 *  - **Judging Criteria**: Define custom judging criteria for competitions to ensure fair and transparent evaluations.
 *  - **Notifications**: Send real-time notifications to participants and judges about competition updates, scores, and results.
 *  This API is ideal for event organizers, educational institutions, and organizations hosting competitive events.",version="1.0",
 * @OA\Contact(email="support@ternaklomba.com", name="the developer"),
 * @OA\License(name="Apache 2.0", url="http://www.apache.org/licenses/LICENSE-2.0"),
 * @OA\License(name="MIT", url="http://opensource.org/licenses/MIT"),
 * @OA\Server(url="https://ternaklomba.com/", description="Main server"),
 * @OA\Server(url="http://localhost:8000/", description="Local server"))
 * 
 * @OA\Tag(name="Authentication", description="Authentication endpoints"),
 * 
 * @OA\Tag(name="Competitions", description="Manage competitive events"),
 * @OA\Tag(name="Participants", description="Manage participants in competitions"),
 * @OA\Tag(name="Teams", description="Manage teams"),
 * @OA\Tag(name="Scores", description="Manage scores and evaluations"),
 * @OA\Tag(name="Results", description="Manage results and rankings"),
 * 
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
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
