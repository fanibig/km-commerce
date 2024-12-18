<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('plugins/fontawesome-free/js/all.min.js') }}"></script>
@include('sweetalert::alert')

@stack('custom_scripts')

<script>
    /*
    $('input[name="date_format"]').on('change', function() {
        $('#date_format6').val($(this).val());
    });
    $('input[name="time_format"]').on('change', function() {
        $('#time_format5').val($(this).val());
    });

    /* Image uploading */
    $(document).ready(function() {
        const $fileDropArea = $('#file-drop-area');
        const $fileInput = $('#file-input');
        const $browseButton = $fileDropArea.find('button');
        const $filePreview = $('#file-preview');

        $fileDropArea.on('dragover', function(event) {
            event.preventDefault();
            $fileDropArea.addClass('drag-over');
        });

        $fileDropArea.on('dragleave', function() {
            $fileDropArea.removeClass('drag-over');
        });

        $fileDropArea.on('drop', function(event) {
            event.preventDefault();
            $fileDropArea.removeClass('drag-over');
            const files = event.originalEvent.dataTransfer.files;
            handleFiles(files);
        });

        $browseButton.on('click', function() {
            $fileInput.click();
        });

        $fileInput.on('change', function() {
            const files = $fileInput[0].files;
            handleFiles(files);
        });

        function handleFiles(files) {
            $filePreview.empty();
            if (files.length > 0) {
                $fileDropArea.hide();
            }
            $.each(files, function(index, file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const $previewItem = $('#file-preview').toggleClass('block');

                    $('#remove_icon').on('click', function() {
                        $previewItem.empty().addClass('hidden');
                        if ($filePreview.children().length === 0) {
                            $fileDropArea.show();
                        }
                    });

                    $('#change_icon').on('click', function() {
                        const newInput = $('<input type="file" class="hidden" name="site_favicon">');
                        newInput.on('change', function() {
                            handleFiles(newInput[0].files);
                        });
                        newInput.click();
                    });

                    const $bigImg = $('#big_favicon').attr('src', e.target.result);
                    const $smallIcon = $('#favicon').attr('src', e.target.result);
                    $filePreview.append($previewItem).append($bigImg).append($smallIcon);
                };

                reader.readAsDataURL(file);
            });
        }
    });
</script>
