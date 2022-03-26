<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Services\NotificationService;
use App\Http\Resources\Notification;

class NotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     *
     * @OA\Get (
     *  path="/api/notifications/my-notifications",
     *  tags={"Notification"},
     *
     *  @OA\Parameter(
     *    name="page",
     *    in="query",
     *    @OA\Schema(
     *      type="integer",
     *      minimum=1,
     *      default=1
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="page_size",
     *    in="query",
     *    @OA\Schema(
     *      type="integer",
     *      default=20
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="read",
     *    in="query",
     *    @OA\Schema(
     *      type="integer", minimum=0, maximum=1
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="received",
     *    in="query",
     *    @OA\Schema(
     *      type="integer", minimum=0, maximum=1
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="platform",
     *    in="query",
     *    @OA\Schema(
     *      type="integer", nullable=true
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="key",
     *    in="query",
     *    @OA\Schema(
     *      type="string", nullable=true
     *    )
     *  ),
     *  @OA\Response (
     *    response=200,
     *    description="Return Notifications",
     *    @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                   ref="App\Http\Resources\Notification\Notification"
     *              )
     *          )
     *      )
     *    )
     *  )
     * )
     *
     */

    public function myNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = $this->notificationService->getUserNotifications($user->id, $request);

        return $notifications;
    }

}
