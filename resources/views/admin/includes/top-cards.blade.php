@php
    $number = 90;
    $products =150;
    $result = ($number / $products) * 100;
    $percentage = round($result, 0);
@endphp
<div class="grid grid-cols-1 sm:grid-cols-12 md:grid-cols-12 gap-4 items-center justify-start my-4">
    <div class="col-span-1 sm:col-span-6 md:col-span-3">
        <div class="flex items-center justify-start py-1.5 px-2 bg-amber-500 shadow-md rounded-md hover:scale-[1.02] transition-all">
            <div class="icon-box mr-3 p-2 rounded-md bg-amber-900">
                <i class="fa-solid fa-box text-6xl text-amber-50"></i>
            </div>
            <div class="detail-box w-full flex flex-col justify-between">
                <div class="cart-heading text-amber-200">{{ __('Orders') }} <small>{{ __('(26)') }}</small></div>

                <div class="cart-heading text-amber-200">{{ shortenFormattedCurrency(14000) }}</div>
            </div>
        </div>
    </div>

    <div class="col-span-1 sm:col-span-6 md:col-span-3">
        <div class="flex items-center justify-start py-1.5 px-2 bg-cyan-500 shadow-md rounded-md hover:scale-[1.02] transition-all">
            <div class="icon-box mr-3 p-2 rounded-md bg-cyan-900">
                <i class="fa-solid fa-box text-6xl text-cyan-50"></i>
            </div>
            <div class="detail-box w-full flex flex-col justify-between">
                <div class="cart-heading text-cyan-200">{{ __('Products') }} <small>{{ __('(150)') }}</small></div>

                <div class="cart-heading">
                    <a href="#" class="text-cyan-200 text-sm">{{ __('Detail') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-1 sm:col-span-6 md:col-span-3">
        <div class="flex items-center justify-start py-1.5 px-2 bg-green-500 shadow-md rounded-md hover:scale-[1.02] transition-all">
            <div class="icon-box mr-3 p-2 rounded-md bg-green-900">
                <i class="fa-solid fa-box text-6xl text-green-50"></i>
            </div>
            <div class="detail-box w-full flex flex-col justify-between">
                <div class="cart-heading text-green-200">{{ __('Customers') }} <small>{{ __('(50)') }}</small></div>

                <div class="cart-heading">
                    <a href="#" class="text-green-200 text-sm">{{ __('Detail') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-1 sm:col-span-6 md:col-span-3">
        <div class="flex items-center justify-start py-1.5 px-2 bg-purple-600 shadow-md rounded-md hover:scale-[1.02] transition-all">
            <div class="icon-box mr-3 p-2 rounded-md bg-purple-900">
                <i class="fa-solid fa-box text-6xl text-purple-50"></i>
            </div>
            <div class="detail-box w-full flex flex-col justify-between">

                <div class="cart-heading text-purple-200">{{ __('Sales') }} <small>{{ __($number) }}</small></div>

                <div class="cart-heading">
                    <a href="#" class="text-purple-200 text-sm">{{ __('Detail') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
