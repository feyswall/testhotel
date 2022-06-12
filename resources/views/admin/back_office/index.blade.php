@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | page</title>
@endsection

@section('content')
    <main class="content">
        @php
            $menu = [
                ['name' => 'Employees', 'icon' => 'users', 'color' => 'alert-primary', 'route' => '/employees'],
                ['name' => 'Item Categories', 'icon' => 'box', 'color' => 'alert-info', 'route' => '/categories/1'],
                ['name' => 'Expenses Categories', 'icon' => 'bar-chart-2', 'color' => 'alert-danger', 'route' => '/categories/2'],
                ['name' => 'Contracts Categories', 'icon' => 'file-text', 'color' => 'alert-success', 'route' => '/categories/3'],
                ['name' => 'Suppliers', 'icon' => 'truck', 'color' => 'alert-primary', 'route' => '/suppliers'],
                ['name' => 'Taxes', 'icon' => 'dollar-sign', 'color' => 'alert-warning', 'route' => '/taxes'],
                ['name' => 'Item Attributes', 'icon' => 'list', 'color' => 'alert-info', 'route' => '/attributes'],
                ['name' => 'Customers', 'icon' => 'shopping-bag', 'color' => 'alert-dark', 'route' => '/customers'],
                ['name' => 'Discounts', 'icon' => 'percent', 'color' => 'alert-success', 'route' => '/discounts'],
                ['name' => 'System Users', 'icon' => 'shield', 'color' => 'alert-primary', 'route' => '/users'],
            ];
        @endphp
      <h1 class="h3 mb-3">Back Office</h1>
      <div class="row">
          @foreach ($menu as $item)
          <a href="{{$item['route']}}" class="col col-md-4 col-sm-12">
            <div>
                <div class="alert {{$item['color']}} alert-outline alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i data-feather="{{$item['icon']}}"></i>
                    </div>
                    <div class="alert-message">
                        {{$item['name']}} 
                    </div>
                </div>
              </div>
          </a>
          @endforeach
      </div>
    </main>
@endsection