<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
    public function index()
    {
        // return response()->json(['categorias' => Categoria::all()]);

        // return CategoriaResource::collection(Categoria::all());
        return new CategoriaCollection(Categoria::all());
    }
}
