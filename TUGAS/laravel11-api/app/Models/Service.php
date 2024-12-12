<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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
     * description
     * 
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($description) => ucfirst($description),
        );
    }
}
