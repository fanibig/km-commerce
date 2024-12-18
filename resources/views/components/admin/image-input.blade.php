@props(['name', 'id', 'value' => '', 'btnName' => 'Choose File'])

<div x-data="imageUploader('{{ $value }}')" class="image-upload">
    <!-- Thumbnail Preview -->
    <div x-show="imagePreview" class="mb-2">
        <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover">
    </div>

    <!-- File Input -->
    <input
        type="file"
        name="{{ $name }}"
        id="{{ $id }}"
        @change="fileChosen"
        accept="image/*"
        class="hidden">

    <!-- Label to trigger file input -->
    <label for="{{ $id }}" class="cursor-pointer inline-block text-white mt-2 py-3 px-4 rounded bg-gray-600 hover:bg-gray-700">
        {{ $btnName }}
    </label>
</div>

<script>
    function imageUploader(initialImage) {
        return {
            imagePreview: initialImage ? initialImage : null,
            fileChosen(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                }
            }
        };
    }
</script>


