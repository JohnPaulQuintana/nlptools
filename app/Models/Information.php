<?php

namespace App\Models;

use App\Models\InformationDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Information extends Model
{
    use HasFactory;
    protected $fillable = ['key'];

    public function informationDetail() :HasOne{
        return $this->hasOne(InformationDetail::class);
    }
}
