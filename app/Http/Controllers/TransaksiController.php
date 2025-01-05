<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use PHPUnit\Event\Tracer\Tracer;

use function Illuminate\Log\log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::paginate(5);
        return view('page.transaksi.index')->with([
            'data' => $data,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $outlet = Outlet::all();
        $member = Member::all();
        $user = User::all();
        $paket = Paket::all();
        $kodeInvoice = Transaksi::createCode();
        $id_transaksi = Transaksi::createCode();
        return view('page.transaksi.create', compact('kodeInvoice'), compact('id_transaksi'))->with([
            'outlet' => $outlet,
            'member' => $member,
            'user' => $user,
            'paket' => $paket,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_outlet' => 'required',
            'kode_invoice' => 'required',
            'id_member' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
            'dibayar' => 'required|in:belum_dibayar,dibayar',
            'batas_waktu' => 'required|date',
            'tgl_bayar' => 'nullable|date',
            'biaya_tambahan' => 'required|numeric|min:0',
            'diskon' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0',
            'id_user' => 'required|exists:users,id',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::create($validated);

        // Simpan detail transaksi jika ada
        if ($request->has('id_paket')) {
            $details = collect($request->id_paket)->map(function ($idPaket, $index) use ($request, $transaksi) {
                return [
                    'id_transaksi' => $transaksi->id,
                    'id_paket' => $idPaket,
                    'qty' => $request->qty[$index],
                    'keterangan' => $request->keterangan[$index],
                ];
            });

            // Insert all detail transaksi in one query
            Detail_Transaksi::insert($details->toArray());
        }

        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }


    public function updatePaymentStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->dibayar = 'dibayar';
        $transaksi->tgl_pembayaran = $request->tgl_pembayaran;

        if ($transaksi->save()) {
            return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui.']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal memperbarui status pembayaran.'], 500);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasi untuk menampilkan detail transaksi
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementasi untuk menampilkan form edit transaksi
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return Response::json(['success' => false, 'message' => 'Transaksi tidak ditemukan.']);
        }

        // Update status pembayaran dan tanggal pembayaran
        $transaksi->dibayar = 'dibayar';
        $transaksi->tgl_bayar = $request->tgl_pembayaran;

        // Simpan perubahan ke database
        if ($transaksi->save()) {
            return Response::json(['success' => true, 'message' => 'Status pembayaran berhasil diubah.']);
        } else {
            return Response::json(['success' => false, 'message' => 'Gagal memperbarui status pembayaran.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kodeInvoice = $transaksi->kode_invoice;

        // Ambil detail transaksi untuk memproses qty
        $details = Detail_Transaksi::where('kode_invoice', $kodeInvoice)->get();

        foreach ($details as $detail) {
            // Logika untuk mengembalikan qty jika diperlukan
        }

        // Hapus detail transaksi dan data transaksi
        Detail_Transaksi::where('kode_invoice', $kodeInvoice)->delete();
        $transaksi->delete();

        return back()->with('message_delete', 'Data Transaksi berhasil dihapus.');
    }
}
