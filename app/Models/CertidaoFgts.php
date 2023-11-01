<?php

namespace App\Models;

use App\Interfaces\IDocument;
use Illuminate\Http\Request;

class CertidaoFgts extends Document implements IDocument
{
    public static function handlerDoc(Request $request, Company $company)
    {
        $certidaoFgts = $company->documents()
            ->where('tipo_documento', 'fgts')->first();

        if (isset($request->certidoes['fgts'])
            && empty($certidaoFgts)) {

            self::createDoc($request, $company);
        } else if ((isset($request->certidoes['fgts'])
            && !empty($certidaoFgts))) {

            self::updateDoc($request, $company, $certidaoFgts);
        }
    }

    public static function createDoc(Request $request, Company $company)
    {
        $url = $request->certidoes['fgts']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $company->documents()->create([
            'tipo_documento' => 'fgts',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }

    public static function updateDoc(Request $request, Company $company, $certidao)
    {

        $url = $request->certidoes['fgts']->store('public/' . $company->cnpj);
        list($dir, $razaoSocial, $name) = explode("/", $url);

        $certidao->update([
            'tipo_documento' => 'fgts',
            'ultima_atualizacao' => now(),
            'url_arquivo' => $razaoSocial . '/' . $name
        ]);
    }
}
