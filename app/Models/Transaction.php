<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'amount',
        'account_id',
    ];

  
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}