@extends('installer::layout')
 
@section('header')
    <h2 class="text-3xl font-semibold tracking-tight text-gray-950">Server Requirements</h2>
    <p class="mt-2 text-base text-gray-600">Check your web server configuration for any items with a red check mark.</p>
@endsection
 
@section('content')

    @foreach ($requirements as $value => $key)
    <div class="flex justify-between items-center space-y-2">
        <div class="text-sm text-gray-600">{!! $value !!}</div>

        <div>
            @if($key)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-500 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
        </div>
    </div>
    @endforeach

    @if(count(array_unique($requirements)) === 1)
        <div class="mt-5">
            <a href="{{ route('installer::configuration.index') }}" class="flex w-full justify-center rounded-md border border-transparent bg-gray-900 py-3 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">Next Step</a>
        </div>
    @else
        <div class="p-4 mt-5 text-sm rounded-md bg-yellow-50 text-yellow-700" role="alert">
            Make sure your web server complies with the following requirements before you can continue.
        </div>
    @endif

@endsection