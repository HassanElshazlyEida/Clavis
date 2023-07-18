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

    protected function getValidationRules($id = null)
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string',
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:employees,email,' . $id;
        }
        return $rules;

    }
}
