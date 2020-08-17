@extends("layouts.admin")
@section("title", "Roles")

@section('js')
    <script src="{{ asset('vendor/sweetalert2@9/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('admins/roles/index/index.js') }}"></script>
@endsection
@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Roles', 'key'=> 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value['name'] !!}</td>
                                    <td>{!! $value['display_name'] !!}</td>
                                    <td>
                                        <a href="{{ route('roles.edit', ['id'=>$value->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <a data-url="{{ route('roles.delete', ['id'=>$value->id]) }}"
                                           class="btn-danger btn action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
