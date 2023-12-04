<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;
use App\Models\User; // Tambahkan use statement untuk model User
use App\Models\Feed;
use App\Models\Htrans; // Import model Htrans
use App\Models\Dtrans;
use App\Models\Friend;

class UserController extends Controller
{
    //

    public function getData(){
        $userlog = Session::get("userlog");
        $data = User::where('username', $userlog->user)->first();
        return $data;
    }

    public function getDataAll(){
        $data = User::all();
        return $data;
    }

    public function getUserBy($username){

        $data = User::where('username', $username)->first();
        return $data;
    }

    public function tampilhomeuser(){
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        return view('user.homeUser', ['user' => $user]);
    }

    public function logoutuser(){
        Session::forget("userlog");
        Session::forget("adminlog");
        Session::forget("remember");
        Session::forget("rememberadmin");
        return view("dashboard");
    }

    public function registerakun(Request $request)
    {
        $user = User::where('username', $request->usernameReg)->first();

        if ($user) {
            return redirect()->route("register")->with('msg', "Username sudah terpakai");
        } else {
            if (
                $request->usernameReg == "" ||
                $request->emailReg == "" ||
                $request->namaReg == "" ||
                $request->password == "" ||
                $request->password_confirmation == "" ||
                $request->tgllahir == ""
            ) {
                return redirect()->route("register")->with('msg', "semua field harus di isi");
            } elseif ($request->input("password") != $request->input("password_confirmation")) {
                return redirect()->route("register")->with('msg', "Password dan password confirmation tidak sama");
            } else {
                User::create([
                    "username" => $request->usernameReg,
                    "nama" => $request->namaReg,
                    "email" => $request->emailReg,
                    "password" => $request->password,
                    "tgllahir" => $request->tgllahir,
                    "saldo" => 0,
                    "role" => "user"
                ]);

                return redirect()->route("login")->with('msg', "Berhasil Register");
            }
        }
    }

    public function registerakunbaker(Request $request)
    {
    // Validate the request data
        $request->validate([
            'usernameReg' => 'required|unique:user,username',
            'emailReg' => 'required|email|unique:user,email',
            'namaReg' => 'required',
            'password' => 'required|min:3|confirmed',
            'tgllahir' => 'required|date',
        ]);

        // Create a new user
        User::create([
            'username' => $request->usernameReg,
            'nama' => $request->namaReg,
            'email' => $request->emailReg,
            'password' => $request->password, 
            'tgllahir' => $request->tgllahir,
            'saldo' => 0,
            'role' => 'baker',
        ]);

        return redirect()->route('admin')->with('msg', 'Berhasil Register');
    }

    public function login(Request $request)
    {
        $listuser = User::all();

        if ($request->input("username") == "admin" && $request->input("password") == "admin") {
            if (isset($request->cbremember)) {
                $user = new stdClass();
                $user->user = "admin";
                $user->password = "admin";
                Session::put('rememberadmin', $user);
                Session::put('adminlog', $user);

                return redirect("/admin");
            } else {
                $user = new stdClass();
                $user->user = "admin";
                $user->password = "admin";

                Session::put('adminlog', $user);

                return redirect("/admin");
            }
        }

        $user = User::where('username', $request->input("username"))->first();

        if ($user) {
            if ($user->password == $request->password) {
                if (isset($request->cbremember)) {
                    $userSession = new stdClass();
                    $userSession->user = $request->username;
                    $userSession->password = $request->password;
                    $userSession->picture = $user->picture;
                    Session::put('remember', $userSession);
                    Session::put('userlog', $userSession);
                    Cookie::queue('usernameyglogin', $request->username, 60);
                    return redirect("/user");
                } else {
                    $userSession = new stdClass();
                    $userSession->user = $request->username;
                    $userSession->password = $request->password;
                    $userSession->picture = $user->picture;
                    Session::put('userlog', $userSession);
                    Cookie::queue('usernameyglogin', $request->username, 60);
                    return redirect("/user");
                }
            } else {
                return redirect()->route("login")->with("msg", "Password Salah");
            }
        } else {
            return redirect()->route("login")->with("msg", "Username tidak ditemukan");
        }
        return redirect("/user");
    }


    public function tampilProfile(Request $request){
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        $userlog = Session::get("userlog");
        $data = User::where('username', $userlog->user)->first();
        $idxlogin = json_decode(Cookie::get("idxLogin"), true);
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        return view("user.profile", ["data" => $data, "idxlogin" => $idxlogin], ['user' => $user]);
    }

    public function HUEditProfile()
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }

        $userlog = Session::get("userlog");
        $data = User::where('username', $userlog->user)->first();
        $idxlogin = json_decode(Cookie::get("idxLogin"), true);

        return view("user.editprofile", ["data" => $data, "idxlogin" => $idxlogin]);
    }

    public function PUEditProfile(Request $request)
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }

        $userlog = $this->getData();
        $request->validate([
            // Validasi lainnya...
            'profile_picture' => 'required|image|mimes:jpeg,jpg,gif,png|max:3072', // Maksimal 3MB
        ]);
        if (
            $request->nama == "" ||
            $request->oldpassword == "" ||
            $request->password == "" ||
            $request->password_confirmation == "" ||
            $request->tgllahir == ""
        ) {
            return redirect()->back()->with('msg', "semua field harus di isi");
        } elseif ($request->oldpassword != $userlog->password) {
            return redirect()->back()->with('msg', "old password tidak sesuai");
        } elseif ($request->input("password") != $request->input("password_confirmation")) {
            return redirect()->back()->with('msg', "Password dan password confirmation tidak sama");
        } else {
            $picture = $request->profile_picture;
            $file_name = $userlog->id . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/profile', $file_name);

            User::where('id', $userlog->id)->update([
                "nama" => $request->nama,
                "tgllahir" => $request->tgllahir,
                "password" => $request->password,
                "picture" => $file_name,
            ]);
            $userSession = Session::get('userlog');
            $userSession->picture = $file_name;
            Session::put('userlog', $userSession);
            return redirect()->back()->with('msg', "berhasil edit profile");
        }
    }


    public function listUser()
    {
        $data = $this->getDataAll();
        $jumlah = count($data);

        return view("admin.listU", ["data" => $data, "jumlah" => $jumlah]);
    }

    public function listBaker()
    {
        $data = $this->getDataAll();
        $jumlah = count($data);

        return view("admin.listB", ["data" => $data, "jumlah" => $jumlah]);
    }

    public function viewmasterbaker()
    {
        return view("admin.masterbaker");
    }



    public function adminedituser($username)
    {
        $data = $this->getUserBy($username);
        return view("admin.edituser", ["data" => $data, "username" => $username]);
    }
    //proses admim edit user
    public function PAEditUser(Request $request, $username)
    {
        User::where('username', $username)->update([
            "nama" => $request->input("nama"),
        ]);

        return redirect()->back()->with("msg", "berhasil edit");
    }

    public function tampilHMembership()
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }

        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();


        return view("user.membership" , ['user' => $user]);
    }



    public function showTopupPage()
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();
        return view("user.topup", ['user' => $user]);
    }

    public function topup(Request $request)
    {
        $user = $this->getData();

        // Validasi input
        $request->validate([
            'nominal' => ['required', 'integer', 'min:1'],
        ]);

        // Cek apakah nominal topup lebih besar dari 0
        if ($request->nominal <= 0) {
            return redirect()->route('topup')->with('msg', 'Nominal topup harus lebih besar dari 0.');
        }
        else{
            User::where('id', $user->id)->update([
                'saldo' => $user->saldo + $request->nominal,
            ]);

            // Mendapatkan data user setelah update
            $user = $this->getData();

            return redirect()->route('topup')->with('msg', "Topup berhasil. Saldo Anda sekarang: " . $user->saldo);
        }

        // Update saldo user setelah topup

    }
    //berikan code baru disini

}
