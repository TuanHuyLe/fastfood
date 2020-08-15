@extends("layouts.admin")
@section("title", "Thêm sản phẩm")

@section("css")
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Product', 'key'=> 'Add'])
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
                        <form action="{{route("product.store")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}"
                                               placeholder="Nhập tên sản phẩm">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price"
                                               class="form-control @error('price') is-invalid @enderror"
                                               value="{{ old('price') }}"
                                               placeholder="Nhập giá sản phẩm">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>
                                        <input type="file" name="feature_image_path" class="form-control-file"
                                               placeholder="Chọn ảnh">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                                name="category_id">
                                            <option value="">Danh mục</option>
                                            {!! $htmlOption !!}
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập tag cho sản phẩm</label>
                                        <select name="tags[]" class="form-control select-tags-choose" multiple>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh chi tiết</label>
                                        <input type="file" multiple name="image_path[]" class="form-control-file"
                                               placeholder="Chọn ảnh">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="form-control tinymce_editor @error('contents') is-invalid @enderror"
                                              name="contents" rows="10">
                                        {{ old('contents') }}
                                    </textarea>
                                    @error('contents')
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
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
