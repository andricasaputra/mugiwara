<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(protected BookingRepository $booking)
    {}

    public function index()
    {
        return view('admin.booking.index');
    }
}
