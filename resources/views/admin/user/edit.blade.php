@extends("layouts.admin")
@section("title", "Cập nhật user")

@section("css")
    <link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Users', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('users.update', ['id'=>$user->id]) }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           value="{{ $user->name }}"
                                           placeholder="Nhập tên">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password"
                                           class="form-control"
                                           placeholder="Nhập password">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                           class="form-control"
                                           value="{{ $user->email }}"
                                           placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò</label>
                                    <select name="role_id[]" multiple class="form-control select2-init">
                                        @foreach($roles as $role)
                                            <option {{ $rolesOfUser->contains('id', $role->id) ? 'selected' : '' }}
                                                    value="{{ $role->id }}">{{ $role->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
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
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection
