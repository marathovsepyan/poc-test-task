<?php

namespace App\Models;

use App\Services\GeocodingService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
        "zip",
        "status"
    ];

    public static function boot()
    {
        parent::boot();

        Client::creating(function (Client $client) {
            $now = Carbon::now();
            $client->start_validity = $now;
            $client->end_validity = $now->clone()->addDays(15);
            $client->status = "Active";

            $coordinates = GeocodingService::getCoordinates(
                $client->zip . " " .
                $client->country . " " .
                $client->city . " " .
                $client->address1
            );

            $client->latitude = $coordinates["lat"];
            $client->longitude = $coordinates["lng"];
        });
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
