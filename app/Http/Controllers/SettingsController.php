<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Show the application settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Logika untuk update profil atau pengaturan lainnya bisa ditambahkan di sini
        // Contoh:
        // $user = Auth::user();
        // $user->update($request->all());
        // return back()->with('success', 'Pengaturan berhasil diperbarui!');

        return back()->with('info', 'Fitur ini sedang dalam pengembangan.');
    }
}
