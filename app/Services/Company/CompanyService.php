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
        $company = $this->companyRepository->create($data);
        if (isset($data['logo']) && $data['logo']) {
            $fileName = $this->fileService->uploadLogo($company,$data['logo']);
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        return $company;
    }

    /**
     * @param array $data
     * @param Company $company
     * @throws \Throwable
     */
    public function update(Company $company, array $data)
    {
        $this->companyRepository->update($company, $data);
        if (isset($data['logo']) && $data['logo']) {
            $fileName = $this->fileService->uploadLogo($company, $data['logo']);
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        return $company;
    }

    /**
     * @param Company $company
     * @throws \Throwable
     */
    public function delete(Company $company)
    {
        $this->companyRepository->delete($company);
    }


}
