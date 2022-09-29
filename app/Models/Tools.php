<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
                $no = Tools::where('created_at', "!=", null)->count();
                $no++;
                $model->kode_alat = str_pad($no, 4, '0', STR_PAD_LEFT);
        });
    }
}
