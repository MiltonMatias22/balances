<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else {
            unset($data['password']);
        }

        $result = auth()->user()->update($data);
                
        if ($result) {
            $this->session($result, "Update successful");
            return redirect()->back();
        }

        $this->session($result, "Update failed");
        return redirect()->back();
    }

    public function session ($success, $message)
    {
        //messages session
        \Session::flash('success',[
            'success' => $success,
            'message' => $message
        ]);
    }
}
