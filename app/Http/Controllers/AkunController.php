<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AkunModel;
use Auth;

use Illuminate\Validation\Rule;

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
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|max:225',
            'email' => [
                'required',
                'email:dns',
                Rule::unique('users')->ignore($request->id),
            ],
            'role' => 'required|max:255',
        ]);

        User::where('id', $request->id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ]);

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