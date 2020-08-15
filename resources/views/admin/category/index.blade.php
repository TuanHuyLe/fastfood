@extends("layouts.admin")
@section("title", "Danh mục")

@section("content")
    <div class="content-wrapper">
    @include('partials.contentheader', ['name'=>'Category', 'key'=> 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route("categories.create") }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value['name'] !!}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', ['id' => $value->id]) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('categories.delete', ['id' => $value->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
