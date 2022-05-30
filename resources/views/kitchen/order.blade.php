@extends('layouts.master')

@section('content')
<div class="card">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kitchen Panel</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Order Listing
                            </div>
                            @if(session('info'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('info') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-body">
                                <table id="dishes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Dish Name</th>
                                            <th>Table Number</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->dishes->name }}</td>
                                            <td>{{ $order->table_id }}</td>
                                            <td>{{ $status[$order->status] }}</td>
                                            <td>
                                                <a href="{{ $order->status == 2 ? '#' : 'order/'.$order->id.'/approve' }}" class="btn btn-info">Approve</a>
                                                <a href="order/{{ $order->id }}/cancel" class="btn btn-danger">Cancel</a>
                                                <a href="order/{{ $order->id }}/ready" class="btn btn-secondary">Ready</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>
@endsection