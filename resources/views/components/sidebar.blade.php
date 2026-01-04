<aside class="w-64 bg-white border-r border-slate-200 min-h-screen px-4 py-6">
    {{-- Brand --}}
    <div class="flex items-center gap-2 mb-10">
        <svg class="w-9 h-9" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 7C15 9.20914 13.2091 11 11 11H8" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 17C9 14.7909 10.7909 13 13 13H16" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="text-lg font-semibold text-slate-900">
            CRM
        </span>
    </div>

    {{-- Menu --}}
    <nav class="flex flex-col space-y-2">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span>Overview</span>
        </a>

        <a href="{{ route('leads.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('leads.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Leads</span>
        </a>

        <a href="{{ route('contacts.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('contacts.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0L15 2m-5 4v6" />
            </svg>
            <span>Contacts</span>
        </a>

        <a href="{{ route('companies.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('companies.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span>Companies</span>
        </a>

        <a href="{{ route('deals.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('deals.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01M18 10a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
            <span>Deals</span>
        </a>

        <a href="{{ route('tasks.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('tasks.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M10 12h.01" />
            </svg>
            <span>Tasks</span>
        </a>

        <a href="{{ route('sales-targets.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('sales-targets.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span>Sales Targets</span>
        </a>

        <a href="{{ route('revenues.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('revenues.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Revenues</span>
        </a>

        <a href="{{ route('documents.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('documents.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Documents</span>
        </a>

        <a href="{{ route('activities.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl
                  {{ request()->routeIs('activities.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Activities</span>
        </a>

        <a href="{{ route('reports.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  {{ request()->routeIs('reports.*') ? 'bg-emerald-50 text-emerald-600 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span>Reports</span>
        </a>


    </nav>

    {{-- Divider --}}
    <div class="border-t border-slate-200 my-6"></div>

    {{-- Quick Stats --}}
    <div>
        <h4 class="text-xs font-semibold text-slate-400 uppercase mb-3">
            Quick Stats
        </h4>

        <div class="space-y-2 text-sm">
            <div class="flex justify-between text-slate-600">
                <span>Open Deals</span>
                <span class="font-medium text-emerald-600">77</span>
            </div>

            <div class="flex justify-between text-slate-600">
                <span>Win Rate</span>
                <span class="font-medium text-emerald-600">68%</span>
            </div>

            <div class="flex justify-between text-slate-600">
                <span>Avg Deal Size</span>
                <span class="font-medium text-emerald-600">$38K</span>
            </div>
        </div>
    </div>
</aside>