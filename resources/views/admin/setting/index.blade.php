@extends("layouts.admin")
@section("title", "Setting")

@section('js')
    <script src="{{ asset('vendor/sweetalert2@9/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('admins/setting/index/index.js') }}"></script>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Setting', 'key'=> 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group dropup m-2">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Add setting
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('setting.add') . '?type=text' }}">Text</a>
                                <a class="dropdown-item" href="{{ route('setting.add') . '?type=textarea' }}">Text
                                    area</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{!! $value['config_key'] !!}</td>
                                    <td>{!! $value['config_value'] !!}</td>
                                    <td>
                                        <a href="{{ route('setting.edit', ['id'=>$value->id]) . '?type=' . $value->type }}"
                                           class="btn btn-warning">Edit</a>
                                        <a data-url="{{ route('setting.delete', ['id'=>$value->id]) }}"
                                           class="btn btn-danger btnDelete">Delete</a>
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
