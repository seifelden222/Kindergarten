<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>تحدث مع معلمي - واجهة الطفل</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f48c25",
                        "background-light": "#f8f8f5",
                        "background-dark": "#221e10",
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
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;
            font-size: 32px;
        }

        .message-stream {
            height: calc(100vh - 400px);
            overflow-y: auto;
        }

        .message-stream::-webkit-scrollbar {
            display: none;
        }

        .message-stream {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* تكبير الأيقونات في الأزرار */
        button .material-symbols-outlined {
            font-size: 3rem;
        }

        .w-24.h-24 .material-symbols-outlined {
            font-size: 4rem;
        }

        /* تأثيرات hover للأزرار */
        button:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white transition-colors duration-300">
    <script src="child-functions.js"></script>
    <div class="relative flex min-h-screen flex-col">
        <!-- Top Navigation Bar -->
        <x-child-navbar />

        <main class="flex-1 max-w-4xl mx-auto w-full flex flex-col p-4 gap-6">
            <div class="message-stream space-y-4 px-2">
                <div class="flex items-end gap-3 justify-start">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-12 h-12 shrink-0 border-2 border-primary" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAZy0GS4vz_pj55ok6xgwbRnSwyGl6oHxN_i5OoEJHgn4ektfjxhbYtVavWDo1tfQ3DQOxXINK-z1zZysjuGg4OdfAQUE5wqjz2-NfcBFM5PvMn2UAZ8ZyaMjtVhOLeVktYT4gVz-h9FCbdHylOh0p3xXvuiLfsMcJfkdQsj9gwjzZ626r4TYhm8RKnJmRN9b0k9ZvJTO26tBtsLAKlEkoVvNyNJ_F0c3ravHTI5QnRazNLe7iATyXyjkY4QwNX72CN4C9SbstUzD7N");'></div>
                    <div class="flex flex-col gap-1 items-start">
                        <div class="flex items-center gap-3 rounded-2xl px-5 py-4 bg-white dark:bg-zinc-800 shadow-sm text-[#111811] dark:text-white border border-zinc-100 dark:border-zinc-700 min-w-[200px]">
                            <button class="bg-primary text-white rounded-full p-2 hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined">play_arrow</span>
                            </button>
                            <div class="flex-1 h-2 bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-1/3"></div>
                            </div>
                            <span class="text-xs font-mono opacity-50">0:12</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-end gap-3 justify-end">
                    <div class="flex flex-col gap-1 items-end">
                        <div class="text-6xl p-4 rounded-3xl bg-primary/20 border-2 border-primary/30 shadow-sm">
                            ❤️
                        </div>
                    </div>
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-12 h-12 shrink-0 border-2 border-zinc-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCgxAeMMl6-pBDHeAPFnTQqQd_EDMQu2B4xOYZO0EPzLgfn1bm-Hvs6Y9c_RT3CUjnPzEPNZigQOWtpOa8OIUorPmY2xcen4qcPiBgNguATHKAtZGIdH1upBYmmdD-hj700kMQqrxzKgqg4YOeL2Y6KAbA2lY7XDh_Zv1KdNp7cXJqCtw-E4XO1vGL-wg8puhqTtWs90XOppJvUviI9zsyuHLRst9ELoK6qKzeOLa5KHFe68NWwg692bSJ-U1aS5yrKGlsoC1i_QEdD");'></div>
                </div>
                <div class="flex items-end gap-3 justify-start">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-12 h-12 shrink-0 border-2 border-primary" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBPoyWni9trdZVI9m39IPG2Py-PEeyZ4RWgzX1nGQM8uocNUuSDLO4BdwIL8aEFySM0NMeI6z3t-t-qzURpDazEwYSV_QGjtfbFWcY0vckgja5qIvpdxus7p2awD39snhZ5BuNkmBF_zYSwZ4MN35ioD9SuWrkQQYyrtYBW4_171XHv8HxAdASoPYnzuIxYAygC36uIlbgntZHb791FpPjl17FO154V2t-F9ZClb6pCclpe-38qo9LDMLURf6BUuBp3MgOyvDMQjl5_");'></div>
                    <div class="flex flex-col gap-1 items-start">
                        <div class="text-base font-medium rounded-2xl px-4 py-3 bg-white dark:bg-zinc-800 text-[#111811] dark:text-white shadow-sm border border-zinc-100 dark:border-zinc-700">
                            أهلاً بك يا بطل! كيف حالك اليوم؟
                        </div>
                        <div class="bg-center bg-no-repeat aspect-square bg-contain w-32 h-32" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCNp1CK6wIEhMN5kherRVtiubeEAIsJ7N1GgnOsLVUvo_KKYaCTa5520T8vGT0ZOHUqH9Q86_prNMdqJrcdEiqXHJZo6eif2L9CPHTIcwB4svggqJsXPoNLWXJzUP9i1YF9zmXmPKo8UVKB9I4xhW61Vbh501bII-GP6JN-uwmgPQnexNH6FaD9zw3TWgeJebe9TN4JXsHPC65ab6TyAFVTquBiLH--LR6GN0rzk2eFIbsn9McIOGdGZet7oFTgJOvJyH-g3R_-1p-o");'></div>
                    </div>
                </div>
                <div class="flex items-end gap-3 justify-end">
                    <div class="flex flex-col gap-1 items-end">
                        <div class="flex items-center gap-3 rounded-2xl px-5 py-4 bg-primary text-white shadow-md min-w-[150px]">
                            <span class="material-symbols-outlined">mic</span>
                            <span class="font-bold">رسالتي الصوتية</span>
                            <span class="text-xs opacity-80">0:04</span>
                        </div>
                    </div>
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-12 h-12 shrink-0 border-2 border-zinc-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBYPFhMpN3S7aPJUwcjT_ixZnfeqk_fhf8lBSI57BxnDsd52rs3mmy8tYn2rmR9_dPam92NTeNZhUBQ7BxKGpZUD6SBpm79xW9iW9ZZ1vLo_z6BnlHesArZZvTzF9SYdWAiDCTCv9RimoVg5cjcky62SmL0O4--d50umr8xAVr1qLjqVk_L3Zuz1LnxEWCU0KOkgQ1vZjNrLEZQPwN933FdLlwnkoYniTYT4uBwYXv55fz4LlMT0ictxgKcbP5-hKz91Et-V38gpOik");'></div>
                </div>
            </div>
            <div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-full max-w-4xl px-4">
                <div class="bg-white dark:bg-zinc-900 p-6 rounded-[2.5rem] shadow-2xl border-2 border-primary/20 flex flex-col gap-6">
                    <div class="grid grid-cols-5 gap-4">
                        <button onclick="sendEmoji('😊')" class="aspect-square flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 rounded-2xl hover:bg-primary/10 hover:scale-105 transition-all group">
                            <span class="text-4xl group-active:scale-125 transition-transform">😊</span>
                        </button>
                        <button onclick="sendEmoji('👍')" class="aspect-square flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 rounded-2xl hover:bg-primary/10 hover:scale-105 transition-all group">
                            <span class="text-4xl group-active:scale-125 transition-transform">👍</span>
                        </button>
                        <button onclick="sendEmoji('⭐')" class="aspect-square flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 rounded-2xl hover:bg-primary/10 hover:scale-105 transition-all group">
                            <span class="text-4xl group-active:scale-125 transition-transform">⭐</span>
                        </button>
                        <button onclick="sendEmoji('🍎')" class="aspect-square flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 rounded-2xl hover:bg-primary/10 hover:scale-105 transition-all group">
                            <span class="text-4xl group-active:scale-125 transition-transform">🍎</span>
                        </button>
                        <button onclick="sendEmoji('💧')" class="aspect-square flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 rounded-2xl hover:bg-primary/10 hover:scale-105 transition-all group">
                            <span class="text-4xl group-active:scale-125 transition-transform">💧</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between gap-6">
                        <button onclick="finishActivity()" class="flex flex-col items-center gap-2 flex-1 p-4 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-3xl font-bold hover:bg-blue-200 transition-colors">
                            <span class="material-symbols-outlined !text-4xl">task_alt</span>
                            <span>انتهيت!</span>
                        </button>
                        <button onclick="startVoiceMessage()" class="bg-primary text-white w-24 h-24 rounded-full flex items-center justify-center shadow-xl shadow-primary/40 hover:scale-110 active:scale-95 transition-all outline outline-offset-4 outline-primary/20">
                            <span class="material-symbols-outlined !text-5xl">mic</span>
                        </button>
                        <button onclick="askForHelp()" class="flex flex-col items-center gap-2 flex-1 p-4 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 rounded-3xl font-bold hover:bg-orange-200 transition-colors">
                            <span class="material-symbols-outlined !text-4xl">help</span>
                            <span>ساعديني</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="h-80"></div>
        </main>
    </div>
    <script src="{{ asset('js/child-functions.js') }}"></script>

</body>

</html>