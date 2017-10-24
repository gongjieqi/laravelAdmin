<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\AdminRoles;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\EditAdminPostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::all();

        $roles = AdminRoles::all(['id','display_name']);
        return view('admin.admin.index',['admins'=>$admins,'roles'=>$roles])->with('status', 'Profile updated!');;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {
        //
        $admin = new Admin();

        $admin->name = $request->name;

        $admin->password = bcrypt($request->password);

        $admin->save();

        if(count($request->role_ids > 0)){

            $roles = AdminRoles::whereIn('id',$request->role_ids)->get();

            $admin->attachRoles($roles);
        }
        return response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = Admin::find($id)->first();
        $roles = AdminRoles::all(['id','name','display_name']);
        return view('admin.admin.edit',['admin'=>$admin,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAdminPostRequest $request, $id)
    {
        //1.有密码通过验证，修改密码
        $admin = Admin::find($id)->first();

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
        return redirect(route('admin.index'))->with('status', '编辑用户:'.$admin->name.'成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $delete =  Admin::find($id)->delete();

        return redirect()->back()->with('status', '删除用户成功');
    }
}
