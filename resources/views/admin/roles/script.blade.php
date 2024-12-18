@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>

    $(document).ready(function () {
        $('input[name=is_active]').click(function () {
            var getId = $(this).data('id');
            var isChecked = $(this).is(':checked');
            var statusValue = isChecked ? 1 : 0;

            $.ajax({
                url: '{{ url("admin/categories/status-change") }}/'+ getId,
                method: 'POST',
                data: {id: getId, _token: '{{ csrf_token() }}', status: statusValue},
                success: (res) => {
                    if(res.status == 200) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            text: res.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            text: res.message,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });
        // Is active toggle button on listing page to enabled or disabled.

        $('#is_menu').click(function () {
            var isChecked = $(this).is(':checked');
            var isMenu = isChecked ? 1 : 0;
            if(isMenu == 1) {
                $('#is_menu').attr('value', isMenu);
            } else {
                $('#is_menu').attr('value', isMenu);
            }
        });
        // Is menu toggle button in create or edit both functionality.

        $(document).ready(function () {
        // Handle "select all" checkbox change event
        $('#select_all').on('change', function () {
            $('.select-item').prop('checked', $(this).prop('checked'));
        });

        // Uncheck "select all" if one of the items is unchecked
        $('.select-item').on('change', function () {
            if (!$(this).prop('checked')) {
                $('#select_all').prop('checked', false);
            }
            // Check "select all" if all items are checked
            if ($('.select-item:checked').length === $('.select-item').length) {
                $('#select_all').prop('checked', true);
            }
        });
    });
    });
</script>
@endpush
