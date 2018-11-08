<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Transformers\Api\UserTransformer;

/**
 * @resource Me
 * @OpenApiOperationTag Manager:Me
 */
class MeController extends ApiController
{
    /**
     * Get current user.
     *
     * @OpenApiOperationId getUser
     * @OpenApiResponseSchemaRef #/components/schemas/UserResponse
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     * @OpenApiResponseDescription A User
     *
     * @return \Dingo\Api\Http\Response|void
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return $this->response->item($user, new UserTransformer);
    }
}
