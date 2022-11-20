<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function updatePermissions(Request $request): JsonResponse
    {
        $user = $request->user();
        //TODO: Implement Permissions
        return response()->json(['user' => $user]);
    }
}
