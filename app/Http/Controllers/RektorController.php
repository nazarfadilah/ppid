<?php

namespace App\Http\Controllers;
use App\Models\Galleries;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use App\Models\PublicInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RektorController extends Controller
{
    public function index(){
        $totalPublicInformationRequest = PublicInformationRequest::count();
        $totalObjection = Objection::count();
        $totalWhistle = Whistle::count();
        $totalRequest = PublicInformationRequest::count() + Objection::count() + Whistle::count();
        return view('rektor.dashboard.index', compact('totalPublicInformationRequest', 'totalObjection', 'totalWhistle', 'totalRequest'));
    }
    public function galleryIndex(){
        $totalGalleries = Galleries::count();
        $galleries = Galleries::all();
        return view('rektor.gallery.index', compact('galleries'));
    }
    public function informasiIndex()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $initialChartData = $this->fetchStatisticalData($startDate, $endDate, 'all', 'monthly');
        return view('rektor.informasi.index', ['initialChartData' => $initialChartData]);
    }

    /**
     * FUNGSI 2: JALUR TELEPON (API)
     * Melayani permintaan data dari JavaScript.
     */
    public function getStatistics(Request $request)
    {
        $startDate = Carbon::parse($request->input('startDate', Carbon::now()->startOfMonth()))->startOfDay();
        $endDate = Carbon::parse($request->input('endDate', Carbon::now()->endOfMonth()))->endOfDay();
        $status = $request->input('status', 'all');
        $period = $request->input('period', 'monthly');
        $data = $this->fetchStatisticalData($startDate, $endDate, $status, $period);
        return response()->json($data);
    }

    /**
     * FUNGSI 3 (private): RESEP RAHASIA
     * Hanya untuk internal, tidak bisa diakses dari luar.
     */
    private function fetchStatisticalData(Carbon $startDate, Carbon $endDate, string $status, string $period): array
    {
        $query = PublicInformationRequest::query()->whereBetween('created_at', [$startDate, $endDate]);
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $filteredQuery = clone $query;
        $summary = ['total' => (clone $filteredQuery)->count(), 'approved' => (clone $filteredQuery)->where('status', 'Approved')->count(), 'rejected' => (clone $filteredQuery)->where('status', 'Rejected')->count(), 'pending' => (clone $filteredQuery)->whereIn('status', ['Checking'])->count()];
        $byStatusData = (clone $filteredQuery)->select('status', DB::raw('count(*) as total'))->groupBy('status')->get()->pluck('total', 'status');
        $byCategoryData = (clone $filteredQuery)->select('request_category', DB::raw('count(*) as total'))->groupBy('request_category')->get();
        $categoryLabels = ['individual' => 'Perorangan', 'organization' => 'Organisasi', 'group' => 'Kelompok'];
        $dateFormat = match($period) { 'daily' => '%Y-%m-%d', 'yearly' => '%Y', default => '%Y-%m' };
        $trendData = (clone $filteredQuery)->select(DB::raw("DATE_FORMAT(created_at, '{$dateFormat}') as date_label"), DB::raw('count(*) as total'))->groupBy('date_label')->orderBy('date_label', 'asc')->get()->pluck('total', 'date_label');
        $responseTimeData = (clone $filteredQuery)->whereNotNull('updated_at')->where('status', '!=', 'Checking')->select('request_category', DB::raw('AVG(TIMESTAMPDIFF(DAY, created_at, updated_at)) as avg_days'))->groupBy('request_category')->get();

        return [
            'summary' => $summary,
            'byStatus' => ['labels' => $byStatusData->keys(), 'values' => $byStatusData->values()],
            'byCategory' => ['labels' => $byCategoryData->map(fn($i) => $categoryLabels[$i->request_category] ?? $i->request_category), 'values' => $byCategoryData->pluck('total')],
            'trend' => ['labels' => $trendData->keys(), 'values' => $trendData->values()],
            'responseTime' => ['labels' => $responseTimeData->map(fn($i) => $categoryLabels[$i->request_category] ?? $i->request_category), 'values' => $responseTimeData->pluck('avg_days')]
        ];
    }
    public function keberatanIndex()
    {
        $initialChartData = $this->fetchKeberatanStats(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth(), 'all');
        $objections = Objection::latest()->paginate(10);
        return view('rektor.keberatan.index', [
            'initialChartData' => $initialChartData,
            'objections' => $objections
        ]);
    }

    /**
     * Menyediakan data dinamis untuk filter (AJAX).
     */
    public function getKeberatanData(Request $request)
    {
        $status = $request->input('status', 'all');
        $startDate = Carbon::parse($request->input('startDate', Carbon::now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('endDate', Carbon::now()->endOfMonth()));
        $perPage = $request->input('perPage', 10);

        $chartData = $this->fetchKeberatanStats($startDate, $endDate, $status);

        $objectionQuery = Objection::query()->whereBetween('created_at', [$startDate, $endDate]);
        if ($status !== 'all') {
            $objectionQuery->where('status', $status);
        }
        $objections = $objectionQuery->latest()->paginate($perPage);

        // === PERUBAHAN UTAMA DI SINI ===
        // Membangun HTML untuk tabel langsung di controller
        $table_html = '';
        if ($objections->isEmpty()) {
            $table_html = '<tr><td colspan="7" class="text-center">Tidak ada data ditemukan.</td></tr>';
        } else {
            foreach ($objections as $key => $obj) {
                $iteration = $objections->firstItem() + $key;
                $statusBadge = '';
                if ($obj->status == 'Approved') {
                    $statusBadge = '<span class="badge bg-success">Approved</span>';
                } elseif ($obj->status == 'Rejected') {
                    $statusBadge = '<span class="badge bg-danger">Rejected</span>';
                } else {
                    $statusBadge = '<span class="badge bg-warning">Checking</span>';
                }

                // Ganti '#' dengan rute detail yang benar jika ada
                $detailUrl = '#';
                $alasanLimit = Str::limit($obj->alasan_pengajuan, 30);
                $tanggal = $obj->created_at->format('d M Y');

                $table_html .= "
                    <tr>
                        <td>{$iteration}</td>
                        <td>{$obj->nama_pemohon}</td>
                        <td>{$obj->email_pemohon}</td>
                        <td>{$alasanLimit}</td>
                        <td>{$statusBadge}</td>
                        <td>{$tanggal}</td>
                        <td><a href='{$detailUrl}' class='btn btn-sm btn-info'>Detail</a></td>
                    </tr>
                ";
            }
        }
        // === BATAS AKHIR PERUBAHAN ===

        return response()->json([
            'chartData' => $chartData,
            'table_html' => $table_html, // Kirim HTML yang sudah jadi
            'pagination_html' => (string) $objections->links('pagination::bootstrap-5'),
        ]);
    }

    /**
     * Fungsi private untuk mengambil data statistik. (Tidak berubah)
     */
    private function fetchKeberatanStats(Carbon $startDate, Carbon $endDate, string $status): array
    {
        $query = Objection::query()->whereBetween('created_at', [$startDate, $endDate]);
        if ($status !== 'all') {
            $query->where('status', 'like', $status);
        }
        $filteredQuery = clone $query;
        $summary = ['total' => (clone $filteredQuery)->count(), 'approved' => (clone $filteredQuery)->where('status', 'Approved')->count(), 'rejected' => (clone $filteredQuery)->where('status', 'Rejected')->count(), 'pending' => (clone $filteredQuery)->where('status', 'Checking')->count()];
        $byStatusData = (clone $filteredQuery)->select('status', DB::raw('count(*) as total'))->groupBy('status')->get()->pluck('total', 'status');

        return [
            'summary' => $summary,
            'byStatus' => ['labels' => $byStatusData->keys(), 'values' => $byStatusData->values()],
        ];
    }

    public function whistleIndex()
    {
        $initialChartData = $this->fetchWhistleStats(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth(), 'all');
        $whistles = Whistle::latest()->paginate(10);
        return view('rektor.whistle.index', [
            'initialChartData' => $initialChartData,
            'whistles' => $whistles
        ]);
    }

    /**
     * FUNGSI 2: Menyediakan data untuk Chart, Filter, dan Paginasi (AJAX).
     */
    public function getWhistleData(Request $request)
    {
        $status = $request->input('status', 'all');
        $startDate = Carbon::parse($request->input('startDate', Carbon::now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('endDate', Carbon::now()->endOfMonth()));
        $perPage = $request->input('perPage', 10);

        $chartData = $this->fetchWhistleStats($startDate, $endDate, $status);

        $whistleQuery = Whistle::query()->whereBetween('created_at', [$startDate, $endDate]);
        if ($status !== 'all') {
            $whistleQuery->where('status', $status);
        }
        $whistles = $whistleQuery->latest()->paginate($perPage);

        // === PERUBAHAN UTAMA: Membangun HTML Langsung di Controller ===
        $table_html = '';
        if ($whistles->isEmpty()) {
            $table_html = '<tr><td colspan="8" class="text-center">Tidak ada data ditemukan.</td></tr>';
        } else {
            foreach ($whistles as $key => $whistle) {
                $iteration = $whistles->firstItem() + $key;
                $statusBadge = '';
                if ($whistle->status == 'confirmed') $statusBadge = '<span class="badge bg-info">Confirmed</span>';
                elseif ($whistle->status == 'rejected') $statusBadge = '<span class="badge bg-danger">Rejected</span>';
                elseif ($whistle->status == 'finished') $statusBadge = '<span class="badge bg-success">Finished</span>';
                else $statusBadge = '<span class="badge bg-warning">Pending</span>';

                // Ganti '#' dengan rute detail yang benar
                $detailUrl = '#';
                $tindakanLimit = Str::limit($whistle->tindakan, 25);

                $table_html .= "
                    <tr>
                        <td>{$iteration}</td>
                        <td>{$whistle->nama}</td>
                        <td>{$whistle->email}</td>
                        <td>{$tindakanLimit}</td>
                        <td>{$whistle->nama_terlapor}</td>
                        <td>{$statusBadge}</td>
                        <td><a href='{$detailUrl}' class='btn btn-sm btn-info'>Detail</a></td>
                    </tr>
                ";
            }
        }
        // === BATAS AKHIR PERUBAHAN ===

        return response()->json([
            'chartData' => $chartData,
            'table_html' => $table_html,
            'pagination_html' => (string) $whistles->links('pagination::bootstrap-5'),
        ]);
    }

    /**
     * FUNGSI 3 (private): Mengambil dan mengolah data statistik Whistle.
     */
    private function fetchWhistleStats(Carbon $startDate, Carbon $endDate, string $status): array
    {
        $query = Whistle::query()->whereBetween('created_at', [$startDate, $endDate]);
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $filteredQuery = clone $query;
        $summary = [
            'total' => (clone $filteredQuery)->count(),
            'confirmed' => (clone $filteredQuery)->where('status', 'confirmed')->count(),
            'rejected' => (clone $filteredQuery)->where('status', 'rejected')->count(),
            'finished' => (clone $filteredQuery)->where('status', 'finished')->count(),
            'pending' => (clone $filteredQuery)->where('status', 'pending')->count(),
        ];
        $byStatusData = (clone $filteredQuery)->select('status', DB::raw('count(*) as total'))->groupBy('status')->get()->pluck('total', 'status');

        return ['summary' => $summary, 'byStatus' => ['labels' => $byStatusData->keys(), 'values' => $byStatusData->values()]];
    }
}
