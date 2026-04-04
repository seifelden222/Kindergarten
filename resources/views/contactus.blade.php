<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <title>اتصل بنا - نظام إدارة الحضانة</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#0ea60e",
            "background-light": "#f6f8f6",
            "background-dark": "#112111",
          },
          fontFamily: {
            "display": ["Cairo", "sans-serif"]
          },
          borderRadius: {
            "DEFAULT": "0.5rem",
            "lg": "1rem",
            "xl": "1.5rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
  <style>
    body {
      font-family: 'Cairo', sans-serif;
    }

    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white transition-colors duration-300">
  <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">

    <header class="sticky top-0 z-50 w-full border-b border-solid border-[#dce5dc] bg-white/80 dark:bg-background-dark/80 backdrop-blur-md px-4 md:px-20 lg:px-40 py-3">
      <div class="flex items-center justify-between whitespace-nowrap">
        <a href="{{ route('register') }}" class="flex items-center gap-4 text-[#111811] dark:text-white">
          <div class="size-8 bg-primary rounded-lg flex items-center justify-center text-white">
            <span class="material-symbols-outlined">child_care</span>
          </div>
          <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">نظام إدارة الحضانة</h2>
        </a>
        <nav class="hidden md:flex flex-1 justify-center gap-8">
          <a class="text-[#111811] dark:text-white text-sm font-medium hover:text-primary transition-colors" href="{{ url('/') }}">الرئيسية</a>
          <a class="text-[#111811] dark:text-white text-sm font-medium hover:text-primary transition-colors" href="{{url('contactus')}}">اتصل بنا</a>
        </nav>
        <div class="flex items-center gap-4">
          <a href="{{ route('login') }}" class="flex min-w-[100px] cursor-pointer items-center justify-center rounded-xl h-10 px-4 bg-primary text-[#111811] text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
            <span class="truncate">بوابة الدخول</span>
          </a>
        </div>
      </div>
    </header>

    <main class="flex-1">

      <section class="px-4 md:px-20 lg:px-40 py-16">
        <div class="flex flex-col gap-10 max-w-5xl mx-auto">
          <div class="text-center">
            <h1 class="text-[#111811] dark:text-white text-4xl md:text-5xl font-black leading-tight tracking-[-0.025em]">
              اتصل <span class="text-primary">بنا</span>
            </h1>
            <p class="mt-5 text-[#638863] dark:text-gray-400 text-lg max-w-2xl mx-auto">
              نحن هنا للإجابة على جميع استفساراتكم – تواصلوا معنا بأي طريقة تفضلونها
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="flex flex-col items-center gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-10 text-center hover:border-primary transition-all shadow-sm hover:shadow-lg">
              <span class="material-symbols-outlined text-primary text-5xl">call</span>
              <h3 class="text-xl font-bold mt-2">اتصال هاتفي</h3>
              <p class="text-[#638863] dark:text-gray-300 mt-1">متاح يومياً</p>
              <a href="tel:+201012345678" class="text-2xl font-bold text-primary mt-3 hover:underline">+20 101 234 5678</a>
            </div>

            <div class="flex flex-col items-center gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-10 text-center hover:border-primary transition-all shadow-sm hover:shadow-lg">
              <span class="material-symbols-outlined text-primary text-5xl">mail</span>
              <h3 class="text-xl font-bold mt-2">البريد الإلكتروني</h3>
              <p class="text-[#638863] dark:text-gray-300 mt-1">رد خلال 24 ساعة</p>
              <a href="mailto:info@nursery.edu.eg" class="text-xl font-medium text-primary mt-3 hover:underline">info@nursery.edu.eg</a>
            </div>

            <div class="flex flex-col items-center gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-10 text-center hover:border-primary transition-all shadow-sm hover:shadow-lg">
              <span class="material-symbols-outlined text-primary text-5xl">location_on</span>
              <h3 class="text-xl font-bold mt-2">موقعنا</h3>
              <p class="text-[#638863] dark:text-gray-300 mt-1">جمهورية مصر العربية</p>
              <p class="text-lg font-medium mt-3">جمهورية مصر العربية</p>
            </div>
          </div>
        </div>
      </section>

      <section class="px-4 md:px-20 lg:px-40 py-16 bg-white dark:bg-background-dark/50">
        <div class="max-w-4xl mx-auto">
          <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#111811] dark:text-white">
              أرسل لنا رسالتك
            </h2>
            <p class="mt-4 text-[#638863] dark:text-gray-400 text-lg">
              املأ النموذج التالي وسوف نرد عليك في أقرب وقت ممكن
            </p>
          </div>

          <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
              <label class="text-sm font-medium">الاسم الكامل</label>
              <input type="text" class="rounded-xl border border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/60 px-4 py-3 focus:border-primary focus:ring-primary outline-none" placeholder="أدخل اسمك الكامل" required>
            </div>

            <div class="flex flex-col gap-2">
              <label class="text-sm font-medium">رقم الجوال</label>
              <input type="tel" class="rounded-xl border border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/60 px-4 py-3 focus:border-primary focus:ring-primary outline-none" placeholder="01xxxxxxxxx" required>
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
              <label class="text-sm font-medium">البريد الإلكتروني</label>
              <input type="email" class="rounded-xl border border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/60 px-4 py-3 focus:border-primary focus:ring-primary outline-none" placeholder="example@email.com" required>
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
              <label class="text-sm font-medium">الموضوع</label>
              <input type="text" class="rounded-xl border border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/60 px-4 py-3 focus:border-primary focus:ring-primary outline-none" placeholder="مثال: استفسار عن التسجيل" required>
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
              <label class="text-sm font-medium">الرسالة</label>
              <textarea rows="6" class="rounded-xl border border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/60 px-4 py-3 focus:border-primary focus:ring-primary outline-none resize-none" placeholder="اكتب رسالتك بالتفصيل..." required></textarea>
            </div>

            <div class="md:col-span-2 flex justify-center mt-4">
              <button type="submit" class="min-w-[220px] h-14 px-8 bg-primary text-[#111811] text-lg font-bold rounded-xl hover:scale-105 transition-transform">
                إرسال الرسالة
              </button>
            </div>
          </form>
        </div>
      </section>

    </main>

    <footer class="bg-white dark:bg-background-dark border-t border-[#dce5dc] dark:border-white/10 px-4 md:px-20 lg:px-40 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-right">
        <div class="flex flex-col gap-4">
          <div class="flex items-center gap-2">
            <div class="size-6 bg-primary rounded-md flex items-center justify-center text-white">
              <span class="material-symbols-outlined text-sm">child_care</span>
            </div>
            <h3 class="text-xl font-bold dark:text-white">إدارة الحضانة</h3>
          </div>
          <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">
            نهدف إلى تغيير مستقبل التعليم المبكر من خلال حلول تقنية مبتكرة تضع مصلحة الطفل وأمنه في المقام الأول.
          </p>
        </div>
        <div class="flex flex-col gap-4">
          <h4 class="text-lg font-bold dark:text-white">روابط سريعة</h4>
          <nav class="flex flex-col gap-2">
            <a class="text-[#638863] dark:text-gray-400 hover:text-primary text-sm transition-colors" href="{{ url('/') }}">الرئيسية</a>
            <a class="text-[#638863] dark:text-gray-400 hover:text-primary text-sm transition-colors" href="{{ url('/contactus') }}">اتصل بنا</a>
          </nav>
        </div>
        <div class="flex flex-col gap-4">
          <h4 class="text-lg font-bold dark:text-white">تواصل معنا</h4>
          <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
              <span class="material-symbols-outlined text-sm text-primary">mail</span>
              <a href="mailto:info@nursery.edu.eg" class="hover:text-primary transition-colors">info@nursery.edu.eg</a>
            </div>
            <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
              <span class="material-symbols-outlined text-sm text-primary">call</span>
              <a href="tel:+201012345678" class="hover:text-primary transition-colors">+201012345678</a>
            </div>
            <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
              <span class="material-symbols-outlined text-sm text-primary">location_on</span>
              جمهورية مصر العربية
            </div>
          </div>
        </div>
        <div class="flex flex-col gap-4">
          <h4 class="text-lg font-bold dark:text-white">النشرة البريدية</h4>
          <p class="text-[#638863] dark:text-gray-400 text-sm">اشترك لتصلك أحدث نصائح تربية الأطفال</p>
          <form id="newsletterForm" class="flex gap-2">
            <input id="newsletterEmail" class="flex-1 rounded-xl border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/50 p-2 text-sm focus:border-primary focus:ring-primary" placeholder="البريد الإلكتروني" type="email" required />
            <button type="submit" class="bg-primary text-[#111811] rounded-xl px-4 py-2 font-bold hover:opacity-90">اشترك</button>
          </form>
        </div>
      </div>
      <div class="mt-12 pt-8 border-t border-[#dce5dc] dark:border-white/10 text-center text-[#638863] dark:text-gray-400 text-sm">
        <p>© 2026 نظام إدارة الحضانة الذكي. جميع الحقوق محفوظة.</p>
      </div>
    </footer>

  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('newsletterForm');
      const emailInput = document.getElementById('newsletterEmail');

      if (!form || !emailInput) {
        return;
      }

      form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!emailInput.value.trim()) {
          return;
        }

        alert('تم استلام طلب الاشتراك بنجاح.');
        emailInput.value = '';
      });
    });
  </script>
</body>

</html>
