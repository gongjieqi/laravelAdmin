<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermissions;
use App\AdminRoles;
use App\Http\Requests\RoleCreateRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
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
        $this->role->createRoleAndSavePermission($request);
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
        $return_array = $this->role->getRoleInfo($id);

        return view('admin.role.edit',$return_array);
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
        $role = $this->role->updateRoleAndPermission($request,$id);
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
}
