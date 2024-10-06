<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserThirdApiRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserThirdApiController extends Controller
{

    public function __construct(public UserService $userService)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UserThirdApiRequest $request)
    {
        if ($request->input('email')) {
            $this->userService->updateUserIndividual($request->input('email' ));
            return response()->noContent();
        }
    }
}
