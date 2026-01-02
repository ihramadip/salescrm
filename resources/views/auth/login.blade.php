<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SalesPro CRM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-emerald-50 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h1 class="text-2xl font-semibold text-slate-900 mb-1">
        Welcome back
    </h1>
    <p class="text-sm text-slate-500 mb-6">
        Login to your SalesPro CRM
    </p>

    <form method="POST" action="/login" class="space-y-4">
        @csrf

        {{-- General Error Display --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Something went wrong.</span>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="text-sm text-slate-600">Email</label>
            <input type="email" name="email" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 @error('email') border-red-500 @enderror"
                value="{{ old('email') }}">
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="text-sm text-slate-600">Password</label>
            <input type="password" name="password" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus="ring-emerald-400 focus:border-emerald-400 @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white 
                   font-semibold py-3 rounded-xl transition">
            Sign In
        </button>
    </form>

    <p class="text-sm text-center text-slate-500 mt-6">
        Don’t have an account?
        <a href="/register" class="text-emerald-600 font-medium hover:underline">
            Sign up
        </a>
    </p>
</div>

</body>
</html>