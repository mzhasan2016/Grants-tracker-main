<x-layout title="Password reset">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full px-6">
            <h2 class="text-3xl font-bold text-center leading-9 font-display">
                Reset your password
            </h2>
            <p class="mt-5 text-sm leading-5 text-center text-gray-600">
                Enter your email and we'll send you a link to reset your password.
            </p>

            <form method="POST" action="{{ route('password.email') }}" class="mt-5">
                @csrf
                <div class="rounded-md shadow-sm">
                    <input aria-label="Email address" name="email" type="email" required autofocus placeholder="Email address" class="@if ($errors->any()) border-red-400 placeholder-red-500 focus:shadow-outline-red appearance-none relative block w-full px-3 py-2 border text-gray-900 rounded-md focus:outline-none sm:text-sm sm:leading-5 @else border-gray-300 placeholder-gray-500 focus:shadow-outline-blue focus:border-blue-300 appearance-none relative block w-full px-3 py-2 border text-gray-900 rounded-md focus:outline-none sm:text-sm sm:leading-5 @endif">
                </div>
                @foreach ($errors->all() as $error)
                    <p class="mt-2 text-sm leading-5 text-red-600">
                        {{ $error }}
                    </p>
                @endforeach
                @if (session('status'))
                    <p class="mt-2 text-sm leading-5 text-blue-600">
                        {{ session('status') }}
                    </p>
                @endif

                <div class="mt-5">
                    <button type="submit" class="relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        Send password reset email
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
