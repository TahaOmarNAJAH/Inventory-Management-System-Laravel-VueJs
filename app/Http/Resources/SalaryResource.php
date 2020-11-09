<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'salary_month' => $this->salary_mounth,
            'salary_date' => $this->salary_date,
            'employee_id' => $this->employee_id,
            'employee_name' =>$this->employee->name,
            'employee_email' =>$this->employee->email,
            'employee_photo' =>$this->employee->photo,
            'employee_phone' =>$this->employee->phone,
        ];
    }
}
