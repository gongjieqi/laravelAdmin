<ul class="nav navbar-nav">
        @inject('adminPermission', 'App\BladeService\adminPermission')

        {!! $adminPermission->permissionHtml() !!}

</ul>