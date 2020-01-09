<?php

namespace App\Http\Controllers;

use App\User;
use App\Statusblacklisted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\UserBlacklist;
use App\Cart;



class UserController extends Controller
{

    // ini untuk search user manage (Admin)
    public function searchuser(Request $request)
    {

        $users = User::selectRaw('users.id, users.username, users.role,users.name,users.email,users.phone,users.birthday,users.gender')
            ->whereRaw(
                'users.username = ? or users.role = ? or users.role = ? or users.name = ? or users.email = ? or users.phone = ? or users.birthday = ? or users.gender = ?',
                [$request->search, $request->search, $request->search, $request->search, $request->search, $request->search, $request->search, $request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('admin.manage-user', compact('users', 'search'));
    }

    // INI UNTUK UPDATE USER PROFILE
    public function updateUser($id)
    {
        /*Mengambil data user sesuai id untuk dibawa ke view update-profile*/
        $carts = Cart::whereRaw('user_id = ?', [Auth::user()->id])->get();
        $updateUser = User::find($id);
        return view('member.update-profile', ['users' => $updateUser], compact('carts'));
    }
    public function doUpdateUser(Request $request, $id)
    {

        /*Validator update user*/
        $rules = [
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("update-profile/$id")->withErrors($validator)->withInput();
        }

        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $user = User::find($id);

        $user->name = $request['name'];
        $user->birthday = $request['birthday'];
        $user->gender = $request['gender'];
        $user->photo = $request['photo'];
        $user->save();

        return redirect("update-profile/$id")->with('success', 'Data profile has been updated.');
    }


    // INI UNTUK UPDATE USER ACCOUNT
    public function updateAccount($id)
    {
        /*Mengambil data user sesuai id untuk dibawa ke view update-account*/

        $updateAccount = User::find($id);
        return view('member.update-account', ['users' => $updateAccount]);
    }

    public function doUpdateAccount(Request $request, $id)
    {

        /*Validator update user Account*/
        $rules = [
            'username' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required',
            'phone' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("update-account/$id")->withErrors($validator)->withInput();
        }

        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $user = User::find($id);
        // ini untuk validasi
        $user->username = $request['username'];
        $user->password = $request['password'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("update-account/$id")->with('success', 'Data account has been updated.');
    }


    // Ini untuk manager User (admin)
    public function manageUser()
    {
        $datauser = User::paginate(15);

        return view('admin.manage-user', ['users' => $datauser]);
    }
    // ini untuk delete user (Admin)
    public function deleteUser($id)
    {
        $user = User::find($id); /*Mengambil data user sesuai id user*/
        $user->delete(); /*Menghapus user yang dipilih sesuai id user*/
        return redirect("manage-user")->with('danger', 'Data has been deleted.');
    }


    //  ini untuk add new member (Admin)
    public function addmember(Request $request)
    {

        /*Validator form penambahan member*/
        $rules = [
            'username' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|numeric',
            'birthday' => 'required',
            'gender' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("add-member")->withErrors($validator)->withInput();
        }

        $newMember = new User();
        $newMember->username = $request['username'];
        $newMember->name = $request['name'];
        $newMember->email = $request['email'];
        $newMember->password = $request['password'];
        $newMember->phone = $request['phone'];
        $newMember->birthday = $request['birthday'];
        $newMember->gender = $request['gender'];
        $newMember->photo = $request['photo'];
        $newMember->role = 'member';
        $newMember->save();

        return redirect("manage-user")->with('info', 'New Member has been created.');
    }

    // ini untuk edit user (admin)
    public function edituser($id)
    {
        $edituser = User::find($id);
        return view('admin.edit-member', ['users' => $edituser]);
    }

    public function doedituser(Request $request, $id)
    {

        /*Validator update user Account*/
        $rules = [
            'username' => 'unique:users',
            'name' => 'required',
            'email' => 'string|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'numeric',
            'birthday' => 'required',
            'gender' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-member/$id")->withErrors($validator)->withInput();
        }

        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $user = User::find($id);
        // ini untuk validasi
        $user->username = $request['username'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->phone = $request['phone'];
        $user->birthday = $request['birthday'];
        $user->gender = $request['gender'];
        $user->photo = $request['photo'];
        $user->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("manage-user")->with('success', 'Data has been updated.');
    }

    // manage user blacklisted
    // untuk view user 
    public function userBlacklisted()
    {

        $datauser = UserBlacklist::selectRaw('user_blacklist.id as id ,user_blacklist.description, c.username as username , s.status as status')
            ->join('users as c', 'c.id', '=', 'user_blacklist.user_id')
            ->join('statusblacklisted as s', 's.id', '=', 'user_blacklist.status_id')
            ->paginate(15);

        return view('admin.user-blacklisted', ['user_blacklist' => $datauser]);
    }
    // ini untuk search
    public function searchblacklisted(Request $request)
    {

        $user_blacklist = userBlacklist::selectRaw('user_blacklist.id  ,user_blacklist.description, c.username as username , s.status as status')
            ->join('users as c', 'c.id', '=', 'user_blacklist.user_id')
            ->join('statusblacklisted as s', 's.id', '=', 'user_blacklist.status_id')
            ->whereRaw(
                ' c.username = ? or s.status = ? or user_blacklist.description = ?',
                [$request->search, $request->search, $request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('admin.user-blacklisted', compact('user_blacklist', 'search'));
    }



    // add user blacklisted
    public function adduser()
    {
        $users = User::all();
        $statusblacklisted = Statusblacklisted::all();

        return view('admin.add-userblacklisted', compact('users', 'statusblacklisted'));
    }
    // doo add user blacklist
    public function doAddUser(Request $request)
    {
        //validasi
        $rules = [
            'username' => 'required',
            'status' => 'required',
            'description' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("add-userblacklisted")->withErrors($validator)->withInput();
        }

        $user = new UserBlacklist();
        $user->user_id = $request->username;
        $user->status_id = $request->status;
        $user->description = $request->description;
    
        $user->save();

        return back()->with('success', 'New User has been created.');
    }
    //   delete user blacklisted
    public function deleteUserBlacklist($id)
    { 

        $blacklisted = UserBlacklist::find($id);

        $blacklisted->delete();
        return redirect("user-blacklisted")->with('danger', 'Data has been deleted.');
    }
    //  edit user blacklist
    public function editUserBlacklist($id)
    {
        $users = User::all();
        $statusblacklisted = Statusblacklisted::all();
        $datauser = UserBlacklist::selectRaw('user_blacklist.id as id ,user_blacklist.description, c.id as user_id , s.id as status_id')
        ->join('users as c', 'c.id', '=', 'user_blacklist.user_id')
        ->join('statusblacklisted as s', 's.id', '=', 'user_blacklist.status_id')
        ->where('user_blacklist.id',$id)
        ->first();

        return view('admin.edit-userblacklisted',  compact('datauser','users', 'statusblacklisted'));
    }

    // do edit user blacklist
    public function doeditUserBlacklist(Request $request, $id)
    {

        $rules = [
            'username' => 'required',
            'status' => 'required',
            'description' => 'required',
         
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-userblacklisted/$id")->withErrors($validator)->withInput();
        }

        $user = UserBlacklist::find($id);
        // ini untuk validasi
        $user->user_id = $request['username'];
        $user->status_id = $request['status'];
        $user->description = $request['description'];
        $user->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("edit-userblacklisted/$id")->with('success', 'Data account has been updated.');
    }
  

}
