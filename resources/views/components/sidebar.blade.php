<aside class="w-64 bg-white border-r border-slate-200 min-h-screen px-4 py-6">
    {{-- Brand --}}
    <div class="flex items-center gap-2 mb-10">
        <div class="w-9 h-9 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold">
            S
        </div>
        <span class="text-lg font-semibold text-slate-900">
            SalesPro CRM
        </span>
    </div>

    {{-- Menu --}}
    <nav class="space-y-2">
        <a href="/dashboard"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  bg-emerald-50 text-emerald-600 font-medium">
            📊 Overview
        </a>

        <a href="/leads"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  text-slate-600 hover:bg-slate-100">
            👥 Leads
        </a>

        <a href="/contacts"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  text-slate-600 hover:bg-slate-100">
            📇 Contacts
        </a>

        <a href="/deals"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  text-slate-600 hover:bg-slate-100">
            💼 Deals
        </a>

        <a href="/reports"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  text-slate-600 hover:bg-slate-100">
            📈 Reports
        </a>

        <a href="/documents"
           class="flex items-center gap-3 px-4 py-2 rounded-xl 
                  text-slate-600 hover:bg-slate-100">
            📄 Documents
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