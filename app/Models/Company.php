<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'website',
        'logo'
    ];

    protected $perPage = 10;

    public function getLogoFullPathAttribute()
    {
        $filePath = 'storage/uploads/companies/' . $this->id . '/100x100/' . $this->logo;
        return asset($filePath);
    }
}
