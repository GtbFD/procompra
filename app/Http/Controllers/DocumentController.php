<?php

namespace App\Http\Controllers;

use App\Models\CertidaoEstadual;
use App\Models\CertidaoFalencia;
use App\Models\CertidaoFederal;
use App\Models\CertidaoFgts;
use App\Models\CertidaoMunicipal;
use App\Models\CertidaoTrabalhista;
use App\Models\Company;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create()
    {
        $companies = Company::all();

        $data = [
            'companies' => $companies
        ];

        return view('empresa.documento.cadastro', $data);
    }

    public function createExternal()
    {
        return view('empresa.documento.cadastro_externo');
    }

    public function finishCreation(Request $request)
    {
        if (isset($request->company_id)) {
            $company = Company::find($request->company_id);
        } else if ($request->cnpj) {
            $company = Company::where('cnpj', $request->cnpj)
                ->first();
        }

        if (isset($certidoes['federal'])
            && empty($certidaoFederal)) {

            CertidaoFederal::createDoc($request, $company);
        } else if (isset($certidoes['federal'])
            && !empty($certidaoFederal)) {

            CertidaoFederal::updateDoc($request, $company);
        }

        /*if (isset($certidoes['estadual'])
            && empty($certidaoEstadual)) {

            CertidaoEstadual::createDoc($request, $company);
        } else if (isset($certidoes['estadual'])
            && !empty($certidaoEstadual)) {

            CertidaoEstadual::updateDoc($request, $company);
        }

        if (isset($certidoes['municipal'])
            && empty($certidaoMunicipal)) {

            CertidaoMunicipal::createDoc($request, $company);
        } else if (isset($certidoes['municipal'])
            && !empty($certidaoMunicipal)) {

            CertidaoMunicipal::updateDoc($request, $company);
        }

        if (isset($certidoes['falencia'])
            && empty($certidaoFalencia)) {

            CertidaoFalencia::createDoc($request, $company);
        } else if (isset($certidoes['falencia'])
            && !empty($certidaoFalencia)) {

            CertidaoFalencia::updateDoc($request, $company);
        }

        if (isset($certidoes['fgts'])
            && empty($certidaoFgts)) {

            CertidaoFgts::createDoc($request, $company);
        } else if (isset($certidoes['fgts'])
            && !empty($certidaoFgts)) {

            CertidaoFgts::updateDoc($request, $company);
        }

        if (isset($certidoes['trabalhista'])
            && empty($certidaoTrabalhista)) {

            CertidaoTrabalhista::createDoc($request, $company);
        } else if (isset($certidoes['trabalhista'])
            && !empty($certidaoTrabalhista)) {

            CertidaoTrabalhista::updateDoc($request, $company);
        }*/

        return redirect()->to('/company/all');
    }

    public function downloadDoc($path)
    {
    }
}
