@extends('frontend.master')
@section('frontend_content')
    <div class="container flex items-center justify-center py-12 mobile-container">

        <div class="md:w-[500px] shadow-md  flex items-start justify-center flex-col w-[400px] rounded-lg px-6 py-4">

            <h2 class="font-semibold text-gray-700 md:text-xl sm:text-lg">Enter your Email </h2>
            @if (session('success'))
                <div class="w-full px-3 py-2 my-3 text-sm font-semibold rounded-lg"
                    style="background-color: rgb(168, 192, 168)">{{ session('success') }}</div>
            @endif
            @if (session('invalid'))
                <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">{{ session('invalid') }}</div>
            @endif
            <div class="flex flex-col w-full gap-3 mt-4">
                <form action="{{ route('pass.reset.email') }}" method="POST">
                    @csrf
                    <label for="" class="text-sm font-semibold text-slate-600">Email</label>
                    <input type="email" name="email"
                        class="w-full px-2 py-2 my-3 border rounded outline-none ring-1 ring-slate-500 focus:ring-red-500 focus:outline-none focus:ring-1 placeholder:text-slate-400"
                        placeholder="hello@gmail.com">
                    <div class="flex justify-end mt-2">
                        <button type="submit"
                            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
