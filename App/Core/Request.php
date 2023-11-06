<?php

namespace App\Core;

class Request
{
    private $params;
    private $agent;
    private $ip;
    private $methode;

    public function __construct()
    {
        $this->agent = $_SERVER['HTTP_USER_AGENT']; # Browser data
        $this->methode = $_SERVER['REQUEST_METHOD'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->params = $_REQUEST; # POST & GET
    }

    public function __get($name)
    {
      if($this->isset($name))
    return $this->input($name);
     else return "property does not exist";
    }

    public function getMethode()
    {
        return $this->methode;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function input($key)
    {
        return $this->params[$key] ?? null;
    }

    public function isset($key)
    {
        return isset($this->params[$key]);
    }

    public function redirect($route)
    {
        header("Location: " . site_url($route));
        die();
    }
}
