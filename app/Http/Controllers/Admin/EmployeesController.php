<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\Company\CompanyService;
use App\Services\Employee\EmployeeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EmployeesController extends Controller
{

    /**
     * @var employeeService
     */
    protected $employeeService;

    /**
     * @var companyService
     */
    protected $companyService;

    /**
     *
     * @param EmployeeService $employeeService
     * @param CompanyService $companyService
     *
     */
    public function __construct(EmployeeService $employeeService, CompanyService $companyService)
    {
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('dashboard.employees.index', [
            'employees' => $this->employeeService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('dashboard.employees.create', [
            'companies' => $this->companyService->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmployeeRequest  $request
     */
    public function store(StoreEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->employeeService->create($request->validated());
            DB::commit();
            return redirect()->route('employees.index')->with('success', 'Employee created successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee  $employee
     */
    public function edit(Employee $employee)
    {
        if (!$employee) {
            return redirect()->route('employees.index');
        }

        return view('dashboard.employees.edit', [
            'employee' => $employee,
            'companies' => $this->companyService->getAll()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest  $request
     * @param  Employee  $employee
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();
        try {
            $this->employeeService->update($employee, $request->validated());
            DB::commit();
            return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     */
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $this->employeeService->delete($employee);
            DB::commit();
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
