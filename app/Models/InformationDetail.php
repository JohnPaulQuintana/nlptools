<?php

namespace App\Models;

use App\Models\Information;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformationDetail extends Model
{
    use HasFactory;

    protected $fillable = ['information_id', 'fullname'];

    public function information() :BelongsTo{
        return $this->belongsTo(Information::class);
    }
}
