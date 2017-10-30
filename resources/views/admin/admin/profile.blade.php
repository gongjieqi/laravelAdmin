@extends('admin.layouts.app')

@section('content')
    <div class="page-title">
        <span class="title">账户管理</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <div class="title">编辑账户</div>
                    </div>
                </div>
                @include('admin.message.success')
                @include('admin.message.error')
                <div class="card-body">
                    {!! Form::open(['route' => ['admin.profile']]) !!}
                    <div class="form-group">
                        {!! Form::label('old_password', '原密码') !!}
                        {!! Form::password('old_password',['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', '密码') !!}
                        {!! Form::password('password',['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', '重复密码') !!}
                        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('保存',['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection