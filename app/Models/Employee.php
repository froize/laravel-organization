<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;


class Employee extends Model
{
    use HasFactory;
    public function branches() {
        return $this->belongsToMany(Branch::class);
    }
}
