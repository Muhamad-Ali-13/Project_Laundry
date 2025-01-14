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
        // $idTransaksi = Transaksi::createCode();
        return view('page.transaksi.create', compact('kodeInvoice'))->with([
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
        $kodeInvoice = $request->input('kode_invoice');
        // Validasi input untuk memastikan data lengkap
        $request->validate([
            'id_outlet' => 'required|exists:outlet,id',
            'kode_invoice' => 'required|unique:transaksi',
            'id_member' => 'required|exists:member,id',
            'tanggal' => 'required|date',
            'batas_waktu' => 'required|date',
            'biaya_tambahan' => 'nullable|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'status' => 'nullable|in:baru,proses,selesai,diambil',
            'dibayar' => 'nullable|in:dibayar,belum dibayar',
            'total_bayar' => 'required|numeric',
            'id_paket' => 'required|array',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1', // Pastikan qty ada dan valid
        ]);

        // Simpan data transaksi utama
        $transaksi = Transaksi::create([
            'id_outlet' => $request->id_outlet,
            'kode_invoice' => $request->kode_invoice,
            'id_member' => $request->id_member,
            'tanggal' => $request->tanggal,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => null,
            'biaya_tambahan' => $request->biaya_tambahan ?? 0,
            'diskon' => $request->diskon ?? 0,
            'pajak' => $request->pajak ?? 0,
            'status' => $request->status ?? 'baru',
            'dibayar' => in_array($request->dibayar, ['dibayar', 'belum dibayar']) ? $request->dibayar : 'belum dibayar',
            'id_user' => Auth::user()->id,
            'total_bayar' => $request->total_bayar ?? 0,
        ]);

        // Simpan detail transaksi
        $kodeInvoice = $transaksi->kode_invoice; // Ambil kode_invoice dari transaksi utama
        $detailTransaksiData = [];

        foreach ($request->id_paket as $index => $id_paket) {
            // Ambil paket berdasarkan ID
            $paket = Paket::find($id_paket);

            if ($paket) {
                // Siapkan data untuk detail transaksi
                $detailTransaksiData[] = [
                    'id_transaksi' => $kodeInvoice, // Gunakan kode_invoice sebagai ID transaksi
                    'id_paket' => $paket->id,
                    'qty' => $request->qty[$index],
                    'keterangan' => $request->keterangan[$index] ?? null,
                    
                ];
            }
        }

        // Masukkan data detail transaksi ke database
        if (count($detailTransaksiData) > 0) {
            Detail_Transaksi::insert($detailTransaksiData);
        } else {
            return back()->with('error', 'Tidak ada paket yang valid untuk disimpan.');
        }

        return redirect()->route('transaksi.index')->with('success', 'Data Transaksi berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data = Transaksi::with(['detail_transaksi', 'outlet', 'member', 'user'])->findOrFail($id);
        // return view('page.transaksi.show')->with([
        //     'data' => $data,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Transaksi::with('detail_transaksi')->findOrFail($id);
        $outlet = Outlet::all();
        $member = Member::all();
        $user = User::all();
        $paket = Paket::all();
        return view('page.transaksi.edit')->with([
            'data' => $data,
            'outlet' => $outlet,
            'member' => $member,
            'user' => $user,
            'paket' => $paket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dibayar' => 'required|in:dibayar,belum dibayar', // Validasi status pembayaran
            'tgl_bayar' => 'nullable|date', // Pastikan tgl_bayar adalah tanggal yang valid
        ]);

        // Ambil data transaksi yang akan diupdate
        $transaksi = Transaksi::findOrFail($id);

        // Update status pembayaran
        $transaksi->dibayar = $request->dibayar;

        // Update tanggal pembayaran (jika dibayar)
        if ($request->dibayar === 'dibayar') {
            $transaksi->tgl_bayar = $request->tgl_bayar ?? now(); // Gunakan tanggal yang diinput atau tanggal sekarang
        } else {
            $transaksi->tgl_bayar = null; // Jika belum dibayar, kosongkan tanggal pembayaran
        }

        // Simpan perubahan ke database
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('message_update', 'Data transaksi berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $id_invoice = $transaksi->kode_invoice;

        // Hapus detail penjualan dan data penjualan
        Detail_Transaksi::where('id_transaksi', $id_invoice)->delete();
        $transaksi->delete();

        return back()->with('message_delete', 'Data Transaksi berhasil dihapus.');
    }
}
