<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\kirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\Console\Input\Input;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    //

    public function login() {
        return view("pages.layout-login", [
            'title' => 'Login',


        ]);
        
    }
    public function reset_password() {
        return view("pages.reset-password", [
            'title' => 'Masukkan Email',


        ]);
        
    }
    public function verifikasi_otp(Request $request) {

        // dd($request);
        $code = random_int(100000, 999999);

        // dd($request, $code);


        $logo = public_path('assets/images/online.png');

        $data = [
            "email"=>$request->email,
            "code"=>$code,
            "logo"=>$logo,

        ];

        
        $data_code = [
            "otp"=>$code,

        ];

        $user = User::where("email",$request->email)->first();

        $user->update($data_code);


        $email = $request->email;

        
        $mail = Mail::to($request->email)->send(new kirimEmail($data));


        return response()->json([
            'email' => $email,
            'code' => $code,
        ]);

        
    }

    

    public function code_verification(Request $request, Response $response) {

      
        // varification_otp()
        $email = session()->get('email');
        $code = session()->get('code');
        return view("pages.verIfikasi_otp", [
            'title' => 'Kode OTP',
            'email' => $email,
            'code' => $code
        ]);
    }

    public function confirm_password(Request $request) {
        // dd($request);


        $id = User::where('email',$request->email)->first()->id;

        $user = User::find($id);


        $data = [
            "password"=> $request->password_baru,
        ];

        $data['password']= Hash::make($data['password']);

        $user->update($data);


        return response()->json([
            'success'   => true
        ]);    
    }

    public function konfirmasi_password(Request $request, Response $response) {
        // dd($request);
        // $email = $request->email;
        // return response()->json($email);

        return view("pages.konfirmasi_password", [
            'title' => 'Kode OTP',
        ]);

    }


    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
      
      
        //tambahkan script di bawah ini 
        public function handleProviderCallback(Request $request)
        {
            try {
                $user_google    = Socialite::driver('google')->user();
                $user           = User::where('email', $user_google->getEmail())->first();
                // dd($user_google);
    
                //jika user ada maka langsung di redirect ke halaman home
                //jika user tidak ada maka simpan ke database
                //$user_google menyimpan data google account seperti email, foto, dsb
    
                if($user != null){
                    \auth()->login($user, true);
                    Alert::success('Selamat Datang di AIS-ONLINE', 'Anda Login sebagai '.$user_google->getEmail().'');
                    return redirect('/');

                }else{

                    // $create = User::Create([
                    //     'email'             => $user_google->getEmail(),
                    //     'name'              => $user_google->getName(),
                    //     'password'          => 0,
                    //     'email_verified_at' => now()
                    // ]);
            
                    
                    // \auth()->login($create, true);

                    Alert::error(''.$user_google->getEmail().'','Email ini tidak terdaftar dalam sistem');

                    return redirect('/login');
                }
    
            } catch (\Exception $e) {
                return redirect('/');
            }
    
    
        }

    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    
    public function verifikasi_ulang_otp(Request $request) {
    
        // dd($request);
        $code = random_int(100000, 999999);
    
        // dd($request, $code);

        $logo = public_path('assets/images/online.png');

    
        $data = [
            "email"=>$request->email,
            "code"=>$code,
            "logo"=>$logo,

        ];

        
        $data_code = [
            "otp"=>$code,
        ];

        $user = User::where("email",$request->email)->first();

        $user->update($data_code);
    
        
        $mail = Mail::to($request->email)->send(new kirimEmail($data));
    
        return response()->json($data);
        
    }

    public function getOTP(Request $request) {
        $otp = User::where("email", $request->email)->value('otp');
        
        return response()->json([
            "otp" => $otp,
        ]);
    }

    public function check_OTP(Request $request) {
        $otp_input = str_replace('-', '', $request->post('kode_otp'));
        $otp_database = User::where("email", $request->post('email'))->value('otp');

        if($otp_input != $otp_database) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }        
        // dd($otp_input, $otp_database);
    }

    public function check_Email(Request $request) {
        $email = $request->post('email');

        $checkEmail = User::where("email", $email)->get();

        if(count($checkEmail) > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}

