<?php


namespace LebedevSoft\Uis\Libs;

use LebedevSoft\Uis\Models\UisApps;
use Illuminate\Database\Eloquent\Model;

class UisAuth
{
    private $api_data;
    private $db_apps;

    /**
     * AmoCRM constructor.
     * @param $app_id - id інтеграції, збереженої в БД
     */
    public function __construct($app_id)
    {
        $this->db_apps = new UisApps();
        $api_data = $this->db_apps->getAuthData($app_id);
        if ($api_data) {
            $this->api_data = $api_data;
        } else {
            dd("Not app in DB");
        }
    }

}
