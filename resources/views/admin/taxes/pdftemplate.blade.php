@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Taxes</title>
@endsection

@section('content')
    <div class="p-4">
        <button onclick="printInvoice('invoice')" type="button" class="btn btn-success">Print Invoice</button>
        <button onclick="printInvoice('taxinvoice')" type="button" class="btn btn-primary">Print Tax Invoice</button>
    </div>
       
    <main class="content nunito">
        <div class="container-fluid p-0 d-none">
            <div class="row" id="invoice">
                <div class="col-12">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-5">
                                    <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="80%" height="100%">
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <h1 class="text-dark broadway">Proforma Invoice</h1>
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
                                <div class="col col-md-7">
                                    <table class="table table-sm table-bordered mini-text">
                                        <tr>
                                            <td class="text-start">To: </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat rem enim exercitationem aliquid totam consectetur. Dolorum nemo impedit dicta soluta corporis itaque. Ipsa excepturi dolorum fugiat quae a necessitatibus qui!
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-n3">
                                <div class="col col-md-12">
                                    <table class="table table-sm table-bordered mini-text">
                                        <tr>
                                            <td class="text-center">NO.</td>
                                            <td class="text-center">ITEM</td>
                                            <td class="text-center">DESCRIPTION</td>
                                            <td class="text-center">QTY</td>
                                            <td class="text-center">RATE</td>
                                            <td class="text-center">TOTAL</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">SUBTOTAL: </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">VAT TOTAL: </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-grey"></td>
                                            <td colspan="3" class="text-start">TOTAL: </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid p-0">
            <div class="row" id="taxinvoice">
                <div class="col-12">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-5">
                                    <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="80%" height="100%">
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <h1 class="text-dark broadway">Tax Invoice</h1>
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
                                            <td class="text-start">INVOICE NUMBER: </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">TIN: </td>
                                            <td class="text-start">VRN: </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col col-md-7">
                                    <table class="table table-sm table-bordered mini-text">
                                        <tr>
                                            <td class="text-start">Sold To: </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat rem enim exercitationem aliquid totam consectetur. Dolorum nemo impedit dicta soluta corporis itaque. Ipsa excepturi dolorum fugiat quae a necessitatibus qui!
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col col-md-5 text-md-end">
                                    <table class="table table-bordered mini-text table-sm">
                                        <tr>
                                            <td class="text-center">Cheque No</td>
                                            <td class="text-center">Payment Method</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Lorem ipsum</td>
                                            <td class="text-center">Lorem ipsum</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-n3">
                                <div class="col col-md-12">
                                    <table class="table table-sm table-borderless mini-text">
                                        <tr>
                                            <td class="text-start">NO.</td>
                                            <td class="text-start">ITEM</td>
                                            <td class="text-start">DESCRIPTION</td>
                                            <td class="text-center">QTY</td>
                                            <td class="text-center">RATE</td>
                                            <td class="text-center">TOTAL</td>
                                        </tr>
                                        @for ($i = 0; $i < 7; $i++)
                                            <tr>
                                                <td>#</td>
                                                <td>Item {{$i + 1}}</td>
                                                <td>Description</td>
                                                <td class="text-center">{{$i + 3}}</td>
                                                <td class="text-center">200,000</td>
                                                <td class="text-center">200,000</td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">SUBTOTAL: </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">VAT TOTAL: </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">DISCOUNT TOTAL: </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="bg-light"></td>
                                            <td colspan="3" class="text-start">TOTAL: </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        function printInvoice(id) {
            var element = document.getElementById(id);
            var opt = {
            margin:       [0.3, 0.3, 0.3, 0.8],
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 1 },
            jsPDF:        { unit: 'cm', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endsection
