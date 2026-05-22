<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        "name",
        "price",
        "description",
        "status"
    ];

    protected function casts(): array
    {
        return [
            "status" => "boolean",
            "price" => "integer",
        ];
    }
}