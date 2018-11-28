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
        $user = auth()->user();

        $data = $request->all();

        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else {
            unset($data['password']);
        }

        $data['img_path'] = $user->img_path;

        if ($request->hasFile('img_path') &&
            $request->file('img_path')->isValid()) {

            if ($user->img_path) {
                // if img_path exist, create img name again
                $img_name = $user->id.'-'.kebab_case($user->name);
                // remove old img from directory
                unlink(storage_path('app/public/img-users/'.$user->img_path));                
            }else {
                // create img name
                $img_name = $user->id.'-'.kebab_case($user->name);
            }

            $img_extension = $request->img_path->extension();

            $img_fileName = "{$img_name}.{$img_extension}";
            
            $data['img_path'] = $img_fileName;
            
            $img_upload = $request->img_path
                ->storeAs('public/img-users', $img_fileName);

            if (!$img_upload) {
                $this->session(false, "image upload failed");
                return redirect()->back();
            }
        }

        $result = $user->update($data);
                
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
