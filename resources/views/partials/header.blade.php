<div class="header">
    <h1 class="text-2xl font-bold">Dashboard Guru</h1>

    <div class="flex items-center gap-4">
        <button class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0B1D51]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 block h-2 w-2 bg-red-600 rounded-full"></span>
        </button>

        <div class="flex items-center gap-3">
            <p class="font-semibold">{{ Auth::user()->name ?? 'Guru' }}</p>
            <div class="avatar">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</div>
        </div>
    </div>
</div>
