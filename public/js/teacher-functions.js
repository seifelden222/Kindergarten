// ==================== Teacher Portal JavaScript Functions ====================
// ملف JavaScript شامل لجميع صفحات المعلم

// ==================== Global Variables ====================
let currentPopup = null;
let selectedStudents = [];
let currentChat = null;
let attachedFiles = [];
const teacherGalleryStorageKey = 'teacher_gallery_images';
const teacherDefaultGalleryImages = [
    'https://lh3.googleusercontent.com/aida-public/AB6AXuDdhplbP3H82o9tEb9D0XLjLv3e1XX5SsR-FK99wrAcicty2ECPmJwIGrkZqEjnjTSoR2yImla3FV669ZIi9cAeaqe2a6yi4i7qWbztcf9kgS6JPV5Xh5MjMZojR_MdW01lliEr5FNm2QDhx1a0qwrw1R4NGa20FNtJRqfzUugADZ2vvhG4Bu3oXEngcq-wMTE_-8IzDDuBWIpssenetbL308QpG8AKHmzCen0XTGp-Na38kO2lpmR1WmUMdN2f2_BIzIb1LinGhGBI',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuALdWpXUijdTqTuku3D3WsLRVrnDsZ0NSqzHG2e3T13eklGSTvo-zCSJ6yThJUTA7iTahCCp0bqkVSDlch_qo0ONCGGRzgE4s59Joa8BZSEWd3P8Wk_vKPBH0Dh3x6JzAMqUtjsD-YFXyEQ0jBa_xXF1znheYBUDD1_2yF1rECDkkQRVvv00nSX7WHYFoth4-CYKhK3t1bxTsDrepWrti7PEkG9Z84SjbmNkW2qhwBxH2mQYnD41v6VhmOzS10q8U-y367BuRpsCvsq',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuA-qcip3O8MklKeBV1IFIl8fwHN6kjzxjwkcdB1E1-u7WN2S4qfmFbDc-xeMBWG3yM3h2mN4M2lN5O0ocYodrXLJxOMY8nyUZORE5eUQfK2m3F6vaAj-0H5CTFR1o1QZxT45K6kUlVqBoVVX2u_kxWmaTcvXwKHEG1Ryw_Lt8eYCcW53k0A-_H_LAlOdKrvlFlm7fuyuwvOQahwpnABSMqfLkl-KXprr4hgYLnX45jxjS_Hy2s7psBWg57z4rFrYheHN0KnQ58fxxDs'
];

function getTeacherGalleryImages() {
    const stored = localStorage.getItem(teacherGalleryStorageKey);

    if (!stored) {
        return [...teacherDefaultGalleryImages];
    }

    try {
        const parsed = JSON.parse(stored);
        return Array.isArray(parsed) && parsed.length > 0 ? parsed : [...teacherDefaultGalleryImages];
    } catch {
        return [...teacherDefaultGalleryImages];
    }
}

function setTeacherGalleryImages(images) {
    localStorage.setItem(teacherGalleryStorageKey, JSON.stringify(images));
}

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
            background: #1a2a1a;
            border: 1px solid #2a3a2a;
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
        <div class="${sizeClasses[size]} w-full bg-white dark:bg-[#1a2a1a] rounded-2xl shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between p-6 border-b border-[#dce5dc] dark:border-[#2a3a2a] bg-gray-50/50 dark:bg-black/10">
                <h3 class="text-xl font-bold">${title}</h3>
                <button onclick="closeAllPopups()" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-[#2a3a2a] transition-colors">
                    <span class="material-symbols-outlined text-[#638863] dark:text-[#a0b0a0]">close</span>
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


// ==================== Search Functions ====================
function searchInPage() {
    const searchInput = document.querySelector('input[placeholder*="بحث"]');
    if (!searchInput) return;

    const searchTerm = searchInput.value.toLowerCase().trim();
    console.log('Searching for:', searchTerm);

    // البحث في بطاقات الأطفال
    const studentCards = document.querySelectorAll('.grid > div');
    let foundCount = 0;

    studentCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchTerm) || searchTerm === '') {
            card.style.display = '';
            foundCount++;
        } else {
            card.style.display = 'none';
        }
    });

    if (searchTerm && foundCount === 0) {
        showToast('لم يتم العثور على نتائج', 'warning');
    } else if (searchTerm) {
        showToast(`تم العثور على ${foundCount} نتيجة`, 'success');
    }
}


// ==================== Dashboard Functions ====================

// تسجيل حضور طالب
function markAttendance(studentName, status) {
    const statusText = status === 'present' ? 'حاضر' : 'غائب';
    showToast(`تم تسجيل ${studentName} كـ ${statusText}`, 'success');
}

// تسجيل الحضور لجميع الطلاب
function submitAttendance() {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">تأكيد تسجيل الحضور</h4>
                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">هل أنت متأكد من تسجيل الحضور لجميع الطلاب؟</p>
            </div>

            <div class="bg-white dark:bg-[#112111] p-5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a]">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-3xl font-bold text-primary">22</p>
                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">حاضر</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-red-500">3</p>
                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">غائب</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button onclick="confirmSubmitAttendance()" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    تأكيد التسجيل
                </button>
            </div>
        </div>
    `;

    createPopup('تسجيل الحضور', content, 'medium');
}

function confirmSubmitAttendance() {
    showToast('جاري تسجيل الحضور...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم تسجيل الحضور بنجاح!', 'success');
    }, 1500);
}


// إضافة نشاط يومي
function addDailyActivity() {
    const content = `
        <form onsubmit="handleAddActivity(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">عنوان النشاط</label>
                <input type="text" required placeholder="مثال: الرسم بالألوان المائية" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">نوع النشاط</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر نوع النشاط</option>
                    <option value="art">نشاط فني</option>
                    <option value="sport">نشاط رياضي</option>
                    <option value="music">نشاط موسيقي</option>
                    <option value="reading">قراءة وقصص</option>
                    <option value="science">نشاط علمي</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الوصف</label>
                <textarea required rows="4" placeholder="اكتب وصف النشاط..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">الوقت</label>
                    <input type="time" required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">المدة (دقيقة)</label>
                    <input type="number" required placeholder="30" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    إضافة النشاط
                </button>
            </div>
        </form>
    `;

    createPopup('إضافة نشاط يومي', content, 'medium');
}

function handleAddActivity(event) {
    event.preventDefault();
    showToast('جاري إضافة النشاط...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إضافة النشاط بنجاح!', 'success');
    }, 1000);
}


// إضافة ملاحظة سلوكية
function addBehaviorNote() {
    const content = `
        <form onsubmit="handleAddBehaviorNote(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">اختر الطالب</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر الطالب</option>
                    <option value="1">أحمد علي</option>
                    <option value="2">ليلى محمود</option>
                    <option value="3">ياسين عمر</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">نوع الملاحظة</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر النوع</option>
                    <option value="positive">إيجابية</option>
                    <option value="negative">تحتاج تحسين</option>
                    <option value="neutral">عامة</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الملاحظة</label>
                <textarea required rows="5" placeholder="اكتب الملاحظة السلوكية..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>

            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-xl">info</span>
                    <p class="text-sm text-blue-800 dark:text-blue-300">
                        سيتم إرسال هذه الملاحظة إلى ولي الأمر تلقائياً
                    </p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    إرسال الملاحظة
                </button>
            </div>
        </form>
    `;

    createPopup('إضافة ملاحظة سلوكية', content, 'medium');
}

function handleAddBehaviorNote(event) {
    event.preventDefault();
    showToast('جاري إرسال الملاحظة...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إرسال الملاحظة بنجاح!', 'success');
    }, 1000);
}


// إضافة صور
function addPhotos() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.multiple = true;
    input.onchange = (e) => {
        const files = Array.from(e.target.files);

        if (files.length === 0) {
            return;
        }

        const images = getTeacherGalleryImages();
        let loadedCount = 0;

        files.forEach((file) => {
            const reader = new FileReader();
            reader.onload = (loadEvent) => {
                const result = loadEvent.target?.result;

                if (typeof result === 'string') {
                    images.unshift(result);
                }

                loadedCount += 1;

                if (loadedCount === files.length) {
                    setTeacherGalleryImages(images.slice(0, 30));
                    showToast(`تمت إضافة ${files.length} صورة إلى المعرض`, 'success');
                    viewAllPhotos();
                }
            };

            reader.readAsDataURL(file);
        });
    };

    input.click();
}

// عرض جميع الصور
function viewAllPhotos() {
    const images = getTeacherGalleryImages();

    const content = `
        <div class="space-y-5">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                ${images.map((image, i) => `
                    <div class="aspect-square rounded-xl bg-cover bg-center border border-[#dce5dc] dark:border-[#2a3a2a] cursor-pointer hover:scale-105 transition-transform"
                         style="background-image: url('${image}')"
                         onclick="viewPhotoDetails(${i})">
                    </div>
                `).join('')}
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="addPhotos()" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">add_a_photo</span>
                    إضافة المزيد
                </button>
            </div>
        </div>
    `;

    createPopup('معرض الصور', content, 'large');
}

function viewPhotoDetails(index) {
    const images = getTeacherGalleryImages();
    const selectedImage = images[index];

    if (!selectedImage) {
        return;
    }

    const content = `
        <div class="space-y-5">
            <div class="rounded-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2a3a2a]">
                <img src="${selectedImage}" alt="صورة النشاط" class="w-full h-auto" />
            </div>
            <div class="flex justify-between items-center">
                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">الصورة ${index + 1} من ${images.length}</p>
                <button onclick="viewAllPhotos()" class="px-5 py-2 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium">رجوع للمعرض</button>
            </div>
        </div>
    `;

    createPopup('تفاصيل الصورة', content, 'large');
}

// إرسال التقرير اليومي
function sendDailyReport() {
    const content = `
        <form onsubmit="handleSendDailyReport(event)" class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">التقرير اليومي</h4>
                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">فصل الزهور (أ) - ${new Date().toLocaleDateString('ar-EG')}</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">ملخص اليوم</label>
                <textarea required rows="4" placeholder="اكتب ملخص عن أنشطة اليوم..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">عدد الأنشطة</label>
                    <input type="number" required value="3" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">التقييم العام</label>
                    <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <option value="excellent">ممتاز</option>
                        <option value="good">جيد</option>
                        <option value="average">متوسط</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                <input type="checkbox" id="includePhotos" class="w-5 h-5 text-primary rounded">
                <label for="includePhotos" class="text-sm">إرفاق صور الأنشطة</label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    إرسال التقرير
                </button>
            </div>
        </form>
    `;

    createPopup('إرسال التقرير اليومي', content, 'medium');
}

function handleSendDailyReport(event) {
    event.preventDefault();
    showToast('جاري إرسال التقرير...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إرسال التقرير بنجاح لجميع أولياء الأمور!', 'success');
    }, 2000);
}


// تعديل الملف الشخصي
function editProfile() {
    const content = `
        <form onsubmit="handleEditProfile(event)" class="space-y-5">
            <div class="flex justify-center mb-4">
                <div class="relative">
                    <div class="size-24 rounded-full bg-cover bg-center border-4 border-primary" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA-NWq3LGx-QdmdnVL0WxNPG-VwwZK1NCc9Mj53x3yw5XhAJ3DIfCVftHnyYny6HViotlVBVUIW9ZPYMpklXDKdhjP-7J9bBTkMkx32TSOO6k9aiZgqTbXpKf9p0jL7ycUzJr3fQbKnGs7htazQvmO8zPYdFbS7Qo7FhxFhXOQKX-t8vad7Kbp2hBbJ5km2WtYLv6GvXQJqwHrvCveb8afZYJTYakHfakW9ruSuAJKsx-Lrl5T72Za2YeX4bXeErPTynTfMORrhbDu7');"></div>
                    <button type="button" class="absolute bottom-0 right-0 size-8 bg-primary text-white rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">الاسم الأول</label>
                    <input type="text" required value="سارة" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">اسم العائلة</label>
                    <input type="text" required value="أحمد" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">البريد الإلكتروني</label>
                <input type="email" required value="sara.ahmed@nursery.com" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">رقم الجوال</label>
                <input type="tel" required value="01012345678" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    `;

    createPopup('تعديل الملف الشخصي', content, 'medium');
}

function handleEditProfile(event) {
    event.preventDefault();
    showToast('جاري حفظ التغييرات...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم حفظ التغييرات بنجاح!', 'success');
    }, 1000);
}


// ==================== Notifications Functions ====================
function showNotifications() {
    const content = `
        <div class="space-y-4">
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-600 text-2xl">emergency</span>
                    <div class="flex-1">
                        <p class="font-bold text-red-600 dark:text-red-400 mb-1">تنبيه طبي</p>
                        <p class="text-sm text-red-800 dark:text-red-300">أحمد علي لديه حساسية من الفول السوداني</p>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-2">منذ ساعتين</p>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-2xl">info</span>
                    <div class="flex-1">
                        <p class="font-bold text-blue-600 dark:text-blue-400 mb-1">تذكير</p>
                        <p class="text-sm text-blue-800 dark:text-blue-300">اجتماع المعلمات غداً الساعة 4 مساءً</p>
                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">منذ 3 ساعات</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-green-600 text-2xl">check_circle</span>
                    <div class="flex-1">
                        <p class="font-bold text-green-600 dark:text-green-400 mb-1">تم الموافقة</p>
                        <p class="text-sm text-green-800 dark:text-green-300">تمت الموافقة على التقرير اليومي</p>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-2">أمس</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="markAllNotificationsRead()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    تحديد الكل كمقروء
                </button>
                <button onclick="closeAllPopups()" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium">
                    إغلاق
                </button>
            </div>
        </div>
    `;

    createPopup('الإشعارات', content, 'medium');
}

function markAllNotificationsRead() {
    showToast('تم تحديد جميع الإشعارات كمقروءة', 'success');
    const badge = document.querySelector('.size-2.bg-red-500');
    if (badge) badge.remove();
    closeAllPopups();
}


// ==================== Levels/Classes Functions ====================

// إضافة فصل جديد
function addNewClass() {
    const content = `
        <form onsubmit="handleAddClass(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">اسم الفصل</label>
                <input type="text" required placeholder="مثال: فصل الورود" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">المعلمة المسؤولة</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر المعلمة</option>
                    <option value="1">أ. سارة أحمد</option>
                    <option value="2">أ. نورا محمد</option>
                    <option value="3">أ. لمى خالد</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">السعة القصوى</label>
                    <input type="number" required placeholder="25" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">المرحلة العمرية</label>
                    <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <option value="">اختر المرحلة</option>
                        <option value="1">2-3 سنوات</option>
                        <option value="2">3-4 سنوات</option>
                        <option value="3">4-5 سنوات</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">لون الفصل</label>
                <div class="flex gap-3">
                    <button type="button" class="size-10 rounded-full bg-primary border-2 border-gray-300" onclick="selectClassColor(this, '#0ea60e')"></button>
                    <button type="button" class="size-10 rounded-full bg-blue-500 border-2 border-gray-300" onclick="selectClassColor(this, '#3b82f6')"></button>
                    <button type="button" class="size-10 rounded-full bg-purple-500 border-2 border-gray-300" onclick="selectClassColor(this, '#a855f7')"></button>
                    <button type="button" class="size-10 rounded-full bg-orange-500 border-2 border-gray-300" onclick="selectClassColor(this, '#f97316')"></button>
                    <button type="button" class="size-10 rounded-full bg-pink-500 border-2 border-gray-300" onclick="selectClassColor(this, '#ec4899')"></button>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    إضافة الفصل
                </button>
            </div>
        </form>
    `;

    createPopup('إضافة فصل جديد', content, 'medium');
}

function selectClassColor(button, color) {
    document.querySelectorAll('[onclick*="selectClassColor"]').forEach(btn => {
        btn.classList.remove('ring-4', 'ring-primary');
    });
    button.classList.add('ring-4', 'ring-primary');
}

function handleAddClass(event) {
    event.preventDefault();
    showToast('جاري إضافة الفصل...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إضافة الفصل بنجاح!', 'success');
    }, 1000);
}


// عرض تفاصيل الفصل
function viewClassDetails(className, teacherName, studentCount) {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-2xl font-bold mb-2">${className}</h4>
                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة: ${teacherName}</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-3xl font-bold text-primary">${studentCount}</p>
                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">عدد الأطفال</p>
                </div>
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-3xl font-bold text-green-500">92%</p>
                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">نسبة الحضور</p>
                </div>
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-3xl font-bold text-blue-500">15</p>
                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">الأنشطة</p>
                </div>
            </div>

            <div>
                <h5 class="font-bold mb-3">قائمة الأطفال</h5>
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    ${['أحمد علي', 'ليلى محمود', 'ياسين عمر', 'فاطمة حسن', 'محمد سعيد'].map(name => `
                        <div class="flex items-center justify-between p-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                    ${name.charAt(0)}
                                </div>
                                <span class="font-medium">${name}</span>
                            </div>
                            <button class="text-primary hover:underline text-sm">عرض الملف</button>
                        </div>
                    `).join('')}
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="editClass('${className}')" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">edit</span>
                    تعديل الفصل
                </button>
            </div>
        </div>
    `;

    createPopup(`تفاصيل ${className}`, content, 'large');
}

function editClass(className) {
    showToast(`جاري فتح صفحة تعديل ${className}...`, 'info');
    closeAllPopups();
}


// ==================== Messages Functions ====================

// متغيرات المحادثات
let currentChatData = {
    name: 'أم أحمد علي',
    role: 'أم / ولي أمر - أحمد علي',
    image: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=987&q=80',
    status: 'online'
};

// التبديل بين جهات الاتصال
function switchContact(name, role, image, status = 'online') {
    currentChatData = { name, role, image, status };

    console.log('Switching to contact:', name);

    // تحديث هيدر المحادثة
    const chatHeader = document.querySelector('.lg\\:col-span-8 .p-5.border-b');
    if (chatHeader) {
        chatHeader.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('${image}');"></div>
                <div>
                    <p class="font-bold">${name}</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0]">${role}</p>
                </div>
            </div>
        `;
        console.log('Chat header updated');
    }

    // مسح الرسائل القديمة وعرض رسائل ترحيبية
    const messagesContainer = document.querySelector('.flex-1.p-6.overflow-y-auto');
    if (messagesContainer) {
        messagesContainer.innerHTML = `
            <div class="flex justify-start">
                <div class="max-w-[70%] bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-2xl rounded-tr-none px-5 py-3">
                    <p>مرحباً، كيف يمكنني مساعدتك؟</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">الآن</p>
                </div>
            </div>
        `;
        console.log('Messages cleared');
    }

    // تحديث الحالة النشطة في القائمة
    document.querySelectorAll('.lg\\:col-span-4 .divide-y > div').forEach(contact => {
        contact.classList.remove('bg-primary/5');
    });

    showToast(`تم فتح محادثة ${name}`, 'success');
}

// إرسال رسالة جديدة
function composeNewMessage() {
    const content = `
        <form onsubmit="handleSendMessage(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">المرسل إليه</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر المستلم</option>
                    <option value="1">أم أحمد علي</option>
                    <option value="2">أبو ليلى محمود</option>
                    <option value="3">إدارة الحضانة</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الموضوع</label>
                <input type="text" required placeholder="موضوع الرسالة" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الرسالة</label>
                <textarea required rows="6" placeholder="اكتب رسالتك هنا..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    إرسال
                </button>
            </div>
        </form>
    `;

    createPopup('رسالة جديدة', content, 'medium');
}

function handleSendMessage(event) {
    event.preventDefault();
    showToast('جاري إرسال الرسالة...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إرسال الرسالة بنجاح!', 'success');
    }, 1000);
}

// إرسال رسالة في المحادثة
function sendChatMessage() {
    const messageInput = document.querySelector('input[placeholder*="اكتب رسالتك"]');
    if (!messageInput) {
        console.error('Message input not found');
        return;
    }

    const messageText = messageInput.value.trim();
    console.log('Sending message:', messageText);
    console.log('Attached files:', attachedFiles.length);

    if (!messageText && attachedFiles.length === 0) {
        showToast('يرجى كتابة رسالة أو إرفاق ملف', 'warning');
        return;
    }

    const messagesContainer = document.querySelector('.flex-1.p-6.overflow-y-auto');
    if (!messagesContainer) {
        console.error('Messages container not found');
        return;
    }

    const messageDiv = document.createElement('div');
    messageDiv.className = 'flex justify-end';

    let filesHTML = '';
    if (attachedFiles.length > 0) {
        filesHTML = '<div class="flex gap-2 mt-3 flex-wrap">';
        attachedFiles.forEach(file => {
            if (file.type.startsWith('image/')) {
                filesHTML += `
                    <div class="relative group">
                        <img src="${file.preview}" class="w-24 h-24 rounded-lg object-cover border-2 border-white/20" />
                        <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs">${file.name}</span>
                        </div>
                    </div>
                `;
            } else {
                filesHTML += `
                    <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-lg p-2">
                        <span class="material-symbols-outlined text-white text-sm">description</span>
                        <div class="text-xs text-white">
                            <p class="font-bold">${file.name}</p>
                            <p class="opacity-80">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                `;
            }
        });
        filesHTML += '</div>';
    }

    messageDiv.innerHTML = `
        <div class="max-w-[70%] bg-primary text-white rounded-2xl rounded-tl-none px-5 py-3">
            ${messageText ? `<p>${messageText}</p>` : ''}
            ${filesHTML}
            <p class="text-xs text-white/80 mt-1">الآن</p>
        </div>
    `;

    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    console.log('Message sent successfully');

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
function attachFileToMessage() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*,.pdf,.doc,.docx';
    input.multiple = true;
    input.onchange = (e) => {
        const files = Array.from(e.target.files);
        console.log('Files selected:', files.length);

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
                    console.log('Image file added:', file.name);
                };
                reader.readAsDataURL(file);
            } else {
                attachedFiles.push(fileObj);
                updateAttachedFilesDisplay();
                console.log('File added:', file.name);
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
        container.className = 'px-5 py-3 border-t border-[#dce5dc] dark:border-[#2a3a2a] bg-[#f0f4f0] dark:bg-[#2a3a2a]';

        const chatFooter = document.querySelector('.lg\\:col-span-8 .p-5.border-t');
        if (chatFooter && chatFooter.parentNode) {
            chatFooter.parentNode.insertBefore(container, chatFooter);
            console.log('Attached files container created');
        } else {
            console.error('Could not find chat footer');
            return;
        }
    }

    container.innerHTML = `
        <div class="flex items-center gap-2 mb-2">
            <span class="text-xs font-bold text-[#638863] dark:text-[#a0b0a0]">الملفات المرفقة (${attachedFiles.length})</span>
            <button onclick="clearAttachedFiles()" class="text-xs text-red-500 hover:underline">مسح الكل</button>
        </div>
        <div class="flex gap-2 flex-wrap">
            ${attachedFiles.map((file, index) => `
                <div class="relative group">
                    ${file.preview ?
                        `<img src="${file.preview}" class="w-16 h-16 rounded-lg object-cover border border-[#dce5dc] dark:border-[#2a3a2a]" />` :
                        `<div class="w-16 h-16 rounded-lg border border-[#dce5dc] dark:border-[#2a3a2a] bg-white dark:bg-[#1a2a1a] flex items-center justify-center">
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



// فلتر المحادثات
function filterMessages() {
    const content = `
        <div class="space-y-4">
            <h4 class="font-bold text-lg mb-4">تصفية المحادثات</h4>

            <div>
                <label class="block text-sm font-medium mb-2">نوع المحادثة</label>
                <select class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="all">الكل</option>
                    <option value="parents">أولياء الأمور</option>
                    <option value="admin">الإدارة</option>
                    <option value="teachers">المعلمات</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الحالة</label>
                <select class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="all">الكل</option>
                    <option value="unread">غير مقروءة</option>
                    <option value="read">مقروءة</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الفترة الزمنية</label>
                <select class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="all">الكل</option>
                    <option value="today">اليوم</option>
                    <option value="week">هذا الأسبوع</option>
                    <option value="month">هذا الشهر</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button onclick="applyMessageFilter()" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium">
                    تطبيق الفلتر
                </button>
            </div>
        </div>
    `;

    createPopup('تصفية المحادثات', content, 'small');
}

function applyMessageFilter() {
    showToast('تم تطبيق الفلتر', 'success');
    closeAllPopups();
}


// ==================== Reports Functions ====================

// إنشاء تقرير جديد
function createNewReport() {
    const content = `
        <form onsubmit="handleCreateReport(event)" class="space-y-5">
            <div>
                <label class="block text-sm font-medium mb-2">نوع التقرير</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر نوع التقرير</option>
                    <option value="daily">تقرير يومي</option>
                    <option value="weekly">تقرير أسبوعي</option>
                    <option value="monthly">تقرير شهري</option>
                    <option value="activity">تقرير نشاط</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الفصل</label>
                <select required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر الفصل</option>
                    <option value="1">فصل الزهور (أ)</option>
                    <option value="2">فصل الفراشات (ب)</option>
                    <option value="3">فصل النجوم (ج)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">التاريخ</label>
                <input type="date" required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">محتوى التقرير</label>
                <textarea required rows="6" placeholder="اكتب محتوى التقرير..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    إنشاء التقرير
                </button>
            </div>
        </form>
    `;

    createPopup('تقرير جديد', content, 'medium');
}

function handleCreateReport(event) {
    event.preventDefault();
    showToast('جاري إنشاء التقرير...', 'info');
    setTimeout(() => {
        closeAllPopups();
        showToast('تم إنشاء التقرير بنجاح!', 'success');
    }, 1500);
}

// عرض تقرير
function viewReport(reportTitle) {
    const content = `
        <div class="space-y-5">
            <div class="bg-primary/10 p-5 rounded-xl border-r-4 border-primary">
                <h4 class="text-xl font-bold mb-2">${reportTitle}</h4>
                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">فصل الزهور (أ) - ${new Date().toLocaleDateString('ar-EG')}</p>
            </div>

            <div class="prose dark:prose-invert max-w-none">
                <p class="text-[#638863] dark:text-[#a0b0a0]">
                    كان يوماً رائعاً مليئاً بالأنشطة المفيدة. بدأنا اليوم بحلقة الصباح حيث تعلم الأطفال عن فصل الربيع وأهمية النباتات.
                </p>
                <p class="text-[#638863] dark:text-[#a0b0a0] mt-3">
                    في النشاط الفني، قام الأطفال بالرسم بالألوان المائية وأظهروا إبداعاً كبيراً. كان أحمد وليلى متميزين بشكل خاص.
                </p>
                <p class="text-[#638863] dark:text-[#a0b0a0] mt-3">
                    نسبة الحضور اليوم كانت ممتازة (22 من 25 طالب). جميع الأطفال كانوا متعاونين ومتفاعلين.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-2xl font-bold text-primary">3</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">أنشطة</p>
                </div>
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-2xl font-bold text-green-500">88%</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">حضور</p>
                </div>
                <div class="bg-white dark:bg-[#112111] p-4 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] text-center">
                    <p class="text-2xl font-bold text-blue-500">25</p>
                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">طالب</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إغلاق
                </button>
                <button onclick="downloadReport()" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">download</span>
                    تحميل PDF
                </button>
            </div>
        </div>
    `;

    createPopup('عرض التقرير', content, 'large');
}

function downloadReport() {
    showToast('جاري تحميل التقرير...', 'info');
    setTimeout(() => {
        showToast('تم تحميل التقرير بنجاح!', 'success');
    }, 1500);
}

// تصدير جميع التقارير
function exportAllReports() {
    showToast('جاري تصدير جميع التقارير...', 'info');
    setTimeout(() => {
        showToast('تم تصدير التقارير بنجاح!', 'success');
    }, 2000);
}


// فلتر التقارير
function filterReports(period) {
    showToast(`تم التصفية: ${period}`, 'info');
    // هنا يمكن إضافة كود لتصفية التقارير
}

// عرض الكل
function viewAllReports() {
    showToast('عرض جميع التقارير', 'info');
}

// ==================== Event Listeners ====================
document.addEventListener('DOMContentLoaded', function() {
    console.log('Teacher Portal Functions Loaded ✓');

    // ربط حقل البحث
    const searchInput = document.querySelector('input[placeholder*="بحث"]');
    if (searchInput) {
        searchInput.addEventListener('input', searchInPage);
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchInPage();
        });
        console.log('Search input connected');
    }

    // ربط زر الإشعارات - البحث عن الزر بطريقة أفضل
    const notificationBtns = document.querySelectorAll('button');
    notificationBtns.forEach(btn => {
        if (btn.textContent.includes('الإشعارات')) {
            btn.onclick = function(e) {
                e.preventDefault();
                showNotifications();
            };
            console.log('Notification button connected');
        }
    });

    // ربط أزرار الحضور والغياب
    const allButtons = document.querySelectorAll('button');
    allButtons.forEach(btn => {
        const text = btn.textContent.trim();

        // أزرار الحضور
        if (text === 'حاضر') {
            btn.onclick = function(e) {
                e.preventDefault();
                const card = this.closest('div[class*="bg-white"]');
                const studentName = card?.querySelector('p.font-bold')?.textContent || 'الطالب';
                markAttendance(studentName, 'present');
                this.classList.add('bg-primary', 'text-white');
                this.classList.remove('bg-primary/10', 'text-primary', 'bg-[#f0f4f0]', 'text-[#638863]');
            };
        }

        // أزرار الغياب
        if (text === 'غائب') {
            btn.onclick = function(e) {
                e.preventDefault();
                const card = this.closest('div[class*="bg-white"]');
                const studentName = card?.querySelector('p.font-bold')?.textContent || 'الطالب';
                markAttendance(studentName, 'absent');
                this.classList.add('bg-red-500', 'text-white');
                this.classList.remove('bg-[#f0f4f0]', 'text-[#638863]');
            };
        }

        // أزرار Dashboard
        if (text.includes('تسجيل الحضور')) {
            btn.onclick = function(e) {
                e.preventDefault();
                submitAttendance();
            };
            console.log('Submit attendance button connected');
        }

        if (text.includes('إضافة نشاط يومي')) {
            btn.onclick = function(e) {
                e.preventDefault();
                addDailyActivity();
            };
            console.log('Add activity button connected');
        }

        if (text.includes('ملاحظة سلوكية')) {
            btn.onclick = function(e) {
                e.preventDefault();
                addBehaviorNote();
            };
            console.log('Add behavior note button connected');
        }

        if (text.includes('إرسال التقرير اليومي')) {
            btn.onclick = function(e) {
                e.preventDefault();
                sendDailyReport();
            };
            console.log('Send daily report button connected');
        }

        if (text.includes('تعديل الملف الشخصي')) {
            btn.onclick = function(e) {
                e.preventDefault();
                editProfile();
            };
            console.log('Edit profile button connected');
        }

        if (text.includes('مشاهدة الكل')) {
            btn.onclick = function(e) {
                e.preventDefault();
                viewAllPhotos();
            };
            console.log('View all photos button connected');
        }

        // أزرار الفصول
        if (text.includes('إضافة فصل جديد')) {
            btn.onclick = function(e) {
                e.preventDefault();
                addNewClass();
            };
            console.log('Add new class button connected');
        }

        if (text.includes('عرض التفاصيل')) {
            btn.onclick = function(e) {
                e.preventDefault();
                const card = this.closest('div[class*="bg-white"]');
                const className = card?.querySelector('h3')?.textContent || 'الفصل';
                const teacherName = card?.querySelector('p.text-lg')?.textContent || 'المعلمة';
                const studentCount = card?.querySelector('p.text-2xl')?.textContent || '0';
                viewClassDetails(className, teacherName, studentCount);
            };
            console.log('View class details button connected');
        }

        if (text === 'تعديل' && !text.includes('الملف')) {
            btn.onclick = function(e) {
                e.preventDefault();
                const card = this.closest('div[class*="bg-white"]');
                const className = card?.querySelector('h3')?.textContent || 'الفصل';
                editClass(className);
            };
        }

        // أزرار الرسائل
        if (text.includes('رسالة جديدة')) {
            btn.onclick = function(e) {
                e.preventDefault();
                composeNewMessage();
            };
            console.log('New message button connected');
        }

        // أزرار التقارير
        if (text.includes('تقرير جديد')) {
            btn.onclick = function(e) {
                e.preventDefault();
                createNewReport();
            };
            console.log('New report button connected');
        }

        if (text.includes('عرض الكل') && window.location.pathname.includes('reports')) {
            btn.onclick = function(e) {
                e.preventDefault();
                viewAllReports();
            };
        }

        if (text.includes('تصدير الكل')) {
            btn.onclick = function(e) {
                e.preventDefault();
                exportAllReports();
            };
            console.log('Export all reports button connected');
        }

        if (text === 'عرض' && window.location.pathname.includes('reports')) {
            btn.onclick = function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const reportTitle = row?.querySelector('td:first-child')?.textContent || 'التقرير';
                viewReport(reportTitle);
            };
        }
    });

    // ربط أيقونات الفلتر والترتيب
    const filterIcons = document.querySelectorAll('.material-symbols-outlined');
    filterIcons.forEach(icon => {
        if (icon.textContent.includes('filter_alt')) {
            icon.parentElement.onclick = function(e) {
                e.preventDefault();
                showToast('فلتر القائمة', 'info');
            };
        }
        if (icon.textContent.includes('sort_by_alpha')) {
            icon.parentElement.onclick = function(e) {
                e.preventDefault();
                showToast('ترتيب أبجدي', 'info');
            };
        }
        if (icon.textContent.includes('filter_list')) {
            icon.parentElement.onclick = function(e) {
                e.preventDefault();
                filterMessages();
            };
        }
        if (icon.textContent.includes('add_a_photo')) {
            icon.parentElement.onclick = function(e) {
                e.preventDefault();
                addPhotos();
            };
        }
    });

    // ربط أزرار الرسائل - Messages Page
    if (window.location.pathname.includes('messages')) {
        // ربط جهات الاتصال للتبديل
        const contactDivs = document.querySelectorAll('.lg\\:col-span-4 .divide-y > div');
        contactDivs.forEach((contactDiv, index) => {
            contactDiv.style.cursor = 'pointer';
            contactDiv.onclick = function(e) {
                e.preventDefault();

                // إزالة الخلفية النشطة من جميع جهات الاتصال
                contactDivs.forEach(div => div.classList.remove('bg-primary/5'));

                // إضافة الخلفية النشطة للجهة المختارة
                this.classList.add('bg-primary/5');

                // استخراج معلومات جهة الاتصال
                const nameElement = this.querySelector('p.font-medium');
                const roleElement = this.querySelector('p.text-sm');
                const imageElement = this.querySelector('div[style*="background-image"]');

                if (nameElement && imageElement) {
                    const name = nameElement.textContent.trim();
                    const role = roleElement ? roleElement.textContent.trim() : 'جهة اتصال';
                    const imageStyle = imageElement.getAttribute('style');
                    const imageMatch = imageStyle.match(/url\(['"]?([^'"]+)['"]?\)/);
                    const image = imageMatch ? imageMatch[1] : '';

                    switchContact(name, role, image);
                }
            };
            console.log(`Contact ${index + 1} connected`);
        });

        // زر إرسال الرسالة
        const sendBtns = document.querySelectorAll('button');
        sendBtns.forEach(btn => {
            const icon = btn.querySelector('.material-symbols-outlined');
            if (icon && icon.textContent.includes('send')) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    sendChatMessage();
                };
                console.log('Send message button connected');
            }
            if (icon && icon.textContent.includes('attach_file')) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    attachFileToMessage();
                };
                console.log('Attach file button connected');
            }
        });

        // ربط Enter في حقل الرسالة
        const messageInput = document.querySelector('input[placeholder*="اكتب رسالتك"]');
        if (messageInput) {
            messageInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendChatMessage();
                }
            });
            console.log('Message input connected');
        }
    }

    // ربط فلتر الإحصائيات في التقارير
    if (window.location.pathname.includes('reports')) {
        const statsFilter = document.querySelectorAll('select');
        statsFilter.forEach(select => {
            if (select.closest('.bg-white')) {
                select.onchange = function() {
                    filterReports(this.value);
                };
                console.log('Stats filter connected');
            }
        });
    }

    console.log('All event listeners connected successfully ✓');
});

console.log('Teacher Portal JavaScript Loaded Successfully ✓');
