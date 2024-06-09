<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membro extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'membros';

    protected $fillable = [
        'nome',
        'endereco',
        'telefone',
        'data_conversao',
        'data_inicio_celula',
    ];

    public $timestemps = true;

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

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'membro_cargo')
            ->withPivot('data_associacao', 'deleted_at')
            ->withTimestamps();
    }

    public function reunioesComoPregador()
    {
        return $this->hasMany(Reuniao::class, 'pregador_id');
    }
}
