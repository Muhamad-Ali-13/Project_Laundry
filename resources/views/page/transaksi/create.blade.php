<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="font-bold text-lg mb-4">Form Input Transaksi</div>
                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    <div class="flex gap-5">
                        <div class="mb-5 w-full">
                            <label for="id_outlet" class="block text-sm font-medium text-gray-700">Outlet</label>
                            <select id="id_outlet" name="id_outlet"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value=""></option>
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama_outlet }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="mb-5 w-full">
                            <label for="kode_invoice" class="block text-sm font-medium text-gray-700">Kode
                                Invoice</label>
                            <input type="text" id="kode_invoice" name="kode_invoice" value="{{ $kodeInvoice }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                readonly>
                        </div>

                        <div class="mb-5 w-full">
                            <label for="id_member" class="block text-sm font-medium text-gray-700">Member</label>
                            <select id="id_member" name="id_member"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value=""></option>
                                @foreach ($member as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="mb-5 w-full">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal
                                Transaksi</label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="batas_waktu"
                                class="block mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                Batas Waktu
                            </label>
                            <input type="date" id="batas_waktu" name="batas_waktu" value="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required />

                        </div>
                    </div>
                    {{-- <div>
                            <label for="tgl_bayar" class="block text-sm font-medium text-gray-700">Tanggal Bayar</label>
                            <input type="date" id="tgl_bayar" name="tgl_bayar" value="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                        </div> --}}
                    <div class="flex gap-5">
                        <div class="mb-5 w-full">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value=""></option>
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="diambil">Diambil</option>
                            </select>
                        </div>
                        {{-- <div>
                            <label for="dibayar" class="block text-sm font-medium text-gray-700">Dibayar</label>
                            <select id="dibayar" name="dibayar"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value=""></option>
                                <option value="dibayar">Dibayar</option>
                                <option value="belum_dibayar">Belum Dibayar</option>
                            </select>
                        </div> --}}
                    </div>
                    {{-- <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700">User</label>
                        <select id="id_user" name="id_user"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value=""></option>
                            @foreach ($user as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- DETAIL TRANSAKSI --}}
                    <div class="p-4 bg-gray-100 mt-6 rounded-xl font-bold">
                        <div class="flex items-center justify-between">
                            <div class="w-full">
                                DETAIL TRANSAKSI
                            </div>
                            <div><button id="addRowBtn"
                                    class="bg-sky-400 hover:bg-sky-500 text-white px-2 rounded-xl">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="border border-2 rounded-xl p-2 mb-2" id="detailContainer">
                        </div>
                    </div>

                    <div class="flex gap-5 mt-5">
                        <div class="mb-5 w-full">
                            <label for="biaya_tambahan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Biaya Tambahan
                            </label>
                            <input type="number" id="biaya_tambahan" name="biaya_tambahan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600"
                                value="0" min="0" step="0.01" required />
                        </div>
                        <div class="mb-5 w-full">
                            <label for="diskon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Diskon (%)
                            </label>
                            <input type="number" id="diskon" name="diskon" placeholder="Masukkan diskon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600"
                                value="0" min="0" step="0.01" />
                        </div>
                        <div class="mb-5 w-full">
                            <label for="pajak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pajak
                            </label>
                            <input type="text" id="pajak" name="pajak"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600"
                                readonly />
                        </div>
                        <div class="mb-5 w-full">
                            <label for="total_bayar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                                Bayar</label>
                            <input type="number" id="total_bayar" name="total_bayar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                readonly />
                        </div>
                    </div>


                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600" onclick="success">Simpan
                            Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Mendapatkan tanggal saat ini
        const today = new Date();
        // Menambahkan 7 hari
        today.setDate(today.getDate() + 7);
        // Format ke yyyy-mm-dd
        const formattedDate = today.toISOString().split('T')[0];
        // Menetapkan nilai default ke input
        document.getElementById('batas_waktu').value = formattedDate;
    </script>
    <script>
        $(document).ready(function() {

            function calculateTotalAwal() {
                let totalAwal = 0;

                // Iterasi elemen dengan id yang diawali "total"
                $('[id^="totalketerangan"]').each(function() {
                    const value = parseFloat($(this).val());

                    // Validasi nilai input
                    if (!isNaN(value) && value >= 0) {
                        totalAwal += value; // Tambahkan ke totalAwal jika nilai valid
                    } else {
                        console.warn(`Invalid value detected in element:`,
                            this); // Debug jika nilai tidak valid
                    }
                });

                return totalAwal; // Kembalikan total awal yang sudah divalidasi
            }

            // Fungsi bind event untuk baris tertentu
            function bindRowEvents(rowId) {
                const hargaInput = document.getElementById(`harga${rowId}`);
                const qtyInput = document.getElementById(`qty${rowId}`);
                const totalHargaInput = document.getElementById(`totalketerangan${rowId}`);


                // Perhitungan total harga
                const calculateTotalHarga = () => {
                    const harga = parseFloat(hargaInput.value) || 0;
                    const qty = parseInt(qtyInput.value) || 0;
                    totalHargaInput.value = Math.round(harga * qty); // Bulatkan hasil ke bilangan bulat

                    // Update total bayar setelah perubahan
                    calculateTotalBayar();
                };

                // Event listener untuk input harga dan qty
                hargaInput.addEventListener("input", calculateTotalHarga);
                qtyInput.addEventListener("input", calculateTotalHarga);
            }

            // Fungsi menghitung Total Bayar
            function calculateTotalBayar() {
                const totalAwal = calculateTotalAwal(); // Hitung total awal dari semua baris
                const diskonValue = $('#diskon').val().replace('%', ''); // Ambil angka diskon tanpa simbol "%"
                const diskon = parseFloat(diskonValue) || 0; // Diskon dalam persen
                const pajak = 12; // Pajak tetap 12%
                const biayaTambahan = parseFloat($('#biaya_tambahan').val()) || 0; // Ambil biaya tambahan atau 0

                // Validasi diskon agar tidak lebih dari 100%
                const diskonValid = Math.min(diskon, 100);

                // Perhitungan nilai diskon dan pajak
                const nilaiDiskon = Math.round((totalAwal * diskonValid) / 100); // Bulatkan nilai diskon
                const nilaiPajak = Math.round((totalAwal * pajak) / 100); // Bulatkan nilai pajak

                // Rumus Total Bayar
                const totalBayar = Math.round(totalAwal - nilaiDiskon + nilaiPajak +
                    biayaTambahan); // Tambahkan biaya tambahan

                // Update nilai di input
                $('#pajak').val(nilaiPajak); // Pajak
                $('#total_bayar').val(totalBayar); // Total Bayar
            }

            // Inisialisasi nilai default
            $('#total_bayar').val('0');

            // Event listener untuk diskon
            $('#diskon').on('input', function() {
                const diskonValue = parseFloat($(this).val()) || 0;

                // Validasi agar diskon tidak lebih dari 100%
                if (diskonValue > 100) {
                    $(this).val(100);
                } else {
                    $(this).val(Math.round(diskonValue)); // Bulatkan diskon ke bilangan bulat
                }

                calculateTotalBayar();
            });

            // Event listener untuk biaya tambahan
            $('#biaya_tambahan').on('input', function() {
                calculateTotalBayar(); // Perbarui total bayar saat biaya tambahan diubah
            });

            // MENAMBAH ROW DETAIL TRANSAKSI
            $('#addRowBtn').click(function(event) {
                event.preventDefault();
                addRow();
            });

            let rowCount = 0;

            function addRow() {
                rowCount++;
                const newRow = `
                    <div class="border border-2 rounded-xl mb-2 p-2" id="row${rowCount}">
                        <div class="flex mb-2 gap-2">
    
                            <div class="mb-5 w-full">
                                <label for="id_paket${rowCount}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Paket</label>
                                <select id="id_paket${rowCount}" name="id_paket[]" onchange="getJenis(${rowCount})"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required>
                                    <option value=""></option>
                                    @foreach ($paket as $k)
                                        <option value="{{ $k->id }}">{{ $k->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-5 w-full">
                                <label for="harga${rowCount}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " placeholder="Harga">Harga</label>
                                <input type="number" id="harga${rowCount}" name="harga[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly />
                            </div>
                            <div class="mb-5 w-full">
                                <label for="qty${rowCount}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>
                                <input type="number" id="qty${rowCount}" name="qty[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required value="0" />
                            </div>
                            <div class="mb-5 w-full">
                                <label for="total${rowCount}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
                                <input type="number" id="totalketerangan${rowCount}" name="total[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required readonly/>
                            </div>
                            <div class="mb-5 w-full">
                                <label for="keterangan${rowCount}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                <input type="text" id="keterangan${rowCount}" name="keterangan[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required />
                            </div>
                            <button type="button" class="btn-remove px-2 bg-red-100" data-row-id="${rowCount}">
                                Hapus
                            </button>
                        </div>
                    </div>`;
                $('#detailContainer').append(newRow);
                $(`#detail${rowCount}`).select2({
                    placeholder: "Pilih Detail"
                });

                // tambahin ini
                bindRowEvents(rowCount);
            }

            // MENGHAPUS ROW DETAIL TRANSAKSI
            $(document).on('click', '.btn-remove', function() {
                const rowId = $(this).data('row-id');
                $(`#row${rowId}`).remove();
                calculateTotal();
            });
        });
    </script>

    <script>
        const getJenis = (rowCount) => {
            const jenisId = document.getElementById(`id_paket${rowCount}`).value;

            // Jika tidak ada jenis yang dipilih, reset harga
            if (!jenisId) {
                document.getElementById(`harga${rowCount}`).value = "";
                return;
            }

            // Memanggil endpoint untuk mendapatkan data harga
            axios.get(`/paket/paket_jenis/${jenisId}`)
                .then(response => {
                    const paket = response.data.paket;

                    // Jika data ditemukan, isi input harga
                    document.getElementById(`harga${rowCount}`).value = paket ? paket.harga : "";
                })
                .catch(error => {
                    console.error("Gagal memuat data harga paket:", error);

                    // Reset input harga jika terjadi error
                    document.getElementById(`harga${rowCount}`).value = "";
                });
        };
    </script>

</x-app-layout>
