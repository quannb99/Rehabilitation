<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * send api response Success
     *
     * @param  mixed $data
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data, $message = '', $code = 200)
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message,
        ], $code);
    }

    /**
     * send api response Error
     *
     * @param  string $mesage
     * @param  string $title
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message = '', $error, $title = '', $code = 400)
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message,
            'error' => $error,
            'title' => $title,
        ], $code);
    }
}
