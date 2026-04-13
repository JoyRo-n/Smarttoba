<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tampilkan halaman admin
    public function index()
    {
        $rooms = Room::all();
        return view('admin', compact('rooms'));
    }

    // Simpan room baru
    public function store(Request $request)
    {
        Room::create($request->only('name', 'location', 'price'));
        return back()->with('success', 'Room ditambahkan!');
    }

    // Update room
    public function update(Request $request, Room $room)
    {
        $room->update($request->only('name', 'location', 'price'));
        return back()->with('success', 'Room diperbarui!');
    }

    // Hapus room
    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Room dihapus!');
    }
}