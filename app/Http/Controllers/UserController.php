<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // tìm kiếm
        // $name = request()->query('name');
        $name = $request->name;
        // dd($name);
        $user = User::orderBy('id','DESC');
        // kt name nếu có gtri
        if ($name) { 
            $user = $user->where('name','like','%' .$name. '%');
        }
        $user = $user->get();
        
        //  ktr co bản ghi thì báo
        if ($user->count()) {
            $status = 'success';
        } else {
            $status = 'no_data';
        }
        $response = [
            'status' => $status,
            'data' => $user,
        ];
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // validate 
        $this->validation($request);
        $method = $request ->method();

        if($method=='POST'){
            $user =  User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'username'=>$request->username,
                // mã hóa mật khẩu thanh chuỗi kí tự
                'password'=>Hash::make($request->password),
            ]);
            $response = [
                'status' => 'success',
                'data' => $user,
            ];
           
            } else {
            $response = [
                'status' => 'erross',
            ];
            }
            return $response;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // xem 1 ban ghi
    public function show($id)
    {
        // chuyển APP_DEBUG=false
        $user = User::find($id);
        
        // ktra
        if (!$user) {
            $status = 'no data';
        } else {
            $status = 'success';
        }
        // trả về
        $response = [
            'status' => $status,
            'data' => $user,
        ];
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $user = User::find($id);
        
        // dd($user);
        // $this->validation($request);
        $method = $request ->method();
        if($method=='PATCH'){
            if($request->name){
                $user->name = $request->name;
            }
            if($request->email){
                $user->email = $request->email;
            }
            if($request->username){
                $user->username = $request->username;
            }
            if($request->password){
                $user->password = Hash::make($request->password);
            }
             $user->save();
        } else {
            if($request->name){
                $user->name = $request->name;
            }
            if($request->email){
                $user->email = $request->email;
            }
            if($request->username){
                $user->username = $request->username;
            }
            if($request->password){
                $user->password = Hash::make($request->password);
            }
             $user->save();
        }
        if (!$user) {
            $response = [
                'status' => 'no_data',
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $user,
            ];
        }
            return $response;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // ktr xóa không tc
        if ($user) {
            $user->delete();
            $response = [
                'status' => 'success delete',
            ];
        } else {
            $response = [
                'status' => 'errors delete',
            ];
        }
        return $response;
    }

    public function validation($request, $id=0)
    { 
        $emailValidation = 'required|email|unique:users';
        // if(!empty($id)){
        //     $emailValidation.=',email,'.$id;
        // }
        $rules = [
            'name' => 'required|min:5|unique:users',
            'email' => $emailValidation,
            'password' => 'required|min:8|unique:users',
        ];
        $messages = [
            'name.required' => 'tên không được trống',
            'name.min' => 'tên không được nhỏ hơn :min kí tự',
            'email.required' => 'email không được trống',
            'email.email' => 'email không đúng đinh dạng',
            'email.unique' => 'email đã tồm tại',
            'name.unique' => 'name đã tồm tại',
            'password.unique' => 'password không được trùng với mật khẩu cũ',
            'password.required' => 'mật khẩu bắt buộc phải nhập',
            'password.min' => 'mật khẩu không được nhỏ hơn :min kí tự',

        ];
        $request->validate($rules, $messages);
    }
}
