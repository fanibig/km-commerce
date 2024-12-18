<x-admin-layout :title="$pageTitle">
    <x-slot name="header">{{ $pageTitle }}</x-slot>

    @include('admin.includes.top-cards')
    @include('admin.includes.big-cards')

    <div class="container max-w-full mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-4">
            <div class="col-span-1 sm:col-span-1 md:col-span-1 lg:col-span-4">
                <div class="lifetime-sales mb-8">
                    <h2 class="text-xl font-bold text-black mb-2 tracking-wide dark:text-gray-200">{{ __('Lifetime Sales') }}</h2>
                    <div class="text-2xl text-orange-600 font-bold">
                        @php
                            $number = 1234.50;
                        @endphp
                        {{ shortenFormattedCurrency($number + 1200) }}
                    </div>
                </div>
                {{-- Lifetime sales column --}}

                <div class="average-orders mb-8">
                    <h2 class="text-xl font-bold text-black mb-2 tracking-wide dark:text-gray-200">{{ __('Average Orders') }}</h2>
                    <div class="text-2xl text-gray-600 font-bold dark:text-gray-400">
                        @php
                            $number = 1234.50;
                        @endphp
                        {{ shortenFormattedCurrency($number / 2) }}
                    </div>
                </div>
                {{-- Average Order --}}

                @include('admin.includes.latest-orders')

                {{-- Multiple tabs  --}}
                @include('admin.includes.multiple-tabs-dashboard')
            </div>

            <div class="col-span-1 sm:col-span-1 md:col-span-1 lg:col-span-8">
                <div class="dashboard-chart mb-5">
                    <x-chart
                        id="salesChart"
                        type="doughnut"
                        :data="$chartData"
                        :options="$chartOptions"
                    />
                </div>
                @include('admin.includes.tabs-dashboard')
            </div>
        </div>
    </div>
</x-admin-layout>
