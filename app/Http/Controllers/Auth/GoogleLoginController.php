<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        // Debug konfigurasi
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUri = config('services.google.redirect');
        
        Log::info('Google Auth Config Check', [
            'client_id_exists' => !empty($clientId),
            'client_secret_exists' => !empty($clientSecret),
            'redirect_uri' => $redirectUri,
            'client_id_length' => strlen($clientId ?? ''),
        ]);
        
        // Validasi konfigurasi
        if (empty($clientId) || empty($clientSecret)) {
            Log::error('Google Auth: Missing configuration');
            return redirect()->route('login')->with('error', 'Konfigurasi Google OAuth tidak lengkap. Silakan hubungi administrator.');
        }
        
        try {
            Log::info('Google Auth: Redirecting to Google');
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Google Auth Redirect Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal mengarahkan ke Google: ' . $e->getMessage());
        }
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        Log::info('Google Auth: Handling callback');
        
        try {
            // Dapatkan user dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            Log::info('Google Auth: Got user from Google', [
                'id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name
            ]);

            // Cek apakah user sudah ada berdasarkan email
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                Log::info('Google Auth: User exists, updating google_id');
                
                // Update google_id dan avatar jika belum ada
                $existingUser->google_id = $googleUser->id;
                $existingUser->avatar = $googleUser->avatar;
                $existingUser->save();
                
                $user = $existingUser;
            } else {
                Log::info('Google Auth: Creating new user');
                
                // Buat user baru
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => null,
                ]);
            }

            // Login user
            Auth::login($user, true);
            
            Log::info('Google Auth: User logged in successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}