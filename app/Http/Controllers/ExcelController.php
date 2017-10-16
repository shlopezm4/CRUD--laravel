<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Maatwebsite\Excel\Facades\Excel;



class ExcelController extends Controller
{
    public function index()
    {
    
           Excel::create('Laravel Excel', function ($excel) {
               $excel->sheet('Productos', function ($sheet) {
                   $producto = Producto::all();
                   $sheet->fromArray($producto);
               });
           })->export('xls');
    }
}
