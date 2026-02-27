<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->where(function ($query) use ($q) {
                $query->where('nik', 'LIKE', "%{$q}%")
                    ->orWhere('nama_karyawan', 'LIKE', "%{$q}%");
            })
            ->whereIn('area_kerja', ['VDNI', 'VDNIP'])
            ->select(
                'nik',
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
}
