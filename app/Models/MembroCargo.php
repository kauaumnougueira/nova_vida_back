<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembroCargo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'membro_cargo';

    protected $fillable = ['membro_id', 'cargo_id', 'celula_id', 'data_associacao'];

    // Relacionamento com o modelo Membro
    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }

    // Relacionamento com o modelo Cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Define o evento que será acionado antes de excluir um registro
        static::deleting(function ($membro) {
            // Atualiza o campo 'ativo' para 0 ao excluir o registro
            $membro->ativo = 0;
            $membro->save(); // Salva as alterações no banco de dados
        });
    }
}
