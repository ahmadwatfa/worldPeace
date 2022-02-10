<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }
}
