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
        if (isset($request->company_id)) {
            $company = Company::find($request->company_id);
        } else if ($request->cnpj) {
            $company = Company::where('cnpj', $request->cnpj)
                ->first();
        }

        CertidaoFederal::handlerDoc($request, $company);

        CertidaoEstadual::handlerDoc($request, $company);

        CertidaoMunicipal::handlerDoc($request, $company);

        CertidaoFalencia::handlerDoc($request, $company);

        CertidaoFgts::handlerDoc($request, $company);

        CertidaoTrabalhista::handlerDoc($request, $company);

        return redirect()->to('/company/all');
    }

    public function checkLateDocument($id)
    {
        $document = Document::where(['id' => $id])->first();

        $delayDayLimit = 5;

        $lastUpdatedDateDocument = $document->ultima_atualizacao;

        $actualDate = Carbon::create(now());

        $differenceDate = $actualDate->diff($lastUpdatedDateDocument);

        if($differenceDate->invert
            && $differenceDate->days >= $delayDayLimit)
        {
            return true;
        }else {
            return false;
        }
    }
}
