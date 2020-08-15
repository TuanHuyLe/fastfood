@extends("layouts.admin")
@section("title", "Cập nhật danh mục")

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Category', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route("categories.update", ['id' => $data->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" value="{{ $data->name }}" name="name" class="form-control"
                                       placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
