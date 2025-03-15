<form method="POST" action="/logout">
    @csrf
    <button type="submit"
        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
        Logout
    </button>
</form>
