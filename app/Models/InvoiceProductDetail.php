<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProductDetail extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'product_name', 'quantity', 'price', 'total_price'];

    // Define the inverse of the relationship with Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
