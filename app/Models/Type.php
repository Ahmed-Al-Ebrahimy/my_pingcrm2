<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'name'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

}
