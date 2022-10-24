<?php
/**
 * Created by PhpStorm.
 * User: Bawa, Lakhveer
 * Email: iamdeep.dhaliwal@gmail.com
 * Date: 2020-06-14
 * Time: 12:18 p.m.
 */

namespace App\Traits;

//use App\Http\Resources\Ghost\EmptyResource;
//use App\Http\Resources\Ghost\EmptyResourceCollection;
use Error;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

/**
 * Trait ApiResponseTrait
 * @package App\Http\Traits
 */
trait ApiResponseTrait
{
    /**
     * @param $resource
     * @param null $message
     * @param int $status_code
     * @param array $headers
     * @return JsonResponse
     */
    protected function respond_success_data($resource, $message = 'common.success', $status_code = 200, $headers = []): JsonResponse
    {
        return $this->api_response(
            [
                'success' => true,
                'result' => $resource,
                'message' => trans($message)
            ], $status_code, $headers
        );
    }

    /**
     * @param array $data
     * @param int $status_code
     * @param array $headers
     * @return array
     */
    public function parse_given_data($data = [], $status_code = 200, $headers = []): array
    {

        $response_structure = [
            'success' => $data['success'],
            'result' => $data['result'] ?? null,

        ];
        if (isset($data['errors'])) {
            $response_structure['errors'] = $data['errors'];
        }
//        echo $data['message'];
        if (isset($data['message'])) {
            $response_structure['message'] = trans($data['message']);
        } else {
            $response_structure['message'] = null;
        }

//        if (isset($data['status'])) {
//            $status_code = $data['status'];
//        }

        if (config('app.debug')) {
            if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
                $response_structure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
                if ($status_code === 200) {
                    $status_code = 500;
                }
            }
            if (isset($data['error_type'])) {
                $response_structure['error_type'] = $data['error_type'];
            }
        }
        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $response_structure['error_code'] = $data['error_code'];
            } else {
                $response_structure['error_code'] = $status_code;
            }
        }
        return ['content' => $response_structure, 'statusCode' => $status_code, 'headers' => $headers];
    }


    /*
     *
     * Just a wrapper to facilitate abstract
     */

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $status_code
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function api_response($data = [], $status_code = 200, $headers = []): JsonResponse
    {
        $result = $this->parse_given_data($data, $status_code, $headers);
        return response()->json($result['content'], $result['statusCode'], $result['headers']);
    }

    /*
     *
     * Just a wrapper to facilitate abstract
     */


    /**
     * Respond with success.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respond_success($message = 'common.success'): JsonResponse
    {
        return $this->api_response(['success' => true, 'message' => $message]);
    }

    /**
     * Respond with created.
     *
     * @param $message
     * @return JsonResponse
     */
    protected function respond_created($message): JsonResponse
    {
        return $this->api_response(['success' => true, 'message' => $message], 201);
    }

    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respond_no_content($message = 'No Content Found'): JsonResponse
    {
        return $this->api_response(['success' => false, 'message' => $message], 200);
    }


    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respond_un_authorized($message = 'Unauthorized'): JsonResponse
    {
        return $this->respond_error($message, 401);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param int $status_code
     * @param int $error_code
     * @return JsonResponse
     */
    protected function respond_error(string $message, int $status_code = 400, int $error_code = 1): JsonResponse
    {
        return $this->api_response(
            [
                'success' => false,
                'message' => trans($message),
                'error_code' => $error_code
            ], $status_code
        );
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respond_forbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->respond_error($message, 403);
    }


    /**
     * Respond with failed login.
     *
     * @param array|Application|Translator|string|null $message
     * @return JsonResponse
     */
    protected function respond_failed_login($message = 'auth.failed'): JsonResponse
    {
        return $this->api_response([
            'success' => false,
            'error_type' => 'failed login',
            'message' => $message
        ], 422);
    }


    protected function respond_validation_errors(ValidationException $exception): JsonResponse
    {
        return $this->api_response(
            [
                'success' => false,
                'message' => $exception->getMessage(),
                'errors' => $exception->errors()
            ],
            422
        );
    }

    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respond_not_found($message = 'Not Found')
    {
        return $this->respond_error($message, 404);
    }
}
