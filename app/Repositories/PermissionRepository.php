<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2017/10/27
 * Time: 11:08
 */

namespace App\Repositories;
use App\AdminPermissions;

class PermissionRepository
{
    public function createPermission($request)
    {
        $permission = new AdminPermissions();

        $permission->name = $request->name;

        $permission->display_name = $request->display_name;

        $permission->group_name = $request->group_name;

        $permission->fid = $request->fid;

        $permission->description = $request->description;

        $permission->save();
    }

    public function getPermissionInfo($id)
    {
        $permission = AdminPermissions::find($id);

        $fathers = ['顶级分类']+AdminPermissions::where('fid','0')->where('id','<>',$id)->pluck('display_name','id')->toArray();

        return ['permission'=>$permission,'father'=>$fathers];
    }

    public function updatePermissionInfo($request,$id)
    {
        $permission = AdminPermissions::find($id);


        $permission->display_name = $request->display_name;

        $permission->group_name = $request->group_name;

        $permission->fid = $request->fid;

        $permission->description = $request->description;

        if($permission->save()){
            return true;
        }else{
            return false;
        }
    }
}