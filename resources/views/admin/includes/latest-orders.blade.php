<div class="average-orders mb-4">
    <h2 class="text-xl font-bold text-black mb-1 tracking-wide dark:text-gray-200">{{ __('Last Orders') }}</h2>
    <table class="table-fixed w-full">
        <thead class="border-b border-gray-200 dark:border-gray-500">
            <tr class="text-sm dark:text-gray-400">
                <th class="text-left py-3">{{ __('Customer') }}</th>
                <th class="w-32 text-center py-3">{{ __('Items') }}</th>
                <th class="w-36 text-right py-3">{{ __('Total') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-sm dark:text-gray-200">
                <td class="font-normal py-2 capitalize">Malcolm Lockyer</td>
                <td class="text-center py-2">1</td>
                <td class="text-right py-2">{{ currencyFormatted($number) }}</td>
            </tr>
            <tr class="text-sm dark:text-gray-200">
                <td class="font-normal py-2 capitalize">Malcolm Lockyer</td>
                <td class="text-center py-2">4</td>
                <td class="text-right py-2">{{ currencyFormatted($number + 1200) }}</td>
            </tr>
        </tbody>
    </table>
</div>
{{-- Avergar Order --}}
