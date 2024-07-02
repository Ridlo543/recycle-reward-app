<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Notifications\NewComplaintNotification;
// use Illuminate\Support\Facades\Notification;
use App\Models\Admin;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Menyimpan ke database
        $complaint = Complaint::create([
            'name' => $request->input('nama'),
            'description' => $request->input('description'),
        ]);

        // Mengirim notifikasi ke admin
        // $admins = Admin::all();
        // Notification::send($admins, new NewComplaintNotification($complaint));
        
        $admins = Admin::all();
        foreach ($admins as $admin) {
            Notification::make()
                ->title('Pengaduan baru')
                ->body('Pengaduan baru telah diajukan dari User ' . $complaint->name)
                ->sendToDatabase($admin);
            event(new DatabaseNotificationsSent($admin));
        }

        return redirect()->route('pengaduan.create')->with('success', 'Pengaduan berhasil dikirim!');
    }
}
