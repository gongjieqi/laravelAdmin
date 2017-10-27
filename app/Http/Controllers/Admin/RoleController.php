<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermissions;
use App\AdminRoles;
use App\Http\Requests\RoleCreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = AdminRoles::all();

        $permission = AdminPermissions::all();
        
        return view('admin.role.index',['roles'=>$roles,'permission'=>$permission]);
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
    public function store(RoleCreateRequest $request)
    {
        //
        $role = new AdminRoles();

        $role->name = $request->name;

        $role->display_name = $request->display_name;

        $role->save();

        $role->attachPermissions($request->permission_ids);
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
        $role = AdminRoles::find($id);

        $permission = AdminPermissions::all();

        $tree_permission = $this->tree($permission);

        return view('admin.role.edit',['role'=>$role,'permission'=>$tree_permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //1.有密码通过验证，修改密码
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
        return redirect(route('role.index'))->with('status', '编辑角色:'.$role->display_name.'成功');
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
        $delete =  AdminRoles::find($id)->delete();

        return redirect()->back()->with('status', '删除角色成功');
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
