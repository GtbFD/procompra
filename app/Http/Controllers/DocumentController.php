<?php

namespace App\Http\Controllers;

use App\Models\CertidaoEstadual;
use App\Models\CertidaoFalencia;
use App\Models\CertidaoFederal;
use App\Models\CertidaoFgts;
use App\Models\CertidaoMunicipal;
use App\Models\CertidaoTrabalhista;
use App\Models\Company;
use App\Models\Document;
use Carbon\Carbon;
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
        $company = $this->findCompanyBy($request);

        if($this->isExistCompany($company)) {
            CertidaoFederal::handlerDoc($request, $company);

            CertidaoEstadual::handlerDoc($request, $company);

            CertidaoMunicipal::handlerDoc($request, $company);

            CertidaoFalencia::handlerDoc($request, $company);

            CertidaoFgts::handlerDoc($request, $company);

            CertidaoTrabalhista::handlerDoc($request, $company);

            return redirect()->to('/company/all');
        }else {
            return redirect()->to('/document/create/external');
        }
    }

    public function findCompanyBy(Request $request)
    {
        if ($this->isExistCompany($request->company_id)
            && $this->findCompanyById($request) != null) {
            return $this->findCompanyById($request);

        } else if ($this->isExistCompany($request)) {
            return $this->findCompanyByCnpj($request);
        }
    }

    public function isExistCompany($company)
    {
        if ($company != null) {
            return true;
        } else {
            return false;
        }
    }

    public function findCompanyById(Request $request)
    {
        if (isset($request->company_id)) {
            return Company::find($request->company_id);
        }
    }

    public function findCompanyByCnpj(Request $request)
    {
        if (isset($request->cnpj)) {
            return Company::where('cnpj', $request->cnpj)->first();
        }
    }

    public function checkLateDocument($id)
    {
        $document = Document::where(['id' => $id])->first();

        $delayDayLimit = 5;

        $lastUpdatedDateDocument = $document->ultima_atualizacao;

        $actualDate = Carbon::create(now());

        $differenceDate = $actualDate->diff($lastUpdatedDateDocument);

        if ($differenceDate->invert
            && $differenceDate->days >= $delayDayLimit) {
            return true;
        } else {
            return false;
        }
    }
}
