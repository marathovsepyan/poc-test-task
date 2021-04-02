<?php


namespace App\Repositories;


use App\Http\Requests\User\RegisterRequest;
use App\Models\Client;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function register(RegisterRequest $request): Client
    {
        $validated = $request->validated();

        $validated["password"] = bcrypt($validated["password"]);

        $user = User::create($validated);

        $client = Client::create($validated);

        $user->client()->associate($client);
        $user->save();

        $client->update([
            "client_name" => $user->first_name . " " . $user->last_name
        ]);

        $client->load("user");

        return $client;
    }
}
