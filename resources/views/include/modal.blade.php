<div class="modal fade" id="show_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script>
    function showAjaxModal(title, url) {
        $('#show_modal .modal-body').html('');
        $('#show_modal .modal-title').text(title);

        var modal = new bootstrap.Modal(document.getElementById('show_modal'));
        modal.show();

        $.ajax({
            url: url,
            success: function(response) {
                $('#show_modal .modal-body').html(response);
            },
            error: function(xhr, status, error) {
                $('#show_modal .modal-body').html('<p class="text-danger">Gagal memuat konten.</p>');
                console.error('AJAX Error:', status, error);
            }
        });
    }
</script>

@if (session('success'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            html: "{!! session('success') !!}",
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "Gagal!",
            text: "{{ session('error') }}",
            icon: "error",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif


