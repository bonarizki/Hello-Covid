<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MitraRs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "mitra_rs";
    protected $primaryKey = "id_mitra";
    protected $guarded = [];
    protected $hidden = [
        "created_by" ,
        "created_at" ,
        "updated_by" ,
        "updated_at"
    ];
}
