<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
    <!-- font awesome -->

    <!-- font awesome -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend') }}/output.css" />
</head>

<body>
    <div class="container flex items-center justify-center py-20 border mobile-container bg-gray-50">
        <div class="flex flex-col w-3/5 gap-4">
            <h1 class="text-4xl font-semibold text-center text-gray-600">
                Cresent
            </h1>
            <p class="text-xl font-semibold text-center text-slate-700 whitespace-nowrap">
                Sign up to your free account
            </p>
            <div class="w-full form-wrapper">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('customer.register.post') }}" class="grid grid-cols-1 gap-4 pt-5 sm:grid-cols-2"
                    method="POST">
                    @csrf

                    <div class="flex flex-col gap-4">
                        <label for="name" class="font-semibold text-slate-600">Your Name</label>
                        <input type="text" name="name"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Your name" />
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="email" class="font-semibold text-slate-600">Your Email</label>
                        <input type="email" name="email"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Your email" />
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="password" class="font-semibold text-slate-600">Password</label>
                        <input type="password" name="password"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Your password" />
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="confirm-password" class="font-semibold text-slate-600">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Confirm password" />
                        @error('password_confirmation')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-3 lg:flex-row">
                        <button class="px-5 py-2 font-semibold text-white bg-red-500 rounded shadow">
                            Sign up
                        </button>
                    </div>
                    <div class="flex justify-center mt-3 lg:justify-end">
                        <a class="text-lg font-normal text-red-500 border-b"
                            href="{{ route('customer.login') }}">Already have an account? sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        <!-- Bootstrap Bundle with Popper
        -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    </script>
</body>

</html>
