<?php

namespace App\Services\Employee;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeInterface;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    /**
     * @var \App\Repositories\Interfaces\EmployeeInterface
     */
    private $employeeRepository;

    /**
     * EmployeeService constructor.
     *
     * @param EmployeeInterface $employeeRepository
     */
    public function __construct(
        EmployeeInterface $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Get companies
     * @throws \Throwable
     */
    public function get()
    {
        return $this->employeeRepository->paginate();
    }

    /**
     * @param array $data
     * @throws \Throwable
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        $employee = $this->employeeRepository->create($data);
        DB::commit();
        return $employee;
    }

    /**
     * @param array $data
     * @param Employee $employee
     * @throws \Throwable
     */
    public function update(Employee $employee, array $data)
    {
        DB::beginTransaction();
        $this->employeeRepository->update($employee, $data);
        DB::commit();
        return $employee;
    }

    /**
     * @param Employee $employee
     * @throws \Throwable
     */
    public function delete(Employee $employee)
    {
        DB::beginTransaction();
        $this->employeeRepository->delete($employee);
        DB::commit();
    }


}
