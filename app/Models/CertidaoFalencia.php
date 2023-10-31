<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;

class CertidaoFalencia extends Document implements IDocument
{
    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['falencia']->store('public/'.$company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'falencia',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial.'/'.$name
        ]);
    }

    public static function updateDoc(Request $request, Company $company)
    {
        $certidaoFederal = $company->documents()
            ->where('tipo_documento', 'falencia')->first();

        $url = $request->certidoes['falencia']->store('public/'.$company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidaoFederal->update([
            'tipo_documento' => 'falencia',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial.'/'.$name
        ]);
    }
}
