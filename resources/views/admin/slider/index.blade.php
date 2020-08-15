@extends("layouts.admin")
@section("title", "Slider")

@section('css')
    <link href="{{ asset('admins/sliders/index/index.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('vendor/sweetalert2@9/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('admins/sliders/index/index.js') }}"></script>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Slider', 'key'=> 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('slider.add') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value->name !!}</td>
                                    <td>{!! $value->description !!}</td>
                                    <td>
                                        <img class="slider-image-50x50"
                                             src="{!! $value->image_path !!}"
                                             alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('slider.edit', ['id'=>$value->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <a data-url="{{ route('slider.delete', ['id'=>$value->id]) }}"
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
