@extends('installer::layout')
 
@section('header')
    <h2 class="text-3xl font-semibold tracking-tight text-gray-950">Register User</h2>
    <p class="mt-2 text-base text-gray-600">Create a user account</p>
@endsection
 
@section('content')
    <form class="space-y-4" action="{{ route('installer::create-user.store') }}" method="POST">
        @csrf

        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Full name</label>
            <input id="name" name="name" type="text" required autocomplete="name" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email address</label>
            <input id="email" name="email" type="email" required autocomplete="email" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-gray-700">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
            </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-gray-900 py-3 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">Complete</button>
        </div>
    </form>
@endsection