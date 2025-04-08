<div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
    <span class="inline-block text-gray-500"> Sortir </span>
    <div>
        <form method="GET" action="{{ route($route) }}">
            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select order type</label>
            <select id="order-type" name="status_filter" onchange="this.form.submit()"
                class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                <option value="" {{ request('status_filter') == '' ? 'selected' : '' }}>Semua</option>
                <option value="0" {{ request('status_filter') == '0' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                <option value="1" {{ request('status_filter') == '1' ? 'selected' : '' }}>Disetujui</option>
                <option value="2" {{ request('status_filter') == '2' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>
</div>