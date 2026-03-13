        @props(['active' => ''])

        @php
            $user = auth()->user();

            $navItemClasses = static fn (string $item): string => $active === $item
                ? 'flex items-center gap-3 px-5 py-3 rounded-xl bg-primary/10 text-primary font-bold'
                : 'flex items-center gap-3 px-5 py-3 rounded-xl text-[#638863] dark:text-[#a0b0a0] transition-colors hover:bg-primary/10 hover:text-primary';
        @endphp

        <aside class="w-72 bg-white dark:bg-[#1a2a1a] border-l border-[#dce5dc] dark:border-[#2a3a2a] flex flex-col">
            <div class="p-6 border-b border-[#dce5dc] dark:border-[#2a3a2a] flex items-center gap-4">
                <div class="size-10 bg-primary rounded-xl flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-2xl">child_care</span>
                </div>
                <div>
                    <h2 class="text-lg font-bold leading-tight">نظام إدارة الحضانة</h2>
                </div>
            </div>

            <div class="p-6">
                <label class="flex flex-col">
                    <div class="flex w-full items-stretch rounded-xl overflow-hidden border border-[#dce5dc] dark:border-[#2a3a2a]">
                        <div class="bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] flex items-center justify-center px-4">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </div>
                        <input class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] border-none focus:ring-0 placeholder:text-[#638863] px-4 py-3 text-base" placeholder="بحث عن فصل..." value="" />
                    </div>
                </label>
            </div>

            <nav class="flex flex-col gap-2 px-4 flex-1">
                <a class="{{ $navItemClasses('dashboard') }}" href="{{ route('teacher.teacherdashboard') }}">
                    <span class="material-symbols-outlined">home</span>
                    الرئيسية
                </a>
                <a class="{{ $navItemClasses('levels') }}" href="{{ route('teacher.levels.index') }}">
                    <span class="material-symbols-outlined">groups</span>
                    الفصول
                </a>
                <a class="{{ $navItemClasses('reports') }}" href="{{ route('teacher.reports') }}">
                    <span class="material-symbols-outlined">description</span>
                    التقارير
                </a>
                <a class="{{ $navItemClasses('messages') }}" href="{{ route('teacher.messages') }}">
                    <span class="material-symbols-outlined">chat_bubble</span>
                    الرسائل
                </a>
            </nav>

            <div class="p-6 border-t border-[#dce5dc] dark:border-[#2a3a2a] flex items-center gap-4">
                <div class="bg-center bg-cover rounded-full size-12 border-2 border-primary" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA-NWq3LGx-QdmdnVL0WxNPG-VwwZK1NCc9Mj53x3yw5XhAJ3DIfCVftHnyYny6HViotlVBVUIW9ZPYMpklXDKdhjP-7J9bBTkMkx32TSOO6k9aiZgqTbXpKf9p0jL7ycUzJr3fQbKnGs7htazQvmO8zPYdFbS7Qo7FhxFhXOQKX-t8vad7Kbp2hBbJ5km2WtYLv6GvXQJqwHrvCveb8afZYJTYakHfakW9ruSuAJKsx-Lrl5T72Za2YeX4bXeErPTynTfMORrhbDu7');"></div>
                <div>
                    <p class="font-bold">{{ $user?->name ?? 'مستخدم النظام' }}</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0]">{{ $user?->specialization ?? $user?->role ?? 'معلم' }}</p>
                </div>
            </div>

            <div class="p-4 relative">
                <button class="w-full flex items-center justify-center gap-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] hover:bg-primary hover:text-white text-[#111811] dark:text-white py-3 rounded-xl transition-colors relative">
                    <span class="material-symbols-outlined">notifications</span>
                    الإشعارات
                    <span class="absolute top-2 right-4 size-2 bg-red-500 rounded-full"></span>
                </button>
            </div>

            <div class="px-4 pb-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-xl bg-red-50 py-3 text-red-600 transition-colors hover:bg-red-100">
                        <span class="material-symbols-outlined">logout</span>
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </aside>
