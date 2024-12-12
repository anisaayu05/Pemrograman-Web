<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'specialization',
        'clinic_name',
    ];

    /**
     * name
     * 
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($name) => ucwords($name),
        );
    }

    /**
     * specialization
     * 
     * @return Attribute
     */
    protected function specialization(): Attribute
    {
        return Attribute::make(
            get: fn ($specialization) => ucfirst($specialization),
        );
    }

    /**
     * clinic_name
     * 
     * @return Attribute
     */
    protected function clinicName(): Attribute
    {
        return Attribute::make(
            get: fn ($clinic_name) => ucwords($clinic_name),
        );
    }
}
