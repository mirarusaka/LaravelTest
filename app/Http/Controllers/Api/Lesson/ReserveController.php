<?php

namespace App\Http\Controllers\Api\Lesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Reservation;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Lesson $lesson)
    {
        $user = Auth::user();
        try {
            $user->canReserve($lesson);
        } catch (Exception $e) {
            return response()->json(['error' => '予約できません。：' . $e->getMessage()], Response::HTTP_CONFLICT);
        }
        $reservation = Reservation::create(['lesson_id' => $lesson->id, 'user_id' => $user->id]);

        return response()->json($reservation, Response::HTTP_CREATED);
    }
}
