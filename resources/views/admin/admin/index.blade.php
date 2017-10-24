@extends('admin.layouts.app')

@section('content')
    <div class="page-title">
        <span class="title">用户管理</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <div class="title">用户列表</div>
                    </div>
                    <div class="card-title">
                        <div class="title">
                            <create-user-button action_url="{{ route('admin.store') }}" roles="{{ $roles }}"></create-user-button>
                        </div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>角色</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>
                                @foreach( $admin->roles as $role)
                                    {{ $role->display_name }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.edit',['id'=>$admin->id]) }}" class="btn btn-info">编辑</a>
                                @if($admin->id != '1')
                                    | <a href="javascript:void(0);" onclick="deleteUser({{ $admin->id }});" class="btn btn-danger">删除</a>
                                    <form class="admin-delete-{{ $admin->id }}" method="post" action="{{route('admin.destroy',['id'=>$admin->id])}}" style="display:none">
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