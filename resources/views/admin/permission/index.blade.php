@extends('admin.layouts.app')

@section('content')
    <div class="page-title">
        <span class="title">权限管理</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <div class="title">权限列表</div>
                    </div>
                    <div class="card-title">
                        <div class="title">
                            <create-permission-button action_url="{{ route('permission.store') }}" father="{{ $father }}" child="{{ $is_child }}"></create-permission-button>
                        </div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>权限显示名称</th>
                            <th>权限名称</th>
                            <th>分组</th>
                            <th>类别</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Permissions as $Permission)
                            <tr>
                                <td>{{ $Permission->display_name }}</td>
                                <td>
                                    {{ $Permission->name }}
                                </td>
                                <td>
                                    {{ $Permission->group_name }}
                                </td>
                                <td>
                                    {{ $Permission->fatherName($Permission->fid) }}
                                </td>
                                <td>
                                    @if($Permission->fid == '0')
                                        <a href="{{ route('permission.child',['id'=>$Permission->id]) }}" class="btn btn-success">Child</a>
                                        |
                                    @endif
                                    <a href="{{ route('permission.edit',['id'=>$Permission->id]) }}" class="btn btn-info">编辑</a>
                                    | <a href="javascript:void(0);" onclick="deletePermission({{ $Permission->id }});" class="btn btn-danger">删除</a>
                                    <form class="permission-delete-{{ $Permission->id }}" method="post" action="{{route('permission.destroy',['id'=>$Permission->id])}}" style="display:none">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
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