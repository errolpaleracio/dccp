<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_no', 
        'released_by', 
        'claimed_by', 
        'date_claimed', 
        'status', 
        'reason', 
        'claim_date', 
        'user_id',
        'remarks'
    ];

    protected $dates = ['claim_date', 'date_claimed', 'created_at'];

    public function Request()
    {
        return $this->hasMany(Request::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
