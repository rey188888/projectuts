<!-- Sidebar (Navbar) -->
<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidenav">
    <div
        class="flex flex-col h-full overflow-y-auto py-5 px-3 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <!-- Navigation Items -->
        <ul class="space-y-2">
            <li>
                <a href="/student"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Pengajuan Surat</span>
                </a>
            </li>
            <li>
                <a href="/student/status"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Status Pengajuan</span>
                </a>
            </li>
            <!-- Dashboard -->
            <li>
                <a href="/student/dashboard"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <!-- Daftar Surat (Collapsible Menu) -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    aria-controls="daftar-surat-dropdown" data-collapse-toggle="daftar-surat-dropdown">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4h12v12H4V4zm2 2v8h8V6H6z"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Daftar Surat</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="daftar-surat-dropdown" class=" py-2 space-y-2">
                    <li>
                        <a href="/student/surat/disetujui"
                            class="flex items-center w-full p-2 pl-11 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            Disetujui
                        </a>
                    </li>
                    <li>
                        <a href="/student/surat/ditolak"
                            class="flex items-center w-full p-2 pl-11 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            Ditolak
                        </a>
                    </li>
                    <li>
                        <a href="/student/surat/menunggu"
                            class="flex items-center w-full p-2 pl-11 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            Menunggu Persetujuan
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Cetak Surat -->
            <li>
                <a href="/staff/print_surat"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Print Surat</span>
                </a>
            </li>
        </ul>
        <!-- Logout Button at Bottom -->
        <div class="mt-auto">
            <x-logout-button />
        </div>
    </div>
</aside>
