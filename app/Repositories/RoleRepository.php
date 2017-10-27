<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2017/10/27
 * Time: 10:57
 */

namespace App\Repositories;
use App\AdminRoles;
use App\AdminPermissions;

class RoleRepository
{
    public function createRoleAndSavePermission($request)
    {
        $role = new AdminRoles();

        $role->name = $request->name;

        $role->display_name = $request->display_name;

        $role->save();

        $role->attachPermissions($request->permission_ids);
    }

    public function getRoleInfo($id)
    {
        $role = AdminRoles::find($id);

        $permission = AdminPermissions::all();

        $tree_permission = $this->tree($permission);

        return ['role'=>$role,'permission'=>$tree_permission];
    }

    public function updateRoleAndPermission($request,$id)
    {
        $role = AdminRoles::find($id);

        $role->display_name = $request->display_name;
        $role->save();


        //2.权限
        if(count($request->permission_ids) <=0 ){
            $role->detachPermissions($role->perms);
        }else{

            $newPerms = AdminPermissions::whereIn('id',$request->permission_ids)->get();
            $newPermsIds = [];
            foreach($newPerms as $perms){
                if(!$role->hasPermission($perms->name)){
                    $role->attachPermission($perms);
                }
                array_push($newPermsIds,$perms->id);
            }

            $hasPermsIds = [];
            foreach($role->perms as $rolePerms){
                array_push($hasPermsIds,$rolePerms->id);
            }


            foreach($hasPermsIds as $hasPermsId){
                if(!in_array($hasPermsId,$newPermsIds)){
                    $role->perms()->detach($hasPermsId);
                }
            }
        }

        return $role;
    }

    public function tree($table,$p_id='0') {
        $tree = array();
        foreach($table as $row){
            if($row['fid']==$p_id){
                $tmp = $this->tree($table,$row['id']);
                if($tmp){
                    $row['children']=$tmp;
                }else{
                    $row['leaf'] = true;
                }
                $tree[]=$row;
            }
        }
        Return $tree;
    }
}