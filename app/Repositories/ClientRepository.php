<?php


namespace App\Repositories;


use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\Request;

class ClientRepository implements ClientRepositoryInterface
{
    protected $filterable = [
        "client_name",
        "address1",
        "address2",
        "city",
        "state",
        "country",
        "latitude",
        "longitude",
        "phone_no1",
        "phone_no2",
        "zip"
    ];

    public function getAllClients(Request $request)
    {
        $clients = Client::query()
            ->with("user");

        foreach ($this->filterable as $key) {
            $val = $request->get($key);

            if (!$val) {
                continue;
            }

            $clients->orWhere($key, "like", "%{$val}%");
        }

        $orderKey = $request->get("order_key");
        $orderDirection = $request->get("order_direction");

        if ($orderKey && $orderDirection && in_array($orderKey, $this->filterable)) {
            $clients->orderBy($orderKey, $orderDirection);
        }

        return $clients->paginate(5);
    }
}
