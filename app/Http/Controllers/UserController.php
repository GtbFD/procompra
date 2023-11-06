<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function autentication()
    {
        return view('autenticacao');
    }

    public function autenticate(Request $request)
    {
        $user = User::where(['cpf' => $request->cpf, 'senha' => $request->senha])
            ->first();

        if (!empty($user)) {
            $request->session()->put('id', $user->id);

            $this->verifyAllCompaniesWithOldDocuments();

            return redirect()->intended('/dashboard');
        } else {
            return redirect()->to('/');
        }
    }

    public function verifyAllCompaniesWithOldDocuments()
    {
        $allCompanies = Company::all();

        foreach ($allCompanies as $company) {
            $document = $company->documents()
                ->where(['tipo_documento' => 'federal'])->first();

            if ($this->isExistsDocument($document)) {
                $documentController = new DocumentController();
                $isLate = $documentController->checkLateDocument($document->id);

                if ($isLate && !$this->hasSendedEmail($company)) {
                    $this->sendMailToCompanyWithLateDocument($company);
                }

            }
        }
    }

    public function isExistsDocument($document)
    {
        if (empty($document)) {
            return false;
        } else {
            return true;
        }
    }

    public function hasSendedEmail(Company $company)
    {
        if ($company->email_documento_enviado)
        {
            return true;
        }else{
            return false;
        }
    }

    public function sendMailToCompanyWithLateDocument(Company $company)
    {
        $this->markAsCheckMailSended($company);

        $data = [
            'mensagem' => 'Olá, por questões de agilidade nos processos contidos neste órgão, por gentileza, atualize as seguintes documentações da empresa em nosso sistema:',
            'certidoes' => [
                'FEDERAL',
                'ESTADUAL',
                'MUNICIPAL',
                'FALENCIA',
                'FGTS',
                'TRABALHISTA'
            ]
        ];

        Mail::send(['text' => 'mail'], $data, function($message) use ($company) {
            $message->to($company->email, $company->razao_social)
                ->subject('DOCUMENTAÇÃO: Atualização de documentação da empresa!');

            $message->from('email_setor_de_compras@gmail.com',
                'SETOR DE COMPRAS - HOSPITAL REGIONAL  DE CAJAZEIRAS');
        });
    }

    public function markAsCheckMailSended(Company $company)
    {
        Company::where(['id' => $company->id])
            ->update(['email_documento_enviado' => true]);
    }

    public static function markAsNotCheckMailSended(Company $company){
        Company::where(['id' => $company->id])
            ->update(['email_documento_enviado' => false]);
    }

    public function authorization(Request $request)
    {
        $userId = $request->session()->get('id');
        if (!empty($userId)) {
            $user = User::where(['id' => $userId])->first();

            $data = [
                'user' => $user
            ];

            return view('dashboard.home', $data);
        } else {
            return redirect()->to('');
        }

    }

    public function registration()
    {
        return view('user.register');
    }

    public function registrate(Request $request)
    {
        $tokenAutorizacao = $request->token_autorizacao;

        $data = [
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'cpf' => $request->cpf,
            'senha' => $request->senha
        ];

        if ($tokenAutorizacao == 'procompra') {
            User::create($data);
            return redirect()->to('/');
        } else {
            return redirect()->to('/registration');
        }

    }

    public function logout(Request $request)
    {
        $request->session()->pull('id', 'default');
        return view('autenticacao');
    }
}
