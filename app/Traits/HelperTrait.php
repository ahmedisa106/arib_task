<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

trait HelperTrait
{
    /**
     * @param $request
     * @return array
     */
    public function getAuthenticationCredentials($request): array
    {
        $field_is_email = filter_var($request->field, FILTER_VALIDATE_EMAIL);
        if ($field_is_email) {
            $credentials['email'] = $request->field;
        } else {
            $credentials['phone'] = $request->field;
        }
        $credentials['password'] = $request->password;
        return $credentials;
    }// end of getAuthenticationCredentials function

    public function uploadFile($file, $dir, $old = '')
    {
        if (!empty($old)) {
            Storage::disk('public')->delete($old);
        }
        $file_name = time() . '_' . $file->getClientOriginalName();
        if (!file_exists(storage_path('app/public/' . $dir))) {
            mkdir(storage_path('app/public/' . $dir), 0777);
        }
        return $file->storeAs($dir, $file_name, 'public');
    }// end of uploadFile function

    /**
     * @param int $status
     * @param string $message
     * @param array|string $errors
     * @param array|object $data
     * @param array|null $pagination_urls
     * @return JsonResponse
     */
    public function final_response(int $status = 200, string $message = '', array|string $errors = [], array|object $data = [], array|null $pagination_urls = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ];
        if (!empty($pagination_urls)) {
            $response['pagination_urls'] = $pagination_urls;
        }
        return response()->json($response, $status);
    }
}
