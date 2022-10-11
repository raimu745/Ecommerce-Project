@extends('admin.index')

@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                    {{-- <a href="{{url('admin/view_user/{id}')}}" class="btn btn-success">View User</a> --}}
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>

                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>

                        <td>
                            <a href="{{url('admin/view_user/'.$item->id )}}" class="btn btn-primary">View</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection
