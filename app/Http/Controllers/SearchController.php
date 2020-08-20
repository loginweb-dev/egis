<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medidore;
use App\Transformadore;
use App\Proteccione;
use App\Search;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    function search_first($code)
    {
        Search::create([
            'user_id' => Auth::user()->id,
            'criterio' => $code
        ]);

        $find = Medidore::where('codigo', $code)->first();
        if ($find) {
            return response()->json([
                'find' => $find,
                'table' => 'Medidores' 
                ]);
        }else{
            $find = Transformadore::where('codigo', $code)->first();
            if($find){
                return response()->json([
                    'find' => $find,
                    'table' => 'Transformadores' 
                ]);
            }else{
                $find = Proteccione::where('codigo', $code)->first();
                if ($find) {
                    return response()->json([
                        'find' => $find,
                        'table' => 'Protecciones' 
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Busqueda NO encontrada'
                    ]);
                }
            }
        }
    }
}
