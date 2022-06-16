@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Taxes</title>
@endsection

@section('content')
    <div class="p-4">
        <button onclick="printInvoice()" type="button" class="btn btn-dark">Print Invoice</button>
    </div>
       
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row" id="invoice">
                <div class="col-12">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-5">
                                    <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="60%" height="100%">
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <h2 class="font-weight-bold">Proforma Invoice</h2>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-5">
                                    <address class="mini-text">
                                        P.O.BOX 960,<br>
                                        BWAWANI - MABLUU ROAD<br>
                                        ZANZIBAR - TANZANIA<br>
                                        Phone: +255 777 411 887<br>
                                        Email: chau@hotel-solutions.co.tz<br>
                                        Website: <a href="#">hotel-solutions.co.tz</a><br>
                                    </address>
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <table class="table table-sm table-bordered table-responsive mini-text">
                                        <tr>
                                            <td class="text-start">DATE: </td>
                                            <td class="text-start">P.I NUMBER: </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">TIN: </td>
                                            <td class="text-start">VRN: </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">VALIDITY: </td>
                                            <td class="text-start">Due Date: </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted">Payment No.</div>
                                    <strong>741037024</strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted">Payment Date</div>
                                    <strong>October 2, 2018 - 03:45 pm</strong>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="text-muted">Client</div>
                                    <strong>
                                        Charles Hall
                                    </strong>
                                    <p>
                                        4183 Forest Avenue <br>
                                        New York City <br>
                                        10011 <br>
                                        USA <br>
                                        <a href="#">
                                            chris.wood@gmail.com
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted">Payment To</div>
                                    <strong>
                                        AdminKit Demo LLC
                                    </strong>
                                    <p>
                                        354 Roy Alley <br>
                                        Denver <br>
                                        80202 <br>
                                        USA <br>
                                        <a href="#">
                                            info@adminkit.com
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>AdminKit Demo Theme Customization</td>
                                        <td>2</td>
                                        <td class="text-end">$150.00</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Subscription </td>
                                        <td>3</td>
                                        <td class="text-end">$25.00</td>
                                    </tr>
                                    <tr>
                                        <td>Additional Service</td>
                                        <td>1</td>
                                        <td class="text-end">$100.00</td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Subtotal </th>
                                        <th class="text-end">$275.00</th>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Shipping </th>
                                        <th class="text-end">$8.00</th>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Discount </th>
                                        <th class="text-end">5%</th>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Total </th>
                                        <th class="text-end">$268.85</th>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center">
                                <p class="text-sm">
                                    <strong>Extra note:</strong>
                                    Please send all items at the same time to the shipping address.
                                    Thanks in advance.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        function printInvoice() {
            var element = document.getElementById('invoice');
            var opt = {
            margin:       0.2,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 1 },
            jsPDF:        { unit: 'cm', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endsection
