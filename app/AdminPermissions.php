<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class AdminPermissions extends EntrustPermission
{
    //

    public $fillable = ['name','display_name','description','route_name','fid'];
    public function fatherName($fid)
    {
        switch($fid){
            case '0': return '顶级分类';break;
            default : $father = self::where('id',$fid)->first(); return $father->display_name;
        }
    }
}
