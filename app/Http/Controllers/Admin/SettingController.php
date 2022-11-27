<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HasPaymentSetting;
use App\Traits\HasPointSetting;
use App\Traits\HasPopUpSetting;
use App\Traits\HasTaxSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use HasPaymentSetting, HasPointSetting, HasTaxSetting;

}
