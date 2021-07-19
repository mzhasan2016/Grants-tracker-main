<x-layout title="Reset Password">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full px-6">
            <h2 class="text-3xl font-bold text-center leading-9 font-display">
                Reset your password
            </h2>
            <p class="mt-5 text-sm leading-5 text-center text-gray-600">
                Enter your email and the new password you'd like to use to access your account.
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-5">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="rounded-md shadow-sm">
                    <div>
                        <input required id="email" name="email" value="{{ old('email', $request->email) }}" type="email" aria-label="Email address" placeholder="Email address" class="@if ($errors->any()) appearance-none rounded-none relative block w-full px-3 py-2 border border-red-400 placeholder-red-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-red focus:z-10 sm:text-sm sm:leading-5 @else appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5 @endif">
                    </div>
                    <div class="-mt-px">
                        <input required id="password" name="password" type="password" aria-label="Password" placeholder="Password" class="@if ($errors->any()) appearance-none rounded-none relative block w-full px-3 py-2 border border-red-400 placeholder-red-500 text-gray-900 focus:outline-none focus:shadow-outline-red focus:z-10 sm:text-sm sm:leading-5 @else appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5 @endif">
                    </div>
                    <div class="-mt-px">
                        <input required id="password_confirmation" name="password_confirmation" type="password" aria-label="Confirm password" placeholder="Confirm password" class="@if ($errors->any()) appearance-none rounded-none relative block w-full px-3 py-2 border border-red-400 placeholder-red-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-red focus:z-10 sm:text-sm sm:leading-5 @else appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5 @endif">
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <p class="mt-2 text-sm leading-5 text-red-600">
                        {{ $error }}
                    </p>
                @endforeach
                <div class="mt-5">
                    <button type="submit" class="relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
