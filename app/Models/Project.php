<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'price', 'service_id', 'user_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}