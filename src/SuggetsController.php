<?php namespace NMinten\OverheidAPI;

class SuggetsController{
    private $api_key;
    private $query_string;
    private $api_url = "http://api.overheid.io/suggest/openkvk";
    private $failsafe = true;


    // First function adds the api key to a global variable
    public function set_api_key($key){
        $this->api_key = "?ovio-api-key=" . $key;
    }

    // makes a connection to the api
    public function connect() {
        if ($this->query_string != null && $this->api_key != null && $this->failsafe) {
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

    public function set_query_string ($string) {
        if ($string != "" || $string != null) {
            $this->api_url .= sprintf("/%s", $string);
        }
    }

    public function set_query ($size, $field) {
        $field = strtolower($field);
        if ($field == "handelsnaam" || $field == "dossiernummer") {
            $this->query_string = "&size=".$size."&fields[]=" . $field;
            echo $this->query_string;
            //$this->query_string = sprintf("&size=%d&fields[]=%s", $size, $field);
        }
        else {
            $this->failsafe = false;
        }
    }

}