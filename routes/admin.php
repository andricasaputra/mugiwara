<?php

use App\Http\Controllers\AboutAwalController;
use App\Http\Controllers\AboutKeduaController;
use App\Http\Controllers\AboutPertamaController;
use App\Http\Controllers\Admin\AccomodationController;
use App\Http\Controllers\Admin\AppStoreController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\ManajemenMenuController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfficeListController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentMethodSettingController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlayStoreController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PrivacyPoliciesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductUserController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\PushController;
use App\Http\Controllers\Admin\RefferalController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomNumberController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\DocumentUnduhController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\KeteranganFiturController;
use App\Http\Controllers\KeteranganSliderController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MitraGabungController;
use App\Http\Controllers\PenukaranMarchendiseController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProsesPendaftaranController;
use App\Http\Controllers\SliderFiturController;
use App\Http\Controllers\SliderMitraController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\TambahMenuController;
use App\Http\Controllers\TambahSliderController;
use App\Http\Controllers\TeamHeaderController;
use App\Http\Controllers\TombolController;
use App\Http\Controllers\VisiMisiController;
use App\Models\KeteranganSlider;
use App\Models\MitraGabung;
use App\Models\SliderMitra;
use App\Models\TambahSlider;
use App\Models\documentUnduh;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

Route::resource('users', UsersController::class)->except(['index', 'store', 'create']);
Route::get('users', [UsersController::class, 'showEmployee'])->name('users.employee');
Route::get('customers', [UsersController::class, 'showCustomer'])->name('users.customer');
Route::get('users/roles/{user}', [UsersController::class, 'roles'])->name('users.roles');
Route::post('users/roles/{user}', [UsersController::class, 'attachRoles'])->name('users.attach.roles');

Route::get('users/permissions/{user}', [UsersController::class, 'permissions'])->name('users.permissions');
Route::post('users/permissions/{user}', [UsersController::class, 'attachPermissions'])->name('users.attach.permissions');

Route::get('users/detail/{user}', [UsersController::class, 'detail'])->name('users.detail');

Route::post('users/banned/{user}', [UsersController::class, 'banned'])->name('users.banned');

Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');

Route::put('users/update/{user}', [UsersController::class, 'update'])->name('users.update');

Route::delete('users/destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

Route::get('users/banned/{user}', [UsersController::class, 'bannedPage'])->name('users.banned.page');

Route::post('users/banned/', [UsersController::class, 'banned'])->name('users.banned');

Route::post('users/release', [UsersController::class, 'release'])->name('users.banned.release');

Route::delete('users/customer/destroy', [UsersController::class, 'destroyCustomer'])->name('customers.destroy');

Route::resource('offices', OfficeListController::class);
Route::get('accomodations_room/add/{accomodation}', [AccomodationController::class, 'add'])->name('accomodations.add');
Route::post('accomodations_room/add/', [AccomodationController::class, 'storeRoom'])->name('accomodations.store_room');
Route::resource('accomodations', AccomodationController::class);

Route::post('/tambah_kamar', [AccomodationController::class, 'tambah_kamar'])->name('tambah_kamar');

Route::resource('rooms', RoomController::class);
Route::post('rooms/filter', [RoomController::class, 'filter'])->name('rooms.filter');
Route::get('rooms/reviews/{room}', [ReviewController::class, 'index'])->name('rooms.reviews.index');
Route::get('rooms/reviews/edit/{room}/{review}', [ReviewController::class, 'edit'])->name('rooms.reviews.edit');
Route::put('rooms/reviews/update/{room}/{review}', [ReviewController::class, 'update'])->name('rooms.reviews.update');
Route::resource('facilities', FacilityController::class);
Route::resource('room_numbers', RoomNumberController::class);
Route::resource('room_types', RoomTypeController::class);
Route::resource('booking', BookingController::class);
Route::resource('privacy', PrivacyPoliciesController::class)->except('show');

Route::get('tukar_marchendise', [PenukaranMarchendiseController::class, 'index'])->name('tukar_marchendise');
Route::get('tambah_penukaran', [PenukaranMarchendiseController::class, 'create'])->name('tambah_penukaran');
Route::post('store_penukaran', [PenukaranMarchendiseController::class, 'store'])->name('store_penukaran');
Route::get('hapus_penukaran/{id}', [PenukaranMarchendiseController::class, 'destroy'])->name('hapus_penukaran');
Route::get('update_penukaran/{id}', [PenukaranMarchendiseController::class, 'update'])->name('update_penukaran');
Route::get('edit_penukaran/{id}', [PenukaranMarchendiseController::class, 'edit'])->name('edit_penukaran');

Route::name('admin.')->group(function() {

    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('index');
        Route::post('orderchart', [DashboardController::class, 'orderChart'])->name('orderchart');
        Route::post('pointchart', [DashboardController::class, 'pointChart'])->name('pointchart');
        Route::post('financechart', [DashboardController::class, 'financeChart'])->name('financechart');
    });

    Route::prefix('post')->name('post.')->group(function() {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::get('{id}/show', [PostController::class, 'show'])->name('show');
        Route::put('', [PostController::class, 'update'])->name('update');
        Route::delete('', [PostController::class, 'delete'])->name('delete');
    });

    Route::prefix('point')->name('point.')->group(function() {
        Route::get('', [PointController::class, 'index'])->name('index');
        Route::get('{id}/show', [PointController::class, 'show'])->name('show');
    });

    Route::prefix('slider')->name('slider.')->group(function() {
        Route::get('', [SliderController::class, 'index'])->name('index');
        Route::get('create', [SliderController::class, 'create'])->name('create');
        Route::post('', [SliderController::class, 'store'])->name('store');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('', [SliderController::class, 'update'])->name('update');
        Route::delete('', [SliderController::class, 'delete'])->name('delete');
    });


    Route::prefix('type')->name('type.')->group(function() {
        Route::get('', [TypeController::class, 'index'])->name('index');
        Route::get('create', [TypeController::class, 'create'])->name('create');
        Route::post('', [TypeController::class, 'store'])->name('store');
        Route::get('{id}/edit', [TypeController::class, 'edit'])->name('edit');
        Route::put('', [TypeController::class, 'update'])->name('update');
        Route::delete('', [TypeController::class, 'delete'])->name('delete');
    });
    Route::prefix('category-post')->name('category_post.')->group(function() {
        Route::get('', [CategoryPostController::class, 'index'])->name('index');
        Route::get('create', [CategoryPostController::class, 'create'])->name('create');
        Route::post('', [CategoryPostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryPostController::class, 'edit'])->name('edit');
        Route::put('', [CategoryPostController::class, 'update'])->name('update');
        Route::delete('', [CategoryPostController::class, 'delete'])->name('delete');
    });

    Route::prefix('product')->name('product.')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('', [ProductController::class, 'update'])->name('update');
        Route::delete('', [ProductController::class, 'delete'])->name('delete');

        Route::get('redeem/lists', [ProductUserController::class, 'redeemList'])->name('redeem.list');
        Route::get('redeem/list/detail/{prodcut_id}', [ProductUserController::class, 'detail'])->name('redeem.list.detail');
        Route::get('edit/redeem/list/{id}', [ProductUserController::class, 'edit'])->name('redeem.list.edit');
        Route::get('create/redeem/list/{redem_type}', [ProductUserController::class, 'edit'])->name('redeem.list.upload.page');
        Route::put('create/redeem/list/{id}', [ProductUserController::class, 'update'])->name('redeem.list.update');
        Route::delete('create/redeem/list/', [ProductUserController::class, 'delete'])->name('redeem.list.delete');

        Route::get('tukar_marchendise', [PenukaranMarchendiseController::class, 'index'])->name('tukar_marchendise');
        Route::get('tambah_penukaran', [PenukaranMarchendiseController::class, 'create'])->name('tambah_penukaran');
        Route::post('store_penukaran', [PenukaranMarchendiseController::class, 'store'])->name('store_penukaran');
        Route::get('hapus_penukaran/{id}', [PenukaranMarchendiseController::class, 'destroy'])->name('hapus_penukaran');
        Route::get('update_penukaran/{id}', [PenukaranMarchendiseController::class, 'update'])->name('update_penukaran');
        Route::get('edit_penukaran/{id}', [PenukaranMarchendiseController::class, 'edit'])->name('edit_penukaran');
    });

    Route::prefix('voucher')->name('voucher.')->group(function() {
        Route::get('', [VoucherController::class, 'index'])->name('index');
        Route::get('create', [VoucherController::class, 'create'])->name('create');
        Route::post('', [VoucherController::class, 'store'])->name('store');
        Route::get('{id}/edit', [VoucherController::class, 'edit'])->name('edit');
        Route::get('{id}/show', [VoucherController::class, 'show'])->name('show');
        Route::put('', [VoucherController::class, 'update'])->name('update');
        Route::delete('', [VoucherController::class, 'delete'])->name('delete');
        Route::get('redeem/lists', [VoucherController::class, 'redeemList'])->name('redeem.list');
    });

    Route::resource('promotion', PromotionController::class);
    Route::get('refferals', [RefferalController::class, 'index'])->name('refferals.index');
    Route::get('refferals/{refferral}', [RefferalController::class, 'show'])->name('refferals.show');

    Route::get('refunds', [RefundController::class, 'index'])->name('refund.index');
    Route::get('refunds/detail/{refund}', [RefundController::class, 'show'])->name('refund.show');
    Route::get('refunds/action/{refund}', [RefundController::class, 'actionPage'])->name('refund.action.page');
    Route::post('refunds/action/{refund}', [RefundController::class, 'action'])->name('refund.action');

     Route::get('refunds/reason', [RefundController::class, 'showReason'])->name('refund.reason.index');
     Route::get('refunds/reason/create', [RefundController::class, 'createReason'])->name('refund.reason.create');
     Route::get('refunds/reason/edit/{reason}', [RefundController::class, 'editReason'])->name('refund.reason.edit');
     Route::post('refunds/reason/', [RefundController::class, 'storeReason'])->name('refund.reason.store');
     Route::put('refunds/reason/{reason}', [RefundController::class, 'updateReason'])->name('refund.reason.update');
     Route::delete('refunds/reason/destroy', [RefundController::class, 'destroyReason'])->name('refund.reason.destroy');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/detail/{order}', [OrderController::class, 'detail'])->name('orders.detail');
    Route::post('orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('orders/checkin/{order}', [OrderController::class, 'checkinPage'])->name('orders.checkin.page');
    Route::post('orders/checkin', [OrderController::class, 'checkin'])->name('orders.checkin');
    Route::get('orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('finance', [FinanceController::class, 'index'])->name('finance.index');

    Route::get('finance/detail/{payment}', [FinanceController::class, 'paymentDetail'])->name('finance.detail');

    Route::get('finance/balace', [FinanceController::class, 'getBalance'])->name('finance.balance');

    Route::get('finance/transaction/list/{page?}/{limit?}/{link?}', [FinanceController::class, 'transaction'])->name('finance.transaction.list');


    Route::get('finance/transaction/detail/{id}', [FinanceController::class, 'transactionDetail'])->name('finance.transaction.detail');

    Route::get('finance/invoices/{payment}', [FinanceController::class, 'invoices'])->name('finance.invoices');

    Route::post('payment/export/excel', [PaymentController::class, 'export'])->name('payment.export.excel');

    Route::resource('playstores', PlayStoreController::class);
    Route::resource('appstores', AppStoreController::class);

    Route::get('notifications', [NotificationController::class, 'index'])->name('notification.index');
    Route::delete('notifications/delete', [NotificationController::class, 'destroy'])->name('notification.destroy');
    Route::delete('notifications/delete/all', [NotificationController::class, 'destroyAll'])->name('notification.destroy.all');
    Route::get('notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markasread');
    Route::get('notifications/readall/mark', [NotificationController::class, 'markAsReadAll'])->name('notification.markasread.all');

    Route::resource('menus', ManajemenMenuController::class);

    Route::get('notifikasi/push', [PushController::class, 'index'])->name('notifications.push.index');

    Route::get('notifikasi/push/create', [PushController::class, 'create'])->name('notifications.push.create');

    Route::post('notifikasi/push', [PushController::class, 'store'])->name('notifications.push.store');

    Route::delete('notifikasi/push', [PushController::class, 'destroy'])->name('notifications.push.destroy');

    Route::resource('payments_methods', PaymentMethodSettingController::class);

    Route::prefix('compro')->name('compro.')->group(function() {
        Route::get('', [TambahMenuController::class, 'index'])->name('tambah.menu');
        Route::get('create', [TambahMenuController::class, 'create'])->name('create.menu');
        Route::get('edit/{id}', [TambahMenuController::class, 'edit'])->name('edit.menu');
        Route::post('store', [TambahMenuController::class, 'store'])->name('store.menu');
        Route::post('update/{id}', [TambahMenuController::class, 'update'])->name('update.menu');
        Route::get  ('delete/{id}', [TambahMenuController::class, 'destroy'])->name('delete.menu');

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

    });

    Route::get('tombol', [TombolController::class, 'update'])->name('tombol');

    require __DIR__.'/setting.php';


});

