<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function index()
    {
        return view('account.index');
    }

    protected function validator(array $data)
    {
        $rules = ['password' => 'string|min:8|confirmed'];
        $message = [
            'password.min' => '8文字以上で入力してください。',
            'password.confirmed' => '確認用パスワードと一致しません。'
        ];
        return Validator::make($data,$rules,$message);
    }

    public function confirm(AccountRequest $request)
    {
        $user = Auth::user();
        // dd($user);

        if(isset($request->current_password)) {
            if(!password_verify($request->current_password,$user->password))
            {
                return redirect()
                    ->route('account.index')
                    ->with('warning','パスワードが違います');
            }

            $this->validator($request->all())->validate();
            $inputs = $request->except('password', 'password_confirm');
            $password = $request->password;
            session(['password' => $password]);


        } else {
            $inputs = $request->all();
        }

        //フォームからの入力値をすべて取得
        if(isset($request->image)){
            $dir = 'image';

            $fileData = file_get_contents(
                $request->file('image')->getPathname()
            );
            $request->file('image')->store('public/'.$dir);
            $file_name = $request->file('image')->hashName();
            $file_path = $dir.'/'.$file_name;

        }else{
            $fileData = null;
            $file_path = null;

        }

        return view('account.confirm')
            ->with([
                'inputs' => $inputs,
                'fileData' => $fileData,
                'file_path' => $file_path
            ]);
    }




    public function thanks(Request $request)
    {
        $user = Auth::user();
        //  dd($user);

        $action = $request->input('action');

        if($action !== 'submit'){
            \Storage::disk('public')->delete($file_path);

            session()->forget('password');

            //戻るボタンの場合リダイレクト処理
            return redirect()
            ->route('account.index')
            ->withInput($inputs);

        } else {
            $request->session()->regenerateToken();

            if(isset($request->nickname)){
                $user->nickname = $request->nickname;
            }
            if(isset($request->file_path)){
                $user->image = $request->file_path;
            }

            if(isset($request->introduction)){
                $user->introduction = $request->introduction;
            }

            if(isset($request->email)){
                $user->email = $request->email;
            }

            if(session()->has('password')){
                $user->password = bcrypt(session('password'));
                session()->forget('password');
            }

            $user->save();

            // $userBuilder = DB::table('users');
            // $userBuilder
            //     ->where('id', $user_id)
            //     ->update([
            //         ''
            //     ])

        }


        return view('account.thanks');



    }
}
