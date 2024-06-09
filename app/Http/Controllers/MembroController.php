<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Membro;
use Illuminate\Http\Request;

class MembroController extends Controller
{
    public function index()
    {
        $membros = Membro::where('ativo', 1)
            ->with(['cargos', 'reunioesComoPregador'])
            ->get();

        // Retorna a resposta JSON com os membros
        return response()->json([
            'data' => $membros
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'data_conversao' => 'required|date',
            'data_inicio_celula' => 'required|date',
        ]);

        $membro = Membro::create($validated);
        return response()->json($membro, 201);
    }

    public function show($id)
    {
        $membro = Membro::with(['cargos', 'reunioesComoPregador'])->findOrFail($id);
        return response()->json($membro);
    }

    public function update(Request $request, $id)
    {
        $membro = Membro::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'data_conversao' => 'required|date',
            'data_inicio_celula' => 'required|date',
        ]);

        $membro->update($validated);
        return response()->json($membro);
    }

    public function destroy($id)
    {
        // Encontra o membro pelo ID
        $membro = Membro::find($id);

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
