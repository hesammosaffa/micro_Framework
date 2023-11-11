<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use App\Utilities\Asset;



class BlockIp implements MiddlewareInterface
{

    public function handle()
    {
        global $request;

        $res = file_get_contents('https://www.iplocate.io/api/lookup/' . $request->getIp());
        $res = json_decode($res);
        if ($res->country != "Iran" && !is_null($res->country)) {
            $data = ['country' => $res->country];
            Asset::view('errors.vpn', $data);
            die();
        }
    }
}
