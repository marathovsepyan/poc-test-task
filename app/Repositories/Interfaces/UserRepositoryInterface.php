<?php


namespace App\Repositories\Interfaces;


use App\Http\Requests\User\RegisterRequest;
use App\Models\Client;

interface UserRepositoryInterface
{
    public function register(RegisterRequest $request): Client;
}
