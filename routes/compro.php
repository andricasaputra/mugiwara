<?php  


use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BerandaOverviewController;
use App\Http\Controllers\DocumentUnduhController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\KeteranganFiturController;
use App\Http\Controllers\KeteranganSliderController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MitraGabungController;
use App\Http\Controllers\MitraRegistranController;
use App\Http\Controllers\MitraSectionController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenukaranMarchendiseController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProsesPendaftaranController;
use App\Http\Controllers\SliderFiturController;
use App\Http\Controllers\SliderMitraController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\SyaratDokumenController;
use App\Http\Controllers\TambahBerandaController;
use App\Http\Controllers\TambahBerandaInformasiController;
use App\Http\Controllers\TambahFiturController;
use App\Http\Controllers\TambahMenuController;
use App\Http\Controllers\TambahSliderController;
use App\Http\Controllers\TambahSliderMitraController;
use App\Http\Controllers\TambahSliderTentangController;
use App\Http\Controllers\TeamHeaderController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TombolController;
use App\Http\Controllers\VisiMisiController;
use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function() {

    Route::prefix('general-settings')->name('general-settings.')->group(function(){
        Route::get('', [GeneralSettingsController::class, 'index'])->name('general-settings');
        Route::post('store', [GeneralSettingsController::class, 'store'])->name('store.general-settings');
    });

    Route::prefix('menu')->name('menu.')->group(function() {
        Route::get('', [TambahMenuController::class, 'index'])->name('menu');
        Route::get('create', [TambahMenuController::class, 'create'])->name('create.menu');
        Route::get('edit/{id}', [TambahMenuController::class, 'edit'])->name('edit.menu');
        Route::post('store', [TambahMenuController::class, 'store'])->name('store.menu');
        Route::post('update/{id}', [TambahMenuController::class, 'update'])->name('update.menu');
        Route::get  ('delete/{id}', [TambahMenuController::class, 'destroy'])->name('delete.menu');

    });

    Route::prefix('beranda')->name('beranda.')->group(function() {
        Route::get('', [TambahBerandaController::class, 'index'])->name('beranda');
        Route::get('create', [TambahBerandaController::class, 'create'])->name('create.beranda');
        Route::post('store', [TambahBerandaController::class, 'store'])->name('store.beranda');
        Route::post('delete', [TambahBerandaController::class, 'destroy'])->name('delete.beranda');
        Route::get('edit/{id}', [TambahBerandaController::class, 'edit'])->name('edit.beranda');
        Route::post('update', [TambahBerandaController::class, 'update'])->name('update.beranda');
    });
    
    Route::prefix('beranda-tentang')->name('beranda-tentang.')->group(function() {
        Route::get('', [TentangController::class, 'index'])->name('beranda-tentang');
        Route::get('create', [TentangController::class, 'create'])->name('create.beranda-tentang');
        Route::post('store', [TentangController::class, 'store'])->name('store.beranda-tentang');
        Route::post('delete', [TentangController::class, 'destroy'])->name('delete.beranda-tentang');
        Route::get('edit/{id}', [TentangController::class, 'edit'])->name('edit.beranda-tentang');
        Route::post('update', [TentangController::class, 'update'])->name('update.beranda-tentang');
    });

    Route::prefix('beranda-overview')->name('beranda-overview.')->group(function() {
        Route::get('', [BerandaOverviewController::class, 'index'])->name('beranda-overview');
        Route::get('create', [BerandaOverviewController::class, 'create'])->name('create.beranda-overview');
        Route::post('store', [BerandaOverviewController::class, 'store'])->name('store.beranda-overview');
        Route::post('delete', [BerandaOverviewController::class, 'destroy'])->name('delete.beranda-overview');
        Route::get('edit/{id}', [BerandaOverviewController::class, 'edit'])->name('edit.beranda-overview');
        Route::post('update', [BerandaOverviewController::class, 'update'])->name('update.beranda-overview');
    });

    Route::prefix('mitra-section')->name('mitra-section.')->group(function() {
        Route::get('', [MitraSectionController::class, 'index'])->name('mitra-section');
        Route::get('create', [MitraSectionController::class, 'create'])->name('create.mitra-section');
        Route::post('store', [MitraSectionController::class, 'store'])->name('store.mitra-section');
        Route::post('delete', [MitraSectionController::class, 'destroy'])->name('delete.mitra-section');
        Route::get('edit/{id}', [MitraSectionController::class, 'edit'])->name('edit.mitra-section');
        Route::post('update', [MitraSectionController::class, 'update'])->name('update.mitra-section');
    });

    Route::prefix('beranda-informasi')->name('beranda-informasi.')->group(function() {
        Route::get('', [TambahBerandaInformasiController::class, 'index'])->name('beranda-informasi');
        Route::get('create', [TambahBerandaInformasiController::class, 'create'])->name('create.beranda-informasi');
        Route::post('store', [TambahBerandaInformasiController::class, 'store'])->name('store.beranda-informasi');
        Route::post('delete', [TambahBerandaInformasiController::class, 'destroy'])->name('delete.beranda-informasi');
        Route::get('edit/{id}', [TambahBerandaInformasiController::class, 'edit'])->name('edit.beranda-informasi');
        Route::post('update', [TambahBerandaInformasiController::class, 'update'])->name('update.beranda-informasi');
    });

    Route::prefix('slider-tentang')->name('slider-tentang.')->group(function() {
        Route::get('', [TambahSliderTentangController::class, 'index'])->name('slider-tentang');
        Route::get('create', [TambahSliderTentangController::class, 'create'])->name('create.slider-tentang');
        Route::post('store', [TambahSliderTentangController::class, 'store'])->name('store.slider-tentang');
        Route::post('delete', [TambahSliderTentangController::class, 'destroy'])->name('delete.slider-tentang');
        Route::get('edit/{id}', [TambahSliderTentangController::class, 'edit'])->name('edit.slider-tentang');
        Route::post('update', [TambahSliderTentangController::class, 'update'])->name('update.slider-tentang');
    });

    Route::prefix('slider-mitra')->name('slider-mitra.')->group(function() {
        Route::get('', [TambahSliderMitraController::class, 'index'])->name('slider-mitra');
        Route::get('create', [TambahSliderMitraController::class, 'create'])->name('create.slider-mitra');
        Route::post('store', [TambahSliderMitraController::class, 'store'])->name('store.slider-mitra');
        Route::post('delete', [TambahSliderMitraController::class, 'destroy'])->name('delete.slider-mitra');
    });

    Route::prefix('mitra-registran')->name('mitra-registran.')->group(function() {
        Route::get('', [MitraRegistranController::class, 'index'])->name('mitra-registran');
        Route::get('compose/{id}', [MitraRegistranController::class, 'compose'])->name('compose.mitra-registran');
        Route::post('compose', [MitraRegistranController::class, 'submitCompose'])->name('submit.compose.mitra-registran');
        Route::post('delete', [MitraRegistranController::class, 'destroy'])->name('delete.mitra-registran');
    });

    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function() {
        Route::get('', [PendaftaranController::class, 'index'])->name('pendaftaran');
        Route::get('create', [PendaftaranController::class, 'create'])->name('create.pendaftaran');
        Route::post('store', [PendaftaranController::class, 'store'])->name('store.pendaftaran');
        Route::post('delete', [PendaftaranController::class, 'destroy'])->name('delete.pendaftaran');
        Route::get('edit/{id}', [PendaftaranController::class, 'edit'])->name('edit.pendaftaran');
        Route::post('update', [PendaftaranController::class, 'update'])->name('update.pendaftaran');
    });

    Route::prefix('syarat-dokumen')->name('syarat-dokumen.')->group(function() {
        Route::get('', [SyaratDokumenController::class, 'index'])->name('syarat-dokumen');
        Route::get('create', [SyaratDokumenController::class, 'create'])->name('create.syarat-dokumen');
        Route::post('store', [SyaratDokumenController::class, 'store'])->name('store.syarat-dokumen');
        Route::post('delete', [SyaratDokumenController::class, 'destroy'])->name('delete.syarat-dokumen');
        Route::get('edit/{id}', [SyaratDokumenController::class, 'edit'])->name('edit.syarat-dokumen');
        Route::post('update', [SyaratDokumenController::class, 'update'])->name('update.syarat-dokumen');
    });

    Route::prefix('slider')->name('slider.')->group(function() {
        Route::get('', [TambahSliderController::class, 'index'])->name('slider');
        Route::get('create', [TambahSliderController::class, 'create'])->name('create.slider');
        Route::get('edit/{id}', [TambahSliderController::class, 'edit'])->name('edit.slider');
        Route::post('store', [TambahSliderController::class, 'store'])->name('store.slider');
        Route::post('update/{id}', [TambahSliderController::class, 'update'])->name('update.slider');
        Route::get  ('delete/{id}', [TambahSliderController::class, 'destroy'])->name('delete.slider');
    });

    Route::prefix('aboutPertama')->name('aboutPertama.')->group(function() {
        Route::get('', [AboutPertamaController::class, 'index'])->name('aboutPertama');
        Route::get('create', [AboutPertamaController::class, 'create'])->name('create.aboutPertama');
        Route::get('edit/{id}', [AboutPertamaController::class, 'edit'])->name('edit.aboutPertama');
        Route::post('store', [AboutPertamaController::class, 'store'])->name('store.aboutPertama');
        Route::post('update/{id}', [AboutPertamaController::class, 'update'])->name('update.aboutPertama');
        Route::get  ('delete/{id}', [AboutPertamaController::class, 'destroy'])->name('delete.aboutPertama');

    });

    Route::prefix('aboutKedua')->name('aboutKedua.')->group(function() {
        Route::get('', [AboutKeduaController::class, 'index'])->name('aboutKedua');
        Route::get('create', [AboutKeduaController::class, 'create'])->name('create.aboutKedua');
        Route::get('edit/{id}', [AboutKeduaController::class, 'edit'])->name('edit.aboutKedua');
        Route::post('store', [AboutKeduaController::class, 'store'])->name('store.aboutKedua');
        Route::post('update/{id}', [AboutKeduaController::class, 'update'])->name('update.aboutKedua');
        Route::get  ('delete/{id}', [AboutKeduaController::class, 'destroy'])->name('delete.aboutKedua');

    });

    Route::prefix('keteranganFitur')->name('keteranganFitur.')->group(function() {
        Route::get('', [KeteranganFiturController::class, 'index'])->name('keteranganFitur');
        Route::get('create', [KeteranganFiturController::class, 'create'])->name('create.keteranganFitur');
        Route::get('edit/{id}', [KeteranganFiturController::class, 'edit'])->name('edit.keteranganFitur');
        Route::post('store', [KeteranganFiturController::class, 'store'])->name('store.keteranganFitur');
        Route::post('update/{id}', [KeteranganFiturController::class, 'update'])->name('update.keteranganFitur');
        Route::get  ('delete/{id}', [KeteranganFiturController::class, 'destroy'])->name('delete.keteranganFitur');

    });

    Route::prefix('sliderFitur')->name('sliderFitur.')->group(function() {
        Route::get('', [SliderFiturController::class, 'index'])->name('sliderFitur');
        Route::get('create', [SliderFiturController::class, 'create'])->name('create.sliderFitur');
        Route::get('edit/{id}', [SliderFiturController::class, 'edit'])->name('edit.sliderFitur');
        Route::post('store', [SliderFiturController::class, 'store'])->name('store.sliderFitur');
        Route::post('update/{id}', [SliderFiturController::class, 'update'])->name('update.sliderFitur');
        Route::get  ('delete/{id}', [SliderFiturController::class, 'destroy'])->name('delete.sliderFitur');

    });

    Route::prefix('sosmed')->name('sosmed.')->group(function() {
        Route::get('', [SosmedController::class, 'index'])->name('sosmed');
        Route::get('create', [SosmedController::class, 'create'])->name('create.sosmed');
        Route::get('edit/{id}', [SosmedController::class, 'edit'])->name('edit.sosmed');
        Route::post('store', [SosmedController::class, 'store'])->name('store.sosmed');
        Route::post('update/{id}', [SosmedController::class, 'update'])->name('update.sosmed');
        Route::get  ('delete/{id}', [SosmedController::class, 'destroy'])->name('delete.sosmed');

    });

    Route::prefix('alamat')->name('alamat.')->group(function() {
        Route::get('', [AlamatController::class, 'index'])->name('alamat');
        Route::get('create', [AlamatController::class, 'create'])->name('create.alamat');
        Route::get('edit/{id}', [AlamatController::class, 'edit'])->name('edit.alamat');
        Route::post('store', [AlamatController::class, 'store'])->name('store.alamat');
        Route::post('update/{id}', [AlamatController::class, 'update'])->name('update.alamat');
        Route::get  ('delete/{id}', [AlamatController::class, 'destroy'])->name('delete.alamat');

    });

    Route::prefix('kontak')->name('kontak.')->group(function() {
        Route::get('', [KontakController::class, 'index'])->name('kontak');
        Route::get('create', [KontakController::class, 'create'])->name('create.kontak');
        Route::get('edit/{id}', [KontakController::class, 'edit'])->name('edit.kontak');
        Route::post('store', [KontakController::class, 'store'])->name('store.kontak');
        Route::post('update/{id}', [KontakController::class, 'update'])->name('update.kontak');
        Route::get  ('delete/{id}', [KontakController::class, 'destroy'])->name('delete.kontak');

    });

    Route::prefix('sliderMitra')->name('sliderMitra.')->group(function() {
        Route::get('', [SliderMitraController::class, 'index'])->name('sliderMitra');
        Route::get('create', [SliderMitraController::class, 'create'])->name('create.sliderMitra');
        Route::get('edit/{id}', [SliderMitraController::class, 'edit'])->name('edit.sliderMitra');
        Route::post('store', [SliderMitraController::class, 'store'])->name('store.sliderMitra');
        Route::post('update/{id}', [SliderMitraController::class, 'update'])->name('update.sliderMitra');
        Route::get  ('delete/{id}', [SliderMitraController::class, 'destroy'])->name('delete.sliderMitra');

    });

    Route::prefix('prosesPendaftaran')->name('prosesPendaftaran.')->group(function() {
        Route::get('', [ProsesPendaftaranController::class, 'index'])->name('prosesPendaftaran');
        Route::get('create', [ProsesPendaftaranController::class, 'create'])->name('create.prosesPendaftaran');
        Route::get('edit/{id}', [ProsesPendaftaranController::class, 'edit'])->name('edit.prosesPendaftaran');
        Route::post('store', [ProsesPendaftaranController::class, 'store'])->name('store.prosesPendaftaran');
        Route::post('update/{id}', [ProsesPendaftaranController::class, 'update'])->name('update.prosesPendaftaran');
        Route::get  ('delete/{id}', [ProsesPendaftaranController::class, 'destroy'])->name('delete.prosesPendaftaran');

    });

    Route::prefix('syarat')->name('syarat.')->group(function() {
        Route::get('', [SyaratController::class, 'index'])->name('syarat');
        Route::get('create', [SyaratController::class, 'create'])->name('create.syarat');
        Route::get('edit/{id}', [SyaratController::class, 'edit'])->name('edit.syarat');
        Route::post('store', [SyaratController::class, 'store'])->name('store.syarat');
        Route::post('update/{id}', [SyaratController::class, 'update'])->name('update.syarat');
        Route::get  ('delete/{id}', [SyaratController::class, 'destroy'])->name('delete.syarat');

    });

    Route::prefix('documentUnduh')->name('documentUnduh.')->group(function() {
        Route::get('', [DocumentUnduhController::class, 'index'])->name('documentUnduh');
        Route::get('create', [DocumentUnduhController::class, 'create'])->name('create.documentUnduh');
        Route::get('edit/{id}', [DocumentUnduhController::class, 'edit'])->name('edit.documentUnduh');
        Route::post('store', [DocumentUnduhController::class, 'store'])->name('store.documentUnduh');
        Route::post('update/{id}', [DocumentUnduhController::class, 'update'])->name('update.documentUnduh');
        Route::get  ('delete/{id}', [DocumentUnduhController::class, 'destroy'])->name('delete.documentUnduh');

    });


    Route::prefix('teamHeader')->name('teamHeader.')->group(function() {
        Route::get('', [TeamHeaderController::class, 'index'])->name('teamHeader');
        Route::get('create', [TeamHeaderController::class, 'create'])->name('create.teamHeader');
        Route::get('edit/{id}', [TeamHeaderController::class, 'edit'])->name('edit.teamHeader');
        Route::post('store', [TeamHeaderController::class, 'store'])->name('store.teamHeader');
        Route::post('update/{id}', [TeamHeaderController::class, 'update'])->name('update.teamHeader');
        Route::get  ('delete/{id}', [TeamHeaderController::class, 'destroy'])->name('delete.teamHeader');

    });

    Route::prefix('visiMisi')->name('visiMisi.')->group(function() {
        Route::get('', [VisiMisiController::class, 'index'])->name('visiMisi');
        Route::get('create', [VisiMisiController::class, 'create'])->name('create.visiMisi');
        Route::get('edit/{id}', [VisiMisiController::class, 'edit'])->name('edit.visiMisi');
        Route::post('store', [VisiMisiController::class, 'store'])->name('store.visiMisi');
        Route::post('update/{id}', [VisiMisiController::class, 'update'])->name('update.visiMisi');
        Route::get  ('delete/{id}', [VisiMisiController::class, 'destroy'])->name('delete.visiMisi');

    });

    Route::prefix('pertanyaan')->name('pertanyaan.')->group(function() {
        Route::get('', [PertanyaanController::class, 'index'])->name('pertanyaan');
        Route::get('create', [PertanyaanController::class, 'create'])->name('create.pertanyaan');
        Route::get('edit/{id}', [PertanyaanController::class, 'edit'])->name('edit.pertanyaan');
        Route::post('store', [PertanyaanController::class, 'store'])->name('store.pertanyaan');
        Route::post('update/{id}', [PertanyaanController::class, 'update'])->name('update.pertanyaan');
        Route::get  ('delete/{id}', [PertanyaanController::class, 'destroy'])->name('delete.pertanyaan');

    });

    Route::prefix('aboutAwal')->name('aboutAwal.')->group(function() {
        Route::get('', [AboutAwalController::class, 'index'])->name('aboutAwal');
        Route::get('create', [AboutAwalController::class, 'create'])->name('create.aboutAwal');
        Route::get('edit/{id}', [AboutAwalController::class, 'edit'])->name('edit.aboutAwal');
        Route::post('store', [AboutAwalController::class, 'store'])->name('store.aboutAwal');
        Route::post('update/{id}', [AboutAwalController::class, 'update'])->name('update.aboutAwal');
        Route::get  ('delete/{id}', [AboutAwalController::class, 'destroy'])->name('delete.aboutAwal');

    });

    Route::prefix('keteranganSlider')->name('keteranganSlider.')->group(function() {
        Route::get('', [KeteranganSliderController::class, 'index'])->name('keteranganSlider');
        Route::get('create', [KeteranganSliderController::class, 'create'])->name('create.keteranganSlider');
        Route::get('edit/{id}', [KeteranganSliderController::class, 'edit'])->name('edit.keteranganSlider');
        Route::post('store', [KeteranganSliderController::class, 'store'])->name('store.keteranganSlider');
        Route::post('update/{id}', [KeteranganSliderController::class, 'update'])->name('update.keteranganSlider');
        Route::get  ('delete/{id}', [KeteranganSliderController::class, 'destroy'])->name('delete.keteranganSlider');

    });

    Route::prefix('mitraGabung')->name('mitraGabung.')->group(function() {
        Route::get('', [MitraGabungController::class, 'index'])->name('mitraGabung');
        Route::get('create', [MitraGabungController::class, 'create'])->name('create.mitraGabung');
        Route::get('edit/{id}', [MitraGabungController::class, 'edit'])->name('edit.mitraGabung');
        Route::post('store', [MitraGabungController::class, 'store'])->name('store.mitraGabung');
        Route::post('update/{id}', [MitraGabungController::class, 'update'])->name('update.mitraGabung');
        Route::get  ('delete/{id}', [MitraGabungController::class, 'destroy'])->name('delete.mitraGabung');

    });

    Route::prefix('hubungiKami')->name('hubungiKami.')->group(function() {
        Route::get('', [HubungiKamiController::class, 'index'])->name('hubungiKami');
        Route::get('create', [HubungiKamiController::class, 'create'])->name('create.hubungiKami');
        Route::get('edit/{id}', [HubungiKamiController::class, 'edit'])->name('edit.hubungiKami');
        Route::post('update/{id}', [HubungiKamiController::class, 'update'])->name('update.hubungiKami');
        Route::get  ('delete/{id}', [HubungiKamiController::class, 'destroy'])->name('delete.hubungiKami');
        Route::post('store', [HubungiKamiController::class, 'store'])->name('store.hubungiKami');
        Route::get('compose/{id}', [HubungiKamiController::class, 'compose'])->name('compose.hubungiKami');
        Route::post('compose', [HubungiKamiController::class, 'submitCompose'])->name('submit.compose.hubungiKami');
    });

    Route::get('tombol', [TombolController::class, 'update'])->name('tombol');
});