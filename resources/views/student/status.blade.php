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
                            <select id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
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
                            <select id="duration" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                <option selected>this week</option>
                                <option value="this month">this month</option>
                                <option value="last 3 months">the last 3 months</option>
                                <option value="lats 6 months">the last 6 months</option>
                                <option value="this year">this year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200">
                        <!-- Order 1 -->
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">#FWB127364372</a>
                                </dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">20.12.2023</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">SKMA</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                    </svg>
                                    Pre-order
                                </dd>
                            </dl>
                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <button type="button" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300">Cancel order</button>
                                <a href="#" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View details</a>
                            </div>
                        </div>
                        <!-- Order 2 -->
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">#FWB125467980</a>
                                </dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">11.12.2023</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">SPTMK</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                    </svg>
                                    In transit
                                </dd>
                            </dl>
                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <button type="button" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300">Cancel order</button>
                                <a href="#" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View details</a>
                            </div>
                        </div>
                        <!-- Order 3 -->
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">#FWB139485607</a>
                                </dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">08.12.2023</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">LHS</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    Confirmed
                                </dd>
                            </dl>
                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <button type="button" class="w-full rounded-lg bg-primary-700 px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Order again</button>
                                <a href="#" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View details</a>
                            </div>
                        </div>
                        <!-- Order 4 -->
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">#FWB137364371</a>
                                </dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">16.11.2023</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">SKL</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    Confirmed
                                </dd>
                            </dl>
                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <button type="button" class="w-full rounded-lg bg-primary-700 px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Order again</button>
                                <a href="#" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View details</a>
                            </div>
                        </div>
                        <!-- Order 5 -->
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">#FWB134567890</a>
                                </dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">02.11.2023</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">SKMA</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                    <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    Confirmed
                                </dd>
                            </dl>
                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <button type="button" class="w-full rounded-lg bg-primary-700 px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Order again</button>
                                <a href="#" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                    <ul class="flex h-8 items-center -space-x-px text-sm">
                        <li>
                            <a href="#" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#" class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection