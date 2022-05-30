<?php

namespace App\Http\Controllers;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function getPoli(){
        $posts = Poli::all();
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $posts  
        ], 200);
    }
}
