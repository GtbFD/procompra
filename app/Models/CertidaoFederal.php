<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;


class CertidaoFederal extends Document implements IDocument
{

    public static function handlerDoc(Request $request, Company $company)
    {
        $certidaoFederal = $company->documents()
            ->where('tipo_documento', 'federal')->first();

        if (isset($request->certidoes['federal'])
            && empty($certidaoFederal)) {

            self::createDoc($request, $company);
        } else if ((isset($request->certidoes['federal'])
            && !empty($certidaoFederal))) {

            self::updateDoc($request, $company, $certidaoFederal);
        }
    }

    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['federal']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'federal',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }

    public static function updateDoc(Request $request, Company $company, $certidao)
    {

        $url = $request->certidoes['federal']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidao->update([
            'tipo_documento' => 'federal',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }
}
