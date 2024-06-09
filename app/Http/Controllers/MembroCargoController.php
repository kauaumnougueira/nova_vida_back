<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MembroCargo;
use Illuminate\Http\Request;

class MembroCargoController extends Controller
{

    public function index()
    {
        $associacoes = MembroCargo::where('ativo', true)->get();

        return response()->json($associacoes);
    }
    /**
     * Associa um membro a um cargo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function associar(Request $request)
    {
        $request->validate([
            'membro_id' => 'required|exists:membros,id',
            'cargo_id' => 'required|exists:cargos,id',
            'celula_id' => 'required|exists:celulas,id',
            'data_associacao' => 'required|date',
        ]);

        $membroCargo = MembroCargo::create($request->all());

        return response()->json($membroCargo, 201);
    }

    /**
     * Remove a associação de um membro com um cargo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desassociar($id)
    {
        $membroCargo = MembroCargo::findOrFail($id);
        $membroCargo->delete();

        return response()->json(['message' => 'Associação desativada com sucesso']);
    }
}
