<ul class="nav navbar-nav">
    <li class="active">
        <a href="index.html">
            <span class="icon fa fa-tachometer"></span><span class="title">控制面板</span>
        </a>
    </li>

    <li class="panel panel-default dropdown">
        <a data-toggle="collapse" href="#dropdown-element">
            <span class="icon fa fa-desktop"></span><span class="title">系统管理</span>
        </a>
        <!-- Dropdown level 1 -->
        <div id="dropdown-element" class="panel-collapse collapse">
            <div class="panel-body">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('admin.index') }}">用户列表</a>
                    </li>
                    <li><a href="{{ route('role.index') }}">角色列表</a>
                    </li>
                    <li><a href="{{ route('permission.index') }}">权限列表</a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
</ul>