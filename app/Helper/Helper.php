<?php

namespace App\Helper;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function instance()
    {
        return new AppHelper();
    }
}