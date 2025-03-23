<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Check for success message
    @if (session('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            draggable: true,
            confirmButtonText: "OK"
        });
    @endif

    // Check for error message (e.g., database errors or Mahasiswa not found)
    @if (session('error'))
        Swal.fire({
            title: "Error!",
            text: "{{ session('error') }}",
            icon: "error",
            draggable: true,
            confirmButtonText: "OK"
        });
    @endif

    // Check for validation errors
    @if ($errors->any())
        Swal.fire({
            title: "Validation Error!",
            html: `
    <ul style="text-align: left;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    `,
            icon: "error",
            draggable: true,
            confirmButtonText: "OK"
        });
    @endif
</script>
