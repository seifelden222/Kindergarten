@props(['active' => '', 'activePage' => ''])

@php
    $currentPage = $activePage ?: $active;

    $navItemClasses = static fn (string $item): string => $currentPage === $item
        ? 'flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 text-[#111811] dark:text-primary font-bold'
        : 'flex items-center gap-3 px-4 py-3 rounded-xl text-[#638863] dark:text-[#a3c2a3] transition-colors hover:bg-gray-100 dark:hover:bg-white/5';
@endphp

<aside class="w-72 bg-white dark:bg-[#1a2e1a] border-l border-[#dce5dc] dark:border-[#2d402d] flex flex-col justify-between p-6 overflow-y-auto">
    <div class="flex flex-col gap-8">
        <div class="flex items-center gap-3 px-2">
            <div class="bg-primary rounded-xl p-2 flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-3xl">child_care</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-lg font-bold leading-tight">نظام الحضانة</h1>
                <p class="text-[#638863] dark:text-[#a3c2a3] text-xs">بوابة أولياء الأمور</p>
            </div>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="{{ $navItemClasses('dashboard') }}" href="{{ route('parent.parentdashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">الرئيسية</span>
            </a>
            <a class="{{ $navItemClasses('activities') }}" href="{{ route('parent.activities') }}">
                <span class="material-symbols-outlined">auto_stories</span>
                <span class="text-sm">الأنشطة</span>
            </a>
            <a class="{{ $navItemClasses('absence') }}" href="{{ route('parent.absence') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="text-sm">الحضور والغياب</span>
            </a>
            <a class="{{ $navItemClasses('calendar') }}" href="{{ route('parent.calendar') }}">
                <span class="material-symbols-outlined">event_note</span>
                <span class="text-sm">التقويم</span>
            </a>
            <a class="{{ $navItemClasses('notification') }}" href="{{ route('parent.notification') }}">
                <span class="material-symbols-outlined">notifications</span>
                <span class="text-sm">التنبيهات</span>
                <span class="mr-auto bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">3</span>
            </a>
            <a class="{{ $navItemClasses('messages') }}" href="{{ route('parent.messages') }}">
                <span class="material-symbols-outlined">chat</span>
                <span class="text-sm">التواصل</span>
            </a>
        </nav>
    </div>
    <div class="flex flex-col gap-4">
        <div class="bg-zinc-50 dark:bg-zinc-800/50 p-4 rounded-xl flex items-center gap-3">
            <div class="size-10 rounded-full bg-cover bg-center border-2 border-primary" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAgiplVXOh0xcoOTBaM8Ak_8PGDlffuK4F6klF_Pm5GBw3eAy5V-afsqUc_UqjKsutDmMQiIpaJrD8tZMcAj1yXv42k_lqP36nrivBiGMCrWEl9z200-ePOa72Qs7Ka2TZQ0fOgeyrU3UNn5KaEj9ulGOklBXbFnQT3RdPecrXXKhOlooj5hO_cF-bBRIGJOhxrBIIbphXui0CJG2JWrk1AXFkpatglk5EgSSHDwyd7yIiQPdn4texHrh7297piAupNUjfcmqIkNFnd')"></div>
            <div class="flex flex-col truncate">
                <span class="text-sm font-bold truncate">{{ auth()->user()?->name ?? 'مستخدم النظام' }}</span>
                <span class="text-[10px] text-zinc-500 uppercase tracking-wider">{{ auth()->user()?->role ?? 'user' }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-medium">تسجيل الخروج</span>
            </button>
        </form>
    </div>
</aside>
