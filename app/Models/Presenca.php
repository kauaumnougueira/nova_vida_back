<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presenca extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['reuniao_id', 'membro_id', 'data'];

    // Relacionamento com Membro
    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }

    // Relacionamento com Reuniao
    public function reuniao()
    {
        return $this->belongsTo(Reuniao::class);
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
