<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Ajax extends Controller
{
    public function getEditrow(Request $request)
    {
        $value_where = $request->get('value_where');
        $row_where = $request->get('row_where');
        $value = $request->get('value');
        $row = $request->get('row');
        $event = $request->get('event');
        $table = $request->get('table');
        echo '<pre>';
        print_r('1');
        echo '</pre>';
        exit();
    }
}
