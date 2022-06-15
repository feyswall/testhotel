<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  font-size: 0.75em;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.user-info{
    line-height: 5px;
        font-size: 0.8rem;
}
.deposit-details{
    line-height: 5px;
    font-size: 0.8rem;
}
.main-title {
    text-align: center;
    font-size: 1.7rem;
}
.deposit{
    margin-bottom: 1px;
}
.customer{
    margin-bottom: 1px;
}
</style>
</head>
<body>


<h2 class="main-title">Invoice</h2>

<h4 class="deposit">Deposit Details</h4>
   <div class="deposit-details">
    <p>Invoice No: {{ $sale->invoice_number }}</p>
    <p>Account No: 0228890890 default</p>
    <p>Account Name: mjengo default</p>
    <p>Bank: PBZ default</p>
   </div>

<h4 class="customer">Billed To</h4>
<div class="user-info">
    <p>Name: {{ $sale->customer->name }}</p>
    <p>Email: {{ $sale->customer->email }} </p>
    <p>Phone: {{ $sale->customer->phone }}</p>
    <p>Address: {{ $sale->customer->address }}</p>
</div>



<table>

  <thead>
    <tr>
      <th>No:</th>
      <th>Item Name</th>
      <th>Item Code</th>
      <th>Price</th>
      <th>Tax</th>
      <th>quantity</th>
      <th>total</th>
    </tr>

  </thead>

<tbody>
     @php
        $subtotal = 0;
    @endphp

    @foreach ($sale->items  as $item  )
    @php
        $subtotal += ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity;
    @endphp
  <tr>
     <td>No:</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->code }}</td>
      <td>{{ $item->selling_price }}</td>
      <td>{{ $item->tax }}</td>
      <td>{{ number_format($item->pivot->quantity) }}</td>
      <td>{{ number_format(($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity) }}</td>
  </tr>
  @endforeach

</tbody>

</table>

</body>
</html>

