<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermissions;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionEditRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{


    protected $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

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
        $this->permission->createPermission($request);

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
        $return_array = $this->permission->getPermissionInfo($id);

        return view('admin.permission.edit',$return_array);
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
        $update = $this->permission->updatePermissionInfo($request,$id);

        if($update){
            return redirect(route('permission.index'))->with('status', '编辑成功');
        }else{
            return redirect(route('permission.index'))->withErrors('status', '编辑失败');
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
