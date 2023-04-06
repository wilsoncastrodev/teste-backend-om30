<?php

namespace App\Http\Controllers\Api;

use \Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    public function sendResponse(mixed $result, int $code = 200, string $message = null): Response
    {
        $response['data'] = $result;

        if ($message) {
            $response['message'] = $message;
        }

        return response($response, $code);
    }

    public function sendError(string $message, array $errorMessages = [], int $code = 404): Response
    {
        $response['message'] = $message;

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response($response, $code);
    }

    public function sendErrorException(Exception $e, int $code = 500): Response
    {
        Log::error($e);

        $response['message'] = 'Ocorreu um erro interno e sua solicitação não foi concluída';

        return response($response, $code);
    }
}
