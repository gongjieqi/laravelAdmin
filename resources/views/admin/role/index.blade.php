@extends('admin.layouts.app')

@section('content')
<div class="page-title">
    <span class="title">角色管理</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">

                <div class="card-title">
                    <div class="title">角色列表</div>
                </div>
                <div class="card-title">
                    <div class="title">
                        <create-role-button action_url="{{ route('role.store') }}" permission="{{ $permission }}"></create-role-button>
                    </div>
                </div>
            </div>
            @include('admin.message.success')
            @include('admin.message.error')
            <div class="card-body">
                <table class="datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>角色显示名称</th>
                        <th>角色名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->display_name }}</td>
                        <td>
                            {{ $role->name }}
                        </td>

                        <td>
                            @if($role->id != '1')
                            <a href="{{ route('role.edit',['id'=>$role->id]) }}" class="btn btn-info">编辑</a>
                            | <a href="javascript:void(0);" onclick="deleteRole({{ $role->id }});" class="btn btn-danger">删除</a>
                            <form class="role-delete-{{ $role->id }}" method="post" action="{{route('role.destroy',['id'=>$role->id])}}" style="display:none">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection