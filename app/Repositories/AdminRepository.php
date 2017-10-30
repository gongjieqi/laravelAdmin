<?php
namespace App\Repositories;

use App\Admin;
use App\AdminRoles;
use App\Notifications\PermissionNotification;
use Illuminate\Support\Facades\Hash;

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
            $needNotify = false;
            foreach($newRoles as $role){
                if(!$admin->hasRole($role->name)){
                    $needNotify = true;
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
                    $needNotify = true;
                    $admin->roles()->detach($hasRoleId);
                }
            }
            if($needNotify){
                $admin->notify(new PermissionNotification($newRoles));
            }
        }
        return $admin;
    }

    public function updateProfile($request)
    {
        $admin = auth()->guard('admin')->user();

        if(strlen($request->old_password) > 0 && strlen($request->password) > 0){
            if(Hash::check($request->old_password, $admin->password)){
                $admin->password = bcrypt($request->password);
                return $admin->save();
            }else{
                return false;
            }
        }
        return true;
    }
}