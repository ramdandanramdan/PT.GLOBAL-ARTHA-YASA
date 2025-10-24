<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Facades\Auth; 
// use App\Models\SpgActivity; // Uncomment baris ini jika Anda memiliki model SpgActivity

class SpgController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk SPG.
     */
    public function index(): View
    {
        // PERBAIKAN: Mendefinisikan variabel $routeStock untuk menghilangkan error "Undefined variable $routeStock"
        $routeStock = 'spg.stock'; 
        
        $metrics = [
            'current_stock' => ['title' => 'STOK DISPLAY', 'value' => '180 Pcs'],
            // ... metrik lain yang mungkin ditampilkan di dashboard
        ];
        
        return view('spg.dashboard', compact('routeStock', 'metrics'));
    }

    /**
     * Menampilkan form untuk membuat laporan aktivitas.
     */
    public function createActivity(): View
    {
        // View yang dipanggil sudah benar: resources/views/spg/activity/create.blade.php
        return view('spg.activity.create');
    }

    /**
     * Menyimpan data laporan aktivitas.
     */
    public function storeActivity(Request $request): RedirectResponse
    {
        // 1. VALIDASI DATA
        $validated = $request->validate([
            'activity_type' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        // 2. LOGIKA PENYIMPANAN DATA
        try {
            // Logika penyimpanan data
            
            // 3. REDIRECT SUKSES
            return redirect()->route('spg.dashboard')->with('success', 'Laporan aktivitas berhasil disimpan dan dicatat.');

        } catch (\Exception $e) {
            // 4. ERROR HANDLING
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan laporan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan riwayat aktivitas SPG.
     * PERBAIKAN: Mengganti spg.history menjadi spg.activity.history
     */
    public function history(): View
    {
        // Mengubah path view agar sesuai dengan struktur file Anda:
        // resources/views/spg/activity/history.blade.php
        return view('spg.activity.history'); 
    }
}