@extends("layouts.admin")
@section("title", "Sản phẩm")

@section('css')
    <link href="{{ asset('admins/product/index/index.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('vendor/sweetalert2@9/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('admins/product/index/index.js') }}"></script>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Product', 'key'=> 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value->name !!}</td>
                                    <td>{!! number_format($value->price) !!} VNĐ</td>
                                    <td>
                                        <img class="feature-image-50x50"
                                             src="{!! $value->feature_image_path !!}"
                                             alt="">
                                    </td>
                                    <td>{!! optional($value->category)->name !!}</td>
                                    <td>
                                        <a href="{{ route('product.edit', ['id' => $value->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <a data-url="{{ route('product.delete', ['id'=>$value->id]) }}"
                                           class="action_delete btn btn-danger">Delete</a>
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
