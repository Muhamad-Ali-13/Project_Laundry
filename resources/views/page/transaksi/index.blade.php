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
                            {{-- BUTTON REDIRECT HALAMAN ADD TRANSAKSI --}}
                            @can('role-A')
                                <div>
                                    <a href="{{ route('transaksi.create') }}"
                                        class="bg-sky-400 p-1 text-white rounded-xl px-4">Tambah</a>
                                </div>
                            @endcan
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
                                                {{ $t->Outlet->nama_outlet }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->kode_invoice }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $t->member->id }}
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

                                            <td class="px-6 py-4 bg-gray-100">
                                                <button type="button" data-id="{{ $t->id }}"
                                                    data-tgl_bayar="{{ $t->tgl_bayar }}"
                                                    data-dibayar="{{ $t->dibayar }}" data-modal-target="sourceModal"
                                                    onclick="editSourceModal(this)"
                                                    class="bg-amber-500 hover:bg-amber-600 mb-3 px-3 py-1 rounded-md text-xs text-white">
                                                    Pembayaran
                                                </button>
                                                <button
                                                    class="bg-red-400 ml-6 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                                    onclick="return dataDelete('{{ $t->id }}','{{ $t->kode_invoice }}')">
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
    <!-- Modal -->
    <div id="sourceModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Update Transaksi
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col p-4 space-y-6">
                        <div class="">
                            <label for="tgl_bayar" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Bayar</label>
                            <input type="date" id="tgl_bayar" name="tgl_bayar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="">
                            <label for="dibayar" class="block mb-2 text-sm font-medium text-gray-900">Status
                                Pembayaran</label>
                            <select name="dibayar" id="dibayar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="dibayar">Dibayar</option>
                                <option value="belum_dibayar">Belum Dibayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"t
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const tglBayar = button.dataset.tgl_bayar;
            const dibayar = button.dataset.dibayar;

            let url = "{{ route('transaksi.update', ':id') }}".replace(':id', id);

            document.getElementById('title_source').innerText = `UPDATE TRANSAKSI ${id}`;
            document.getElementById('tgl_bayar').value = tglBayar;
            document.getElementById('dibayar').value = dibayar;

            // Hapus input tersembunyi yang lama
            const existingInputs = formModal.querySelectorAll('input[type="hidden"]');
            existingInputs.forEach(input => input.remove());

            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('name', '_token');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            formModal.setAttribute('action', url);

            document.getElementById(modalTarget).classList.remove('hidden');
        };

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            document.getElementById(modalTarget).classList.add('hidden');
        };

        const dataDelete = async (id, kode_invoice) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus KODE INVOICE ${kode_invoice} ?`);
            if (tanya) {
                await axios.post(`/transaksi/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                        Swal.fire({
                            title: 'Deleted!',
                            text: '{{ session('message_delete') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }


        @if (session('success'))
            <
            script >
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }); <
            />
        @endif
        @if (session('message_update'))
            <
            script >
                Swal.fire({
                    title: 'Updated!',
                    text: '{{ session('message_update') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
    </script>
    @endif

    </script>
</x-app-layout>
