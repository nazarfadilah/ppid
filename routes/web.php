<?php
use App\Models\PublicInformation;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use App\Models\Galleries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicInformationRequestController;
use App\Http\Controllers\PublicInformationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ObjectionController;
use App\Http\Controllers\WhistleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\coba;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RektorController;
use App\Http\Middleware\AuthLogin;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PublicController;



// Route untuk halaman sebagai masyarakat umum
Route::get('/', function () {
    $totalPublicInformationRequest = PublicInformationRequest::count();
    $totalObjection = Objection::count();
    $totalWhistle = Whistle::count();
    $totalRequest = PublicInformationRequest::count() + Objection::count() + Whistle::count();
    return view('public.index', compact('totalPublicInformationRequest', 'totalObjection', 'totalWhistle', 'totalRequest'));
})->name('public.index');

Route::get('/information-form', fn() => view('public.information-form'))->name('request.form');

Route::get('/objection-form', function () {
    return view('public.objectionform');
})->name('objection.form');

Route::get('/whistle-form', function () {
    return view('public.form_whistle_bowling');
})->name('whistle-bowling');

// Profil
Route::get('/profile-ppid', function () {
    return view('public.profil.profilePpid');
})->name('profile-ppid');

Route::get('/visi-misi', function () {
    return view('public.profil.visiMisi');
})->name('profile-visimisi-ppid');

Route::get('/struktur-organisasi', function () {
    return view('public.profil.strukturOrganisasi');
})->name('profile-struktur-ppid');

Route::get('/tugas-dan-fungsi', function () {
    return view('public.profil.tugasDanFungsi');
})->name('tugas-dan-fungsi');

Route::get('/maklumat-pelayanan', function () {
    return view('public.profil.maklumatPelayananInformasiPublik');
})->name('maklumat-pelayanan');

Route::get('/kontak-kami', function () {
    return view('public.profil.kontak-kami');
})->name('kontak');

Route::get('/informasi-public-berkala', function () {
    return view('public.informasiPublic.berkala');
})->name('info-berkala');

Route::get('/informasi-public-dikecualikan', function () {
    return view('public.informasiPublic.dikecualikan');
})->name('info-dikecualikan');

Route::get('/informasi-public-setiap-saat', function () {
    return view('public.informasiPublic.setiapSaat');
})->name('info-setiap-saat');

Route::get('/informasi-public-serta-merta', function () {
    return view('public.informasiPublic.sertaMerta');
})->name('info-serta-merta');

Route::get('/informasi-public-ringkasan-laporan', function() {
    return view ('public.informasiPublic.ringkasan_laporan');
})->name('ringkasan-laporan');

Route::get('/informasi-public-statistik-pmb', fn() => view('public.informasiPublic.statistik-pmb'))->name('statistik-pmb');

Route::get('/tata-cara-permohonan-informasi', function () {
    return view('public.standarPelayanan.informasi');
})->name('standar-informasi');

Route::get('/tata-cara-keberatan-informasi', function () {
    return view('public.standarPelayanan.keberatan');
})->name('standar-keberatan');

Route::get('/tata-cara-penyelesaian-sengketa', function () {
    return view('public.standarPelayanan.sengketa');
})->name('standar-sengketa');

Route::get('/tata-cara-pengaduan', function () {
    return view('public.standarPelayanan.tataCaraPengaduan');
})->name('tata-cara-pengaduan');

Route::get('/jadwal-pelayanan', function () {
    return view('public.standarPelayanan.jadwalPelayanan');
})->name('jadwal-pelayanan');

Route::get('/whistle-bowler', function () {
    return view('public.standarPelayanan.whistleBowler');
})->name('whistle-bowler');

Route::get('/hak-hak-masyarakat', function () {
    return view('public.standarPelayanan.hakHakMasyarakat');
})->name('hak-hak-masyarakat');

// Route Crud Public
Route::post('/public-information-requests-create', [PublicInformationRequestController::class, 'store'])->name('public-information-requests-create');
Route::post('/objections-create', [ObjectionController::class, 'store'])->name('objections-create');
Route::post('/whistles-create', [WhistleController::class, 'store'])->name('whistles-create');

// Route Khusus login dan logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/proses', [AuthController::class, 'login'])->name('api-login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/proses', [AuthController::class, 'register'])->name('api-register');
Route::post('/logout', [AuthController::class, 'logout'])->name('api-logout');

// Route Petugas Gallery
// Route::middleware([AuthLogin::class])->group(function () {
    Route::post('/petugas/gallery/store', [GalleriesController::class, 'store'])->name('gallery.store');
    Route::put('/petugas/gallery/{id}', [GalleriesController::class, 'update'])->name('gallery.update');
    Route::apiResource('galleries', GalleriesController::class)->names([
        'destroy' => 'galleries.destroy',
    ]);
// });


// Khusus pengiriman email percobaan
Route::get('/coba-email', [coba::class, 'index'])->name('coba.email');



Route::apiResource('objections', ObjectionController::class)->names([
    'destroy' => 'objections.destroy',
]);
Route::apiResource('public-information', PublicInformationController::class)->names([
    'destroy' => 'public-information.destroy',
]);
Route::apiResource('whistles', WhistleController::class)->names([
    'destroy' => 'whistles.destroy',
]);
Route::apiResource('reports', ReportController::class)->names([
    'destroy' => 'reports.destroy',
]);
Route::apiResource('public-information-requests', PublicInformationRequestController::class)->names([
    'destroy' => 'public-information-requests.destroy',
]);


// Khusus Pengiriman Email

Route::put('/petugas/objection/email/konfirmasi/{id}', [EmailController::class, 'ObjectionConfirmed'])->name('objection.email.konfirmasi');
Route::put('/petugas/objection/email/tolak/{id}', [EmailController::class, 'ObjectionRejected'])->name('objection.email.tolak');

Route::put('/petugas/whistle/confirm/{id}', [EmailController::class, 'whistleConfirmed'])->name('whistle.confirm');
Route::put('/petugas/whistle/selesai/{id}', [EmailController::class, 'whistleFinished'])->name('whistle.finish');
Route::put('/petugas/whistle/reject/{id}', [EmailController::class, 'whistleRejected'])->name('whistle.reject');

Route::put('/petugas/requests/email/{id}', [EmailController::class, 'approveRequest'])->name('requests.updateStatus');
Route::put('/petugas/requests/email/rejected/{id}', [EmailController::class, 'rejectRequest'])->name('requests.rejectStatus');



// Khusus Akses Halaman Admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
Route::get('/admin/galeri', [AdminController::class, 'galleries'])->name('admin-gallery');
Route::get('/admin/public-information', [AdminController::class, 'publicInformation'])->name('admin-request');
Route::get('/admin/public-information/{id}', [AdminController::class, 'publicInformationDetail'])->name('admin-request-detail');
Route::get('/admin/objection', [AdminController::class, 'objection'])->name('admin-objection');
Route::get('/admin/objection/{id}', [AdminController::class, 'objectionDetail'])->name('admin-objection-detail');
Route::get('/admin/whistle', [AdminController::class, 'whistleBowling'])->name('admin-whistle');
Route::get('admin/whistle/{id}', [AdminController::class, 'whistleDetail'])->name('admin-whistle-detail');
Route::get('/admin/user-management', [AdminController::class, 'userManagement'])->name('admin.user.index');
Route::delete('/admin/user-management/{id}', [AdminController::class, 'userHapus'])->name('admin.user.hapus');

// Kusus Akses Halaman Petugas
Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas-dashboard');
Route::get('/petugas/galeri', [PetugasController::class, 'galleries'])->name('petugas-galeri');
Route::get('/petugas/galeri/create', [PetugasController::class, 'galleriesCreate'])->name('petugas-galeri-create');
Route::post('/petugas/galeri/store', [GalleriesController::class, 'store'])->name('galleries-create');
Route::put('/petugas/galeri/{id}', [GalleriesController::class, 'update'])->name('galleries-update');
Route::get('/petugas/galeri/edit/{id}', [PetugasController::class, 'galleriesEdit'])->name('petugas-galeri-edit');
Route::get('/petugas/informasi', [PetugasController::class, 'publicInformation'])->name('petugas-informasi');
Route::get('/petugas/informasi/{id}', [PetugasController::class, 'publicInformationDetail'])->name('petugas-informasi-detail');
// Route::get('/petugas/informasi/edit/{id}', [PetugasController::class, 'publicInformationEdit'])->name('petugas-informasi-edit');
Route::get('/petugas/keberatan', [PetugasController::class, 'objection'])->name('petugas-keberatan');
Route::get('/petugas/keberatan/{id}', [PetugasController::class, 'objectionDetail'])->name('petugas-keberatan-detail');
// Route::get('/petugas/keberatan/edit/{id}', [PetugasController::class, 'objectionEdit'])->name('petugas-keberatan-edit');
Route::get('/petugas/whistle-bowling', [PetugasController::class, 'whistleBowling'])->name('petugas-whistle-bowling');
Route::get('/petugas/whistle-bowling/{id}', [PetugasController::class, 'whistleBowlingDetail'])->name('petugas-whistle-bowling-detail');
// Route::get('/petugas/whistle-bowling/edit/{id}', [PetugasController::class, 'whistleBowlingEdit'])->name('petugas-whistle-bowling-edit');


// Khusus Akses Halaman Rektor
Route::get('/rektor/dashboard', [RektorController::class, 'index'])->name('rektor-dashboard');
Route::get('/rektor/gallery', [RektorController::class, 'galleryIndex'])->name('rektor-gallery');
Route::get('/rektor/informasi', [RektorController::class, 'informasiIndex'])->name('rektor-informasi');
Route::get('/rektor/informasi/statistics', [RektorController::class, 'getStatistics'])->name('rektor-informasi-statistics');
Route::get('/rektor/keberatan', [RektorController::class, 'keberatanIndex'])->name('rektor-keberatan');
Route::get('/rektor/keberatan/data', [RektorController::class, 'getKeberatanData'])->name('rektor.keberatan.data');
Route::get('/rektor/whistle', [RektorController::class, 'whistleIndex'])->name('rektor-whistle');
Route::get('/rektor/whistle/data', [RektorController::class, 'getWhistleData'])->name('rektor.whistle.data');


Route::get('/petugas/whistle/image/{id}', [WhistleController::class, 'showImage'])->name('whistle.image');
Route::get('/petugas/objection/ktp/{id}', [ObjectionController::class, 'showKTP'])->name('objection.ktp');
Route::get('/petugas/information/ktp/{id}', [PublicInformationRequestController::class, 'showKTP'])->name('petugas-informasi.ktp');

Route::get('/admin/informasi/ktp/{id}', [PublicInformationRequestController::class, 'showKTP'])->name('admin-informasi.ktp');
Route::get('/admin/objection/ktp/{id}', [ObjectionController::class, 'showKTP'])->name('admin-objection.ktp');
Route::get('/admin/whistle/image/{id}', [WhistleController::class, 'showImage'])->name('admin-whistle.image');
Route::get('/admin/galeri/{id}', [GalleriesController::class, 'showBlob'])->name('galleries.show-blob');
Route::get('/rektor/galeri/{id}', [GalleriesController::class, 'showBlob'])->name('galleries-public');
Route::get('/petugas/galeri/{id}', [GalleriesController::class, 'showBlob'])->name('galeri.petugas');

Route::get('/public/informasi/ktp/{id}', [PublicInformationRequestController::class, 'showKTP'])->name('public-informasi.ktp');
Route::get('/public/objection/ktp/{id}', [ObjectionController::class, 'showKTP'])->name('public-objection.ktp');
Route::get('/public/whistle/image/{id}', [WhistleController::class, 'showImage'])->name('public-whistle.image');



// Khusus Export
Route::post('/admin/request/export', [ExportController::class, 'export'])->name('admin-request-export');
Route::post('/admin/objection/export', [ExportController::class, 'exportObjection'])->name('admin-objection-export');
Route::post('/admin/whistle/export', [ExportController::class, 'exportWhistle'])->name('admin-whistle-export');

// Route untuk PublicController
Route::get('/public/dashboard', [PublicController::class, 'dashboard'])->name('public-dashboard');
Route::get('/public/information-requests', [PublicController::class, 'showPublicInformationRequests'])->name('public.information-requests');
Route::get('/public/objections', [PublicController::class, 'showObjections'])->name('public.objections');
Route::get('/public/whistles', [PublicController::class, 'showWhistles'])->name('public.whistles');
Route::get('/public/information-requests/create', [PublicController::class, 'fromStoreRequest'])->name('public.information-requests.create');
Route::get('/public/objections/create', [PublicController::class, 'fromStoreObjection'])->name('public.objections.create');
Route::get('/public/whistles/create', [PublicController::class, 'fromStoreWhistle'])->name('public.whistles.create');
Route::get('/public/information-requests/{request}', [PublicController::class, 'showPublicInformationRequest'])->name('public-information.detail');
Route::get('/public/objections/{objection}', [PublicController::class, 'showObjection'])->name('objection.show');
Route::get('/public/whistles/{whistle}', [PublicController::class, 'showWhistle'])->name('whistle-detail');