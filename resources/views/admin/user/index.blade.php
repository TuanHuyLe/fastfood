@extends("layouts.admin")
@section("title", "Users")

@section('js')
    <script src="{{ asset('vendor/sweetalert2@9/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('admins/user/index/index.js') }}"></script>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Users', 'key'=> 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('users.add') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value['name'] !!}</td>
                                    <td>{!! $value['email'] !!}</td>
                                    <td>
                                        <a href="{{ route('users.edit', ['id'=>$value->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <a data-url="{{ route('users.delete', ['id'=>$value->id]) }}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
