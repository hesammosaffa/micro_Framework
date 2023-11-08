<?php

namespace App\Controllers;

use App\Utilities\Asset;

class ArchiveController
{

    public function index()
    {
        Asset::view('archive.index');
    }

    public function articles()
    {
        Asset::view('archive.articles');
    }

    public function products()
    {
        Asset::view('archive.products');
    }

}