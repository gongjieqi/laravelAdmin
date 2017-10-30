<?php

namespace App\BladeService;
use App\AdminPermissions;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Route;
use PHPUnit\Runner\Exception;

/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2017/10/29
 * Time: 1:03
 */
class adminPermission
{
    public $roleRepository;
    public $admin;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->admin = auth()->guard('admin')->user();
    }

    public function permissionHtml()
    {
        $Permission = AdminPermissions::where('fid','0')->orWhere('name','like','%index')->get();

        $treePermission = $this->roleRepository->tree($Permission);

        $currentPermission = AdminPermissions::where('name',Route::currentRouteName())->first();

        if(Route::currentRouteName() =='admin.home') {
            $html = '<li class="active">
                    <a href="/admin">
                        <span class="icon fa fa-tachometer"></span><span class="title">控制面板</span>
                    </a>
                </li>';
        }else{
            $html = '<li>
                    <a href="/admin">
                        <span class="icon fa fa-tachometer"></span><span class="title">控制面板</span>
                    </a>
                </li>';
        }

        foreach($treePermission as $fatherPermission) {
            if($this->admin->can($fatherPermission['name']) || $this->admin->hasRole('admin')) {

                if(isset($currentPermission->fid) && $currentPermission->fid == $fatherPermission['id']){

                    $fatherLiClass = 'panel panel-default dropdown active';
                    $fatherDivClass = 'panel-collapse collapse in';
                }else{
                    $fatherLiClass = 'panel panel-default dropdown';
                    $fatherDivClass = 'panel-collapse collapse';
                }

                $html .= '<li class="'.$fatherLiClass.'">
                        <a data-toggle="collapse" href="#father-permission-'.$fatherPermission['id'].'">
                        <span class="icon "></span><span class="title">'.$fatherPermission['display_name'].'</span>
                        </a>';
                if(count($fatherPermission['children']) > 0){
                    $html .= '<div id="father-permission-'.$fatherPermission['id'].'" class="'.$fatherDivClass.'">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">';
                    foreach($fatherPermission['children'] as $childPermission){
                        if($this->admin->can($childPermission['name']) || $this->admin->hasRole('admin')){
                            if(isset($currentPermission->group_name) && $currentPermission->group_name == $childPermission['group_name']){
                                $childStyle = 'color:#19B5FE';
                            }else{
                                $childStyle = '';
                            }
                            $html .= '<li><a style="'.$childStyle.'" href="'.route($childPermission['name']).'">'.$childPermission['display_name'].'</a></li>';
                        }
                    }
                    $html .='</ul></div></div></li>';
                }
            }
        }
        return $html;
    }
}