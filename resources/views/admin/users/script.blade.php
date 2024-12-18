@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        //$('#role').select2();

        $('input[name=is_active]').click(function () {
            var getId = $(this).data('id');
            var isChecked = $(this).is(':checked');
            var statusValue = isChecked ? 1 : 0;

            $.ajax({
                url: '/'+ getId,
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

        $('#status').click(function () {
            var isChecked = $(this).is(':checked');
            var isMenu = isChecked ? 1 : 0;
            if(isMenu == 1) {
                $('#status').attr('value', isMenu);
            } else {
                $('#status').attr('value', isMenu);
            }
        });
        // Is menu toggle button in create or edit both functionality.
    });

    function passwordToggle() {
        return {
            showPassword: false,
            password: '',
            passwordConfirmation: '',
            togglePassword() {
                this.showPassword = !this.showPassword;
            },
            get isValid() {
                return this.password === this.passwordConfirmation && this.password.length > 0;
            }
        };
    }


</script>
@endpush
