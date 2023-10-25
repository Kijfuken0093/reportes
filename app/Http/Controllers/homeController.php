<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     
    public function index():View
    {
        $personas = DB::table('personas')->paginate(10);

        return view('welcome', ['personas' => $personas]);
    }
   

public function reporte(Request $request) {
  
    $nombre = $request->input('nombre');
    $filas = $request->input('filas');
    
  }


}
