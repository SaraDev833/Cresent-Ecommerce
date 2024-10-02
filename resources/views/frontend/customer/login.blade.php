<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <!-- font awesome -->

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- font awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend') }}/output.css" />
</head>

<body>
    <div class="container flex items-center justify-center py-20 border mobile-container bg-gray-50">
        <div class="flex flex-col w-3/5 gap-4">
            <h1 class="text-4xl font-semibold text-center text-gray-600">
                Cresent
            </h1>
            <p class="text-xl font-semibold text-center text-slate-700">
                Sign in to your account
            </p>


            <div class="flex flex-col items-center justify-center w-full form-wrapper ">

                <form action="{{ route('customer.login.post') }}" method="POST"
                    class="grid items-center justify-center grid-cols-1 gap-4 pt-5">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <label for="email" class="font-semibold text-slate-600">Your Email</label>
                        @if (session('exist'))
                            <div class="alert alert-danger">{{ session('exist') }}</div>
                        @endif
                        <input type="email" name="email"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Your email" />
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="password" class="font-semibold text-slate-600">Password</label>
                        @if (session('pass_error'))
                            <div class="alert alert-danger">{{ session('pass_error') }}</div>
                        @endif
                        <input type="password" name="password"
                            class="w-full px-2 py-2 border rounded outline-none ring-1 ring-slate-500 placeholder:text-slate-500 focus:ring-red-500"
                            placeholder="Your password" />
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-row items-center justify-between">
                        <label for="remember">
                            <input type="checkbox" name="remember"
                                class="text-red-500 form-checkbox focus:outline-none focus:ring-0">
                            <span class="text-sm font-semibold text-slate-600">Remember me</span>
                        </label>
                        <a href="{{ route('pass.reset.req') }}"
                            class="text-sm font-semibold border-b border-red-500 text-slate-600">Forgot Password?</a>
                    </div>

                    <div class="flex flex-col gap-7 lg:flex-row lg:justify-between lg:items-center">
                        <button class="px-5 py-2 font-semibold text-white bg-red-500 rounded shadow whitespace-nowrap">
                            Sign in
                        </button>
                        <a class="text-lg font-normal text-red-500 border-b"
                            href="{{ route('customer.register') }}">Don't have an account? sign up</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
