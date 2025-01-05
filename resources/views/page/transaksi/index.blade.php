<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TRANSAKSI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="gap-5 items-start flex">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold">
                        <div class="flex items-center justify-between">
                            <div class="w-full">
                                TRANSAKSI
                            </div>
                            {{-- BUTTON REDIRECT HALAMAN ADD PENJUALAN --}}
                            <div>
                                <a href="{{ route('transaksi.create') }}"
                                    class="bg-sky-400 p-1 text-white rounded-xl px-4">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            NO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            OUTLET
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Kode Invoice
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Member
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Batas Waktu
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal Bayar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Biaya Tambahan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Diskon
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Pajak
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Bayar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dibayar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            User
                                        </th>
                                        @can('role-A')
                                            <th scope="col" class="px-6 py-3">
                                                ACTION
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $key => $t)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-100">
                                                {{ $no++ }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $t->Outlet->nama }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->kode_invoice }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->member->nama }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->tanggal }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->batas_waktu }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->tgl_bayar }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->biaya_tambahan }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->diskon }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->pajak }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->total_bayar }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->status }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->dibayar }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->user->id }}
                                            </td>
                                            <td class="px-6 py-4 bg-gray-100">
                                                <button class="btn btn-success mb-3" onclick="update(1)">
                                                    <i class="fa fa-check-circle"></i> Tandai Dibayar
                                                </button>

                                                <button
                                                    class="bg-red-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                                    onclick="return dataDelete('{{ $t->id }}','{{ $t->outlet->nama_outlet }}')">
                                                    <i class="fi fi-sr-delete-document"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        const dataDelete = async (id, nama_outlet) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus transaksi ${nama_outlet}?`);
            if (tanya) {
                try {
                    const response = await axios.post(`/transaksi/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    });

                    if (response.status === 200) {
                        alert('Transaksi berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus transaksi. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus transaksi. Silakan cek konsol untuk detail.');
                }
            }
        };

        function update(id) {
            const confirmed = confirm('Apakah Anda yakin ingin mengubah status pembayaran menjadi "Dibayar"?');
            if (confirmed) {
                fetch(`/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        tgl_pembayaran: new Date().toISOString().slice(0, 19).replace('T',
                        ' '), // Format datetime MySQL
                        status: 'dibayar' // Perbarui status menjadi "dibayar"
                    }),
                })
                .then(response => response.json()) // Mengambil respons dalam format JSON
                .then(data => {
                    console.log(data); // Cek data yang diterima dari server
                    if (data.success) {
                        alert('Status pembayaran berhasil diubah!');
                        location.reload(); // Reload halaman untuk memperbarui status
                    } else {
                        alert('Gagal mengubah status pembayaran: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error); // Cek error di konsol jika ada
                    alert('Terjadi kesalahan.');
                });
            }
        }
    </script>
</x-app-layout>
