<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    public function index()
    {
        $presencas = Presenca::all();
        return response()->json($presencas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'reuniao_id' => 'required|exists:reunioes,id',
            'membro_id' => 'required|exists:membros,id',
        ]);

        $presenca = Presenca::create($request->all());

        return response()->json($presenca, 201);
    }

    public function show($id)
    {
        $presenca = Presenca::findOrFail($id);
        return response()->json($presenca);
    }

    public function update(Request $request, $id)
    {
        $presenca = Presenca::findOrFail($id);

        $request->validate([
            'reuniao_id' => 'required|exists:reunioes,id',
            'membro_id' => 'required|exists:membros,id',
        ]);

        $presenca->update($request->all());

        return response()->json($presenca);
    }

    public function destroy($id)
    {
        $presenca = Presenca::findOrFail($id);
        $presenca->delete();
        return response()->json(['message' => 'Presença desativada com sucesso']);
    }
}
