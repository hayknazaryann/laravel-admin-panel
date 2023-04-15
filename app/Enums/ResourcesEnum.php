<?php

namespace App\Enums;

use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\EmployeesController;

class ResourcesEnum
{
    public const NAMES = [
        'companies',
        'employees'
    ];

    public const CLASSES = [
        CompaniesController::class,
        EmployeesController::class
    ];

    public static function all()
    {
        return array_combine(self::NAMES, self::CLASSES);
    }
}
