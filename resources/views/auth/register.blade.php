<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | SalesPro CRM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-emerald-50 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h1 class="text-2xl font-semibold text-slate-900 mb-1">
        Create account
    </h1>
    <p class="text-sm text-slate-500 mb-6">
        Start managing your sales efficiently
    </p>

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm text-slate-600">Full Name</label>
            <input type="text" name="name" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
        </div>

        <div>
            <label class="text-sm text-slate-600">Email</label>
            <input type="email" name="email" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
        </div>

        <div>
            <label class="text-sm text-slate-600">Password</label>
            <input type="password" name="password" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
        </div>

        <div>
            <label class="text-sm text-slate-600">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 
                       focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
        </div>

        <button type="submit"
            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white 
                   font-semibold py-3 rounded-xl transition">
            Create Account
        </button>
    </form>

    <p class="text-sm text-center text-slate-500 mt-6">
        Already have an account?
        <a href="/login" class="text-emerald-600 font-medium hover:underline">
            Sign in
        </a>
    </p>
</div>

</body>
</html>