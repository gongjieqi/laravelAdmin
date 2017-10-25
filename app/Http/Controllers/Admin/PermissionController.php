<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermissions;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionEditRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topPermission = AdminPermissions::where('fid','0')->get();

        return view('admin.permission.index',['Permissions'=>$topPermission,'father'=>$topPermission]);
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
    public function store(PermissionCreateRequest $request)
    {
        //
        $permission = new AdminPermissions();

        $permission->name = $request->name;

        $permission->display_name = $request->display_name;

        $permission->route_name = $request->route_name;

        $permission->fid = $request->fid;

        $permission->description = $request->description;

        $permission->save();
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

        $permission = AdminPermissions::find($id);

        $fathers = ['顶级分类']+AdminPermissions::where('fid','0')->where('id','<>',$id)->pluck('display_name','id')->toArray();

        return view('admin.permission.edit',['permission'=>$permission,'father'=>$fathers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionEditRequest $request, $id)
    {
        //
        $permission = AdminPermissions::find($id);


        $permission->display_name = $request->display_name;

        $permission->route_name = $request->route_name;

        $permission->fid = $request->fid;

        $permission->description = $request->description;

        if($permission->save()){
            return redirect(route('permission.index'))->with('status', '编辑权限:'.$permission->display_name.'成功');
        }else{
            return redirect(route('permission.index'))->withErrors('status', '编辑权限:'.$permission->display_name.'成功');
        }
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
        AdminPermissions::where('fid',$id)->delete();

        AdminPermissions::find($id)->delete();

        return redirect()->back()->with('status', '删除权限成功');
    }

    public function childIndex($id)
    {
        $topPermission = AdminPermissions::where('fid',$id)->get();

        $father = AdminPermissions::where('id',$id)->first();

        return view('admin.permission.index',['Permissions'=>$topPermission,'father'=>$father]);
    }
}
