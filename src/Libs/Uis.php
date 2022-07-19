<?php


namespace LebedevSoft\Uis\Libs;

use LebedevSoft\Uis\Models\UisApps;
use LebedevSoft\Uis\Models\UisLogs;
use Illuminate\Database\Eloquent\Model;

class Uis
{
    private $db_apps;
    private $db_logs;
    /**
     * @var string access token from amoCRM
     */
    private $access_token;
    /**
     * Uis constructor.
     * @param $app_id - id інтеграції, збереженої в БД
     */
    function __construct($app_id)
    {
        $this->db_logs = new UisLogs("uis_lib");
        $this->db_apps = new UisApps();
        $api_data = $this->db_apps->getApiData($app_id);
        if (($api_data) && (!empty($api_data["access_token"]))) {
            $this->api_data = $api_data;
            $this->access_token = $api_data["access_token"];
        } else {
            $this->db_logs->addLog("construct", "error", ["error" => "Not access token"]);
            dd("Not access token");
        }
    }

    private function getCURL()
    {
        $url = "https://dataapi.uiscom.ru/v2.0";
		$headers = array("Content-Type: application/json");
        $error_codes = [-32001,-32602,-32603,-32700];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $out = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($out, true);
		
        if ((isset($res["error"]["code"])) && (in_array($res["error"]["code"], $error_codes))) {
            $this->db_logs->addLog("getCURL", "error", ["path" => parse_url($url, PHP_URL_PATH), "params" => $data, "response" => $res]);
            return $this->postCURL($data);
        } else {
            $this->db_logs->addLog("getCURL", "success", ["path" => parse_url($url, PHP_URL_PATH), "params" => $data, "response" => $res]);
            return $res;
        }
    }

    private function postCURL($data)
    {
		
		$url = "https://dataapi.uiscom.ru/v2.0";
		$headers = array("Content-Type: application/json");
        $error_codes = [-32001,-32602,-32603,-32700];
		
		$curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $out = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($out, true);

        if ((isset($res["error"]["code"])) && (in_array($res["error"]["code"], $error_codes))) {
            $this->db_logs->addLog("postCURL", "error", ["path" => parse_url($url, PHP_URL_PATH), "params" => $data, "response" => $res]);
            return $this->postCURL($data);
        } else {
            $this->db_logs->addLog("postCURL", "success", ["path" => parse_url($url, PHP_URL_PATH), "params" => $data, "response" => $res]);
            return $res;
        }
    }

    public function getCallsReport($date_from,$date_till,$page)
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.calls_report","params":{"access_token":"'.$this->access_token.'","limit":1000,"offset":'.$page.',"date_from":"'.$date_from.'","date_till":"'.$date_till.'"}}';
        return $this->postCURL($data);
    }
	public function getFinancial_call_legs_report($date_from,$date_till,$page)
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.financial_call_legs_report","params":{"access_token":"'.$this->access_token.'","limit":1000,"offset":'.$page.',"date_from":"'.$date_from.'","date_till":"'.$date_till.'"}}';
        return $this->postCURL($data);
    }
	public function getCallLegsReport($date_from,$date_till,$page)
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.call_legs_report","params":{"access_token":"'.$this->access_token.'","limit":1000,"offset":'.$page.',"date_from":"'.$date_from.'","date_till":"'.$date_till.'"}}';
        return $this->postCURL($data);
    }
	public function getEmployees()
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.employees","params":{"access_token":"'.$this->access_token.'"}}';
        return $this->postCURL($data);
    }
	public function getGroup_employees()
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.group_employees","params":{"access_token":"'.$this->access_token.'"}}';
        return $this->postCURL($data);
    }
	public function getTags()
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.tags","params":{"access_token":"'.$this->access_token.'"}}';
        return $this->postCURL($data);
    }
	public function getStatuses()
    {
		$data='{"jsonrpc":"2.0","id":2,"method":"get.statuses","params":{"access_token":"'.$this->access_token.'"}}';
        return $this->postCURL($data);
    }	
}
