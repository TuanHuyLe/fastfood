@extends("layouts.admin")
@section("title", "Thêm slider")

@section("css")
    <link href="{{ asset('admins/sliders/add/add.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Slider', 'key'=> 'Add'])
        {{--        <div class="col-md-12">--}}
        {{--            @if ($errors->any())--}}
        {{--                <div class="alert alert-danger">--}}
        {{--                    <ul>--}}
        {{--                        @foreach ($errors->all() as $error)--}}
        {{--                            <li>{{ $error }}</li>--}}
        {{--                        @endforeach--}}
        {{--                    </ul>--}}
        {{--                </div>--}}
        {{--            @endif--}}
        {{--        </div>--}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên slider</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}"
                                           placeholder="Nhập tên slider">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="image_path"
                                           class="form-control-file @error('image_path') is-invalid @enderror"
                                           placeholder="Chọn ảnh">
                                    @error('image_path')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ asset('admins/sliders/add/add.js') }}"></script>
@endsection
