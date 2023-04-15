<?php

namespace App\Services\Company;

use App\Http\Resources\CompanyResource;
use App\Http\Resources\OrderResource;
use App\Models\Company;
use App\Models\Order;
use App\Repositories\Interfaces\CompanyInterface;
use App\Repositories\Interfaces\EloquentInterface;
use App\Repositories\Interfaces\OrderInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    }

    /**
     * Get companies
     * @throws \Throwable
     */
    public function getAll()
    {
        $companies = $this->companyRepository->all();
        return CompanyResource::collection($companies);
    }

    /**
     * Get companies
     * @throws \Throwable
     */
    public function get()
    {
        $companies = $this->companyRepository->paginate(10);
        return CompanyResource::collection($companies);
    }

    /**
     * @param array $data
     * @return CompanyResource
     * @throws \Throwable
     */
    public function create(array $data): CompanyResource
    {
        DB::beginTransaction();
        $company = $this->companyRepository->create($data);
        if (isset($data['logo']) && $data['logo']) {
            $upload_dir = '/uploads/companies/'.$company->id.'/';
            $uploadedFile = $data['logo'];
            $fileName = $uploadedFile->hashName();
            $pieces = explode(".", $fileName);
            $fileName = $pieces[0] . '.webp';
            $image = Image::make($uploadedFile);
            Storage::put('public/' . $upload_dir . 'original/' . $fileName, (string) $image->encode('webp'));
            $image->resize(100,100, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::put('public/' . $upload_dir . '100x100/' . $fileName, (string) $image->encode('webp'));
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        DB::commit();
        return new CompanyResource($company);
    }

    /**
     * @param array $data
     * @param Company $company
     * @return CompanyResource
     * @throws \Throwable
     */
    public function update(Company $company, array $data): CompanyResource
    {
        DB::beginTransaction();
        $this->companyRepository->update($company, $data);
        if (isset($data['logo']) && $data['logo']) {
            $upload_dir = '/uploads/companies/'.$company->id.'/';
            $uploadedFile = $data['logo'];
            $fileName = $uploadedFile->hashName();
            $pieces = explode(".", $fileName);
            $fileName = $pieces[0] . '.webp';
            $image = Image::make($uploadedFile);
            Storage::put('public/' . $upload_dir . 'original/' . $fileName, (string) $image);
            $image->resize(100,100, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::put('public/' . $upload_dir . '100x100/' . $fileName, (string) $image);
            $this->companyRepository->update($company,['logo' => $fileName]);
        }
        DB::commit();
        return new CompanyResource($company);
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
