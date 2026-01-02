<header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
    {{-- Search --}}
    <div class="w-1/2">
        <input type="text" placeholder="Search leads, contacts, deals..."
               class="w-full rounded-xl border border-slate-200 px-4 py-2
                      focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
    </div>

    {{-- Right Actions --}}
    <div class="flex items-center gap-4">
        {{-- Notification --}}
        <button class="relative text-slate-500 hover:text-slate-700">
            🔔
            <span class="absolute -top-1 -right-1 bg-emerald-500 text-white text-xs 
                         rounded-full px-1.5">
                3
            </span>
        </button>

        {{-- Profile --}}
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-medium text-slate-900">
                    {{ auth()->user()->name ?? 'Alex Morgan' }}
                </p>
                <p class="text-xs text-slate-500">
                    Sales Manager
                </p>
            </div>

            <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 
                        flex items-center justify-center font-semibold">
                AM
            </div>

            {{-- Logout --}}
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="text-sm text-slate-500 hover:text-red-500">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
