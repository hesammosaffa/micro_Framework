<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use App\Utilities\Asset;
use hisorange\BrowserDetect\Parser as Browser;


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
            echo "لطفا ابتدا فیلتر شکن خود را خاموش کرده و مجددا صفحه را رفرش کنید." . "<br>";
            echo " =================================" . "<br>";
            echo "شما از کشور : " . $res->country . "وارد وب سایت شده اید." . "<br>";
            die();
        }
        // var_dump($request);
    }
}
