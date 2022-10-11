@extends('admin.index')

@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
          <a href="{{url('orderHistory/')}}" class="btn btn-success">Order History</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>Order Date</th>
                    <th>Tracking Number</th>
                    <th>Total price</th>
                    <th>status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                    <tr>

                        <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td>{{$item->tracking_no}}</td>
                        <td>{{$item->total_price}}</td>
                        <td>{{$item->status == 0 ? 'pending' : 'completed'}}</td>
                        <td>
                            <a href="{{url('admin/view_order/'.$item->id )}}" class="btn btn-primary">View</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection
