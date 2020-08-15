@extends("layouts.admin")
@section("title", "Cập nhật slider")

@section("css")
    <link href="{{ asset('admins/sliders/edit/edit.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Slider', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route("slider.update", ['id' => $slider->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên slider</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $slider->name }}"
                                           placeholder="Nhập tên slider">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="3">{{ $slider->description }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="image_path"
                                           class="form-control-file @error('image_path') is-invalid @enderror"
                                           placeholder="Chọn ảnh">
                                    <img src="{{ $slider->image_path }}" class="image-200x200" alt="">
                                    @error('image_path')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ asset('admins/sliders/edit/edit.js') }}"></script>
@endsection
