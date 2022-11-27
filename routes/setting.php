<?php  

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SettingPopUpController;

Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('settings/payment', [SettingController::class, 'paymentList'])->name('settings.payment');

Route::get('settings/payment/edit/{id}', [SettingController::class, 'paymentEdit'])->name('settings.payment.edit');

Route::put('settings/payment/update/{id}', [SettingController::class, 'paymentUpdate'])->name('settings.payment.update');


Route::get('settings/points', [SettingController::class, 'points'])->name('settings.point.index');

Route::get('settings/points/create', [SettingController::class, 'createPointSetting'])->name('settings.point.create');

Route::post('settings/points', [SettingController::class, 'storePointSetting'])->name('settings.point.store');

Route::get('settings/points/edit/{id}', [SettingController::class, 'editPointSetting'])->name('settings.point.edit');

Route::put('settings/points/update/{id}', [SettingController::class, 'updatePointSetting'])->name('settings.point.update');

Route::get('settings/points/delete/{id}', [SettingController::class, 'deletePointSetting'])->name('settings.point.destroy');

Route::get('settings/tax/', [SettingController::class, 'taxSetting'])->name('settings.tax');

Route::get('settings/tax/create', [SettingController::class, 'createTaxSetting'])->name('settings.tax.create');

Route::get('settings/tax/edit/{setting}', [SettingController::class, 'editTaxSetting'])->name('settings.tax.edit');

Route::post('settings/tax', [SettingController::class, 'storeTaxSetting'])->name('settings.tax.store');

Route::get('settings/tax/destroy/{setting}', [SettingController::class, 'destroyTaxSetting'])->name('settings.tax.destroy');

Route::put('settings/tax/{setting}', [SettingController::class, 'updateTaxSetting'])->name('settings.tax.update');

Route::get('settings/popup', [SettingPopUpController::class, 'popUpSetting'])->name('settings.popup');

Route::get('settings/popup/create', [SettingPopUpController::class, 'createPopUpSetting'])->name('settings.popup.create');

Route::get('settings/popup/edit/{setting}', [SettingPopUpController::class, 'editPopUpSetting'])->name('settings.popup.edit');

Route::post('settings/popup', [SettingPopUpController::class, 'storePopUpSetting'])->name('settings.popup.store');

Route::get('settings/popup/destroy/{setting}', [SettingPopUpController::class, 'destroyPopUpSetting'])->name('settings.popup.destroy');

Route::put('settings/popup/{setting}', [SettingPopUpController::class, 'updatePopUpSetting'])->name('settings.popup.update');