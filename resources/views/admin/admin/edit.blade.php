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
                        <div class="title">编辑用户</div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    {!! Form::model($admin,['route' => ['admin.update',$admin->id]]) !!}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        {!! Form::label('name', '用户名') !!}
                        {!! Form::text('name',$admin->name,['class' => 'form-control','disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', '密码') !!}
                        {!! Form::password('password',['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', '重复密码') !!}
                        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('roles', '用户角色') !!}
                        <br/>
                                @foreach($roles as $role)
                                    <div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                                            @if($admin->hasRole($role->name))
                                                {!! Form::checkbox('role_ids[]',$role->id,true,['id'=>'role_ids'.$role->id,'class'=>'form-control']) !!}
                                            @else
                                            {!! Form::checkbox('role_ids[]',$role->id,false,['id'=>'role_ids'.$role->id]) !!}
                                            @endif
                                            {!! Form::label('role_ids'.$role->id, $role->display_name) !!}
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