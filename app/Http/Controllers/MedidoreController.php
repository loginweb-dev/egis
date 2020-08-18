<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medidore;
class MedidoreController extends Controller
{
    function medidor_first($code)
    {
        
        $medidor = Medidore::where('codigo', $code)->first();

        // if ($medidor) {
        //     return response()->json($medidor);
        // }else{

        // }
        return response()->json($medidor);
        
    }
}
