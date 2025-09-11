@extends('admin.layouts.app')

@section('title', 'گزارش فعالیت‌ها')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">@yield('title')</h1>
        <p class="text-gray-600">تاریخچه تمام فعالیت‌های مهم انجام شده در سیستم.</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold text-gray-700">آخرین فعالیت‌ها</h2>
        </div>
        
        <div class="space-y-2">
            @forelse ($activities as $activity)
                @php
                    $icon = 'bi-info-circle';
                    $color = 'gray';
                    if ($activity->event === 'created') {
                        $icon = 'bi-plus-circle';
                        $color = 'green';
                    } elseif ($activity->event === 'updated') {
                        $icon = 'bi-pencil-square';
                        $color = 'blue';
                    } elseif ($activity->event === 'deleted') {
                        $icon = 'bi-trash';
                        $color = 'red';
                    }
                @endphp

                <div class="p-4 border-b border-gray-200 hover:bg-gray-50" x-data="{ open: false }">
                    <div class="flex items-center justify-between cursor-pointer" @click="open = !open">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center">
                                <i class="bi {{ $icon }} text-{{ $color }}-600 text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-gray-800 font-semibold">
                                    @if ($activity->causer)
                                        <span class="text-{{ $color }}-700">{{ $activity->causer->name }}</span>
                                    @else
                                        <span class="text-gray-600">سیستم</span>
                                    @endif
                                    {{ $activity->description }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($activity->created_at)->format('Y/m/d ساعت H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                             @if ($activity->properties->count() > 0)
                                <i class="bi bi-chevron-down transition-transform" :class="{ 'rotate-180': open }"></i>
                             @endif
                        </div>
                    </div>
                    
                    @if ($activity->properties->count() > 0)
                        <div class="mt-4 pr-14 pl-4 text-sm" x-show="open" x-collapse>
                            <div class="bg-gray-100 p-3 rounded-lg border border-gray-200">
                                <h4 class="font-semibold mb-2 text-gray-700">جزئیات تغییرات:</h4>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($activity->properties as $key => $value)
                                        @if ($key === 'attributes' || $key === 'old')
                                            @foreach ($value as $attr => $attrValue)
                                                <li>
                                                    <span class="font-medium">{{ ucfirst($attr) }}:</span> 
                                                    @if(is_array($attrValue))
                                                        <pre class="inline-block bg-white p-1 rounded text-xs">{{ json_encode($attrValue) }}</pre>
                                                    @else
                                                        <span class="text-gray-600">{{ $attrValue }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <i class="bi bi-x-circle text-4xl mb-3"></i>
                    <p>هیچ فعالیتی برای نمایش وجود ندارد.</p>
                </div>
            @endforelse
        </div>
        
        <div class="p-4 bg-gray-50 border-t">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection

@section('additional-scripts')
    <!-- Alpine.js for handling the collapsible details section -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('additional-styles')
    <!-- Bootstrap Icons for the new UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
@endsection
