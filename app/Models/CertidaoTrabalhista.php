<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;

class CertidaoTrabalhista extends Document implements IDocument
{
    public static function handlerDoc(Request $request, Company $company)
    {
        $certidaoTrabalhista = $company->documents()
            ->where('tipo_documento', 'trabalhista')->first();

        if (isset($request->certidoes['trabalhista'])
            && empty($certidaoTrabalhista)) {

            self::createDoc($request, $company);
        } else if ((isset($request->certidoes['trabalhista'])
            && !empty($certidaoTrabalhista))) {

            self::updateDoc($request, $company, $certidaoTrabalhista);
        }
    }

    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['trabalhista']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'trabalhista',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }

    public static function updateDoc(Request $request, Company $company, $certidao)
    {

        $url = $request->certidoes['trabalhista']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidao->update([
            'tipo_documento' => 'trabalhista',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }
}
