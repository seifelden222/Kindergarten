      <aside class="w-72 bg-white dark:bg-zinc-900 border-l border-zinc-200 dark:border-zinc-800 flex flex-col justify-between p-6 shrink-0">
          <div class="flex flex-col gap-8">
              <div class="flex items-center gap-3">
                  <div class="bg-primary/20 p-2 rounded-lg">
                      <span class="material-symbols-outlined text-primary text-3xl">child_care</span>
                  </div>
                  <div class="flex flex-col">
                      <h1 class="text-xl font-bold leading-tight">نظام إدارة الحضانة </h1>
                      <p class="text-zinc-500 dark:text-zinc-400 text-xs">لوحة التحكم الإدارية</p>
                  </div>
              </div>
              <nav class="flex flex-col gap-2">
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/admindashboard')}}">
                      <span class="material-symbols-outlined">dashboard</span>
                      <span class="text-sm font-medium">الرئيسية</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/users')}}">
                      <span class="material-symbols-outlined">group</span>
                      <span class="text-sm font-medium">إدارة المستخدمين</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{ route('admin.academicactivities') }}">
                      <span class="material-symbols-outlined">bar_chart</span>
                      <span class="text-sm font-medium">الأنشطة</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl active-nav transition-all" href="{{url('admin/absense')}}">
                      <span class="material-symbols-outlined">bar_chart</span>
                      <span class="text-sm font-medium">الحضور والغياب</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/reports')}}">
                      <span class="material-symbols-outlined">bar_chart</span>
                      <span class="text-sm font-medium">التقارير</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/tables')}}">
                      <span class="material-symbols-outlined">calendar_month</span>
                      <span class="text-sm font-medium">الجداول الدراسية</span>
                  </a>
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/payment')}}">
                      <span class="material-symbols-outlined">payments</span>
                      <span class="text-sm font-medium">المالية</span>
                  </a>
                  <hr class="my-2 border-zinc-100 dark:border-zinc-800" />
                  <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all" href="{{url('admin/settings')}}">
                      <span class="material-symbols-outlined">settings</span>
                      <span class="text-sm font-medium">إعدادات النظام</span>
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