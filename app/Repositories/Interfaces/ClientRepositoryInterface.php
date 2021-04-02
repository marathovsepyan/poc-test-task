<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface ClientRepositoryInterface
{
    public function getAllClients(Request $request);
}
