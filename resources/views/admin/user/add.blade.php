@extends("layouts.admin")
@section("title", "Thêm user")

@section("css")
    <link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Users', 'key'=> 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}"
                                           placeholder="Nhập tên">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Nhập password">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="Nhập email">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò</label>
                                    <select name="role_id[]" multiple class="form-control select2-init">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
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
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection
