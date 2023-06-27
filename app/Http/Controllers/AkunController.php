<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AkunModel;
use Auth;

class AkunController extends Controller
{
    public function index()
    {

        $data = User::all();

        return view('akun.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Akun",
            'data' => $data

        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success', 'Tambah data berhasil');

        return redirect('/akun');
    }



    public function update(Request $request)
    {


        //$user = Auth::user();

        //$user->update($request->all());
        //Flash::message("your account has been updated!");

        //return Redirect::to('/akun');

        $validatedData = $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required|max:255',
        ]);

        AkunModel::where('id', $request->id)->update($validatedData);

        return redirect('/akun')->with('success', 'Edit data berhasil');
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/akun')->with('success', 'Data Akun berhasil di hapus!!');
    }

    public function getAkun($id)
    {
        $akun = User::find($id);

        return json_encode($akun);

    }



}