@extends('frontend.master')
@section('frontend_content')
    <div class="container flex items-center justify-center py-12 mobile-container">
        <div class="md:w-[500px] shadow-md  flex items-center justify-center flex-col w-[400px] rounded-lg px-6 py-4">

            <h2 class="font-semibold text-gray-700 md:text-xl sm:text-lg">Update Password </h2>
            @if (session('success'))
                <div class="w-full px-3 py-2 my-3 text-sm font-semibold rounded-lg bg-emerald-200">{{ session('success') }}
                </div>
            @endif
            @if (session('expired'))
                <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">{{ session('expired') }}</div>
            @endif
            <div class="flex flex-col w-full gap-3 mt-4">
                <form action="{{ route('new.pass.update', $token) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="text-sm font-semibold text-slate-600">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-2 py-2 my-3 border rounded outline-none ring-1 ring-slate-500 focus:ring-red-500 focus:outline-none focus:ring-1 ">
                        @error('password')
                            <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">{{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="text-sm font-semibold text-slate-600">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-2 py-2 my-3 border rounded outline-none ring-1 ring-slate-500 focus:ring-red-500 focus:outline-none focus:ring-1 ">
                        @error('password_confirmation')
                            <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-2">
                        <button type="submit"
                            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
