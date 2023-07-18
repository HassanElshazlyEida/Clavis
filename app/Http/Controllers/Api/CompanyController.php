<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use App\Http\Controllers\Api\BaseController;

class CompanyController extends BaseController
{
    protected $model = Company::class;
    protected $resource = CompanyResource::class;

    protected function getValidationRules($id = null)
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
        ];
    }
}
