<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>صندوق مفاجآتي</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f4c025",
                        "background-light": "#f8f8f5",
                        "background-dark": "#221e10",
                    },
                    fontFamily: {
                        "display": ["Cairo", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1.5rem",
                        "lg": "2.5rem",
                        "xl": "4rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;
            font-size: 48px;
        }

        body {
            font-family: 'Cairo', sans-serif;
        }

        .gift-card:hover {
            transform: scale(1.05) rotate(2deg);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* تكبير الأيقونات في البطاقات */
        .size-32 .material-symbols-outlined {
            font-size: 5rem;
        }

        /* تأثيرات إضافية */
        .gift-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gift-card:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen">
    <div class="layout-container flex h-full grow flex-col">
        <!-- Top Navigation Bar -->
        <x-child-navbar />
        <main class="flex-1 overflow-y-auto pb-10">
            <div class="px-6 md:px-40 py-8">
                <div class="layout-content-container flex flex-col max-w-[960px] mx-auto text-center">
                    <h1 class="text-[#181611] dark:text-white tracking-light text-[40px] font-bold leading-tight pb-3">
                        مرحبا يا بطل
                    </h1>
                    <p class="text-[#8a8060] dark:text-gray-400 text-lg">انقر على الصناديق لتكتشف مفاجآت اليوم</p>
                </div>
            </div>
            <div class="px-6 md:px-40 py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 p-4">
                        <div onclick="openGiftBox('badge')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-primary transition-all">
                            <div class="absolute -top-4 -right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold shadow-md animate-bounce">
                                {{ $surpriseCards['badge']['label'] }}
                            </div>
                            <div class="size-32 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mb-6">
                                <img src="{{ asset('img/Kindergarten-logo.jpeg') }}" alt="شهادة" class="h-16 w-16 object-cover rounded-full">
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">{{ $surpriseCards['badge']['title'] }}</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">{{ $surpriseCards['badge']['message'] }}</p>
                        </div>
                        <div onclick="openGiftBox('message')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-blue-400 transition-all">
                            <div class="size-32 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-6">
                                <img src="{{ asset('img/chiled.jpeg') }}" alt="رسالة" class="h-16 w-16 object-cover rounded-full">
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">{{ $surpriseCards['message']['title'] }}</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">{{ $surpriseCards['message']['message'] }}</p>
                        </div>
                        <div onclick="openGiftBox('activity')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-green-400 transition-all">
                            <div class="size-32 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-6">
                                @if (!empty($surpriseCards['activity']['image']))
                                    <img src="{{ $surpriseCards['activity']['image'] }}" alt="صورة النشاط" class="size-32 rounded-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-green-500" style="font-size: 64px;">palette</span>
                                @endif
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">{{ $surpriseCards['activity']['title'] }}</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">{{ $surpriseCards['activity']['message'] }}</p>
                        </div>
                        <div onclick="openGiftBox('meal')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-orange-400 transition-all">
                            <div class="size-32 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-orange-500" style="font-size: 64px;">restaurant</span>
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">{{ $surpriseCards['meal']['title'] }}</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">{{ $surpriseCards['meal']['message'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Memories removed for new accounts (hidden by default) -->
        </main>
        <div class="fixed bottom-8 left-8">
            <button class="size-20 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
                <a href="{{ route('child.home') }}"><span class="material-symbols-outlined" style="font-size: 40px;">home</span></a>
            </button>
        </div>
    </div>
    <script>
        window.childSurpriseCards = @json($surpriseCards);
    </script>
    <script src="{{ asset('js/child-functions.js') }}"></script>
</body>

</html>
