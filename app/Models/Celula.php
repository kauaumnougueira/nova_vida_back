<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Celula extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome', 'data_inicio', 'ordem_multiplicacao'
    ];

    public function lider()
    {
        return $this->belongsTo(Membro::class, 'lider_id');
    }

    public function anfitriao()
    {
        return $this->belongsTo(Membro::class, 'anfitriao_id');
    }

    public function viceLider()
    {
        return $this->belongsTo(Membro::class, 'vice_lider_id');
    }

    public function secretario()
    {
        return $this->belongsTo(Membro::class, 'secretario_id');
    }

    public function membrosComCargo($cargo)
    {
        return $this->{$cargo}; // Retorna o membro associado ao cargo dinamicamente
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
