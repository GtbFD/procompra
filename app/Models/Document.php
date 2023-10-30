<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'ultima_atualizacao',
        'url_arquivo'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
