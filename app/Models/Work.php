<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
                $no = Work::where('created_at', "!=", null)->count();
                $no++;
                $model->kode_p = str_pad($no, 4, '0', STR_PAD_LEFT);
        });
    }
}
