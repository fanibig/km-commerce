<table class="table-fixed w-full">
    <thead class="border-b border-gray-200 dark:border-gray-500">
        <tr class="text-sm dark:text-gray-400">
            <th class="text-left py-3">{{ __('Products') }}</th>
            <th class="w-32 text-center py-3">{{ __('Price') }}</th>
            <th class="w-36 text-right py-3">{{ __('Quantity') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-sm dark:text-gray-200">
            <td class="font-bold text-md py-2">Malcolm Lockyer</td>
            <td class="text-center py-2">{{ currencyFormatted($number) }}</td>
            <td class="text-right py-2">1</td>
        </tr>
        <tr class="text-sm dark:text-gray-200">
            <td class="font-bold text-md py-2">Malcolm Lockyer</td>
            <td class="text-center py-2">{{ currencyFormatted($number + 1200) }}</td>
            <td class="text-right py-2">4</td>
        </tr>
    </tbody>
</table>
