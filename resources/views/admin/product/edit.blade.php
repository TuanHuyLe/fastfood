@extends("layouts.admin")
@section("title", "Sửa sản phẩm")

@section("css")
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/product/edit/edit.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Product', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route("product.update", ['id' => $product->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $product->name }}"
                                               placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price" class="form-control"
                                               value="{{ $product->price }}"
                                               placeholder="Nhập giá sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>
                                        <input type="file" name="feature_image_path" class="form-control-file"
                                               placeholder="Chọn ảnh">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <img src="{{ $product->feature_image_path }}"
                                                     class="feature-image-200x200" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control select2_init" name="category_id">
                                            <option value="">Danh mục</option>
                                            {!! $htmlOption !!}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập tag cho sản phẩm</label>
                                        <select name="tags[]" class="form-control select-tags-choose" multiple>
                                            @foreach($product->tags as $item)
                                                <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh chi tiết</label>
                                        <input type="file" multiple name="image_path[]" class="form-control-file"
                                               placeholder="Chọn ảnh">
                                        <div class="col-md-12">
                                            <div class="row">
                                                @foreach($product->images as $item)
                                                    <img src="{{ $item->image_path }}" class="feature-image-200x200"
                                                         alt="">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="form-control tinymce_editor"
                                              name="contents" rows="10">
                                        {{ $product->content }}
                                    </textarea>
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
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
