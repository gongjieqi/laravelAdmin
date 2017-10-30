@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">通知</div>

                    <div class="panel-body">
                        {{ $notification->data['title'] }} : <br/>您的角色改变为:
                        @foreach($notification->data['role'] as $role)
                            {{ $role }}
                        @endforeach
                        <br/>
                        操作人：{{ $notification->data['modify'] }} 操作时间：{{ $notification->created_at }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
