<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Create Invoice</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('invoice.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Customer Name:</label>
            <input type="text" id="name" name="user_name" required>
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productRows">
                <tr>
                    <td><input type="text" name="products[0][product_name]" required></td>
                    <td><input type="number" name="products[0][quantity]" class="quantity" min="1" value="1" required></td>
                    <td><input type="number" name="products[0][price]" class="price" min="0" value="0" required></td>
                    <td><input type="number" name="products[0][total]" class="total" value="0" readonly></td>
                    <td><button type="button" class="removeRow">Remove</button></td>
                </tr>
                
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <button type="button" id="addNewRow">Add New Product</button>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit">Submit Invoice</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let rowIndex = 1;

            // Add a new row when the "Add New Product" button is clicked
            document.getElementById('addNewRow').addEventListener('click', function () {
                let tableBody = document.getElementById('productRows');
                let newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td><input type="text" name="products[${rowIndex}][product_name]" required></td>
                    <td><input type="number" name="products[${rowIndex}][quantity]" class="quantity" min="1" value="1" required></td>
                    <td><input type="number" name="products[${rowIndex}][price]" class="price" min="0" value="0" required></td>
                    <td><input type="number" name="products[${rowIndex}][total]" class="total" value="0" readonly></td>
                    <td><button type="button" class="removeRow">Remove</button></td>
                `;
                tableBody.appendChild(newRow);
                rowIndex++;

                // Update event listeners for dynamic rows
                updateRowEvents();
            });

            function updateRowEvents() {
                // Remove row functionality
                document.querySelectorAll('.removeRow').forEach(button => {
                    button.removeEventListener('click', removeRow); // Remove existing listener to avoid duplicates
                    button.addEventListener('click', removeRow);
                });

                // Update total price calculation for quantity/price change
                document.querySelectorAll('.quantity, .price').forEach(input => {
                    input.removeEventListener('input', updateTotalPrice); // Remove existing listener
                    input.addEventListener('input', updateTotalPrice);
                });
            }

            function removeRow(event) {
                event.target.closest('tr').remove();
            }

            function updateTotalPrice(event) {
                let row = event.target.closest('tr');
                let quantity = row.querySelector('.quantity').value;
                let price = row.querySelector('.price').value;
                let total = row.querySelector('.total');

                total.value = quantity * price;
            }

            // Initial row events
            updateRowEvents();
        });
    </script>
</body>
</html>
