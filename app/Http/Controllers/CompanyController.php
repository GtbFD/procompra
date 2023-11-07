<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    public function registration()
    {
        return view('empresa.cadastro');
    }

    public function registrate(Request $request)
    {
        $company = Company::where('cnpj', $request->cnpj)->first();
        $companyData = $this->fetchDataCompanyFromApi($request);

        if (!$this->existsCompany($company)) {

            $data = $this->assembleDataCompany($companyData);

            if (!empty($data)) {
                Company::create($data);
                return redirect()->to('/company/all');
            }else{
                return redirect()->to('/erro/company-registration');
            }
        } else {
            return redirect()->to('/erro/company-registration');
        }

    }

    public function existsCompany($company)
    {
        if (!empty($company))
        {
            return true;
        }else{
            return false;
        }
    }

    public function fetchDataCompanyFromApi(Request $request)
    {
        return Http::get('https://minhareceita.org/' . $request->cnpj);
    }

    public function hasDataFromApi($companyData)
    {
        return ($companyData->status() == 200);
    }

    public function assembleDataCompany($companyData)
    {
        if($this->hasDataFromApi($companyData)){
             $data = [
                'cnpj' => $companyData['cnpj'],
                'email' => $companyData['email'],
                'razao_social' => $companyData['razao_social'],
                'telefone' => $companyData['ddd_telefone_1'],
                'rua' => $companyData['logradouro'],
                'bairro' => $companyData['bairro'],
                'cidade' => $companyData['municipio'],
                'uf' => $companyData['uf'],
                'cep' => $companyData['cep']
            ];

            return $data;
        }else{
            $data = [];
            return $data;
        }
    }

    public function showAll()
    {
        $companies = Company::all();

        $data = [
            'companies' => $companies
        ];

        return view('empresa.all', $data);
    }

    public function show(Request $request)
    {
        $company = Company::where('razao_social', 'like', '%' . $request->razao_social . '%')->first();

        return view('empresa.search', ['company' => $company]);
    }

    public function editCompany($id)
    {
        $company = Company::where('id', $id)->first();

        $data = [
            'company' => $company
        ];

        return view('empresa.edit', $data);
    }

    public function edit(Request $request, $id)
    {

        $data = [
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'razao_social' => $request->razao_social,
            'telefone' => $request->telefone,
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'cep' => $request->cep
        ];

        Company::where('id', $id)->update($data);

        return redirect()->to('/company/all');
    }

    public function delete($id)
    {
        Company::where('id', $id)->delete();
        return redirect()->to('/company/all');
    }

    public function createDocumentTo(Request $request, $id)
    {
        $company = Company::find($id);

        $data = [
            'tipo_documento' => $request->tipo_documento,
            'ultima_atualizacao' => $request->ultima_atualizacao,
            'url_arquivo' => $request->url_arquivo
        ];

        $company->documents->create($data);
    }

    public function allDocumentsFrom($id)
    {
        $documents = Company::find($id)->documents;
        return view('empresa.documento.all', ['documents' => $documents]);
    }
}
