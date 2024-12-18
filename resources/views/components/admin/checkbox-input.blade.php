@props(['id', 'name' => [], 'value' => '', 'label' => '', 'inputClass' => '', 'labelClass' => '', 'checked' => false])
<div class="flex items-center">
    <label for="{{ $id }}" {{ $attributes->merge(["class"=>"flex items-center w-full bg-white py-2 px-2 shadow-sm border rounded-md border-gray-300 cursor-pointer dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-200 dark:hover:text-gray-800 dark:text-white $labelClass"]) }}>
        <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(["class"=>"bg-white border-gray-300 text-gray-800 focus:ring-gray-800 mr-2 rounded-full dark:text-black dark:focus:ring-white $inputClass"]) }} {{ $checked ? 'checked' : '' }} />
        {{ $label }}
    </label>
</div>
