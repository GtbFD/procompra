<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

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
        $certidoes = $request->certidoes;

        if(isset($request->company_id))
        {
            $company = Company::find($request->company_id);
        }else if($request->cnpj){
            $company = Company::where('cnpj', $request->cnpj)->first();
        }

        $certidaoFederal = $company->documents()->where('tipo_documento', 'federal')->first();
        $certidaoEstadual = $company->documents()->where('tipo_documento', 'estadual')->first();
        $certidaoMunicipal = $company->documents()->where('tipo_documento', 'municipal')->first();
        $certidaoFalencia = $company->documents()->where('tipo_documento', 'falencia')->first();
        $certidaoFgts = $company->documents()->where('tipo_documento', 'fgts')->first();
        $certidaoTrabalhista = $company->documents()->where('tipo_documento', 'trabalhista')->first();


        $dataCreation = [
            'tipo_documento' => '',
            'ultima_atualizacao' => '',
            'url_arquivo' => ''
        ];

        if (isset($certidoes['federal']) && empty($certidaoFederal))
        {

            $url = $certidoes['federal']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'federal';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);

        }else if(isset($certidoes['federal']) && !empty($certidaoFederal))
        {
            $url = $certidoes['federal']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'federal';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoFederal->update($dataCreation);
        }

        if (isset($certidoes['estadual']) && empty($certidaoEstadual))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'estadual';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);
        }else if(isset($certidoes['estadual']) && !empty($certidaoEstadual))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'estadual';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoEstadual->update($dataCreation);
        }

        if (isset($certidoes['municipal']) && empty($certidaoMunicipal))
        {
            $url = $certidoes['municipal']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'municipal';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);
        }else if(isset($certidoes['municipal']) && !empty($certidaoMunicipal))
        {
            $url = $certidoes['municipal']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'municipal';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoMunicipal->update($dataCreation);
        }

        if (isset($certidoes['falencia']) && empty($certidaoFalencia))
        {
            $url = $certidoes['falencia']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'falencia';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);
        }else if(isset($certidoes['falencia']) && !empty($certidaoFalencia))
        {
            $url = $certidoes['falencia']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'falencia';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoFalencia->update($dataCreation);
        }

        if (isset($certidoes['fgts']) && empty($certidaoFgts))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'fgts';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);
        }else if(isset($certidoes['fgts']) && !empty($certidaoFgts))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'fgts';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoFgts->update($dataCreation);
        }

        if (isset($certidoes['trabalhista']) && empty($certidaoTrabalhista))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'trabalhista';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $company->documents()->create($dataCreation);
        }else if(isset($certidoes['trabalhista']) && !empty($certidaoTrabalhista))
        {
            $url = $certidoes['estadual']->store('public/'.$company->cnpj);

            list($public, $razaoSocial, $name) = explode("/", $url);

            $dataCreation['tipo_documento'] = 'trabalhista';
            $dataCreation['ultima_atualizacao'] = now();
            $dataCreation['url_arquivo'] = $razaoSocial.'/'.$name;

            $certidaoTrabalhista->update($dataCreation);
        }

        return redirect()->to('/company/all');
    }

    public function downloadDoc($path)
    {
    }
}
