<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OauthModel;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $success['data'] = Auth::user();
            $success['token'] =  Auth::user()->createToken('Personal Access Token')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Username Atau Password Salah'], 401);
        }
    }

    public function logout(Request $request){
        $userid = Auth::id();
        if(OauthModel::where('user_id', $userid)->delete()){
            $success['message'] = "Token Berhasil Di Hapus";
            return response()->json(['success' => $success], $this->successStatus);
        }else{
            return response()->json(['error' => "Data Gagal Di Hapus"], 401);
        }
    }

    public function index(){

    }

    public function create(){

    }
    
    public function store(Request $request){
        
    }

    public function showAll(){
        $get = User::all();
        if($get){
            $success['data'] = $get;
            return $get->toJson();
        }else{
            return response()->json(['error' => "Data Gagal Di Ambil"], 401);
        }
    }

    public function show($id){
        
    }

    public function edit(Request $request){
        $user = User::where('id', $request['id'])->first();

        $validatedData = $this->validate($request,[
            'email' => ($user->email == $request['email']) ? '' : 'required|unique:users,email',
            'role' => 'required',
        ]);

        $dataUpdate = [
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => ($request['password'] == TRUE) ? bcrypt($request['password']) : $user->password, 
        ];
        if(User::where('id', $request['id'])->update($dataUpdate)){
            return response()->json(['success' => $validatedData], $this->successStatus); 
        }
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
        
    }
}
