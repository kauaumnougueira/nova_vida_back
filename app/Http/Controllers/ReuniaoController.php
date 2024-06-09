<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use Illuminate\Http\Request;

class ReuniaoController extends Controller
{
    public function index()
    {
        $reunioes = Reuniao::withTrashed()->get();
        return response()->json(['data' => $reunioes]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required|date',
            'pregador_id' => 'required|exists:membros,id',
            'tema' => 'required|string',
            'duracao' => 'required|integer',
            'presentes' => 'nullable|integer',
            'visitantes' => 'nullable|integer',
        ]);

        $reuniao = Reuniao::create($validatedData);

        return response()->json($reuniao, 201);
    }

    public function show($id)
    {
        $reuniao = Reuniao::withTrashed()->findOrFail($id);
        return response()->json($reuniao);
    }

    public function update(Request $request, $id)
    {
        $reuniao = Reuniao::withTrashed()->findOrFail($id);

        $validatedData = $request->validate([
            'data' => 'required|date',
            'pregador_id' => 'required|exists:membros,id',
            'tema' => 'required|string',
            'duracao' => 'required|integer',
            'presentes' => 'nullable|integer',
            'visitantes' => 'nullable|integer',
        ]);

        $reuniao->update($validatedData);

        return response()->json($reuniao);
    }

    public function destroy($id)
    {
        $reuniao = Reuniao::withTrashed()->findOrFail($id);
        $reuniao->delete();
        return response()->json(['message' => 'Reunião deletada com sucesso']);
    }
}
