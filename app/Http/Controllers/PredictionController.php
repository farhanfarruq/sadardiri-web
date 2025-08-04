<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PredictionController extends Controller
{
    /**
     * Menjalankan script prediksi pengeluaran dan mengembalikan hasilnya.
     */
    public function predict()
    {
        $user = Auth::user();
        $transactionsJson = $user->transactions()->select('date', 'type', 'amount')->get()->toJson();

        try {
            // --- PATH SUDAH DIPERBARUI ---
            // Menggunakan path absolut ke instalasi Python Anda yang benar.
            $pythonPath = 'C:\\Users\\USER\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';
            $scriptPath = app_path('scripts/predict_expense.py');

            // Proses dibuat tanpa argumen, data akan dikirim via STDIN.
            $process = new Process([$pythonPath, $scriptPath]);
            
            // Mengirim data transaksi melalui Standard Input (STDIN).
            $process->setInput($transactionsJson);
            
            // Menjalankan proses.
            $process->mustRun();

            // Mendapatkan output dari proses.
            $output = $process->getOutput();
            $prediction = json_decode($output, true);
            
            // Jika script Python mengembalikan pesan error, tampilkan.
            if (isset($prediction['error'])) {
                return response()->json($prediction, 422);
            }
            
            return response()->json($prediction);
            
        } catch (ProcessFailedException $exception) {
            // Error jika prosesnya sendiri gagal dijalankan (misal: path salah, permission denied).
            return response()->json([
                'error' => 'Gagal total menjalankan script Python.',
                'message' => $exception->getMessage(),
                'details' => $exception->getProcess()->getErrorOutput()
            ], 500);
        } catch (\Exception $e) {
            // Menangkap error lainnya.
            return response()->json([
                'error' => 'Terjadi kesalahan tidak terduga di server.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Method untuk melakukan tes koneksi ke Python.
     * Akses melalui route /test-python (jika Anda membuatnya).
     */
    public function testPythonConnection()
    {
        try {
            // --- PATH SUDAH DIPERBARUI ---
            $pythonPath = 'C:\\Users\\USER\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';
            // Gunakan script tes yang sederhana
            $scriptPath = app_path('scripts/test_python.py'); // Pastikan file ini ada

            $process = new Process([$pythonPath, $scriptPath]);
            $process->mustRun();

            $output = $process->getOutput();

            return response("SELAMAT! KONEKSI PHP KE PYTHON BERHASIL.\n\nOutput:\n" . $output, 200)
                  ->header('Content-Type', 'text/plain');

        } catch (\Exception $e) {
            return response("GAGAL.\n\n---- PESAN ERROR LENGKAP ----\n\n" . $e->getMessage(), 500)
                  ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * >>> METHOD BARU YANG DISEMPURNAKAN <<<
     * Method untuk memeriksa apakah library Python (pandas, sklearn) sudah ter-install.
     */
    public function testLibraries()
    {
        try {
            $pythonPath = 'C:\\Users\\USER\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';
            $scriptPath = app_path('scripts/test_libraries.py');

            $process = new Process([$pythonPath, $scriptPath]);
            $process->mustRun();

            $output = $process->getOutput();

            return response("--- Hasil Pengecekan Library ---\n\n" . $output, 200)
                  ->header('Content-Type', 'text/plain');

        } catch (\Exception $e) {
            return response("GAGAL MENJALANKAN SCRIPT TES LIBRARY.\n\n---- PESAN ERROR LENGKAP ----\n\n" . $e->getMessage(), 500)
                  ->header('Content-Type', 'text/plain');
        }
    }
}