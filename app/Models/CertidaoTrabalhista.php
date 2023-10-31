<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;

class CertidaoTrabalhista extends Document implements IDocument
{
    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['trabalhista']->store('public/'.$company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'trabalhista',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial.'/'.$name
        ]);
    }

    public static function updateDoc(Request $request, Company $company)
    {
        $certidaoFederal = $company->documents()
            ->where('tipo_documento', 'trabalhista')->first();

        $url = $request->certidoes['trabalhista']->store('public/'.$company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidaoFederal->update([
            'tipo_documento' => 'trabalhista',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial.'/'.$name
        ]);
    }
}
