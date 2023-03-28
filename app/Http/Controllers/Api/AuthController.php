<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon; 
class AuthController extends Controller
{
    // login tài khoản
    public function login(Request $request)
    {
        //check input data có hơp lệ không 
        $checkLogin = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // kiểm tra check longin 
        if ($checkLogin) {
            // lâys thông tin user
            $user = Auth::user();
            // tạo API token bằng method createToken() và sẽ được mã hóa , plainTextToken để lấy ra để sử dụng
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'status' => 200,
                'token' => $token,
            ];
        } else {
            $reponse = [
                'status' => 401,
                'title' => 'Unauthorized',
            ];
        }
        return $response;
    }

    // xoa token khong xoa user,
    public function getToken(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }
    // xóa token và tạo token mới
    public function refreshToken(Request $request)
    {
        // dd(1);
        // kiểm tra nếu lấy ra được chuỗi token 
        if ($request->header('authorization')) {
            // gắn = chuỗi token
            $hashToken = $request->header('authorization');
            // xóa bearer để lấy riêng chuỗi token 
            $hashToken = str_replace('Bearer', '', $hashToken);
            // xóa khoảng trăng trong chuỗi token
            $hashToken = trim($hashToken);
            // lấy ra id của user là tokenable
            $token = PersonalAccessToken::findToken($hashToken);
            // dd($token);
            // nếu có token 
            if ($token) {
                // dd($token);
                // thoi gian  tạo token
                $tokenCreated = $token->created_at;
                // dd($token->created_at);
                // tg tạo + tg sông token
                $expire = Carbon::parse($tokenCreated)->addMinutes(config('sanctum.expiration'))->format('Y-m-d H:i:s');
                // dd(Carbon::now()<=$expire);
                // dd($expire,Carbon::now());
                // Nếu thời gian quá hạn sẽ tạo token mới
                if (Carbon::now()>=$expire) {
                    // dd(1);
                    // gắn = id  
                    $userId = $token->tokenable_id;
                    // tìm id
                    $user = User::find($userId);
                    // xoa token
                    $user->tokens()->delete();
                    // Tạo mới token
                    $newToken = $user->createToken('auth_token')->plainTextToken;
                    $reponse = [
                        'status' => 200,
                        'token' => $newToken,
                    ];
                    // Nếu còn hạn
                } else {
                    $reponse = [
                        'status' => 200,
                        'title' => 'Chưa hết hạn',
                    ];
                }
            } else {
                $reponse = [
                    'status' => 401,
                    'title' => 'Unauthorized',
                ];
            }
            return $reponse;

        }
    
    }
}
