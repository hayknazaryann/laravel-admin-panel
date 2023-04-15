<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeInterface;

class EmployeeRepository extends EloquentRepository implements EmployeeInterface
{
    /**
     * EmployeeRepository constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

}
