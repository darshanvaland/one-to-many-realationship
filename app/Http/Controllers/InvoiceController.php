<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProductDetail;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
    // Validate the incoming request
        $validated = $request->validate([
            'user_name' => 'required|string',
            'date' => 'required|date',
            'products.*.product_name' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);

    // Step 1: Create the Invoice
        $invoice = Invoice::create([
            'user_name' => $validated['user_name'],
            'date' => $validated['date'],
        ]);

        // Step 2: Add the products to the invoice (only if there are any products)
        if (!empty($validated['products'])) {
            foreach ($validated['products'] as $product) {
                $invoice->products()->create([
                    'product_name' => $product['product_name'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'total_price' => $product['total'],
                ]);
            }
        }

    // Redirect back or wherever needed
    return redirect()->back()->with('success', 'Invoice and products added successfully!');
    }
    
}
