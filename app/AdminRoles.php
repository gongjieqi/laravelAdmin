<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Config;


class AdminRoles extends EntrustRole
{
    //

    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.admins.model'), Config::get('entrust.role_user_table'),Config::get('entrust.role_foreign_key'),Config::get('entrust.user_foreign_key'));
        // return $this->belongsToMany(Config::get('auth.model'), Config::get('entrust.role_user_table'));
    }
}
