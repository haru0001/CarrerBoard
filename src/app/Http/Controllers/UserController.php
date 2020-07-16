<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;

// hamada テスト2
class UserController extends Controller
{

    public function userList(Request $request)
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }

    public function userCreate(Request $request)
    {
        // $user = User::create($request->user);
        // return response()->json(['user' => $user]);
        if (request()->img_path) {
            $file_name = time() . '.' . request()->img_path->getClientOriginalName();
            request()->img_path->storeAs('public/image', $file_name);
 
            $user = new User();
            $user->img_path = 'image/' . $file_name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->se_career = $request->se_career;
            $user->introduction = $request->introduction;
            $user->save();
 
            return ['success' => '登録しました!'];
        }
    }

    public function userDetail(User $user)
    {
        return response()->json(['user' => $user]);
    }



    public function userEdit(User $user, Request $request)
    {
        $user->update($request->user);
        return response()->json(['user' => $user]);
    }
  
    public function userDelete(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'delete successfully']);
    }

    //検索画面を訪れた際は全てのユーザーを表示する
    public function showAllUsers()
    {

        return User::select('id', 'name', 'se_career', 'introduction', 'img_path')->get();

    }


    //ユーザーのスキルを取得
    //TODO 中間テーブルがデータ不足のため、とりあえず、Tagsテーブルの全てのデータを読み取る   
    //TODO 引数を追加(識別するためのユーザーid情報)
    public function getUserTags()
    {
        return Tag::select('id', 'ct_name', 'ct_level')->get();
    }

}
