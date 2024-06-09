<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $membros = Cargo::where('ativo', 1)->get();

        // Retorna a resposta JSON com os membros
        return response()->json([
            'data' => $membros
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ]);

        $membro = Cargo::create($validated);
        return response()->json($membro, 201);
    }

    public function show($id)
    {
        $membro = Cargo::findOrFail($id);
        return response()->json($membro);
    }

    public function update(Request $request, $id)
    {
        $membro = Cargo::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ]);

        $membro->update($validated);
        return response()->json($membro);
    }

    public function destroy($id)
    {
        // Encontra o membro pelo ID
        $membro = Cargo::find($id);

        if (!$membro) {
            // Retorna uma resposta not found se o membro não for encontrado
            return response()->json(['message' => 'Membro não encontrado'], 404);
        }

        // Realiza o soft delete do membro
        $membro->delete();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Membro deletado com sucesso']);
    }
}
