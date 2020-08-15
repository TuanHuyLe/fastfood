@extends("layouts.admin")
@section("title", "Cập nhật menu")

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Menu', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route("menus.update", ['id' => $menu->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text" value="{{ $menu->name }}" name="name" class="form-control"
                                       placeholder="Nhập tên menu">
                            </div>
                            <div class="form-group">
                                <label>Menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Menu cha</option>
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
