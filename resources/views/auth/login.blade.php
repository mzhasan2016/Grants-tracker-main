<x-layout title="Log in">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full px-6">
            <x-logo class="mx-auto h-28 w-auto" />
            <p class="mt-4 text-center text-sm leading-5 text-gray-600 max-w">
                Log in to your account
            </p>

            <form method="POST" action="{{ route('login') }}" class="mt-8">
                @csrf
                <div class="rounded-md shadow-sm">
                    <div>
                        <input required id="email" name="email" value="{{ old('email') }}" type="email" aria-label="Email address" placeholder="Email address" class="@if ($errors->any()) appearance-none rounded-none relative block w-full px-3 py-2 border border-red-400 placeholder-red-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-red focus:z-10 sm:text-sm sm:leading-5 @else appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5 @endif">
                    </div>
                    <div class="-mt-px">
                        <input required id="password" name="password" type="password" aria-label="Password" placeholder="Password" class="@if ($errors->any()) appearance-none rounded-none relative block w-full px-3 py-2 border border-red-400 placeholder-red-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-red focus:z-10 sm:text-sm sm:leading-5 @else appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5 @endif">
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <p class="mt-2 text-sm leading-5 text-red-600">
                        {{ $error }}
                    </p>
                @endforeach

                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <label for="remember" class="ml-2 block text-sm leading-5 text-gray-900">Remember me</label>
                    </div>

                    <div class="text-sm leading-5">
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Register for an account
                        </a>
                    </div>
                </div>

                <!Zee's Code!>
                <div class="mt-6">
                    <div class="text-sm leading-5 password_request">
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y pl-3">
                            <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
