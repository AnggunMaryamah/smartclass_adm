<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment; // pastikan model ini ada
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all(); // ambil semua data pembayaran
        return view('admin.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'verified';
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diverifikasi');
    }
}
