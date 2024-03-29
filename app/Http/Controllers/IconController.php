<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function getAll()
    {
        $baseurl = "http://dolphin.academy/";
        $icons = Icon::all();
        foreach ($icons as $icon) {
            $icon->url = $baseurl . $icon->url;
        }
        return $icons;
    }
}
