<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $q = trim($request->get('q'));

        if (!$q) {
            return view('home', [
                'resign' => Employee::whereRaw('1=0')->paginate(12),
            ]);
        }

        // 🔥 SIMPAN RIWAYAT PENCARIAN
        $alreadyLogged = SearchLog::where('user_id', Auth::id())
            ->where('keyword', $q)
            ->where('created_at', '>=', now()->subMinute())
            ->exists();

        if (!$alreadyLogged) {
            SearchLog::create([
                'user_id'    => Auth::id(),
                'keyword'    => $q,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        $resign = Employee::with(
            'departemen',
            'divisi',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan'
        )
            ->where('status_resign', '!=', 'AKTIF')

            // EXCLUDE no_ktp yang punya record AKTIF
            ->whereNotIn('no_ktp', function ($query) {
                $query->select('no_ktp')
                    ->from('employees')
                    ->where('status_resign', 'AKTIF')
                    ->groupBy('no_ktp');
            })

            ->where(function ($query) use ($q) {
                $query->where('nik', 'LIKE', "%{$q}%")
                    ->orWhere('nama_karyawan', 'LIKE', "%{$q}%")
                    ->orWhere('no_ktp', 'LIKE', "%{$q}%");
            })

            ->whereIn('area_kerja', ['VDNI', 'VDNIP'])

            ->select(
                'nik',
                'no_ktp',
                'status_resign',
                'nama_karyawan',
                'departemen_id',
                'divisi_id',
                'posisi',
                'provinsi_id',
                'kabupaten_id',
                'kecamatan_id',
                'kelurahan_id',
                'area_kerja'
            )
            ->orderBy('nik', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('home', [
            'resign' => $resign,
        ]);
    }

    public function edit()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.'
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
