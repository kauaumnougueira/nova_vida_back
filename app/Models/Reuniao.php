<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reuniao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "reunioes";

    protected $fillable = [
        'data',
        'pregador_id',
        'tema',
        'duracao',
        'presentes',
        'visitantes',
    ];

    protected $dates = ['deleted_at'];

    public function pregador()
    {
        return $this->belongsTo(Membro::class, 'pregador_id');
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
