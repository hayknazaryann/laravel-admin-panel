<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\Company\CompanyService;
use Illuminate\View\View;
use PHPUnit\Exception;

class CompaniesController extends Controller
{

    /**
     * @var companyService
     */
    protected $companyService;

    /**
     * CompaniesController __constructor
     *
     * @param CompanyService $companyService
     *
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $companies = $this->companyService->get();
        return view('dashboard.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('dashboard.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            $this->companyService->create($request->validated());
            return redirect()->route('companies.index')->with('success', 'Company created successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return View
     */
    public function edit(Company $company)
    {
        if (!$company) {
            return redirect()->route('companies.index');
        }
        return view('dashboard.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try {
            $this->companyService->update($company, $request->validated());
            return redirect()->route('companies.index')->with('success', 'Company updated successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     */
    public function destroy(Company $company)
    {
        try {
            $this->companyService->delete($company);
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}