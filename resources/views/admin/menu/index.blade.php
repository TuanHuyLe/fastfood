@extends("layouts.admin")
@section("title", "Menu")

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Menu', 'key'=> 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value['name'] !!}</td>
                                    <td>
                                        <a href="{{ route('menus.edit', ['id' => $value->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <a href="{{ route('menus.delete', ['id' => $value->id]) }}"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
