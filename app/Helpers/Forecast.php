<?php

namespace App\Helpers;

use Cache;

class Forecast{

    protected $xml_url;

    public function render($url)
    {
        if( !empty($url)){
            $this->xml_url = $url;
            return $this->parse();
        }else{
            return NULL;
        }
    }

    public function parse()
    {
        $xml = Cache::remember(sha1('forecast'. $this->xml_url), 60*22, function() {
            $xml = simplexml_load_file($this->xml_url); // раскладываем xml на массив
            if(isset($xml->location)){
                return json_encode($xml->location);
            }else{
                return NULL;
            }
        });
        return json_decode($xml, true);
    }
}