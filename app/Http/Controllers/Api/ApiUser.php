<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

use App\Http\Resources\UserRes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUser extends Controller
{
    public function login()
    {
        $email = request()->email;
        $password = request()->password;
        if(auth()->attempt(['email'=> $email, 'password'=>$password])){
            $user = User::where('email', request()->email);
            $userGet = $user->first();
            $user = $user->get();
            $userCol = UserRes::collection($user);
            $token = Auth::user()->createToken('MyApp')->plainTextToken;
            return response()->json([
                'message' => 'Selamat datang ' . $userGet->name,
                'data'=> $userCol[0],
                'token' => $token
            ], 200);
        }
        else{
            return response()->json([
                'message' => "Email/Password anda salah!",
            ], 404);
        }
    }

 public function registerMas()
    {
        $nik = request() -> nik;
        $email = request() -> email;
        $name = request() -> name;
        $nomor_telepon = request() -> nomor_telepon;
        $password = Hash::make(request() -> password);
        $level = 'masyarakat';

        $rules = [
            'name' => 'required',
            'nik' => ['required','unique:users','min:16','max:16'],
            'email'=> ['required','email', 'unique:users'],
            'nomor_telepon'=> ['required','unique:users'],
            'password' => ['required','min:8']
        ];

        $pesannya = [
            'required' => 'Harap di isi di bagian :attribute',
            'unique' => ':attribute sudah digunakan',
            'min'=> ':attribute minimal :min',
            'max'=> ':attribute maximal :max',
            'email'=> 'Harap mengisi dengan @gmail.com'
            
        ];

        $validator = Validator::make(request()->all(), $rules, $pesannya);

        if($validator->fails()){
            return response()-> json([
                'error' => $validator->errors(),
            ]);
        }

        $data = [
            'name' => $name,
            'nik' => $nik,
            'email' => $email,
            'nomor_telepon'=> $nomor_telepon,
            'password' => $password,
            'level' => $level
        ];

        Masyarakat::insert([
            'nik' => $nik,
            'name' => $name,            
            'nomor_telepon'=> $nomor_telepon, 
        ]);
        $user = User::create($data);
        $userData = User::where($data)-> get();
        $userCol = UserRes::collection($userData);

        $token = $user-> createToken('MyApp')-> plainTextToken;
        return response()-> json([
            'message' => 'Selamat Datang',
            'data' => $userCol[0],
            'token' => $token

        ]);
    }

 public function ambilUser()
{
    $idToken = auth('sanctum')-> user()->id;
    $user = User::where('id',$idToken)->get();
    return response()-> json([
        'message'=> 'data berhasil',
        'data' => $user,

    ]);

}
}
