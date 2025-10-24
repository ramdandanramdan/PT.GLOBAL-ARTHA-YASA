<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// *** BARIS KRITIS YANG HILANG/SALAH: Gunakan namespace Illuminate\Routing\Controller; ***
use Illuminate\Routing\Controller; 

class InboxController extends Controller
{
    public function index()
    {
        // View dummy untuk saat ini
        return view('spg.inbox.index', [
            'header' => 'Inbox Pesan',
        ]);
    }
}