// ==================== Parent Portal JavaScript Functions ====================
// ملف JavaScript شامل لجميع صفحات ولي الأمر

// ==================== Global Variables ====================
let currentPopup = null;

// ==================== CSS Styles for Popups ====================
(function() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.2s ease-in-out;
        }
        .popup-content {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease-out;
        }
        .dark .popup-content {
            background: #1a2e1a;
            border: 1px solid #2d402d;
        }
    `;
    document.head.appendChild(style);
})();


// ==================== Popup Functions ====================
function createPopup(title, content, size = 'medium') {
    closeAllPopups();
    
    const sizeClasses = {
        small: 'max-w-md',
        medium: 'max-w-2xl',
        large: 'max-w-4xl',
        xlarge: 'max-w-6xl'
    };
    
    const popup = document.createElement('div');
    popup.id = 'dynamicPopup';
    popup.className = 'popup-overlay';
    popup.onclick = (e) => { if (e.target === popup) closeAllPopups(); };
    
    popup.innerHTML = `
        <div class="${sizeClasses[size]} w-full bg-white dark:bg-[#1a2e1a] rounded-2xl shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between p-6 border-b border-[#dce5dc] dark:border-[#2d402d] bg-gray-50/50 dark:bg-black/10">
                <h3 class="text-xl font-bold">${title}</h3>
                <button onclick="closeAllPopups()" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-[#2d402d] transition-colors">
                    <span class="material-symbols-outlined text-[#638863] dark:text-[#a3c2a3]">close</span>
                </button>
            </div>
            <div class="p-6 max-h-[70vh] overflow-y-auto">
                ${content}
            </div>
        </div>
    `;
    
    document.body.appendChild(popup);
    document.body.style.overflow = 'hidden';
    currentPopup = popup;
    
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

// Close popup with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAllPopups();
});


// ==================== Toast Notifications ====================
function showToast(message, type = 'info') {
    const existingToast = document.getElementById('toast');
    if (existingToast) existingToast.remove();
    
    const icons = {
        success: 'check_circle',
        error: 'error',
        warning: 'warning',
        info: 'info'
    };
    
    const colors = {
        success: 'border-green-500 bg-green-50 dark:bg-green-900/20',
        error: 'border-red-500 bg-red-50 dark:bg-red-900/20',
        warning: 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20',
        info: 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
    };
    
    const iconColors = {
        success: 'text-green-600 dark:text-green-400',
        error: 'text-red-600 dark:text-red-400',
        warning: 'text-yellow-600 dark:text-yellow-400',
        info: 'text-blue-600 dark:text-blue-400'
    };
    
    const toast = document.createElement('div');
    toast.id = 'toast';
    toast.className = `fixed top-20 left-1/2 transform -translate-x-1/2 ${colors[type]} border-2 rounded-xl shadow-2xl px-6 py-4 z-[110] min-w-[300px]`;
    toast.style.animation = 'slideUp 0.3s ease-out';
    
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined ${iconColors[type]} text-3xl">${icons[type]}</span>
            <p class="text-zinc-900 dark:text-white font-medium">${message}</p>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'fadeIn 0.2s ease-out reverse';
        setTimeout(() => toast.remove(), 200);
    }, 3000);
}


// ==================== Dashboard Functions ====================

// عرض التقرير اليومي للطفل
function showDailyReport(childName) {
    const content = `
        <div class="space-y-6">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">التقرير اليومي - ${childName}</h4>
                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">التاريخ: ${new Date().toLocaleDateString('ar-EG', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">restaurant</span>
                        <h5 class="font-bold">الوجبات</h5>
                    </div>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الإفطار: تناول بالكامل ✓</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الغداء: تناول 80%</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الوجبة الخفيفة: تناول بالكامل ✓</p>
                </div>
                
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">bedtime</span>
                        <h5 class="font-bold">القيلولة</h5>
                    </div>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">المدة: ساعة و 15 دقيقة</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الوقت: 1:00 - 2:15 م</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الجودة: نوم هادئ ومريح</p>
                </div>
                
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">mood</span>
                        <h5 class="font-bold">الحالة المزاجية</h5>
                    </div>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">سعيد ومتفاعل طوال اليوم</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">تعاون مع الأصدقاء بشكل ممتاز</p>
                </div>
                
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">draw</span>
                        <h5 class="font-bold">الأنشطة</h5>
                    </div>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">رسم بالألوان المائية</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">قراءة قصة جماعية</p>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">ألعاب حركية في الحديقة</p>
                </div>
            </div>
            
            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-amber-600 text-xl">lightbulb</span>
                    <div class="text-sm">
                        <p class="font-bold text-amber-900 dark:text-amber-200 mb-1">ملاحظة المعلمة</p>
                        <p class="text-amber-800 dark:text-amber-300">
                            ${childName} كان متعاوناً جداً اليوم وأظهر تحسناً ملحوظاً في مهارات الرسم. نشجعه على الاستمرار!
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="printReport()" class="px-6 py-2.5 bg-primary text-[#111811] rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">print</span>
                    طباعة التقرير
                </button>
            </div>
        </div>
    `;
    
    createPopup(`التقرير اليومي - ${childName}`, content, 'large');
}

// طباعة التقرير
function printReport() {
    showToast('جاري تحضير التقرير للطباعة...', 'info');
    setTimeout(() => {
        window.print();
    }, 500);
}


// ==================== Absence Page Functions ====================

// طباعة تقرير الحضور
function printAttendanceReport() {
    showToast('جاري تحضير تقرير الحضور للطباعة...', 'info');
    setTimeout(() => {
        window.print();
        showToast('تم فتح نافذة الطباعة', 'success');
    }, 1000);
}

// تصفية حسب الشهر
function filterByMonth(month) {
    showToast(`جاري تحميل بيانات ${getMonthName(month)}...`, 'info');
    
    setTimeout(() => {
        // هنا يمكن إضافة كود لتحميل البيانات من الخادم
        showToast(`تم تحميل بيانات ${getMonthName(month)} بنجاح`, 'success');
        
        // تحديث عنوان الجدول
        const tableTitle = document.querySelector('.bg-white.dark\\:bg-\\[\\#1a2e1a\\].rounded-2xl .p-6 span.text-xs');
        if (tableTitle) {
            tableTitle.textContent = getMonthName(month);
        }
    }, 1000);
}

// الحصول على اسم الشهر بالعربية
function getMonthName(monthValue) {
    const months = {
        '2025-10': 'أكتوبر 2025',
        '2025-09': 'سبتمبر 2025',
        '2025-08': 'أغسطس 2025',
        '2025-07': 'يوليو 2025',
        '2025-06': 'يونيو 2025',
        '2025-05': 'مايو 2025'
    };
    return months[monthValue] || monthValue;
}

// عرض جميع أيام الشهر
function showAllMonthDays() {
    showToast('جاري تحميل جميع أيام الشهر...', 'info');
    setTimeout(() => {
        showToast('تم تحميل جميع الأيام بنجاح', 'success');
    }, 1000);
}

// ==================== Activities Page Functions ====================

// تصفية الأنشطة حسب الفترة
function filterActivities(period) {
    const buttons = document.querySelectorAll('header button');
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-[#111811]', 'shadow-lg', 'shadow-primary/20');
        btn.classList.add('bg-white', 'dark:bg-[#1a2e1a]', 'border', 'border-[#dce5dc]', 'dark:border-[#2d402d]');
    });
    
    event.target.classList.add('bg-primary', 'text-[#111811]', 'shadow-lg', 'shadow-primary/20');
    event.target.classList.remove('bg-white', 'dark:bg-[#1a2e1a]', 'border', 'border-[#dce5dc]', 'dark:border-[#2d402d]');
    
    showToast(`تم التصفية: ${period}`, 'info');
}

// عرض أنشطة الشهر الماضي - تم حذفها

// عرض تفاصيل النشاط
function showActivityDetails(activityName, childName, date) {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">${activityName}</h4>
                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">${childName} • ${date}</p>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h5 class="font-bold mb-2">وصف النشاط</h5>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">
                        نشاط إبداعي يهدف إلى تنمية المهارات الحركية الدقيقة والإبداع الفني لدى الأطفال.
                    </p>
                </div>
                
                <div>
                    <h5 class="font-bold mb-2">الأهداف التعليمية</h5>
                    <ul class="list-disc list-inside text-sm text-[#638863] dark:text-[#a3c2a3] space-y-1">
                        <li>تطوير المهارات الحركية الدقيقة</li>
                        <li>تعزيز الإبداع والخيال</li>
                        <li>تعلم التعاون والعمل الجماعي</li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-bold mb-2">تقييم الأداء</h5>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-2xl">⭐⭐⭐⭐⭐</span>
                        <span class="text-sm font-bold text-primary">ممتاز</span>
                    </div>
                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">
                        أظهر مهارة رائعة وإبداعاً ملحوظاً في تنفيذ النشاط
                    </p>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إغلاق
                </button>
            </div>
        </div>
    `;
    
    createPopup('تفاصيل النشاط', content, 'medium');
}


// ==================== Add Child Page Functions ====================

// معالجة إضافة طفل جديد
function handleAddChild(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const childData = {
        firstName: formData.get('firstName') || document.querySelector('input[placeholder*="ليلى"]').value,
        lastName: formData.get('lastName') || document.querySelector('input[placeholder*="أحمد"]').value,
        gender: formData.get('gender') || document.querySelector('select').value,
        birthdate: formData.get('birthdate') || document.querySelector('input[type="date"]').value,
        level: formData.get('level'),
        class: formData.get('class')
    };
    
    if (!childData.firstName || !childData.lastName || !childData.gender || !childData.birthdate) {
        showToast('يرجى ملء جميع الحقول المطلوبة', 'error');
        return;
    }
    
    showToast('جاري إضافة الطفل...', 'info');
    
    setTimeout(() => {
        showToast(`تم إضافة ${childData.firstName} ${childData.lastName} بنجاح!`, 'success');
        setTimeout(() => {
            window.location.href = 'parentdashboard.html';
        }, 1500);
    }, 1500);
}

// إلغاء إضافة طفل
function cancelAddChild() {
    if (confirm('هل أنت متأكد من إلغاء إضافة الطفل؟ سيتم فقدان جميع البيانات المدخلة.')) {
        window.location.href = 'parentdashboard.html';
    }
}

// ==================== Messages Page Functions ====================

// متغيرات المحادثات
let currentChat = {
    name: 'أ. سارة محمد',
    role: 'معلمة الصف التمهيدي أ',
    image: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80'
};

let attachedFiles = [];

// التبديل بين المحادثات
function switchChat(chatName, chatRole, chatImage) {
    currentChat = { name: chatName, role: chatRole, image: chatImage };
    
    console.log('Switching to chat:', chatName);
    
    // البحث عن هيدر المحادثة بطرق متعددة
    let chatHeader = document.querySelector('.lg\\:col-span-2 .p-5.border-b');
    
    // محاولة بديلة
    if (!chatHeader) {
        const chatArea = document.querySelector('.lg\\:col-span-2');
        if (chatArea) {
            chatHeader = chatArea.querySelector('.border-b');
        }
    }
    
    console.log('Chat header found:', chatHeader);
    
    if (chatHeader) {
        chatHeader.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-cover bg-center" style="background-image: url('${chatImage}')"></div>
                <div>
                    <p class="font-bold">${chatName}</p>
                    <p class="text-xs text-[#638863] dark:text-[#a3c2a3]">${chatRole}</p>
                </div>
            </div>
            <button class="text-[#638863] dark:text-[#a3c2a3] hover:text-primary transition-colors">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
        `;
        console.log('Chat header updated');
    }
    
    // البحث عن حاوية الرسائل
    let messagesContainer = document.querySelector('.lg\\:col-span-2 .flex-1.p-6.overflow-y-auto');
    
    if (!messagesContainer) {
        const chatArea = document.querySelector('.lg\\:col-span-2');
        if (chatArea) {
            messagesContainer = chatArea.querySelector('.flex-1.overflow-y-auto');
        }
    }
    
    console.log('Messages container found:', messagesContainer);
    
    if (messagesContainer) {
        messagesContainer.innerHTML = `
            <div class="flex items-start gap-4 max-w-3xl">
                <div class="w-10 h-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('${chatImage}')"></div>
                <div class="flex-1">
                    <div class="bg-gray-100 dark:bg-[#112111] rounded-2xl rounded-tr-none p-4">
                        <p>مرحباً، كيف يمكنني مساعدتك؟</p>
                    </div>
                    <span class="text-xs text-[#638863] dark:text-[#a3c2a3] mt-1 block">الآن</span>
                </div>
            </div>
        `;
        console.log('Messages cleared and welcome message added');
    }
    
    // تحديث الحالة النشطة في القائمة
    document.querySelectorAll('.lg\\:col-span-1 a').forEach(link => {
        link.classList.remove('bg-primary/5');
    });
    
    if (event && event.target) {
        const clickedLink = event.target.closest('a');
        if (clickedLink) {
            clickedLink.classList.add('bg-primary/5');
        }
    }
    
    showToast(`تم فتح محادثة ${chatName}`, 'success');
}

// إرسال رسالة جديدة
function sendMessage(event) {
    if (event) event.preventDefault();
    
    const messageInput = document.querySelector('input[placeholder*="اكتب رسالتك"]');
    if (!messageInput) {
        console.error('Message input not found');
        showToast('خطأ: لم يتم العثور على حقل الرسالة', 'error');
        return;
    }
    
    const messageText = messageInput.value.trim();
    console.log('Message text:', messageText);
    console.log('Attached files:', attachedFiles.length);
    
    if (!messageText && attachedFiles.length === 0) {
        showToast('يرجى كتابة رسالة أو إرفاق ملف', 'warning');
        return;
    }
    
    // البحث عن حاوية الرسائل بطرق متعددة
    let messagesContainer = document.querySelector('.lg\\:col-span-2 .flex-1.p-6.overflow-y-auto');
    
    // محاولة بديلة للعثور على الحاوية
    if (!messagesContainer) {
        const chatArea = document.querySelector('.lg\\:col-span-2');
        if (chatArea) {
            messagesContainer = chatArea.querySelector('.flex-1.overflow-y-auto');
        }
    }
    
    console.log('Messages container:', messagesContainer);
    
    if (!messagesContainer) {
        console.error('Messages container not found');
        showToast('خطأ: لم يتم العثور على منطقة الرسائل', 'error');
        return;
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'flex items-start gap-4 max-w-3xl flex-row-reverse';
    messageDiv.style.marginTop = '1.5rem';
    
    let filesHTML = '';
    if (attachedFiles.length > 0) {
        filesHTML = '<div class="flex gap-2 mt-3 flex-wrap">';
        attachedFiles.forEach(file => {
            if (file.type.startsWith('image/')) {
                filesHTML += `
                    <div class="relative group">
                        <img src="${file.preview}" class="w-24 h-24 rounded-lg object-cover border-2 border-primary/20" />
                        <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs">${file.name}</span>
                        </div>
                    </div>
                `;
            } else {
                filesHTML += `
                    <div class="flex items-center gap-2 bg-white dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-lg p-3">
                        <span class="material-symbols-outlined text-primary">description</span>
                        <div class="text-xs">
                            <p class="font-bold">${file.name}</p>
                            <p class="text-[#638863] dark:text-[#a3c2a3]">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                `;
            }
        });
        filesHTML += '</div>';
    }
    
    messageDiv.innerHTML = `
        <div class="w-10 h-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCoNKPpXzXYSEFlvxulodXggbSdsxj0jHDD6aVOTiDJQRBElKwveAMc7giiWmqSnxi-S-OfILt2hkFl-eKa6MTGgvznUfckgigR_vu-XKy_8EP8IVi7EcyVofU1aOxwoSPuTjAsbu-SnPMxr4x6JloEp9utClJEQqqiRcGMxr_VZGM_k2RLIdCpWPGjzyCTUesuurXg6AsSZJb8OOmLDF1p4JHg_hPE7Ay0BxOtczfN42O9_JIZ37cKc29jM6Y5Sp11mv-pLaYmpkOW')"></div>
        <div class="flex-1">
            <div class="bg-primary/10 rounded-2xl rounded-tl-none p-4">
                ${messageText ? `<p>${messageText}</p>` : ''}
                ${filesHTML}
            </div>
            <span class="text-xs text-[#638863] dark:text-[#a3c2a3] mt-1 block text-right">الآن</span>
        </div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    console.log('Message added successfully');
    
    messageInput.value = '';
    attachedFiles = [];
    updateAttachedFilesDisplay();
    showToast('تم إرسال الرسالة', 'success');
}

// تنسيق حجم الملف
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// إرفاق ملف
function attachFile() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*,.pdf,.doc,.docx';
    input.multiple = true;
    input.onchange = (e) => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            if (file.size > 10 * 1024 * 1024) { // 10MB max
                showToast(`الملف ${file.name} كبير جداً (الحد الأقصى 10MB)`, 'error');
                return;
            }
            
            const fileObj = {
                name: file.name,
                size: file.size,
                type: file.type,
                file: file
            };
            
            // إنشاء معاينة للصور
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    fileObj.preview = e.target.result;
                    attachedFiles.push(fileObj);
                    updateAttachedFilesDisplay();
                };
                reader.readAsDataURL(file);
            } else {
                attachedFiles.push(fileObj);
                updateAttachedFilesDisplay();
            }
        });
        
        if (files.length > 0) {
            showToast(`تم إرفاق ${files.length} ملف`, 'success');
        }
    };
    input.click();
}

// تحديث عرض الملفات المرفقة
function updateAttachedFilesDisplay() {
    let container = document.getElementById('attachedFilesContainer');
    
    if (attachedFiles.length === 0) {
        if (container) container.remove();
        return;
    }
    
    if (!container) {
        container = document.createElement('div');
        container.id = 'attachedFilesContainer';
        container.className = 'px-5 py-3 border-t border-[#dce5dc] dark:border-[#2d402d] bg-gray-50/50 dark:bg-black/20';
        
        // البحث عن منطقة الإدخال بطرق متعددة
        let chatFooter = document.querySelector('.lg\\:col-span-2 .p-5.border-t');
        
        if (!chatFooter) {
            const chatArea = document.querySelector('.lg\\:col-span-2');
            if (chatArea) {
                chatFooter = chatArea.querySelector('.border-t:last-child');
            }
        }
        
        console.log('Chat footer found:', chatFooter);
        
        if (chatFooter && chatFooter.parentNode) {
            chatFooter.parentNode.insertBefore(container, chatFooter);
            console.log('Attached files container added');
        } else {
            console.error('Could not find chat footer to insert attached files');
            return;
        }
    }
    
    container.innerHTML = `
        <div class="flex items-center gap-2 mb-2">
            <span class="text-xs font-bold text-[#638863] dark:text-[#a3c2a3]">الملفات المرفقة (${attachedFiles.length})</span>
            <button onclick="clearAttachedFiles()" class="text-xs text-red-500 hover:underline">مسح الكل</button>
        </div>
        <div class="flex gap-2 flex-wrap">
            ${attachedFiles.map((file, index) => `
                <div class="relative group">
                    ${file.preview ? 
                        `<img src="${file.preview}" class="w-16 h-16 rounded-lg object-cover border border-[#dce5dc] dark:border-[#2d402d]" />` :
                        `<div class="w-16 h-16 rounded-lg border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#112111] flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-2xl">description</span>
                        </div>`
                    }
                    <button onclick="removeAttachedFile(${index})" class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                        ×
                    </button>
                    <p class="text-[10px] text-center mt-1 truncate w-16" title="${file.name}">${file.name}</p>
                </div>
            `).join('')}
        </div>
    `;
    
    console.log('Attached files display updated');
}

// إزالة ملف مرفق
function removeAttachedFile(index) {
    attachedFiles.splice(index, 1);
    updateAttachedFilesDisplay();
    showToast('تم إزالة الملف', 'info');
}

// مسح جميع الملفات المرفقة
function clearAttachedFiles() {
    attachedFiles = [];
    updateAttachedFilesDisplay();
    showToast('تم مسح جميع الملفات', 'info');
}

// رسالة جديدة
function composeNewMessage() {
    const content = `
        <form onsubmit="handleSendNewMessage(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">المرسل إليه</label>
                <select required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر المستلم</option>
                    <option value="teacher1">أ. سارة محمد - معلمة الصف</option>
                    <option value="teacher2">أ. نورا علي - معلمة النشاط</option>
                    <option value="admin">إدارة الحضانة</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">الموضوع</label>
                <input type="text" required placeholder="موضوع الرسالة" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">الرسالة</label>
                <textarea required rows="6" placeholder="اكتب رسالتك هنا..." class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-[#111811] rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    إرسال
                </button>
            </div>
        </form>
    `;
    
    createPopup('رسالة جديدة', content, 'medium');
}

function handleSendNewMessage(event) {
    event.preventDefault();
    showToast('جاري إرسال الرسالة...', 'info');
    setTimeout(() => {
        showToast('تم إرسال الرسالة بنجاح!', 'success');
        closeAllPopups();
    }, 1000);
}


// ==================== Notifications Page Functions ====================

// تحديد جميع الإشعارات كمقروءة
function markAllAsRead() {
    showToast('جاري تحديد جميع الإشعارات كمقروءة...', 'info');
    
    setTimeout(() => {
        const badge = document.querySelector('.bg-red-500');
        if (badge) badge.remove();
        
        showToast('تم تحديد جميع الإشعارات كمقروءة', 'success');
    }, 1000);
}

// الاتصال بالحضانة
function callNursery() {
    showToast('جاري الاتصال بالحضانة...', 'info');
    setTimeout(() => {
        window.location.href = 'tel:+201012345678';
    }, 500);
}

// تأجيل التذكير
function snoozeReminder() {
    showToast('تم تأجيل التذكير لمدة ساعة', 'success');
}

// إضافة إلى التقويم
function addToCalendar(eventName, eventDate) {
    showToast(`تم إضافة "${eventName}" إلى التقويم`, 'success');
}

// عرض تفاصيل الإشعار
function showNotificationDetails(title, message) {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">${title}</h4>
            </div>
            
            <div class="text-[#638863] dark:text-[#a3c2a3]">
                <p>${message}</p>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl bg-primary text-[#111811] hover:brightness-110 transition-colors font-medium">
                    حسناً
                </button>
            </div>
        </div>
    `;
    
    createPopup('تفاصيل الإشعار', content, 'medium');
}

// ==================== Payment Page Functions ====================

// عرض سجل الدفعات
function showPaymentHistory() {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">سجل الدفعات</h4>
                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">آخر 6 أشهر</p>
            </div>
            
            <div class="space-y-3">
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold">مارس 2026</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الرسوم الشهرية</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مدفوع</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">المبلغ</span>
                        <span class="font-bold">3,330 ج.م</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">التاريخ</span>
                        <span>٥ مارس ٢٠٢٦</span>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold">فبراير 2026</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الرسوم الشهرية</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مدفوع</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">المبلغ</span>
                        <span class="font-bold">3,700 ج.م</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">التاريخ</span>
                        <span>٨ فبراير ٢٠٢٦</span>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold">يناير 2026</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الرسوم الشهرية</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مدفوع</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">المبلغ</span>
                        <span class="font-bold">3,700 ج.م</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">التاريخ</span>
                        <span>١٠ يناير ٢٠٢٦</span>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="exportPaymentHistory()" class="px-6 py-2.5 bg-primary text-[#111811] rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">download</span>
                    تصدير PDF
                </button>
            </div>
        </div>
    `;
    
    createPopup('سجل الدفعات', content, 'medium');
}

function exportPaymentHistory() {
    showToast('جاري تصدير سجل الدفعات...', 'info');
    setTimeout(() => {
        showToast('تم تصدير السجل بنجاح', 'success');
    }, 1500);
}

// معالجة الدفع
function processPayment(amount) {
    const content = `
        <form onsubmit="handlePayment(event, ${amount})" class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary text-center">
                <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-2">المبلغ المطلوب</p>
                <p class="text-4xl font-black text-primary">${amount.toLocaleString('ar-EG')} ج.م</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">طريقة الدفع</label>
                <select required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر طريقة الدفع</option>
                    <option value="card">بطاقة ائتمان / خصم</option>
                    <option value="bank">تحويل بنكي</option>
                    <option value="fawry">فوري / كروت الدفع</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">رقم البطاقة</label>
                <input type="text" required placeholder="1234 5678 9012 3456" maxlength="19" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">تاريخ الانتهاء</label>
                    <input type="text" required placeholder="MM/YY" maxlength="5" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">CVV</label>
                    <input type="text" required placeholder="123" maxlength="3" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>
            
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-xl">lock</span>
                    <p class="text-sm text-blue-800 dark:text-blue-300">
                        جميع المعاملات محمية بتشفير SSL. بياناتك آمنة تماماً.
                    </p>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-8 py-2.5 bg-primary text-[#111811] rounded-xl hover:brightness-110 transition-colors font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined">payment</span>
                    دفع ${amount.toLocaleString('ar-EG')} ج.م
                </button>
            </div>
        </form>
    `;
    
    createPopup('إتمام عملية الدفع', content, 'medium');
}

function handlePayment(event, amount) {
    event.preventDefault();
    showToast('جاري معالجة الدفع...', 'info');
    
    setTimeout(() => {
        closeAllPopups();
        showToast(`تم الدفع بنجاح! المبلغ: ${amount.toLocaleString('ar-EG')} ج.م`, 'success');
        
        setTimeout(() => {
            showPaymentReceipt(amount);
        }, 1500);
    }, 2000);
}

function showPaymentReceipt(amount) {
    const content = `
        <div class="space-y-5 text-center">
            <div class="flex justify-center">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-5xl">check_circle</span>
                </div>
            </div>
            
            <div>
                <h4 class="text-2xl font-bold mb-2">تم الدفع بنجاح!</h4>
                <p class="text-[#638863] dark:text-[#a3c2a3]">شكراً لك على الدفع</p>
            </div>
            
            <div class="bg-gray-50 dark:bg-[#112111] p-5 rounded-xl">
                <div class="space-y-3 text-right">
                    <div class="flex justify-between">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">المبلغ المدفوع</span>
                        <span class="font-bold">${amount.toLocaleString('ar-EG')} ج.م</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">رقم العملية</span>
                        <span class="font-bold">#${Math.floor(Math.random() * 1000000)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">التاريخ</span>
                        <span class="font-bold">${new Date().toLocaleDateString('ar-EG')}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#638863] dark:text-[#a3c2a3]">الحالة</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center gap-3 pt-4">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="printReceipt()" class="px-6 py-2.5 bg-primary text-[#111811] rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">print</span>
                    طباعة الإيصال
                </button>
            </div>
        </div>
    `;
    
    createPopup('إيصال الدفع', content, 'small');
}

function printReceipt() {
    showToast('جاري طباعة الإيصال...', 'info');
    setTimeout(() => {
        window.print();
    }, 500);
}


// ==================== Settings Page Functions ====================

// حفظ بيانات الحساب
function saveAccountSettings(event) {
    if (event) event.preventDefault();
    
    showToast('جاري حفظ التغييرات...', 'info');
    
    setTimeout(() => {
        showToast('تم حفظ بيانات الحساب بنجاح!', 'success');
    }, 1000);
}

// تطبيق إعدادات المظهر
function applyAppearanceSettings(event) {
    if (event) event.preventDefault();
    
    showToast('جاري تطبيق التغييرات...', 'info');
    
    setTimeout(() => {
        showToast('تم تطبيق إعدادات المظهر بنجاح!', 'success');
    }, 1000);
}

// تغيير كلمة المرور
function changePassword(event) {
    if (event) event.preventDefault();
    
    const currentPassword = document.querySelector('input[placeholder="••••••••"]').value;
    const newPassword = document.querySelectorAll('input[placeholder="••••••••"]')[1]?.value;
    const confirmPassword = document.querySelectorAll('input[placeholder="••••••••"]')[2]?.value;
    
    if (!currentPassword || !newPassword || !confirmPassword) {
        showToast('يرجى ملء جميع الحقول', 'error');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        showToast('كلمة المرور الجديدة غير متطابقة', 'error');
        return;
    }
    
    if (newPassword.length < 8) {
        showToast('كلمة المرور يجب أن تكون 8 أحرف على الأقل', 'error');
        return;
    }
    
    showToast('جاري تغيير كلمة المرور...', 'info');
    
    setTimeout(() => {
        showToast('تم تغيير كلمة المرور بنجاح!', 'success');
        document.querySelectorAll('input[type="password"]').forEach(input => input.value = '');
    }, 1500);
}

// حذف الحساب
function deleteAccount() {
    const content = `
        <div class="space-y-5">
            <div class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-800 p-6 rounded-xl text-center">
                <span class="material-symbols-outlined text-red-500 text-6xl mb-4 block">warning</span>
                <h4 class="text-xl font-bold text-red-600 dark:text-red-400 mb-2">تحذير: حذف الحساب نهائياً</h4>
                <p class="text-[#638863] dark:text-[#a3c2a3]">
                    هذا الإجراء لا يمكن التراجع عنه. سيتم حذف جميع بياناتك وبيانات أطفالك بشكل نهائي.
                </p>
            </div>
            
            <div class="bg-white dark:bg-[#112111] p-5 rounded-xl border border-[#dce5dc] dark:border-[#2d402d]">
                <h5 class="font-bold mb-3">سيتم حذف:</h5>
                <ul class="space-y-2 text-sm text-[#638863] dark:text-[#a3c2a3]">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 text-sm">close</span>
                        جميع بيانات الأطفال والأنشطة
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 text-sm">close</span>
                        سجل الحضور والغياب
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 text-sm">close</span>
                        سجل الدفعات والفواتير
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 text-sm">close</span>
                        جميع الرسائل والمحادثات
                    </li>
                </ul>
            </div>
            
            <form onsubmit="confirmDeleteAccount(event)" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">للتأكيد، اكتب "حذف الحساب"</label>
                    <input type="text" id="deleteConfirmation" required placeholder="حذف الحساب" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/50">
                </div>
                
                <div class="flex justify-center gap-3 pt-4">
                    <button type="button" onclick="closeAllPopups()" class="px-8 py-3 rounded-xl border-2 border-[#dce5dc] dark:border-[#2d402d] hover:bg-gray-100 dark:hover:bg-[#2d402d] transition-colors font-bold">
                        إلغاء
                    </button>
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined">delete_forever</span>
                        حذف الحساب نهائياً
                    </button>
                </div>
            </form>
        </div>
    `;
    
    createPopup('تأكيد حذف الحساب', content, 'medium');
}

function confirmDeleteAccount(event) {
    event.preventDefault();
    
    const confirmation = document.getElementById('deleteConfirmation').value;
    
    if (confirmation !== 'حذف الحساب') {
        showToast('يرجى كتابة "حذف الحساب" للتأكيد', 'error');
        return;
    }
    
    showToast('جاري حذف الحساب...', 'info');
    
    setTimeout(() => {
        closeAllPopups();
        showToast('تم حذف الحساب بنجاح', 'success');
        
        setTimeout(() => {
            window.location.href = '../index.html';
        }, 2000);
    }, 2000);
}

// تبديل الوضع الليلي
function toggleDarkMode(checkbox) {
    if (checkbox.checked) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('darkMode', 'enabled');
        showToast('تم تفعيل الوضع الليلي', 'success');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('darkMode', 'disabled');
        showToast('تم تعطيل الوضع الليلي', 'success');
    }
}

// ==================== Event Listeners ====================
document.addEventListener('DOMContentLoaded', function() {
    // تفعيل الوضع الليلي من localStorage
    const darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'enabled') {
        document.documentElement.classList.add('dark');
        const darkModeToggle = document.querySelector('input[type="checkbox"]');
        if (darkModeToggle) darkModeToggle.checked = true;
    }
    
    // ربط أزرار التقرير اليومي
    const reportButtons = document.querySelectorAll('button:has-text("عرض التقرير اليومي")');
    reportButtons.forEach(button => {
        button.onclick = function() {
            const childCard = this.closest('.bg-white, .dark\\:bg-\\[\\#1a2e1a\\]');
            const childName = childCard?.querySelector('h4')?.textContent || 'الطفل';
            showDailyReport(childName);
        };
    });
    
    // ربط نموذج إضافة طفل
    const addChildForm = document.querySelector('form');
    if (addChildForm && window.location.pathname.includes('addchild')) {
        addChildForm.onsubmit = handleAddChild;
        
        const cancelButton = document.querySelector('button[type="button"]');
        if (cancelButton) cancelButton.onclick = cancelAddChild;
    }
    
    // ربط زر إرسال الرسالة
    const sendButton = document.querySelector('button:has(.material-symbols-outlined:has-text("send"))');
    if (sendButton && window.location.pathname.includes('messages')) {
        sendButton.onclick = sendMessage;
        
        const messageInput = document.querySelector('input[placeholder*="اكتب رسالتك"]');
        if (messageInput) {
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        }
        
        const attachButton = document.querySelector('button:has(.material-symbols-outlined:has-text("attach_file"))');
        if (attachButton) attachButton.onclick = attachFile;
        
        const newMessageButton = document.querySelector('button:has-text("رسالة جديدة")');
        if (newMessageButton) newMessageButton.onclick = composeNewMessage;
    }
    
    // ربط أزرار الإشعارات
    if (window.location.pathname.includes('notification')) {
        const markAllButton = document.querySelector('button:has-text("تحديد الكل كمقروء")');
        if (markAllButton) markAllButton.onclick = markAllAsRead;
        
        const callButtons = document.querySelectorAll('button:has-text("الاتصال بالحضانة")');
        callButtons.forEach(btn => btn.onclick = callNursery);
        
        const snoozeButtons = document.querySelectorAll('button:has-text("تأجيل التذكير")');
        snoozeButtons.forEach(btn => btn.onclick = snoozeReminder);
        
        const calendarButtons = document.querySelectorAll('button:has-text("إضافة إلى التقويم")');
        calendarButtons.forEach(btn => btn.onclick = () => addToCalendar('موعد', 'تاريخ'));
        
        const loadMoreButton = document.querySelector('button:has-text("عرض المزيد من التنبيهات")');
        if (loadMoreButton) loadMoreButton.onclick = loadMoreNotifications;
    }
    
    // ربط أزرار الدفع
    if (window.location.pathname.includes('payment')) {
        const historyButton = document.querySelector('button:has-text("سجل الدفعات")');
        if (historyButton) historyButton.onclick = showPaymentHistory;
        
        const payButton = document.querySelector('button:has-text("دفع")');
        if (payButton) {
            payButton.onclick = function() {
                const amountText = this.textContent.match(/[\d,]+/)?.[0];
                const amount = parseInt(amountText?.replace(/,/g, '') || '3050');
                processPayment(amount);
            };
        }
    }
    
    // ربط أزرار الإعدادات
    if (window.location.pathname.includes('settings')) {
        const forms = document.querySelectorAll('form');
        forms.forEach((form, index) => {
            if (index === 0) form.onsubmit = saveAccountSettings;
            if (index === 1) form.onsubmit = applyAppearanceSettings;
            if (index === 2) form.onsubmit = changePassword;
        });
        
        const deleteButton = document.querySelector('button:has-text("حذف الحساب نهائياً")');
        if (deleteButton) deleteButton.onclick = deleteAccount;
        
        const darkModeToggle = document.querySelector('input[type="checkbox"]');
        if (darkModeToggle) darkModeToggle.onchange = function() { toggleDarkMode(this); };
    }
    
    // ربط أزرار الحضور
    if (window.location.pathname.includes('absence')) {
        const printButton = document.querySelector('button:has-text("طباعة التقرير")');
        if (printButton) printButton.onclick = printAttendanceReport;
        
        const showAllButton = document.querySelector('button:has-text("عرض جميع أيام الشهر")');
        if (showAllButton) showAllButton.onclick = showAllMonthDays;
    }
    
    // ربط أزرار الأنشطة
    if (window.location.pathname.includes('activities')) {
        const previousMonthButton = document.querySelector('button:has-text("عرض أنشطة الشهر الماضي")');
        if (previousMonthButton) previousMonthButton.onclick = showPreviousMonthActivities;
    }
});

// ==================== Utility Functions ====================

// البحث في الجدول
function searchTable() {
    const input = document.getElementById('searchInput');
    if (!input) return;
    
    const filter = input.value.toLowerCase();
    const tables = document.querySelectorAll('table tbody');
    
    tables.forEach(table => {
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
}

console.log('Parent Portal Functions Loaded Successfully ✓');
