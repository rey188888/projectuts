@extends('components.layout')
@section('title')
    Home
@endsection
@section('content')
    <section class="bg-white py-8 antialiased md:py-16 pl-64">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h1 class="text-2xl font-semibold text-gray-900">Daftar Pengajuan Surat</h1>
                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <div>
                            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select order type</label>
                            <select id="order-type"
                                class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                <option selected>All orders</option>
                                <option value="pre-order">Pre-order</option>
                                <option value="transit">In transit</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <span class="inline-block text-gray-500"> from </span>
                        <div>
                            <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select duration</label>
                            <select id="duration"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                <option selected>this week</option>
                                <option value="this month">this month</option>
                                <option value="last 3 months">the last 3 months</option>
                                <option value="last 6 months">the last 6 months</option>
                                <option value="this year">this year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200">
                        <!-- Loop through each application -->
                        @forelse ($pengajuanSurat as $item)
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        <a href="#" class="hover:underline">{{ $item->id_surat }}</a>
                                    </dd>
                                </dl>
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">NRP:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $item->nrp }}</dd>
                                </dl>
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $item->tanggal_perubahan }}</dd>
                                </dl>
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        <span class="inline-block rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
                                            Menunggu Persetujuan
                                        </span>
                                    </dd>
                                </dl>
                                <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <form action="{{ route('kaprodi.updateStatus') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_surat" value="{{ $item->id }}">
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="w-full rounded-lg border border-green-700 px-3 py-2 text-center text-sm font-medium text-green-700 hover:bg-green-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-300">
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('kaprodi.updateStatus') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_surat" value="{{ $item->id }}">
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="button" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300"
                                            data-toggle="modal" data-target="#rejectModal{{ $item->id }}">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No applications found.</p>
                        @endforelse
                    </div>
                </div>
                <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                    <ul class="flex h-8 items-center -space-x-px text-sm">
                        <li>
                            <a href="#"
                                class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m15 19-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection