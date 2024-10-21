<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'date'];

    // Define the one-to-many relationship with InvoiceProductDetail
    public function products()
    {
        return $this->hasMany(InvoiceProductDetail::class);
    }
}
