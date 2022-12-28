<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'InvoiceNumber',
        'InvoiceSum',
        'status',
        'PaymentDate'
    ];

    public function owner() 
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'subscriptions','InvoiceId','PaymentId')->withTimestamps();
    }
}
