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
use App\Models\Supplier;
use App\Models\Ingredients;
use App\Models\pastry;
use App\Models\cart;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //GET DATABASE------------------------------------------------------------------------------------------------------------------------
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

    //LOGOUT SEMUA USER DAN ADMIN---------------------------------------------------------------------------------------------------------
    public function logoutuser(){
        Session::forget("userlog");
        Session::forget("adminlog");
        Session::forget("remember");
        Session::forget("rememberadmin");
        return view("dashboard");
    }

    //REGISTER AKUN USER SESUAI ROLE NYA--------------------------------------------------------------------------------------------------
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
                    "picture" => "default.png",
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

    public function registerakunkaryawan(Request $request)
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
            'role' => 'karyawan',
        ]);

        return redirect()->route('admin')->with('msg', 'Berhasil Register');
    }

    //FITUR LOGIN--------------------------------------------------------------------------------------------------------------------------
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
                    if ($user->role == 'baker') {
                        // Redirect for baker role
                        return redirect("/baker");
                    } elseif ($user->role == 'user') {
                        // Redirect for user role
                        return redirect("/user");
                    } elseif ($user->role == 'karyawan') {
                        // Redirect for karyawan role
                        return redirect("/karyawan");
                    } else {
                        // Handle other roles if needed
                    }
                } else {
                    $userSession = new stdClass();
                    $userSession->user = $request->username;
                    $userSession->password = $request->password;
                    $userSession->picture = $user->picture;
                    Session::put('userlog', $userSession);
                    Cookie::queue('usernameyglogin', $request->username, 60);
                    if ($user->role == 'baker') {
                        // Redirect for baker role
                        return redirect("/baker");
                    } elseif ($user->role == 'user') {
                        // Redirect for user role
                        return redirect("/user");
                    } elseif ($user->role == 'karyawan') {
                        // Redirect for karyawan role
                        return redirect("/karyawan");
                    } else {
                        // Handle other roles if needed
                    }
                }
            } else {
                return redirect()->route("login")->with("msg", "Password Salah");
            }
        } else {
            return redirect()->route("login")->with("msg", "Username tidak ditemukan");
        }
        if ($user->role == 'baker') {
            // Redirect for baker role
            return redirect("/baker");
        } elseif ($user->role == 'user') {
            // Redirect for user role
            return redirect("/user");
        } elseif ($user->role == 'karyawan') {
            // Redirect for karyawan role
            return redirect("/karyawan");
        } else {
            // Handle other roles if needed
        }
    }

    // BAGIAN MENUJU TAMPILAN HOME USER PER ROLE-----------------------------------------------------------------------------------------------
    public function tampilhomeuser(){
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        return view('user.homeUser', ['user' => $user]);
    }

    public function tampilhomebaker(){
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        return view('baker.homeBaker', ['user' => $user]);
    }

    public function tampilhomekaryawan(){
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        return view('karyawan.homeKaryawan', ['user' => $user]);
    }

    // FITUR UPDATE PROFILE DAN TAMPILAN PROFILE USER CUSTOMER--------------------------------------------------------------------------------------
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

    //MENAMPILKAN HALAMAN DI AKUN ADMIN--------------------------------------------------------------------------------------------------------
    public function listUser()
    {
        $data = $this->getDataAll();
        $jumlah = count($data);

        return view("admin.listU", ["data" => $data, "jumlah" => $jumlah]);
    }

    public function listpenjualan()
    {
        $data = $this->getDataAll();
        $penjualan = dtrans::All();


        return view("admin.penjualan", ['penjualan' => $penjualan]);
    }

    public function listBaker()
    {
        $data = $this->getDataAll();
        $jumlah = count($data);

        return view("admin.listB", ["data" => $data, "jumlah" => $jumlah]);
    }

    public function listKaryawan()
    {
        $data = $this->getDataAll();
        $jumlah = count($data);

        return view("admin.listK", ["data" => $data, "jumlah" => $jumlah]);
    }

    public function viewmasterbaker()
    {
        return view("admin.masterbaker");
    }

    public function viewmastermenukaryawan()
    {
        $ingredients = Ingredients::all();
        $suppliers = Supplier::all();
        $pastry = Pastry::all();
        return view('karyawan.mastermenu', ['suppliers' => $suppliers, 'ingredients' => $ingredients, 'pastries' => $pastry]);
    }

    public function updatePastrykaryawan(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'harga' => 'required|integer',
        'new_picturepastry' => 'image|mimes:jpeg,jpg,gif,png|max:3072', // Max 3MB
        'Stok' => 'required|integer',
    ]);

    // Find the pastry
    $pastry = Pastry::find($id);

    if (!$pastry) {
        return redirect()->back()->with('msg', 'Pastry not found.');
    }

    // Handle image upload
    if ($request->hasFile('new_picturepastry')) {
        // Delete the old image if it exists
        if ($pastry->picturepastry) {
            Storage::delete($pastry->picturepastry);
        }

        // Upload the new image
        $newPicturePath = $request->file('new_picturepastry')->store('public/profile');
        $newPicturePath = str_replace('public/', 'storage/', $newPicturePath);

        // Update the pastry with the new image path
        $pastry->update([
            'harga' => $request->harga,
            'picturepastry' => $newPicturePath,
            'Stok' => $request->Stok,
        ]);
    } else {
        // Update the pastry details without changing the image
        $pastry->update([
            'harga' => $request->harga,
            'Stok' => $request->Stok,
        ]);
    }

    return redirect()->back()->with('msg', 'Pastry updated successfully.');
}



    public function viewmasterkaryawan()
    {
        return view("admin.masterkaryawan");
    }

    //proses admim edit user
    public function PAEditUser(Request $request, $username)
    {
        User::where('username', $username)->update([
            "nama" => $request->input("nama"),
        ]);

        return redirect()->back()->with("msg", "berhasil edit");
    }
    public function adminedituser($username)
    {
        $data = $this->getUserBy($username);
        return view("admin.edituser", ["data" => $data, "username" => $username]);
    }
    //TAMPILAN HALAMAN AKUN BAKER DAN FITUR FITURNYA-------------------------------------------------------------------------------------------
    public function viewmasteringredient()
    {
        $ingredients = Ingredients::all();
        $suppliers = Supplier::all();
        return view('baker.masteringredient', ['suppliers' => $suppliers, 'ingredients' => $ingredients]);
    }

    public function viewmastersupplier()
    {
    $suppliers = Supplier::all();
    // Pass the suppliers to the view
    return view("baker.mastersupplier", ['suppliers' => $suppliers]);
    }
    public function viewmastermenu()
    {
        $ingredients = Ingredients::all();
        $suppliers = Supplier::all();
        $pastry = Pastry::all();
        return view('baker.mastermenu', ['suppliers' => $suppliers, 'ingredients' => $ingredients, 'pastries' => $pastry]);
    }


    public function showIngredients()
    {
        $suppliers = Supplier::all();
        $ingredients = Ingredients::all();

        return view('baker.masteringredients', ['suppliers' => $suppliers, 'ingredients' => $ingredients]);
    }


    //BAGIAN INSERT PASTRY, SUPPLIER, BAHAN -------------------------------------------------------------------------------------------
    public function insertpastry(Request $request)
        {
        // Validate the request data
        $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|integer',
            'picturepastry' => 'required|image|mimes:jpeg,jpg,gif,png|max:3072', // Maksimal 3MB
            'ingredients_id' => 'required|exists:ingredients,id',
        ]);

        // Check if the pastry with the same name and ingredients already exists
        $existingPastry = Pastry::where('nama', $request->nama)
                                ->where('ingredients_id', $request->ingredients_id)
                                ->first();

        if (!$existingPastry) {
            // Upload and save the pastry picture
            $picturePath = $request->file('picturepastry')->store('public/profile');
            $picturePath = str_replace('public/', 'storage/', $picturePath);

            // Create a new pastry
            Pastry::create([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'picturepastry' => $picturePath,
                'ingredients_id' => $request->ingredients_id,
                'Stok' => 1,
            ]);

            // Retrieve the updated data
            $ingredients = Ingredients::all();
            $pastries = Pastry::all();

            return view('baker.mastermenu', [
                'ingredients' => $ingredients,
                'pastries' => $pastries,
            ]);
        } else {
            // Handle the case where the pastry with the same name and ingredients already exists
            return redirect()->back()->with('msg', 'Pastry with the same name and ingredients already exists.');
        }
        }

        public function insertIngredient(Request $request)
        {
                // Validate the request data
                $request->validate([
                    'nama' => 'required|max:255',
                    'supplier_id' => 'required|exists:supplier,id',
                ]);

                // Create a new ingredient
                Ingredients::create([
                    'nama' => $request->nama,
                    'supplier_id' => $request->supplier_id,
                ]);

                // Retrieve the updated data
                $suppliers = Supplier::all();
                $ingredients = Ingredients::all();

                // Pass the data to the view
                return view('baker.masteringredient', ['suppliers' => $suppliers, 'ingredients' => $ingredients])
                    ->with('msg', 'Menu added successfully.');

        }


        public function insertSupplier(Request $request)
        {
            // Validate the request data
            $request->validate([
                'nama' => 'required|unique:supplier,nama|max:255',
                'notlp' => 'required| numeric',// Add this line for notlp validation
                'address' => 'required|max:255',
            ]);

            // Create a new supplier
            Supplier::create([
                'nama' => $request->nama,
                'notlp' => $request->notlp,
                'address' => $request->address,
            ]);

            return redirect()->route('baker')->with('msg', 'Supplier added successfully.');
        }


    //TAMPILAN HALAMAN AKUN CUSTOMER ------------------------------------------------------------------------------------------------------------
    public function tampilHMembership()
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }

        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();


        return view("user.membership" , ['user' => $user]);
    }

    public function viewmenuuser()
    {
        $pastries = pastry::all();

        return view('user.menu', ['pastries' => $pastries]);
    }

    //FITUR TOP UP -------------------------------------------------------------------------------------------------------------------------------
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
    public function beliMembership()
    {
        $user = $this->getData();

        // Check saldo
        if ($user->saldo < 50000) {
            return redirect()->route("membership")->with('msg', "Saldo tidak cukup untuk membeli Membership");
        }

        // Membuat Htrans dan mendapatkan ID
        Htrans::create([
            'user_id' => $user->id,
            'tanggal' => now(),  // Assuming you want to use the current date and time
            'membership_id' => 1,  // Assuming membership is always 1
        ]);

        // Dtrans::create([
        //          "id_htrans" => $idhtrans,
        //         "item" => "membership",
        //       "harga" => 50000
        //     ]);

        User::where('id', $user->id)->update([
                "member" => 1,
               "saldo" => $user->saldo - 50000,
            ]);

        return redirect()->back()->with('msg', 'Purchase successful.');

        // $idhtrans = $htrans->id;

        // // Membuat Dtrans
        // Dtrans::create([
        //     "id_htrans" => $idhtrans,
        //     "item" => "membership",
        //     "harga" => 50000
        // ]);

        // // Mengupdate status member pada user
        // User::where('id', $user->id)->update([
        //     "member" => 1,
        //     "saldo" => $user->saldo - 50000,
        // ]);

        // // Mendapatkan data user setelah pembelian
        // $user = $this->getData();

        // return redirect()->route("Hprofile")->with('msg', "Berhasil beli");
    }

    public function membershipbuy()
    {
        if (!Session::has("userlog")) {
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        $username = Cookie::get('usernameyglogin');
        $user = User::where('username', $username)->first();

        $harga = cookie::get('harga');
        $harga = pastry::where('harga',$harga);

        $membership = cookie::get('member');
        $member = User::where('member',$membership);




    }
    public function editIngredient($id)
    {
        $ingredient = Ingredients::find($id);
        $suppliers = Supplier::all(); // Assuming you have a Supplier model

        return view('baker.masteringredient', [
            'ingredient' => $ingredient,
            'suppliers' => $suppliers,
        ]);
    }

    public function updateIngredient(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'supplier_id' => 'required|exists:supplier,id',
        ]);

        $ingredient = Ingredients::find($id);

        if ($ingredient) {
            $ingredient->update([
                'nama' => $request->nama,
                'supplier_id' => $request->supplier_id,
            ]);

            return redirect()->back()->with('msg', 'Ingredient updated successfully.');
        } else {
            return redirect()->back()->with('msg', 'Ingredient not found.');
        }
    }

    public function deleteIngredient($id)
    {
        $ingredient = Ingredients::find($id);

        if ($ingredient) {
            $ingredient->delete();

            return redirect()->back()->with('msg', 'Ingredient deleted successfully.');
        } else {
            return redirect()->back()->with('msg', 'Ingredient not found.');
        }
    }



// Other controller functions...

public function updateSupplier(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|max:255|unique:supplier,nama,' . $id,
        'notlp' => 'required| numeric', // Updated Indonesian phone number regex
        'address' => 'required|nullable|max:255',
    ]);

    $supplier = Supplier::find($id);

    if ($supplier) {
        $supplier->update([
            'nama' => $request->nama,
            'address' => $request->address,
            'notlp' => $request->notlp,
        ]);

        return redirect()->back()->with('msg', 'Supplier updated successfully.');
    } else {
        return redirect()->back()->with('msg', 'Supplier not found.');
    }
}



    public function deleteSupplier($id)
    {
        $supplier = Supplier::find($id);

        if ($supplier) {
            $supplier->delete();

            return redirect()->back()->with('msg', 'Supplier deleted successfully.');
        } else {
            return redirect()->back()->with('msg', 'Supplier not found.');
        }
    }

// ...

public function updatePastry(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'nama' => 'required|max:255',
        'harga' => 'required|integer',
        'ingredients_id' => 'required|exists:ingredients,id',
        'new_picturepastry' => 'image|mimes:jpeg,jpg,gif,png|max:3072', // Max 3MB
    ]);

    // Find the pastry
    $pastry = Pastry::find($id);

    if (!$pastry) {
        return redirect()->back()->with('msg', 'Pastry not found.');
    }

    // Handle image upload
    if ($request->hasFile('new_picturepastry')) {
        // Delete the old image if it exists
        if ($pastry->picturepastry) {
            Storage::delete($pastry->picturepastry);
        }

        // Upload the new image
        $newPicturePath = $request->file('new_picturepastry')->store('public/profile');
        $newPicturePath = str_replace('public/', 'storage/', $newPicturePath);

        // Update the pastry with the new image path
        $pastry->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ingredients_id' => $request->ingredients_id,
            'picturepastry' => $newPicturePath,
        ]);
    } else {
        // Update the pastry details without changing the image
        $pastry->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ingredients_id' => $request->ingredients_id,
        ]);
    }

    return redirect()->back()->with('msg', 'Pastry updated successfully.');
}

public function deletePastry($id)
{
    $pastry = Pastry::find($id);

    if ($pastry) {
        // Soft delete the pastry
        $pastry->delete();

        // If you want to permanently delete the image file, you can uncomment the line below
        // Storage::delete($pastry->picturepastry);

        return redirect()->back()->with('msg', 'Pastry deleted successfully.');
    } else {
        return redirect()->back()->with('msg', 'Pastry not found.');
    }
}

public function tampilmenu(){
    if (!Session::has("userlog")) {
        return redirect()->route("login")->with('msg', "Harus Login Dahulu");
    }
    $username = Cookie::get('usernameyglogin');
    $user = User::where('username', $username)->first();

    $pastries = pastry::all();
    return view('user.menu', ['pastries' => $pastries],['user' => $user]);


}

public function insertcart(Request $request)
    {
        // Validasi request
        $request->validate([
            'pastry_id' => 'required|exists:pastrys,id',
        ]);

        // Periksa apakah user sedang login
        if (auth()->check()) {
            $user = auth()->user();

            // Periksa apakah item sudah ada dalam keranjang user
            $cartItem = Cart::where('user_id', $user->id)
                ->where('pastry_id', $request->pastry_id)
                ->first();

            // Jika item sudah ada, tambahkan jumlahnya
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // Jika item belum ada, tambahkan item baru ke keranjang
                Cart::create([
                    'user_id' => $user->id,
                    'pastry_id' => $request->pastry_id,
                    'quantity' => 1,
                ]);
            }

            // Berikan umpan balik bahwa item berhasil ditambahkan
            return response()->json(['success' => true]);
        }

        // Berikan umpan balik jika user tidak login (bisa disesuaikan)
        return response()->json(['success' => false, 'message' => 'User belum login']);
    }

public function tampilkeranjang()
{
    if (!Session::has("userlog")) {
        return redirect()->route("login")->with('msg', "Harus Login Dahulu");
    }

    $username = Cookie::get('usernameyglogin');
    $user = User::where('username', $username)->first();
    $pastries = pastry::all();

    // Variabel $keranjang harus disertakan sesuai kebutuhan aplikasi Anda
    $keranjang = []; // Contoh array, gantilah dengan data sesuai kebutuhan

    // Mengirimkan variabel $user dan $keranjang ke view 'user.keranjang'
    return view('user.keranjang', ['pastries' => $pastries, 'user' => $user, 'keranjang' => $keranjang]);
}

public function showCart()
{
    $cart = session()->get('cart', []);

    return view('user.keranjang', compact('cart')); // Ensure $cart is passed to the view
}


public function checkout()
    {
        // Mendapatkan data keranjang dari database
        $keranjang = cart::all();

        // Memeriksa apakah keranjang kosong
        if ($keranjang->isEmpty()) {
            return redirect()->route('user.keranjang')->with('error', 'Keranjang masih kosong.');
        }

        // Melakukan proses checkout
        // Misalnya, mengurangi stok pastry, mencatat pesanan, menghitung total harga, dll.
        // ...

        // Mengosongkan keranjang setelah checkout
        cart::truncate();

        // Redirect ke halaman sukses atau halaman lainnya
        return redirect()->route('user.keranjang')->with('success', 'Checkout berhasil. Terima kasih!');
    }



public function tampilpenjualan(){
    if (!Session::has("userlog")) {
        return redirect()->route("login")->with('msg', "Harus Login Dahulu");
    }
    $username = Cookie::get('usernameyglogin');
    $user = User::where('username', $username)->first();

    $pastries = pastry::all();
    // Pass the data to the view
    return view('user.keranjang', ['pastries' => $pastries], ['user' => $user]);
}
}
