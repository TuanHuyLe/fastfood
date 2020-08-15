@extends("layouts.admin")
@section("title", "Thêm setting")

@section('css')
    <link href="{{ asset('admins/setting/add/add.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Setting', 'key'=> 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('setting.store') . '?type=' . request()->type }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text" name="config_key"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       placeholder="Nhập config key">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <input type="text" name="config_value"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           placeholder="Nhập config value">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'textarea')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <textarea class="form-control @error('config_value') is-invalid @enderror"
                                              rows="3" name="config_value"></textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
