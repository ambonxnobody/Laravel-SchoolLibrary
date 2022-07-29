<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit(User $profil)
    {
        if (auth()->user()->id != $profil->id) {
            abort(403);
        }
        return view('Pages.Auth.Profile', [
            'title' => 'Profil',
            'user' => $profil,
            'peminjamen' => Peminjaman::query()->where('user_id', $profil->id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profil)
    {
        if (auth()->user()->id != $profil->id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $profil->id,
        ]);

        if ($request->password) {
            $validatedData['password'] = $request->validate([
                'password' => 'required|confirmed|min:8',
            ]);

            $validatedData['password'] = Hash::make($request->password);
        }

        if ($request->file('photo')) {
            if ($request->oldPhoto) {
                Storage::delete($request->oldPhoto);
            }
            $validatedData['photo'] = $request->file('photo')->store('photo-profile');
        }

        User::query()->where('id', $profil->id)->update($validatedData);

        Alert::toast('Akun Berhasil Diubah!', 'success');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profil)
    {
        if (auth()->user()->id != $profil->id) {
            abort(403);
        }

        if ($profil->photo) {
            Storage::delete($profil->photo);
        }

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        User::destroy($profil->id);

        Alert::toast('Akun Berhasil Dihapus!', 'success');

        return redirect('/');
    }
}
