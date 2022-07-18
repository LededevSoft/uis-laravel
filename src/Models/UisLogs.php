<?php

namespace LebedevSoft\Uis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UisLogs extends Model
{
    use HasFactory;

    public $timestamps = false;

    private $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function addLog($event, $status, $data)
    {
        $log = [
            "source" => $this->source,
            "event" => $event,
            "status" => $status,
            "data" => json_encode($data)
        ];
        return $this->insertGetId($log);
    }
}
