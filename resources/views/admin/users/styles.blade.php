@push('styles')
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        width: 100% !important;
        overflow: hidden;
    }
    /* Match Select2 with Tailwind */
    .select2-container .select2-selection {
        @apply border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full;
    }

    .select2-container .select2-selection--single {
        height: 2.5rem;
        display: flex;
        align-items: center;
    }

    .select2-container .select2-selection__rendered {
        @apply text-gray-700;
        padding-left: 0.75rem;
    }

    .select2-container .select2-selection__arrow {
        height: 100%;
        right: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select2-container .select2-selection--multiple {
        @apply border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm;
    }

    .select2-container .select2-selection__choice {
        @apply bg-indigo-100 text-indigo-800 rounded-md px-2 py-0.5 m-1;
    }

    .select2-container .select2-results__option--highlighted {
        @apply bg-indigo-500 text-white;
    }
</style>
@endpush
