<?php
namespace App\Repositories;

use App\Admin;
use App\AdminRoles;

class AdminRepository
{
    public function createAdminAndSaveRole($request)
    {
        $admin = new Admin();

        $admin->name = $request->name;

        $admin->password = bcrypt($request->password);

        $admin->save();

        if(count($request->role_ids > 0)){

            $roles = AdminRoles::whereIn('id',$request->role_ids)->get();

            $admin->attachRoles($roles);
        }
    }

    public function updateAdminAndRole($request,$id)
    {
        //1.有密码通过验证，修改密码
        $admin = Admin::find($id);

        if(strlen($request->password) > 0){
            $admin->password = bcrypt($request->password);
            $admin->save();
        }

        //2.修改角色
        if(count($request->role_ids) <=0 ){
            $admin->detachRoles($admin->roles);
        }else{
            $newRoles = AdminRoles::whereIn('id',$request->role_ids)->get();
            $newRoleIds = [];
            foreach($newRoles as $role){
                if(!$admin->hasRole($role->name)){
                    $admin->attachRole($role);
                }
                array_push($newRoleIds,$role->id);
            }

            $hasRoleIds = [];
            foreach($admin->roles as $adminRole){
                array_push($hasRoleIds,$adminRole->id);
            }


            foreach($hasRoleIds as $hasRoleId){
                if(!in_array($hasRoleId,$newRoleIds)){
                    $admin->roles()->detach($hasRoleId);
                }
            }
        }

        return $admin;
    }
}