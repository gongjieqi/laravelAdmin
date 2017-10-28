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
                        <div class="title">编辑权限</div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    {!! Form::model($permission,['route' => ['permission.update',$permission->id]]) !!}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        {!! Form::label('display_name', '权限显示名称') !!}
                        {!! Form::text('display_name',$permission->display_name,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', '权限名称') !!}
                        {!! Form::text('name',$permission->name,['class' => 'form-control','disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('group_name', '路由') !!}
                        {!! Form::text('group_name',$permission->group_name,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fid', '分类') !!}
                        {!! Form::select('fid',$father,$permission->fid,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', '描述') !!}
                        {!! Form::textarea('description',$permission->description,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('编辑',['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection