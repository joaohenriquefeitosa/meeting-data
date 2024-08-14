<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'avatar', 
        'title', 
        'linkedin_url', 
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
