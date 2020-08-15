@extends("layouts.admin")
@section("title", "Cập nhật vai trò")

@section("css")
    <link href="{{ asset('admins/roles/add/add.css') }}" rel="stylesheet"/>
@endsection

@section("content")
    <div class="content-wrapper">
        @include('partials.contentheader', ['name'=>'Roles', 'key'=> 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('roles.update', ['id'=>$role->id]) }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tên vai trò</label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           value="{{ $role->name }}"
                                           placeholder="Nhập tên vai trò">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea type="text" name="display_name"
                                              class="form-control" rows="3"
                                              placeholder="Nhập mô tả">{{ $role->display_name }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 checkboxcard">
                                <div class="col-md-12">
                                    <input type="checkbox" id="checkall">
                                    <label for="checkall" class="c-pointer">
                                        <b>Check all</b>
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionParentItem)
                                    <div class="card border-primary col-md-12 p-0">
                                        <div class="card-header bg-ccc">
                                            <input type="checkbox" id="module{{ $permissionParentItem->id }}"
                                                   value="{{ $permissionParentItem->id }}"
                                                   class="checkbox_wrapper">
                                            <label for="module{{ $permissionParentItem->id }}" class="c-pointer">
                                                <b>Module {{ $permissionParentItem->name }}</b>
                                            </label>
                                        </div>
                                        <div class="row">
                                            @foreach($permissionParentItem->permissionChildren as $permissionItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <input name="permission_id[]"
                                                               {{ $permissionChecked->contains('id', $permissionItem->id) ? 'checked' : '' }}
                                                               class="checkbox_children"
                                                               type="checkbox" id="module{{ $permissionItem->id }}"
                                                               value="{{ $permissionItem->id }}">
                                                        <label class="c-pointer"
                                                               for="module{{ $permissionItem->id }}">{{ $permissionItem->name }}</label>
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
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
    <script src="{{ asset('admins/roles/add/add.js') }}"></script>
@endsection
