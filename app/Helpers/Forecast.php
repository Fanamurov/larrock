<?php

namespace App\Helpers;

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
        $xml = simplexml_load_file($this->xml_url); // раскладываем xml на массив
        return $xml->location;
    }
}