<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name'=>$this->full_name,
            'company' => new CompanyResource(Company::find($this->company_id)),
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
