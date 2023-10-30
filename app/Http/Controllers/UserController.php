<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        if (!empty($user))
        {
            $request->session()->put('id', $user->id);

            return redirect()->intended('/dashboard');
        }else{
            return redirect()->to('/');
        }
    }

    public function authorization(Request $request)
    {
        $userId = $request->session()->get('id');
        if (!empty($userId))
        {
            $user = User::where(['id' => $userId])->first();

            $data = [
                'user' => $user
            ];

            return view('dashboard.home', $data);
        }else{
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

        if ($tokenAutorizacao == 'procompra')
        {
            User::create($data);
            return redirect()->to('/');
        }
        else{
            return redirect()->to('/registration');
        }

    }

    public function logout(Request $request)
    {
        $request->session()->pull('id', 'default');
        return view('autenticacao');
    }
}
