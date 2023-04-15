<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    /**
     * @var \App\Repositories\Interfaces\CompanyInterface
     */
    private $companyRepository;

    /**
     * CompanyService constructor.
     *
     * @param CompanyInterface $companyRepository
     */
    public function __construct(
        CompanyInterface $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
        $this->fileService = new FileService();
    }

    /**
     * Get companies
     * @throws \Throwable
     */
    public function getAll()
    {
        return $this->companyRepository->all();
    }

    /**
     * Get companies
     * @throws \Throwable
     */
    public function get()
    {
        return $this->companyRepository->paginate();
    }

    /**
     * @param array $data
     * @throws \Throwable
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        $company = $this->companyRepository->create($data);
        if (isset($data['logo']) && $data['logo']) {
            $fileName = $this->fileService->uploadLogo($company,$data['logo']);
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        DB::commit();
        return $company;
    }

    /**
     * @param array $data
     * @param Company $company
     * @throws \Throwable
     */
    public function update(Company $company, array $data)
    {
        DB::beginTransaction();
        $this->companyRepository->update($company, $data);
        if (isset($data['logo']) && $data['logo']) {
            $fileName = $this->fileService->uploadLogo($company, $data['logo']);
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        DB::commit();
        return $company;
    }

    /**
     * @param Company $company
     * @throws \Throwable
     */
    public function delete(Company $company)
    {
        DB::beginTransaction();
        $this->companyRepository->delete($company);
        DB::commit();
    }


}
