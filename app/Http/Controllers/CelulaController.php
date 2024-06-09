<?php

namespace App\Http\Controllers;

use App\Models\Celula;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CelulaController extends Controller
{
    public function index()
    {
        $celulas = Celula::all();
        return response()->json(['data' => $celulas]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'ordem_multiplicacao' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $celula = Celula::create($request->all());

        return response()->json(['data' => $celula], 201);
    }

    public function show($id)
    {
        $celula = Celula::findOrFail($id);
        return response()->json(['data' => $celula]);
    }

    public function update(Request $request, $id)
    {
        $celula = Celula::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'ordem_multiplicacao' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $celula->update($request->all());

        return response()->json(['data' => $celula]);
    }

    public function destroy($id)
    {
        $celula = Celula::findOrFail($id);
        $celula->delete();

        return response()->json(['message' => 'Celula deleted successfully']);
    }
}
