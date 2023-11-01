<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;

class CertidaoMunicipal extends Document implements IDocument
{
    public static function handlerDoc(Request $request, Company $company)
    {
        $certidaoMunicipal = $company->documents()
            ->where('tipo_documento', 'municipal')->first();

        if (isset($request->certidoes['municipal'])
            && empty($certidaoMunicipal)) {

            self::createDoc($request, $company);
        } else if ((isset($request->certidoes['municipal'])
            && !empty($certidaoMunicipal))) {

            self::updateDoc($request, $company, $certidaoMunicipal);
        }
    }

    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['municipal']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'municipal',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }

    public static function updateDoc(Request $request, Company $company, $certidao)
    {

        $url = $request->certidoes['municipal']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidao->update([
            'tipo_documento' => 'municipal',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }
}
