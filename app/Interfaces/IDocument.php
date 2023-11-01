<?php

namespace App\Interfaces;

use App\Models\Company;
use Illuminate\Http\Request;

interface IDocument
{
    public static function createDoc(Request $request, Company $company);
    public static function updateDoc(Request $request, Company $company, $certidao);

    public static function handlerDoc(Request $request, Company $company);
}
