<?php namespace NMinten\OverheidAPI;

class KVKIDController{
    private $api_key;
    private $query_string;
    private $api_url = "http://api.overheid.io/openkvk";

    // First function adds the api key to a global variable
    public function set_api_key($key){
        $this->api_key = "?ovio-api-key=" . $key;
    }

    // makes a connection to the api
    public function connect() {
        if ($this->api_key != null) {
            try {
                $response = file_get_contents($this->api_url . $this->api_key . $this->query_string);
                return json_decode($response);
            }
            catch (\Exception $e) {
                return sprintf("{\"status\": \"Something went wrong while connecting to the api\", \"error message\": \"%s\"}", $e);
            }
        }
        else {
            return "{\"status\": \"Not all fields required for a connection are filled in !\"}";
        }
    }

    public function set_id ($id) {
        $this->api_url .= sprintf("/%s/", $id);
    }

}