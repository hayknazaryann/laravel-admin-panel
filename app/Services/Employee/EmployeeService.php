<?php

namespace App\Services\Employee;

use App\Http\Resources\EmployeeResource;
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
        $employees = $this->employeeRepository->paginate();
        return EmployeeResource::collection($employees);
    }

    /**
     * @param array $data
     * @return EmployeeResource
     * @throws \Throwable
     */
    public function create(array $data): EmployeeResource
    {
        DB::beginTransaction();
        $employee = $this->employeeRepository->create($data);
        DB::commit();
        return new EmployeeResource($employee);
    }

    /**
     * @param array $data
     * @param Employee $employee
     * @return EmployeeResource
     * @throws \Throwable
     */
    public function update(Employee $employee, array $data): EmployeeResource
    {
        DB::beginTransaction();
        $this->employeeRepository->update($employee, $data);
        DB::commit();
        return new EmployeeResource($employee);
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
