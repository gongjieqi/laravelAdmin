<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2017/10/23
 * Time: 11:54
 */

namespace App\Extensions;

use Illuminate\Http\Request;


trait AuthenticatesLogout
{
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect('/');
    }
}