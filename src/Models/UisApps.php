<?php

namespace Adminka\Uis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UisApps extends Model
{
    use HasFactory;

    public function getAuthData($app_id)
    {
        $uis_app = $this->find($app_id);
        return [
            "auth_id" => $uis_app["id"]
        ];
    }

    public function getApiData($app_id)
    {
        $uis_app = $this->find($app_id);
        return [
            "auth_id" => $uis_app["id"],
            "access_token" => $uis_app["access_token"]
        ];
    }
}
