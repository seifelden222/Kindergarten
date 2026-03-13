// ==================== Child Portal JavaScript Functions ====================
// ملف JavaScript شامل لجميع صفحات الطفل مع animations ممتعة

// ==================== Global Variables ====================
let currentPopup = null;
let stars = 8;
let soundEnabled = true;

// ==================== CSS Styles & Animations ====================
(function() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes sparkle {
            0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.5; transform: scale(1.2) rotate(180deg); }
        }
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease-in-out;
        }
        .popup-content {
            background: white;
            border-radius: 3rem;
            box-shadow: 0 30px 80px rgba(244, 140, 37, 0.4);
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 6px solid #f48c25;
        }
        .dark .popup-content {
            background: #322820;
            border-color: #f48c25;
        }
        .btn-bounce:active {
            animation: bounce 0.5s ease;
        }
        .btn-wiggle:hover {
            animation: wiggle 0.5s ease;
        }
        .star-sparkle {
            animation: sparkle 1.5s ease-in-out infinite;
        }
        /* Styles for games and activities */
        .memory-card {
            transition: all 0.3s ease;
        }
        .memory-card:hover {
            transform: scale(1.1);
        }
        .memory-card.flipped {
            background: #10b981 !important;
        }
        .memory-card.matched {
            opacity: 0.7;
            cursor: not-allowed;
        }
        #drawingCanvas {
            touch-action: none;
        }
    `;
    document.head.appendChild(style);
})();


// ==================== Sound Effects ====================
function playSound(type) {
    if (!soundEnabled) return;
    
    const sounds = {
        click: '🔊',
        success: '🎉',
        star: '⭐',
        celebration: '🎊'
    };
    
    console.log(`Playing sound: ${sounds[type] || '🔊'}`);
    // هنا يمكن إضافة Web Audio API للأصوات الحقيقية
}

// ==================== Popup Functions ====================
function createPopup(title, content, icon = '🎁') {
    closeAllPopups();
    
    const popup = document.createElement('div');
    popup.id = 'dynamicPopup';
    popup.className = 'popup-overlay';
    popup.onclick = (e) => { if (e.target === popup) closeAllPopups(); };
    
    popup.innerHTML = `
        <div class="popup-content" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-primary to-orange-400 p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-20">
                    <div class="text-8xl">✨</div>
                </div>
                <div class="text-7xl mb-4 animate-bounce">${icon}</div>
                <h3 class="text-4xl font-black text-white drop-shadow-lg">${title}</h3>
                <button onclick="closeAllPopups()" class="absolute top-4 left-4 bg-white/30 hover:bg-white/50 text-white rounded-full p-3 transition-all">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            <div class="p-8">
                ${content}
            </div>
        </div>
    `;
    
    document.body.appendChild(popup);
    document.body.style.overflow = 'hidden';
    currentPopup = popup;
    playSound('click');
    
    return popup;
}

function closeAllPopups() {
    if (currentPopup) {
        currentPopup.remove();
        currentPopup = null;
    }
    const existingPopup = document.getElementById('dynamicPopup');
    if (existingPopup) existingPopup.remove();
    
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAllPopups();
});


// ==================== Toast Notifications (للأطفال) ====================
function showToast(message, emoji = '😊') {
    const existingToast = document.getElementById('toast');
    if (existingToast) existingToast.remove();
    
    const toast = document.createElement('div');
    toast.id = 'toast';
    toast.className = 'fixed top-24 left-1/2 transform -translate-x-1/2 bg-white dark:bg-[#322820] border-4 border-primary rounded-3xl shadow-2xl px-8 py-6 z-[110] min-w-[300px]';
    toast.style.animation = 'slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    
    toast.innerHTML = `
        <div class="flex items-center gap-4">
            <span class="text-6xl animate-bounce">${emoji}</span>
            <p class="text-2xl font-bold text-[#181411] dark:text-white">${message}</p>
        </div>
    `;
    
    document.body.appendChild(toast);
    playSound('success');
    
    setTimeout(() => {
        toast.style.animation = 'fadeIn 0.3s ease-out reverse';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ==================== Star Collection ====================
function addStar() {
    stars++;
    updateStarDisplay();
    showCelebration('نجمة جديدة! 🌟');
    playSound('star');
}

function updateStarDisplay() {
    const starElements = document.querySelectorAll('.text-primary.text-3xl.font-bold');
    starElements.forEach(el => {
        if (el.textContent.match(/^\d+$/)) {
            el.textContent = stars;
            el.style.animation = 'pulse 0.5s ease';
        }
    });
}

function showCelebration(message) {
    const celebration = document.createElement('div');
    celebration.className = 'fixed inset-0 pointer-events-none z-[100] flex items-center justify-center';
    celebration.innerHTML = `
        <div class="text-8xl font-black text-primary animate-bounce drop-shadow-2xl">
            ${message}
        </div>
    `;
    document.body.appendChild(celebration);
    
    // إضافة confetti
    if (window.showConfetti) {
        window.showConfetti();
    }
    
    setTimeout(() => celebration.remove(), 2000);
}


// ==================== Additional Interactive Functions ====================

// تفعيل وضع الليل
function toggleDarkMode() {
    document.documentElement.classList.toggle('dark');
    const isDark = document.documentElement.classList.contains('dark');
    showToast(isDark ? 'وضع الليل 🌙' : 'وضع النهار ☀️', isDark ? '🌙' : '☀️');
    playSound('click');
}

// تشغيل/إيقاف الأصوات
function toggleSound() {
    soundEnabled = !soundEnabled;
    showToast(soundEnabled ? 'الأصوات مفعلة 🔊' : 'الأصوات متوقفة 🔇', soundEnabled ? '🔊' : '🔇');
}

// عرض الإنجازات
function showAchievements() {
    const content = `
        <div class="space-y-6">
            <div class="text-center">
                <div class="text-8xl mb-4">🏆</div>
                <h4 class="text-4xl font-bold text-primary mb-2">إنجازاتي</h4>
                <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">شوف كل اللي حققته!</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gradient-to-br from-yellow-400 to-orange-400 p-6 rounded-3xl text-center">
                    <div class="text-6xl mb-3">⭐</div>
                    <p class="text-white text-3xl font-bold">${stars}</p>
                    <p class="text-white text-sm">نجمة</p>
                </div>
                <div class="bg-gradient-to-br from-green-400 to-blue-400 p-6 rounded-3xl text-center">
                    <div class="text-6xl mb-3">🎨</div>
                    <p class="text-white text-3xl font-bold">12</p>
                    <p class="text-white text-sm">نشاط</p>
                </div>
                <div class="bg-gradient-to-br from-purple-400 to-pink-400 p-6 rounded-3xl text-center">
                    <div class="text-6xl mb-3">🏆</div>
                    <p class="text-white text-3xl font-bold">5</p>
                    <p class="text-white text-sm">وسام</p>
                </div>
                <div class="bg-gradient-to-br from-red-400 to-orange-400 p-6 rounded-3xl text-center">
                    <div class="text-6xl mb-3">📅</div>
                    <p class="text-white text-3xl font-bold">18</p>
                    <p class="text-white text-sm">يوم حضور</p>
                </div>
            </div>
            
            <button onclick="closeAllPopups()" class="bg-primary text-white text-2xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                رائع! 🎉
            </button>
        </div>
    `;
    
    createPopup('إنجازاتي', content, '🏆');
}

// عرض الملف الشخصي
function showProfile() {
    const content = `
        <div class="space-y-6 text-center">
            <div class="w-32 h-32 mx-auto rounded-full border-4 border-primary bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDf0Ix67ogfzlpkNqBflrYiwgGhqYcmOqrg4ZEuemA8nLmNxxPYTbqSaiEhaZHaHk7GBWXUEb0OvbcgflNmhHdm9Pwq3qlTPYvCsrUams_WKKTY3BrFI9wYxkn37NIt2IvMlFJq7daZTa9nAv3YN0ItfXGz6Ahel8qmdDm-VbJSzqwOQzlwcXLNDzFvPFmznjrgwlJXlVETgAEGz9Pvt2MnCw_3NjJ3aKLlHzj2pzLk5u9O4qopCeFX3LNj-rEyNaEaAJK83XVFu8vo");'></div>
            
            <h4 class="text-4xl font-bold text-primary">أنا نجم!</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">طفل مبدع ومجتهد</p>
            
            <div class="bg-primary/10 p-6 rounded-3xl space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xl">⭐ النجوم:</span>
                    <span class="text-2xl font-bold text-primary">${stars}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xl">🎨 الأنشطة:</span>
                    <span class="text-2xl font-bold text-primary">12</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xl">📅 أيام الحضور:</span>
                    <span class="text-2xl font-bold text-primary">18</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <button onclick="showAchievements()" class="bg-gradient-to-br from-yellow-400 to-orange-400 text-white text-xl font-bold py-4 px-6 rounded-2xl hover:scale-105 transition-transform">
                    🏆 إنجازاتي
                </button>
                <button onclick="closeAllPopups()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-xl font-bold py-4 px-6 rounded-2xl hover:scale-105 transition-transform">
                    رجوع
                </button>
            </div>
        </div>
    `;
    
    createPopup('ملفي الشخصي', content, '👤');
}

// دالة لإضافة تأثير الاهتزاز
function shakeElement(element) {
    element.style.animation = 'wiggle 0.5s ease';
    setTimeout(() => {
        element.style.animation = '';
    }, 500);
}

// دالة لإضافة تأثير النبض
function pulseElement(element) {
    element.style.animation = 'pulse 0.5s ease';
    setTimeout(() => {
        element.style.animation = '';
    }, 500);
}

// دالة لإضافة تأثير القفز
function bounceElement(element) {
    element.style.animation = 'bounce 0.5s ease';
    setTimeout(() => {
        element.style.animation = '';
    }, 500);
}


// ==================== Home Page Functions ====================

// بدء اليوم
function startDay() {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-8xl animate-bounce">🚀</div>
            <h4 class="text-4xl font-bold text-primary">يلا نبدأ المغامرة!</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">اختر أول نشاط تحب تعمله النهاردة</p>
            
            <div class="grid grid-cols-2 gap-6 mt-8">
                <button onclick="selectActivity('رسم')" class="bg-gradient-to-br from-purple-400 to-purple-600 text-white p-8 rounded-3xl hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-6xl mb-3">palette</span>
                    <p class="text-2xl font-bold">رسم</p>
                </button>
                <button onclick="selectActivity('لعب')" class="bg-gradient-to-br from-green-400 to-green-600 text-white p-8 rounded-3xl hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-6xl mb-3">sports_soccer</span>
                    <p class="text-2xl font-bold">لعب</p>
                </button>
                <button onclick="selectActivity('قصة')" class="bg-gradient-to-br from-blue-400 to-blue-600 text-white p-8 rounded-3xl hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-6xl mb-3">menu_book</span>
                    <p class="text-2xl font-bold">قصة</p>
                </button>
                <button onclick="selectActivity('موسيقى')" class="bg-gradient-to-br from-pink-400 to-pink-600 text-white p-8 rounded-3xl hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-6xl mb-3">music_note</span>
                    <p class="text-2xl font-bold">موسيقى</p>
                </button>
            </div>
        </div>
    `;
    
    createPopup('ابدأ يومك!', content, '🌟');
}

function selectActivity(activity) {
    closeAllPopups();
    showToast(`يلا نبدأ ${activity}!`, '🎨');
    addStar();
}

// بدء نشاط
function startActivity(activityName) {
    closeAllPopups();
    
    // تحديد نوع النشاط وفتح التطبيق المناسب
    if (activityName.includes('رسم') || activityName.includes('الفنون')) {
        openDrawingApp();
    } else if (activityName.includes('لعب') || activityName.includes('الرياضة')) {
        openGameApp();
    } else if (activityName.includes('قصة') || activityName.includes('القصص')) {
        openStoryApp();
    } else if (activityName.includes('موسيقى')) {
        openMusicApp();
    } else {
        // نشاط عام
        openGeneralActivity(activityName);
    }
}

// لوحة الرسم التفاعلية
function openDrawingApp() {
    const content = `
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h4 class="text-3xl font-bold text-primary">🎨 لوحة الرسم</h4>
                <button onclick="closeAllPopups()" class="bg-gray-200 dark:bg-gray-700 p-2 rounded-full">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <!-- لوحة الألوان -->
            <div class="flex gap-2 justify-center flex-wrap">
                <button onclick="changeDrawColor('#000000')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #000000"></button>
                <button onclick="changeDrawColor('#ff0000')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #ff0000"></button>
                <button onclick="changeDrawColor('#00ff00')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #00ff00"></button>
                <button onclick="changeDrawColor('#0000ff')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #0000ff"></button>
                <button onclick="changeDrawColor('#ffff00')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #ffff00"></button>
                <button onclick="changeDrawColor('#ff00ff')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #ff00ff"></button>
                <button onclick="changeDrawColor('#00ffff')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #00ffff"></button>
                <button onclick="changeDrawColor('#ffa500')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #ffa500"></button>
                <button onclick="changeDrawColor('#800080')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #800080"></button>
                <button onclick="changeDrawColor('#ffc0cb')" class="w-12 h-12 rounded-full border-4 border-white shadow-lg" style="background: #ffc0cb"></button>
            </div>
            
            <!-- حجم الفرشاة -->
            <div class="flex gap-4 justify-center items-center">
                <span class="text-lg font-bold">حجم الفرشاة:</span>
                <button onclick="changeBrushSize(5)" class="bg-primary text-white px-4 py-2 rounded-full text-sm">صغير</button>
                <button onclick="changeBrushSize(10)" class="bg-primary text-white px-4 py-2 rounded-full">وسط</button>
                <button onclick="changeBrushSize(20)" class="bg-primary text-white px-4 py-2 rounded-full text-lg">كبير</button>
            </div>
            
            <!-- Canvas للرسم -->
            <canvas id="drawingCanvas" width="600" height="400" class="border-4 border-primary rounded-2xl bg-white cursor-crosshair mx-auto block shadow-xl"></canvas>
            
            <!-- أزرار التحكم -->
            <div class="flex gap-3 justify-center">
                <button onclick="clearCanvas()" class="bg-red-500 text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition-transform">
                    🗑️ مسح الكل
                </button>
                <button onclick="saveDrawing()" class="bg-green-500 text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition-transform">
                    💾 حفظ الرسمة
                </button>
                <button onclick="finishDrawing()" class="bg-primary text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition-transform">
                    ✅ خلصت!
                </button>
            </div>
        </div>
    `;
    
    createPopup('لوحة الرسم', content, '🎨');
    
    // تفعيل Canvas بعد إنشاء الـ popup
    setTimeout(() => {
        initDrawingCanvas();
    }, 100);
}

// متغيرات الرسم
let canvas, ctx, isDrawing = false;
let currentColor = '#000000';
let brushSize = 10;

function initDrawingCanvas() {
    canvas = document.getElementById('drawingCanvas');
    if (!canvas) return;
    
    ctx = canvas.getContext('2d');
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch events للموبايل
    canvas.addEventListener('touchstart', handleTouch);
    canvas.addEventListener('touchmove', handleTouch);
    canvas.addEventListener('touchend', stopDrawing);
}

function startDrawing(e) {
    isDrawing = true;
    const rect = canvas.getBoundingClientRect();
    ctx.beginPath();
    ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
}

function draw(e) {
    if (!isDrawing) return;
    
    const rect = canvas.getBoundingClientRect();
    ctx.strokeStyle = currentColor;
    ctx.lineWidth = brushSize;
    ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
    ctx.stroke();
}

function stopDrawing() {
    isDrawing = false;
}

function handleTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : 'mousemove', {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
}

function changeDrawColor(color) {
    currentColor = color;
    showToast('تم تغيير اللون!', '🎨');
}

function changeBrushSize(size) {
    brushSize = size;
    showToast(`حجم الفرشاة: ${size}`, '✏️');
}

function clearCanvas() {
    if (ctx && canvas) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        showToast('تم مسح الرسمة!', '🗑️');
    }
}

function saveDrawing() {
    if (canvas) {
        const link = document.createElement('a');
        link.download = 'رسمتي.png';
        link.href = canvas.toDataURL();
        link.click();
        showToast('تم حفظ الرسمة!', '💾');
        addStar();
    }
}

function finishDrawing() {
    closeAllPopups();
    showToast('رسمة رائعة! 🎨', '⭐');
    addStar();
    addStar();
}

// لعبة تفاعلية - لعبة الذاكرة
function openGameApp() {
    const content = `
        <div class="space-y-4 text-center">
            <h4 class="text-3xl font-bold text-primary">🎮 اختر لعبتك!</h4>
            
            <div class="grid grid-cols-2 gap-4">
                <button onclick="playMemoryGame()" class="bg-gradient-to-br from-purple-400 to-purple-600 text-white p-6 rounded-3xl hover:scale-105 transition-transform">
                    <span class="text-6xl mb-3 block">🧠</span>
                    <span class="text-xl font-bold">لعبة الذاكرة</span>
                </button>
                
                <button onclick="playColorGame()" class="bg-gradient-to-br from-green-400 to-green-600 text-white p-6 rounded-3xl hover:scale-105 transition-transform">
                    <span class="text-6xl mb-3 block">🎨</span>
                    <span class="text-xl font-bold">لعبة الألوان</span>
                </button>
                
                <button onclick="playNumberGame()" class="bg-gradient-to-br from-blue-400 to-blue-600 text-white p-6 rounded-3xl hover:scale-105 transition-transform">
                    <span class="text-6xl mb-3 block">🔢</span>
                    <span class="text-xl font-bold">لعبة الأرقام</span>
                </button>
                
                <button onclick="playShapeGame()" class="bg-gradient-to-br from-pink-400 to-pink-600 text-white p-6 rounded-3xl hover:scale-105 transition-transform">
                    <span class="text-6xl mb-3 block">⭐</span>
                    <span class="text-xl font-bold">لعبة الأشكال</span>
                </button>
            </div>
        </div>
    `;
    
    createPopup('الألعاب', content, '🎮');
}

// لعبة الذاكرة
function playMemoryGame() {
    const emojis = ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🐻', '🐼'];
    const cards = [...emojis, ...emojis].sort(() => Math.random() - 0.5);
    let flippedCards = [];
    let matchedPairs = 0;
    
    const content = `
        <div class="space-y-4 text-center">
            <h4 class="text-3xl font-bold text-primary">🧠 لعبة الذاكرة</h4>
            <p class="text-xl">اوجد الأزواج المتشابهة!</p>
            
            <div id="memoryGrid" class="grid grid-cols-4 gap-3 max-w-md mx-auto">
                ${cards.map((emoji, index) => `
                    <button onclick="flipCard(${index})" id="card-${index}" 
                        class="memory-card bg-primary text-white w-20 h-20 rounded-2xl text-4xl font-bold hover:scale-105 transition-transform shadow-lg"
                        data-emoji="${emoji}">
                        ❓
                    </button>
                `).join('')}
            </div>
            
            <div class="text-2xl font-bold">
                <span id="matchCount">0</span> / 8 أزواج
            </div>
        </div>
    `;
    
    createPopup('لعبة الذاكرة', content, '🧠');
    
    window.flipCard = function(index) {
        const card = document.getElementById(`card-${index}`);
        if (!card || card.classList.contains('matched') || flippedCards.length >= 2) return;
        
        const emoji = card.getAttribute('data-emoji');
        card.textContent = emoji;
        card.classList.add('flipped');
        flippedCards.push({index, emoji, element: card});
        
        if (flippedCards.length === 2) {
            setTimeout(() => {
                if (flippedCards[0].emoji === flippedCards[1].emoji) {
                    // تطابق!
                    flippedCards[0].element.classList.add('matched');
                    flippedCards[1].element.classList.add('matched');
                    flippedCards[0].element.style.background = '#10b981';
                    flippedCards[1].element.style.background = '#10b981';
                    matchedPairs++;
                    document.getElementById('matchCount').textContent = matchedPairs;
                    showToast('أحسنت! 🎉', '⭐');
                    addStar();
                    
                    if (matchedPairs === 8) {
                        setTimeout(() => {
                            closeAllPopups();
                            showCelebration('🏆 فزت! أنت بطل! 🏆');
                            stars += 5;
                            updateStarDisplay();
                        }, 500);
                    }
                } else {
                    // لم يتطابقا
                    flippedCards[0].element.textContent = '❓';
                    flippedCards[1].element.textContent = '❓';
                    flippedCards[0].element.classList.remove('flipped');
                    flippedCards[1].element.classList.remove('flipped');
                }
                flippedCards = [];
            }, 800);
        }
    };
}

// لعبة الألوان
function playColorGame() {
    const colors = [
        {name: 'أحمر', color: '#ff0000', emoji: '🔴'},
        {name: 'أزرق', color: '#0000ff', emoji: '🔵'},
        {name: 'أخضر', color: '#00ff00', emoji: '🟢'},
        {name: 'أصفر', color: '#ffff00', emoji: '🟡'}
    ];
    
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
    
    const content = `
        <div class="space-y-6 text-center">
            <h4 class="text-3xl font-bold text-primary">🎨 لعبة الألوان</h4>
            <p class="text-2xl">اختر اللون:</p>
            
            <div class="text-8xl animate-bounce">${randomColor.emoji}</div>
            <p class="text-4xl font-bold">${randomColor.name}</p>
            
            <div class="grid grid-cols-2 gap-4 max-w-md mx-auto">
                ${colors.map(c => `
                    <button onclick="checkColorAnswer('${c.name}', '${randomColor.name}')" 
                        class="p-8 rounded-3xl text-white text-2xl font-bold hover:scale-105 transition-transform shadow-lg"
                        style="background: ${c.color}">
                        ${c.name}
                    </button>
                `).join('')}
            </div>
        </div>
    `;
    
    createPopup('لعبة الألوان', content, '🎨');
}

window.checkColorAnswer = function(selected, correct) {
    if (selected === correct) {
        showToast('صح! أحسنت! 🎉', '⭐');
        addStar();
        addStar();
        setTimeout(() => playColorGame(), 1000);
    } else {
        showToast('حاول مرة تانية! 💪', '🤔');
    }
};

// لعبة الأرقام
function playNumberGame() {
    const targetNumber = Math.floor(Math.random() * 10) + 1;
    
    const content = `
        <div class="space-y-6 text-center">
            <h4 class="text-3xl font-bold text-primary">🔢 لعبة الأرقام</h4>
            <p class="text-2xl">اختر الرقم:</p>
            
            <div class="text-9xl font-black text-primary animate-bounce">${targetNumber}</div>
            
            <div class="grid grid-cols-5 gap-3 max-w-lg mx-auto">
                ${Array.from({length: 10}, (_, i) => i + 1).map(num => `
                    <button onclick="checkNumberAnswer(${num}, ${targetNumber})" 
                        class="bg-gradient-to-br from-blue-400 to-blue-600 text-white p-6 rounded-2xl text-3xl font-bold hover:scale-110 transition-transform shadow-lg">
                        ${num}
                    </button>
                `).join('')}
            </div>
        </div>
    `;
    
    createPopup('لعبة الأرقام', content, '🔢');
}

window.checkNumberAnswer = function(selected, correct) {
    if (selected === correct) {
        showToast('برافو! إجابة صحيحة! 🎉', '⭐');
        addStar();
        addStar();
        setTimeout(() => playNumberGame(), 1000);
    } else {
        showToast('حاول مرة تانية! 💪', '🤔');
    }
};

// لعبة الأشكال
function playShapeGame() {
    const shapes = [
        {name: 'دائرة', emoji: '⭕', shape: 'circle'},
        {name: 'مربع', emoji: '🟦', shape: 'square'},
        {name: 'مثلث', emoji: '🔺', shape: 'triangle'},
        {name: 'نجمة', emoji: '⭐', shape: 'star'}
    ];
    
    const randomShape = shapes[Math.floor(Math.random() * shapes.length)];
    
    const content = `
        <div class="space-y-6 text-center">
            <h4 class="text-3xl font-bold text-primary">⭐ لعبة الأشكال</h4>
            <p class="text-2xl">ما هذا الشكل؟</p>
            
            <div class="text-9xl animate-pulse">${randomShape.emoji}</div>
            
            <div class="grid grid-cols-2 gap-4 max-w-md mx-auto">
                ${shapes.map(s => `
                    <button onclick="checkShapeAnswer('${s.name}', '${randomShape.name}')" 
                        class="bg-gradient-to-br from-purple-400 to-pink-600 text-white p-6 rounded-3xl hover:scale-105 transition-transform shadow-lg">
                        <span class="text-5xl block mb-2">${s.emoji}</span>
                        <span class="text-xl font-bold">${s.name}</span>
                    </button>
                `).join('')}
            </div>
        </div>
    `;
    
    createPopup('لعبة الأشكال', content, '⭐');
}

window.checkShapeAnswer = function(selected, correct) {
    if (selected === correct) {
        showToast('ممتاز! إجابة صحيحة! 🎉', '⭐');
        addStar();
        addStar();
        setTimeout(() => playShapeGame(), 1000);
    } else {
        showToast('حاول مرة تانية! 💪', '🤔');
    }
};

// تطبيق القصص
function openStoryApp() {
    const stories = [
        {title: 'الأرنب والسلحفاة', emoji: '🐰🐢', duration: '5 دقائق'},
        {title: 'الأسد والفأر', emoji: '🦁🐭', duration: '4 دقائق'},
        {title: 'البطة القبيحة', emoji: '🦆', duration: '6 دقائق'}
    ];
    
    const content = `
        <div class="space-y-6 text-center">
            <h4 class="text-3xl font-bold text-primary">📚 وقت القصة</h4>
            <p class="text-xl">اختر قصتك المفضلة!</p>
            
            <div class="space-y-4">
                ${stories.map((story, i) => `
                    <button onclick="readStory(${i})" class="w-full bg-gradient-to-r from-purple-400 to-pink-400 text-white p-6 rounded-3xl hover:scale-105 transition-transform shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="text-left">
                                <p class="text-2xl font-bold">${story.title}</p>
                                <p class="text-sm opacity-80">${story.duration}</p>
                            </div>
                            <span class="text-5xl">${story.emoji}</span>
                        </div>
                    </button>
                `).join('')}
            </div>
        </div>
    `;
    
    createPopup('القصص', content, '📚');
}

window.readStory = function(index) {
    const stories = [
        {
            title: 'الأرنب والسلحفاة',
            emoji: '🐰🐢',
            text: 'في يوم من الأيام، تحدى أرنب سريع سلحفاة بطيئة في سباق...\n\nالأرنب كان واثقاً من فوزه، فنام في منتصف الطريق.\n\nلكن السلحفاة استمرت في المشي ببطء وثبات...\n\nوفي النهاية، فازت السلحفاة! 🏆\n\nالدرس: البطء والثبات يفوزان بالسباق!'
        },
        {
            title: 'الأسد والفأر',
            emoji: '🦁🐭',
            text: 'كان هناك أسد قوي نائم في الغابة...\n\nجاء فأر صغير ولعب على الأسد فاستيقظ غاضباً!\n\nتوسل الفأر: "اتركني وسأساعدك يوماً ما!"\n\nضحك الأسد وتركه يذهب.\n\nبعد أيام، وقع الأسد في شبكة صياد.\n\nجاء الفأر وقرض الشبكة وأنقذ الأسد! 🎉\n\nالدرس: الصغير يمكنه مساعدة الكبير!'
        },
        {
            title: 'البطة القبيحة',
            emoji: '🦆',
            text: 'كان هناك بطة صغيرة مختلفة عن إخوتها...\n\nكانوا يسخرون منها لأنها تبدو مختلفة.\n\nحزنت البطة وذهبت بعيداً...\n\nمرت الأيام وكبرت البطة...\n\nوإذا بها تتحول إلى بجعة جميلة! 🦢✨\n\nالدرس: كل واحد فينا مميز وجميل بطريقته!'
        }
    ];
    
    const story = stories[index];
    
    const content = `
        <div class="space-y-6">
            <div class="text-center">
                <div class="text-8xl mb-4">${story.emoji}</div>
                <h4 class="text-3xl font-bold text-primary">${story.title}</h4>
            </div>
            
            <div class="bg-primary/10 p-6 rounded-3xl text-right">
                <p class="text-xl leading-relaxed whitespace-pre-line">${story.text}</p>
            </div>
            
            <div class="flex gap-3">
                <button onclick="closeAllPopups(); addStar(); addStar(); showToast('قصة جميلة! 📚', '⭐')" 
                    class="flex-1 bg-primary text-white text-xl font-bold py-4 px-6 rounded-full hover:scale-105 transition-transform">
                    خلصت القصة! ⭐
                </button>
                <button onclick="openStoryApp()" 
                    class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-xl font-bold py-4 px-6 rounded-full hover:scale-105 transition-transform">
                    قصة تانية 📚
                </button>
            </div>
        </div>
    `;
    
    createPopup(story.title, content, '📚');
};

// تطبيق الموسيقى
function openMusicApp() {
    const instruments = [
        {name: 'بيانو', emoji: '🎹', sound: 'piano'},
        {name: 'طبلة', emoji: '🥁', sound: 'drum'},
        {name: 'جيتار', emoji: '🎸', sound: 'guitar'},
        {name: 'ناي', emoji: '🎺', sound: 'flute'}
    ];
    
    const content = `
        <div class="space-y-6 text-center">
            <h4 class="text-3xl font-bold text-primary">🎵 وقت الموسيقى</h4>
            <p class="text-xl">اختر آلتك الموسيقية!</p>
            
            <div class="grid grid-cols-2 gap-4">
                ${instruments.map(inst => `
                    <button onclick="playInstrument('${inst.name}')" 
                        class="bg-gradient-to-br from-blue-400 to-purple-600 text-white p-8 rounded-3xl hover:scale-105 transition-transform shadow-lg active:scale-95">
                        <span class="text-7xl block mb-3">${inst.emoji}</span>
                        <span class="text-2xl font-bold">${inst.name}</span>
                    </button>
                `).join('')}
            </div>
            
            <div class="bg-primary/10 p-6 rounded-3xl">
                <p class="text-lg font-bold mb-4">🎼 اعزف لحنك الخاص!</p>
                <div class="grid grid-cols-4 gap-2">
                    ${['دو', 'ري', 'مي', 'فا', 'صول', 'لا', 'سي', 'دو'].map((note, i) => `
                        <button onclick="playNote(${i})" 
                            class="bg-white dark:bg-gray-800 text-primary font-bold py-4 rounded-xl hover:scale-110 transition-transform shadow-md active:bg-primary active:text-white">
                            ${note}
                        </button>
                    `).join('')}
                </div>
            </div>
        </div>
    `;
    
    createPopup('الموسيقى', content, '🎵');
}

window.playInstrument = function(name) {
    showToast(`🎵 ${name}`, '🎶');
    addStar();
    // هنا يمكن إضافة Web Audio API لتشغيل أصوات حقيقية
};

window.playNote = function(index) {
    const notes = ['دو', 'ري', 'مي', 'فا', 'صول', 'لا', 'سي', 'دو'];
    showToast(`♪ ${notes[index]} ♪`, '🎵');
    // هنا يمكن إضافة Web Audio API لتشغيل النوتات الموسيقية
};

// نشاط عام
function openGeneralActivity(activityName) {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-8xl animate-pulse">🎨</div>
            <h4 class="text-4xl font-bold text-primary">${activityName}</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">جاهز تبدأ؟</p>
            
            <div class="bg-primary/10 p-6 rounded-3xl">
                <p class="text-xl font-bold mb-4">هتحتاج:</p>
                <div class="flex justify-center gap-4 flex-wrap">
                    <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl">
                        <span class="text-4xl">🖍️</span>
                        <p class="text-sm mt-2">ألوان</p>
                    </div>
                    <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl">
                        <span class="text-4xl">📄</span>
                        <p class="text-sm mt-2">ورق</p>
                    </div>
                    <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl">
                        <span class="text-4xl">💧</span>
                        <p class="text-sm mt-2">ماء</p>
                    </div>
                </div>
            </div>
            
            <button onclick="confirmStartActivity('${activityName}')" class="bg-primary text-white text-3xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                يلا بينا! 🚀
            </button>
        </div>
    `;
    
    createPopup('جاهز؟', content, '🎯');
}

function confirmStartActivity(activityName) {
    closeAllPopups();
    showToast('بدأنا! استمتع', '🎉');
    addStar();
}


// ==================== Activities Page Functions ====================

// عرض تفاصيل النشاط
function showActivityDetails(activityName, time, status) {
    const statusEmojis = {
        'مكتمل': '✅',
        'قريباً': '⏰',
        'الآن': '🎯'
    };
    
    const content = `
        <div class="space-y-6">
            <div class="text-center">
                <div class="text-8xl mb-4">${statusEmojis[status] || '🎨'}</div>
                <h4 class="text-4xl font-bold text-primary mb-2">${activityName}</h4>
                <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">${time}</p>
            </div>
            
            ${status === 'مكتمل' ? `
                <div class="bg-green-100 dark:bg-green-900/30 p-6 rounded-3xl">
                    <p class="text-2xl font-bold text-green-700 dark:text-green-400 mb-4">أحسنت! 🌟</p>
                    <div class="flex justify-center gap-2">
                        <span class="text-5xl">⭐</span>
                        <span class="text-5xl">⭐</span>
                        <span class="text-5xl">⭐</span>
                    </div>
                </div>
            ` : ''}
            
            <div class="grid grid-cols-2 gap-4">
                <button onclick="closeAllPopups()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-xl font-bold py-4 px-6 rounded-2xl hover:scale-105 transition-transform">
                    رجوع
                </button>
                <button onclick="shareActivity('${activityName}')" class="bg-primary text-white text-xl font-bold py-4 px-6 rounded-2xl hover:scale-105 transition-transform">
                    شارك 📤
                </button>
            </div>
        </div>
    `;
    
    createPopup(activityName, content, '🎨');
}

function shareActivity(activityName) {
    closeAllPopups();
    showToast('تم المشاركة!', '📤');
}

// التنقل بين الأنشطة
function navigateActivities(direction) {
    const emoji = direction === 'next' ? '➡️' : '⬅️';
    showToast(`جاري التحميل...`, emoji);
    playSound('click');
}


// ==================== Attendance Page Functions ====================

// عرض تفاصيل يوم الحضور
function showDayDetails(day, status) {
    const statusData = {
        'حاضر': { emoji: '☀️', color: 'primary', message: 'كنت معانا!' },
        'غائب': { emoji: '🌙', color: 'indigo-500', message: 'افتقدناك' },
        'قريباً': { emoji: '❓', color: 'gray-400', message: 'لسه ما جاش' }
    };
    
    const data = statusData[status] || statusData['قريباً'];
    
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-9xl animate-bounce">${data.emoji}</div>
            <h4 class="text-5xl font-bold text-${data.color}">يوم ${day}</h4>
            <p class="text-3xl font-bold">${data.message}</p>
            
            ${status === 'حاضر' ? `
                <div class="bg-primary/10 p-6 rounded-3xl">
                    <p class="text-2xl font-bold mb-4">أنشطة اليوم:</p>
                    <div class="space-y-3">
                        <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl flex items-center gap-4">
                            <span class="text-4xl">🎨</span>
                            <span class="text-xl font-bold">رسم</span>
                        </div>
                        <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl flex items-center gap-4">
                            <span class="text-4xl">⚽</span>
                            <span class="text-xl font-bold">لعب</span>
                        </div>
                        <div class="bg-white dark:bg-[#322820] p-4 rounded-2xl flex items-center gap-4">
                            <span class="text-4xl">🍎</span>
                            <span class="text-xl font-bold">غداء</span>
                        </div>
                    </div>
                </div>
            ` : ''}
            
            <button onclick="closeAllPopups()" class="bg-primary text-white text-2xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                تمام! 👍
            </button>
        </div>
    `;
    
    createPopup(`يوم ${day}`, content, data.emoji);
}

// التنقل بين الشهور
function changeMonth(direction) {
    const months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
    const randomMonth = months[Math.floor(Math.random() * months.length)];
    showToast(`شهر ${randomMonth}`, '📅');
    playSound('click');
}


// ==================== Teacher Talk Page Functions ====================

// إرسال إيموجي
function sendEmoji(emoji) {
    const messagesContainer = document.querySelector('.message-stream');
    if (!messagesContainer) return;
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'flex items-end gap-3 justify-end';
    messageDiv.style.animation = 'slideUp 0.4s ease';
    
    messageDiv.innerHTML = `
        <div class="flex flex-col gap-1 items-end">
            <div class="text-8xl p-6 rounded-3xl bg-primary/20 border-4 border-primary/30 shadow-lg hover:scale-110 transition-transform">
                ${emoji}
            </div>
        </div>
        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-12 h-12 shrink-0 border-2 border-zinc-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDf0Ix67ogfzlpkNqBflrYiwgGhqYcmOqrg4ZEuemA8nLmNxxPYTbqSaiEhaZHaHk7GBWXUEb0OvbcgflNmhHdm9Pwq3qlTPYvCsrUams_WKKTY3BrFI9wYxkn37NIt2IvMlFJq7daZTa9nAv3YN0ItfXGz6Ahel8qmdDm-VbJSzqwOQzlwcXLNDzFvPFmznjrgwlJXlVETgAEGz9Pvt2MnCw_3NjJ3aKLlHzj2pzLk5u9O4qopCeFX3LNj-rEyNaEaAJK83XVFu8vo");'></div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    playSound('click');
    showToast('تم الإرسال!', emoji);
    addStar();
}

// رسالة صوتية
function startVoiceMessage() {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-9xl animate-pulse">🎤</div>
            <h4 class="text-4xl font-bold text-primary">اضغط واتكلم!</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">قول للمعلمة اللي عايز تقوله</p>
            
            <div class="bg-red-500 w-32 h-32 rounded-full mx-auto flex items-center justify-center animate-pulse cursor-pointer hover:scale-110 transition-transform" onclick="recordVoice()">
                <span class="material-symbols-outlined text-white" style="font-size: 64px;">mic</span>
            </div>
            
            <p class="text-xl text-gray-500">اضغط على المايك وابدأ الكلام</p>
            
            <button onclick="closeAllPopups()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-xl font-bold py-4 px-8 rounded-2xl hover:scale-105 transition-transform">
                إلغاء
            </button>
        </div>
    `;
    
    createPopup('رسالة صوتية', content, '🎤');
}

function recordVoice() {
    closeAllPopups();
    showToast('جاري التسجيل...', '🎤');
    
    setTimeout(() => {
        showToast('تم الإرسال!', '✅');
        addStar();
    }, 2000);
}

// انتهيت من النشاط
function finishActivity() {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-9xl animate-bounce">🎉</div>
            <h4 class="text-5xl font-bold text-primary">برافو عليك!</h4>
            <p class="text-3xl text-[#8a7560] dark:text-[#cbb8a6]">خلصت النشاط بنجاح!</p>
            
            <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-8 rounded-3xl">
                <p class="text-white text-4xl font-bold mb-4">كسبت 3 نجوم!</p>
                <div class="flex justify-center gap-3">
                    <span class="text-7xl animate-bounce" style="animation-delay: 0s;">⭐</span>
                    <span class="text-7xl animate-bounce" style="animation-delay: 0.1s;">⭐</span>
                    <span class="text-7xl animate-bounce" style="animation-delay: 0.2s;">⭐</span>
                </div>
            </div>
            
            <button onclick="confirmFinish()" class="bg-primary text-white text-3xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                يلا للنشاط الجاي! 🚀
            </button>
        </div>
    `;
    
    createPopup('أحسنت!', content, '🏆');
    playSound('celebration');
}

function confirmFinish() {
    closeAllPopups();
    stars += 3;
    updateStarDisplay();
    showCelebration('🌟 +3 نجوم! 🌟');
}

// طلب مساعدة
function askForHelp() {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-9xl animate-bounce">🙋</div>
            <h4 class="text-4xl font-bold text-primary">محتاج مساعدة؟</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">المعلمة جاية دلوقتي!</p>
            
            <div class="bg-blue-100 dark:bg-blue-900/30 p-6 rounded-3xl">
                <p class="text-xl font-bold mb-4">عايز مساعدة في إيه؟</p>
                <div class="grid grid-cols-2 gap-4">
                    <button onclick="selectHelp('الرسم')" class="bg-white dark:bg-[#322820] p-6 rounded-2xl hover:scale-105 transition-transform">
                        <span class="text-5xl mb-2 block">🎨</span>
                        <span class="text-lg font-bold">الرسم</span>
                    </button>
                    <button onclick="selectHelp('الأكل')" class="bg-white dark:bg-[#322820] p-6 rounded-2xl hover:scale-105 transition-transform">
                        <span class="text-5xl mb-2 block">🍎</span>
                        <span class="text-lg font-bold">الأكل</span>
                    </button>
                    <button onclick="selectHelp('الحمام')" class="bg-white dark:bg-[#322820] p-6 rounded-2xl hover:scale-105 transition-transform">
                        <span class="text-5xl mb-2 block">🚽</span>
                        <span class="text-lg font-bold">الحمام</span>
                    </button>
                    <button onclick="selectHelp('حاجة تانية')" class="bg-white dark:bg-[#322820] p-6 rounded-2xl hover:scale-105 transition-transform">
                        <span class="text-5xl mb-2 block">❓</span>
                        <span class="text-lg font-bold">تاني</span>
                    </button>
                </div>
            </div>
            
            <button onclick="closeAllPopups()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-xl font-bold py-4 px-8 rounded-2xl hover:scale-105 transition-transform">
                مش محتاج
            </button>
        </div>
    `;
    
    createPopup('محتاج مساعدة', content, '🆘');
}

function selectHelp(type) {
    closeAllPopups();
    showToast(`المعلمة جاية تساعدك في ${type}!`, '👩‍🏫');
}


// ==================== Surprise Page Functions ====================

// فتح صندوق المفاجآت
function openGiftBox(giftType) {
    const gifts = {
        'وسام': {
            emoji: '🏆',
            title: 'وسام البطل!',
            message: 'أنت طفل مبدع ومجتهد!',
            reward: 'نجمتين'
        },
        'رسالة': {
            emoji: '💌',
            title: 'رسالة من المعلمة',
            message: 'أنت طفل رائع! استمر في التفوق يا بطل!',
            reward: 'نجمة'
        },
        'صورة': {
            emoji: '🖼️',
            title: 'صورة نشاطك',
            message: 'شوف رسمتك الجميلة!',
            reward: 'نجمة'
        },
        'وجبة': {
            emoji: '🍕',
            title: 'وقت الأكل!',
            message: 'وجبتك الشهية جاهزة!',
            reward: 'نجمة'
        }
    };
    
    const gift = gifts[giftType] || gifts['وسام'];
    
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-9xl animate-bounce">${gift.emoji}</div>
            <h4 class="text-5xl font-bold text-primary">${gift.title}</h4>
            <p class="text-3xl text-[#8a7560] dark:text-[#cbb8a6]">${gift.message}</p>
            
            <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-8 rounded-3xl">
                <p class="text-white text-3xl font-bold mb-4">مكافأتك:</p>
                <div class="flex justify-center gap-3">
                    ${gift.reward === 'نجمتين' ? 
                        '<span class="text-7xl">⭐</span><span class="text-7xl">⭐</span>' : 
                        '<span class="text-7xl">⭐</span>'}
                </div>
            </div>
            
            ${giftType === 'صورة' ? `
                <div class="bg-white dark:bg-[#322820] p-4 rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=400" class="w-full rounded-2xl" alt="رسمتك">
                </div>
            ` : ''}
            
            <button onclick="collectReward('${gift.reward}')" class="bg-primary text-white text-3xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                خد المكافأة! 🎁
            </button>
        </div>
    `;
    
    createPopup('مفاجأة!', content, '🎁');
    playSound('celebration');
}

function collectReward(reward) {
    const starsToAdd = reward === 'نجمتين' ? 2 : 1;
    stars += starsToAdd;
    updateStarDisplay();
    closeAllPopups();
    showCelebration(`🌟 +${starsToAdd} نجوم! 🌟`);
}

// عرض ذكرى
function viewMemory(day, activity) {
    const content = `
        <div class="space-y-6 text-center">
            <div class="text-8xl animate-bounce">📸</div>
            <h4 class="text-4xl font-bold text-primary">${activity}</h4>
            <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">يوم ${day}</p>
            
            <div class="bg-white dark:bg-[#322820] p-4 rounded-3xl">
                <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=500" class="w-full rounded-2xl" alt="ذكرى">
            </div>
            
            <div class="bg-primary/10 p-6 rounded-3xl">
                <p class="text-xl font-bold">كان يوم جميل! 🌟</p>
            </div>
            
            <button onclick="closeAllPopups()" class="bg-primary text-white text-2xl font-bold py-6 px-12 rounded-full hover:scale-105 transition-transform w-full">
                تمام! 👍
            </button>
        </div>
    `;
    
    createPopup('ذكرى جميلة', content, '💝');
}


// ==================== Event Listeners ====================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎨 Child Portal JavaScript Loaded!');
    
    // ==================== HOME PAGE ====================
    
    // زر "ابدأ اليوم"
    const startDayBtn = document.querySelector('button:has(.material-symbols-outlined)');
    if (startDayBtn && startDayBtn.textContent.includes('ابدأ اليوم')) {
        startDayBtn.addEventListener('click', (e) => {
            e.preventDefault();
            startDayBtn.style.animation = 'bounce 0.5s ease';
            startDay();
        });
    }
    
    // أزرار الأنشطة في الصفحة الرئيسية
    const activityButtons = document.querySelectorAll('button');
    activityButtons.forEach(btn => {
        if (btn.textContent.includes('العب الآن') || 
            btn.textContent.includes('ابدأ الحركة') || 
            btn.textContent.includes('اسمع الآن')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const activityCard = btn.closest('.bg-white');
                const activityName = activityCard?.querySelector('h3')?.textContent || 'النشاط';
                btn.style.animation = 'pulse 0.5s ease';
                startActivity(activityName);
            });
        }
    });
    
    
    // ==================== ACTIVITIES PAGE ====================
    
    // زر "ابدأ الآن" في النشاط الحالي
    const startCurrentActivityBtn = document.querySelector('button:has(.material-symbols-outlined)');
    if (startCurrentActivityBtn && startCurrentActivityBtn.textContent.includes('ابدأ الآن')) {
        startCurrentActivityBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const activityName = document.querySelector('.text-5xl.font-bold')?.textContent || 'النشاط';
            startCurrentActivityBtn.style.animation = 'bounce 0.5s ease';
            startActivity(activityName);
        });
    }
    
    // أزرار التنقل بين الأنشطة
    const navButtons = document.querySelectorAll('button:has(.material-symbols-outlined)');
    navButtons.forEach(btn => {
        const icon = btn.querySelector('.material-symbols-outlined');
        if (icon && (icon.textContent === 'arrow_forward' || icon.textContent === 'arrow_back')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const direction = icon.textContent === 'arrow_back' ? 'next' : 'prev';
                btn.style.animation = 'wiggle 0.5s ease';
                navigateActivities(direction);
            });
        }
    });
    
    // بطاقات الأنشطة (النقر على البطاقة)
    const activityCards = document.querySelectorAll('.group.flex.flex-col.bg-white');
    activityCards.forEach(card => {
        card.addEventListener('click', (e) => {
            e.preventDefault();
            const activityName = card.querySelector('h4')?.textContent || 'النشاط';
            const time = card.querySelector('.text-lg')?.textContent || '9:00 صباحاً';
            const statusBadge = card.querySelector('.rounded-full');
            let status = 'قريباً';
            if (statusBadge?.textContent.includes('مكتمل')) status = 'مكتمل';
            else if (statusBadge?.textContent.includes('الآن')) status = 'الآن';
            
            card.style.animation = 'pulse 0.3s ease';
            showActivityDetails(activityName, time, status);
        });
    });
    
    
    // ==================== ATTENDANCE PAGE ====================
    
    // أزرار التنقل بين الشهور
    const monthNavButtons = document.querySelectorAll('button:has(.material-symbols-outlined)');
    monthNavButtons.forEach(btn => {
        const icon = btn.querySelector('.material-symbols-outlined');
        if (icon && (icon.textContent === 'arrow_forward' || icon.textContent === 'arrow_back')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const direction = icon.textContent === 'arrow_back' ? 'next' : 'prev';
                btn.style.animation = 'wiggle 0.5s ease';
                changeMonth(direction);
            });
        }
    });
    
    // بطاقات الأيام (النقر على اليوم)
    const dayCards = document.querySelectorAll('.flex.flex-col.items-center.gap-3.p-4');
    dayCards.forEach(card => {
        const dayNumber = card.querySelector('.text-xl.font-black');
        const statusText = card.querySelector('.text-xs.font-bold');
        
        if (dayNumber && statusText) {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                const day = dayNumber.textContent;
                const status = statusText.textContent.includes('حاضر') ? 'حاضر' : 
                              statusText.textContent.includes('غائب') ? 'غائب' : 'قريباً';
                
                card.style.animation = 'bounce 0.5s ease';
                showDayDetails(day, status);
            });
        }
    });
    
    
    // ==================== TEACHER TALK PAGE ====================
    
    // أزرار الإيموجي
    const emojiButtons = document.querySelectorAll('button:has(span.text-4xl)');
    emojiButtons.forEach(btn => {
        const emojiSpan = btn.querySelector('span.text-4xl');
        if (emojiSpan && !btn.textContent.includes('انتهيت') && !btn.textContent.includes('ساعديني')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const emoji = emojiSpan.textContent.trim();
                btn.style.animation = 'bounce 0.5s ease';
                sendEmoji(emoji);
            });
        }
    });
    
    // زر الرسالة الصوتية (المايك الكبير)
    const voiceBtn = document.querySelector('button.bg-primary.w-24.h-24');
    if (voiceBtn) {
        voiceBtn.addEventListener('click', (e) => {
            e.preventDefault();
            voiceBtn.style.animation = 'pulse 0.5s ease';
            startVoiceMessage();
        });
    }
    
    // زر "انتهيت!"
    const finishBtn = document.querySelector('button:has(span.material-symbols-outlined)');
    if (finishBtn && finishBtn.textContent.includes('انتهيت')) {
        finishBtn.addEventListener('click', (e) => {
            e.preventDefault();
            finishBtn.style.animation = 'bounce 0.5s ease';
            finishActivity();
        });
    }
    
    // زر "ساعديني"
    allButtons.forEach(btn => {
        if (btn.textContent.includes('ساعديني')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                btn.style.animation = 'wiggle 0.5s ease';
                askForHelp();
            });
        }
    });
    
    
    // ==================== SURPRISE PAGE ====================
    
    // بطاقات المفاجآت
    const giftCards = document.querySelectorAll('.gift-card');
    giftCards.forEach(card => {
        card.addEventListener('click', (e) => {
            e.preventDefault();
            const title = card.querySelector('h3')?.textContent || '';
            let giftType = 'وسام';
            
            if (title.includes('وسام')) giftType = 'وسام';
            else if (title.includes('رسالة')) giftType = 'رسالة';
            else if (title.includes('صورة')) giftType = 'صورة';
            else if (title.includes('وجبة')) giftType = 'وجبة';
            
            card.style.animation = 'bounce 0.5s ease';
            openGiftBox(giftType);
        });
    });
    
    // بطاقات الذكريات
    const memoryCards = document.querySelectorAll('.flex-none.w-64');
    memoryCards.forEach(card => {
        card.addEventListener('click', (e) => {
            e.preventDefault();
            const activity = card.querySelector('.font-bold')?.textContent || 'نشاط';
            const day = card.querySelector('.text-sm')?.textContent || 'الأحد';
            
            card.style.animation = 'pulse 0.3s ease';
            viewMemory(day, activity);
        });
    });
    
    
    // ==================== GLOBAL ANIMATIONS ====================
    
    // النقر على صورة الطفل لعرض الملف الشخصي
    const profileImages = document.querySelectorAll('.w-20.h-20.rounded-full, .w-12.h-12.rounded-full');
    profileImages.forEach(img => {
        if (img.style.backgroundImage && img.style.backgroundImage.includes('AB6AXuDf0Ix67ogfzlpkNqBflrYiwgGhqYcmOqrg4ZEuemA8nLmNxxPYTbqSaiEhaZHaHk7GBWXUEb0OvbcgflNmhHdm9Pwq3qlTPYvCsrUams_WKKTY3BrFI9wYxkn37NIt2IvMlFJq7daZTa9nAv3YN0ItfXGz6Ahel8qmdDm-VbJSzqwOQzlwcXLNDzFvPFmznjrgwlJXlVETgAEGz9Pvt2MnCw_3NjJ3aKLlHzj2pzLk5u9O4qopCeFX3LNj-rEyNaEaAJK83XVFu8vo')) {
            img.style.cursor = 'pointer';
            img.addEventListener('click', (e) => {
                e.preventDefault();
                bounceElement(img);
                showProfile();
            });
        }
    });
    
    // النقر على عداد النجوم لعرض الإنجازات
    const starCounters = document.querySelectorAll('.flex.flex-col.items-center.bg-white');
    starCounters.forEach(counter => {
        const starIcon = counter.querySelector('.material-symbols-outlined');
        if (starIcon && (starIcon.textContent === 'stars' || starIcon.textContent === 'star')) {
            counter.style.cursor = 'pointer';
            counter.addEventListener('click', (e) => {
                e.preventDefault();
                pulseElement(counter);
                showAchievements();
            });
        }
    });
    
    // إضافة animations للأيقونات عند التحميل
    const allIcons = document.querySelectorAll('.material-symbols-outlined');
    allIcons.forEach((icon, index) => {
        setTimeout(() => {
            icon.style.animation = 'fadeIn 0.5s ease';
        }, index * 50);
    });
    
    // إضافة hover effects للبطاقات
    const allCards = document.querySelectorAll('.bg-white, .bg-gradient-to-br, .gift-card');
    allCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'scale(1.02)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'scale(1)';
        });
    });
    
    // تكبير الأيقونات في Navigation
    const navIcons = document.querySelectorAll('.nav-icon');
    navIcons.forEach(icon => {
        icon.style.fontSize = '3.5rem';
    });
    
    // إضافة تأثيرات للـ Navigation Links
    const navLinks = document.querySelectorAll('a[href*=".html"]');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            const icon = link.querySelector('.material-symbols-outlined');
            if (icon) {
                bounceElement(icon);
            }
        });
    });
    
    // إضافة تأثير للـ Home Button في الزاوية
    const homeButtons = document.querySelectorAll('.fixed.bottom-10, .fixed.bottom-8');
    homeButtons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.transform = 'scale(1.1) rotate(5deg)';
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'scale(1) rotate(0deg)';
        });
    });
    
    // إضافة sparkle effect للنجوم
    const starIcons = document.querySelectorAll('.material-symbols-outlined');
    starIcons.forEach(icon => {
        if (icon.textContent === 'stars' || icon.textContent === 'star') {
            icon.classList.add('star-sparkle');
        }
    });
    
    // تفعيل الأصوات عند النقر على أي زر
    document.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', () => {
            playSound('click');
        });
    });
    
    // إضافة confetti effect عند كسب النجوم
    window.showConfetti = function() {
        const colors = ['#f48c25', '#ffd700', '#ff6b6b', '#4ecdc4', '#45b7d1'];
        for (let i = 0; i < 50; i++) {
            setTimeout(() => {
                const confetti = document.createElement('div');
                confetti.style.cssText = `
                    position: fixed;
                    top: -10px;
                    left: ${Math.random() * 100}%;
                    width: 10px;
                    height: 10px;
                    background: ${colors[Math.floor(Math.random() * colors.length)]};
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    animation: fall ${2 + Math.random() * 2}s linear forwards;
                `;
                document.body.appendChild(confetti);
                setTimeout(() => confetti.remove(), 4000);
            }, i * 30);
        }
    };
    
    // إضافة animation للـ confetti
    const confettiStyle = document.createElement('style');
    confettiStyle.textContent = `
        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(confettiStyle);
    
    // تفعيل Dark Mode Toggle (إذا كان موجود)
    const darkModeToggle = document.querySelector('[data-dark-mode-toggle]');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            showToast('تم تغيير الوضع!', '🌙');
        });
    }
    
    // إضافة تأثير الموجة عند النقر
    document.addEventListener('click', (e) => {
        if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
            const ripple = document.createElement('div');
            const btn = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
            const rect = btn.getBoundingClientRect();
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                width: 20px;
                height: 20px;
                left: ${e.clientX - rect.left - 10}px;
                top: ${e.clientY - rect.top - 10}px;
                pointer-events: none;
                animation: ripple 0.6s ease-out;
            `;
            
            btn.style.position = 'relative';
            btn.style.overflow = 'hidden';
            btn.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        }
    });
    
    // إضافة animation للـ ripple
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes ripple {
            to {
                transform: scale(10);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);
    
    console.log('✨ All event listeners attached successfully!');
});

