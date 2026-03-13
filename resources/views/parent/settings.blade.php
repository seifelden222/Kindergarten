<!doctype html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الإعدادات - نظام إدارة الحضانة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0ea60e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112111",
                    },
                    fontFamily: {
                        display: ["Cairo", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: "Cairo", sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings:
                "FILL" 0,
                "wght" 400,
                "GRAD" 0,
                "opsz" 24;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-parent-sidebar active="settings" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-4xl mx-auto p-8">
                <x-parent-header title="الإعدادات" />
                <div class="space-y-10">
                    <div
                        class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div
                            class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3
                                class="text-xl font-bold flex items-center gap-3">
                                <span
                                    class="material-symbols-outlined text-primary text-2xl">person</span>
                                بيانات الحساب
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-sm font-medium mb-2">الاسم الكامل</label>
                                    <input
                                        type="text"
                                        value="أحمد السعدي"
                                        class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium mb-2">رقم الجوال</label>
                                    <input
                                        type="tel"
                                        value="01012345678"
                                        class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium mb-2">البريد الإلكتروني</label>
                                <input
                                    type="email"
                                    value="ahmed.als3dy@example.com"
                                    class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                            </div>
                            <div class="pt-4">
                                <button
                                    class="px-6 py-3 bg-primary text-[#111811] font-bold rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                                    حفظ التغييرات
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div
                            class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3
                                class="text-xl font-bold flex items-center gap-3">
                                <span
                                    class="material-symbols-outlined text-primary text-2xl">palette</span>
                                المظهر والواجهة
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">
                                        الوضع الليلي (Dark Mode)
                                    </p>
                                    <p
                                        class="text-sm text-[#638863] dark:text-[#a3c2a3]">
                                        تفعيل الوضع الداكن للنظام
                                    </p>
                                </div>
                                <label
                                    class="relative inline-flex items-center cursor-pointer">
                                    <input
                                        type="checkbox"
                                        class="sr-only peer"
                                        checked />
                                    <div
                                        class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/30 dark:peer-focus:ring-primary/20 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:right-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">حجم الخط</p>
                                    <p
                                        class="text-sm text-[#638863] dark:text-[#a3c2a3]">
                                        تكبير أو تصغير حجم النصوص في النظام
                                    </p>
                                </div>
                                <select
                                    class="px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    <option>عادي</option>
                                    <option selected>كبير</option>
                                    <option>كبير جداً</option>
                                </select>
                            </div>

                            <div class="pt-4">
                                <button
                                    class="px-6 py-3 bg-primary text-[#111811] font-bold rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                                    تطبيق التغييرات
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div
                            class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3
                                class="text-xl font-bold flex items-center gap-3">
                                <span
                                    class="material-symbols-outlined text-primary text-2xl">security</span>
                                الأمان وكلمة المرور
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-medium mb-2">كلمة المرور الحالية</label>
                                <input
                                    type="password"
                                    placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                            </div>
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-sm font-medium mb-2">كلمة المرور الجديدة</label>
                                    <input
                                        type="password"
                                        placeholder="••••••••"
                                        class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium mb-2">تأكيد كلمة المرور</label>
                                    <input
                                        type="password"
                                        placeholder="••••••••"
                                        class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" />
                                </div>
                            </div>
                            <div class="pt-4">
                                <button
                                    class="px-6 py-3 bg-primary text-[#111811] font-bold rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                                    تغيير كلمة المرور
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div
                            class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3
                                class="text-xl font-bold flex items-center gap-3 text-red-600 dark:text-red-400">
                                <span
                                    class="material-symbols-outlined text-2xl">delete_forever</span>
                                حذف الحساب
                            </h3>
                        </div>
                        <div class="p-6">
                            <p
                                class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-6">
                                حذف الحساب سيؤدي إلى مسح جميع البيانات
                                المرتبطة به بشكل نهائي ولا يمكن استرجاعها.
                            </p>
                            <button
                                class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:brightness-110 transition-colors">
                                حذف الحساب نهائياً
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="parent-functions.js"></script>
    <script>
        // ربط جميع عناصر صفحة الإعدادات
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Settings page loaded");

            // ربط زر حفظ بيانات الحساب
            const saveAccountBtn = document.querySelector(
                ".bg-white.dark\\:bg-\\[\\#1a2e1a\\] button.bg-primary",
            );
            if (saveAccountBtn) {
                saveAccountBtn.onclick = function(e) {
                    e.preventDefault();
                    saveAccountSettings();
                };
                console.log("Save account button connected");
            }

            // ربط زر تطبيق إعدادات المظهر
            const appearanceBtns =
                document.querySelectorAll("button.bg-primary");
            if (appearanceBtns[1]) {
                appearanceBtns[1].onclick = function(e) {
                    e.preventDefault();
                    applyAppearanceSettings();
                };
                console.log("Appearance button connected");
            }

            // ربط زر تغيير كلمة المرور
            if (appearanceBtns[2]) {
                appearanceBtns[2].onclick = function(e) {
                    e.preventDefault();
                    changePassword();
                };
                console.log("Change password button connected");
            }

            // ربط زر حذف الحساب
            const deleteBtn = document.querySelector("button.bg-red-600");
            if (deleteBtn) {
                deleteBtn.onclick = function(e) {
                    e.preventDefault();
                    deleteAccount();
                };
                console.log("Delete account button connected");
            }

            // ربط تبديل الوضع الليلي
            const darkModeToggle = document.querySelector(
                'input[type="checkbox"]',
            );
            if (darkModeToggle) {
                darkModeToggle.onchange = function() {
                    toggleDarkMode(this);
                };
                console.log("Dark mode toggle connected");
            }

            // ربط تغيير حجم الخط
            const fontSizeSelect = document.querySelector("select");
            if (fontSizeSelect) {
                fontSizeSelect.onchange = function() {
                    showToast("تم تغيير حجم الخط", "success");
                };
                console.log("Font size select connected");
            }
        });
    </script>
    <script src="{{ asset('js/parent-functions.js') }}"></script>
</body>

</html>