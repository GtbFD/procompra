<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'cnpj',
        'email',
        'razao_social',
        'telefone',
        'rua',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'email_documento_enviado'
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
