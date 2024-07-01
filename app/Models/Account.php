<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    public $timestamps = false;

    protected $fillable = [
        'account_number',
        'nickname',
        'balance',
        'user_id',
        'account_type',
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class, 'account_id');
    }
}