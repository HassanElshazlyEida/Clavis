<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends BaseController
{
    protected $model = Employee::class;
    protected $resource = EmployeeResource::class;

    protected function getValidationRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
        ];
    }
}
