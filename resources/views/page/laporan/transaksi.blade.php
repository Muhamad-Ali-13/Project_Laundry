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
                                <button onclick="filter(this)" data-modal-target="sourceModal"
                                    class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('laporanTransaksi.store') }}">
                            @csrf
                            <div class="flex gap-5 p-4">
                                <div class="w-full">
                                    <label for="dari"
                                        class="block mb-2 text-sm font-medium text-gray-900">Dari</label>
                                    <input type="date" name="dari" id="dari"
                                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full"
                                        required />
                                </div>
                                <div class="w-full">
                                    <label for="sampai"
                                        class="block mb-2 text-sm font-medium text-gray-900">Sampai</label>
                                    <input type="date" name="sampai" id="sampai"
                                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full"
                                        required />
                                </div>
                            </div>
                            <div class="flex items-center p-4 space-x-2 border-t rounded-b">
                                <button type="submit" id="formSourceButton" onclick="changeFilterData()"
                                    class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Print</button>
                                <button type="reset" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                                    class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:bg-red-600">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
