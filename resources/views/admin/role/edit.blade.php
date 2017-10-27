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
                        <div class="title">编辑角色</div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    {!! Form::model($role,['route' => ['role.update',$role->id]]) !!}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        {!! Form::label('display_name', '角色显示名称') !!}
                        {!! Form::text('display_name',$role->display_name,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', '角色名称') !!}
                        {!! Form::text('name',$role->name,['class' => 'form-control','disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', '权限') !!}
                        @foreach($permission as $father)
                            <div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                                @if($role->hasPermission($father->name))
                                    {!! Form::checkbox('permission_ids[]',$father->id,true,['id'=>'permission_ids'.$father->id,'class'=>'form-control']) !!}
                                @else
                                    {!! Form::checkbox('permission_ids[]',$father->id,false,['id'=>'permission_ids'.$father->id]) !!}
                                @endif
                                {!! Form::label('permission_ids'.$father->id, $father->display_name) !!}

                                @foreach($father->children as $chlid)
                                        @if($role->hasPermission($chlid->name))
                                            {!! Form::checkbox('permission_ids[]',$chlid->id,true,['id'=>'permission_ids'.$chlid->id,'class'=>'form-control']) !!}
                                        @else
                                            {!! Form::checkbox('permission_ids[]',$chlid->id,false,['id'=>'permission_ids'.$chlid->id]) !!}
                                        @endif
                                        {!! Form::label('permission_ids'.$chlid->id, $chlid->display_name) !!}
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    {!! Form::submit('编辑',['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection