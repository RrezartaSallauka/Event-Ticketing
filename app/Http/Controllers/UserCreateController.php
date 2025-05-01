<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserCreateController extends Controller
{
    public function __construct(
        private readonly UserService $service
    ) {
    }

    public function __invoke(UserCreateRequest $request): JsonResponse
    {
        $this->service->create($request);

        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }
}
