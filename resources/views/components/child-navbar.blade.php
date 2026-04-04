    <div
        class="sticky top-0 z-50 bg-white/90 dark:bg-[#322820]/90 backdrop-blur-md shadow-lg border-b-4 border-primary/30">
        <div class="max-w-[1200px] mx-auto px-6 py-5">
            <div class="flex justify-between items-center gap-4">
                <div class="flex items-center gap-5">
                    <div class="bg-primary p-5 rounded-full shadow-xl text-white">
                        <span class="material-symbols-outlined">face_6</span>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight text-primary">مرحباً يا نجم!</h1>
                        <p class="text-xl text-[#8a7560] dark:text-[#cbb8a6]">اليوم يوم ممتع!</p>
                    </div>
                </div>

                <div class="hidden md:flex gap-6 lg:gap-10">
                    <a href="{{ route('child.home') }}" class="flex flex-col items-center gap-2 group">
                        <div
                            class="bg-primary/10 group-hover:bg-primary/30 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                            <span class="material-symbols-outlined nav-icon text-primary">home</span>
                        </div>
                        <span class="text-xl font-bold">الرئيسية</span>
                    </a>

                    <a href="{{ route('child.activties') }}" class="flex flex-col items-center gap-2 group">
                        <div
                            class="bg-primary/10 group-hover:bg-primary/30 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                            <span class="material-symbols-outlined nav-icon text-primary">draw</span>
                        </div>
                        <span class="text-xl font-bold">الأنشطة</span>
                    </a>

                    <a href="{{ route('child.attendance') }}" class="flex flex-col items-center gap-2 group">
                        <div
                            class="bg-primary/10 group-hover:bg-primary/30 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                            <span class="material-symbols-outlined nav-icon text-primary">how_to_reg</span>
                        </div>
                        <span class="text-xl font-bold">تسجيل الحضور</span>
                    </a>

                    <a href="{{ route('child.surprise') }}" class="flex flex-col items-center gap-2 group">
                        <div
                            class="bg-primary/10 group-hover:bg-primary/30 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                            <span class="material-symbols-outlined nav-icon text-primary">emoji_events</span>
                        </div>
                        <span class="text-xl font-bold">المكافآت</span>
                    </a>

                    <a href="{{ route('child.teachertalk') }}" class="flex flex-col items-center gap-2 group">
                        <div
                            class="bg-primary/10 group-hover:bg-primary/30 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                            <span class="material-symbols-outlined nav-icon text-primary">support_agent</span>
                        </div>
                        <span class="text-xl font-bold">المعلمين</span>
                    </a>
                </div>

                <div class="flex items-center gap-5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex flex-col items-center gap-2 group">
                            <div
                                class="bg-red-100 group-hover:bg-red-200 p-5 rounded-3xl transition-all shadow-md group-hover:scale-110">
                                <span class="material-symbols-outlined nav-icon text-red-500">logout</span>
                            </div>
                            <span class="text-xl font-bold text-red-500">الخروج</span>
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
