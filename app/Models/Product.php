<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'ProductName',
        'Price',
        'ProductDescription',
        'VideoUrl'
    ];

    public function subscriber() 
    {
        return $this->belongsToMany(Payment::class,'subscriptions','ProductId','InvoiceId')->withTimestamps();
    }
}
