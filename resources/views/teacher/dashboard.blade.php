@extends('layouts.app')

@section('content')
<style>
    .bg-main-gradient { background: var(--bg-page-soft); }
    .premium-shadow { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.05); }
    .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(226, 232, 240, 0.8); }
    .card-hover:hover { transform: translateY(-4px); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); border-color: #6366f1; }
    .sidebar-shadow { box-shadow: 10px 0 15px -3px rgba(0, 0, 0, 0.05); }
    .active-group-btn { background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important; color: white !important; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.5); border: none !important; }
    .active-student-card { border: 2px solid #6366f1 !important; background-color: #f5f3ff !important; box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.2); }
    .modern-input { background: #ffffff; border: 2px solid #e2e8f0; transition: all 0.3s; }
    .modern-input:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    
    /* Overlay backdrop */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 30;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        display: none;
    }
    
    @media (max-width: 1024px) {
        .sidebar-overlay {
            display: block;
        }
    }
    
    .sidebar-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }
</style>

<div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebars()"></div>

<div class="min-h-screen md:pb-0 flex flex-col bg-main-gradient">
    {{-- Біріктірілген Мобильді Header (Тек телефонда көрінеді) --}}
    <div class="lg:hidden flex justify-between items-center p-4 border-b sticky top-0 z-[60] shadow-sm theme-card">
        <button onclick="toggleGroupsSidebar()" class="p-2.5 rounded-xl active:scale-95 transition-transform" style="background: var(--bg-card-soft); color: var(--text-secondary)">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
        
        <div class="flex flex-col items-center gap-2">
            <span class="font-black text-indigo-500 tracking-tighter text-sm uppercase">Ұстаз Панелі</span>
            @include('partials.theme-toggle')
        </div>

        <button onclick="toggleStudentsSidebar()" class="p-2.5 rounded-xl active:scale-95 transition-transform" style="background: var(--bg-card-soft); color: var(--text-secondary)">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2"/></svg>
        </button>
    </div>
{{-- ОСНОВНОЙ LAYOUT --}}
    <div class="flex min-h-screen bg-slate-50 relative overflow-hidden">
        
        {{-- 1. LEFT SIDEBAR (Groups) --}}
        <aside id="groupsSidebar" class="fixed top-16 md:top-20 bottom-0 left-0 w-72 md:w-80 bg-white border-r border-slate-200 flex flex-col z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0">
            {{-- Mobile Close Button --}}
       

            <div class="p-6 space-y-3">
                <a href="/teacher/journal" class="flex items-center gap-3 px-5 py-4 rounded-2xl text-white bg-indigo-600 font-black shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase text-[10px] tracking-widest leading-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" stroke-width="2"/></svg>
                    Журналға өту
                </a>
                <a href="/teacher/lessons/create" class="flex items-center gap-3 px-5 py-4 rounded-2xl text-indigo-600 bg-indigo-50 font-black hover:bg-indigo-100 transition-all uppercase text-[10px] tracking-widest leading-none text-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Жаңа сабақ
                </a>
            </div>

            <div class="flex-1 overflow-y-auto px-6 py-6">
                <div class="px-2">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Курс</h2>
                    <p class="text-sm font-black text-slate-800">Python бағдарламалау</p>
                    <p class="text-[10px] text-slate-400 font-bold mt-2">{{ $lessons->count() }} сабақ • {{ $students->count() }} студент</p>
                </div>
            </div>
<div class="p-6 border-t border-slate-100 bg-white">
    <div class="flex items-center justify-between gap-2 px-2">
        <div class="flex items-center gap-3 overflow-hidden">
            <div class="w-8 h-8 shrink-0 rounded-full bg-slate-900 flex items-center justify-center text-[10px] text-white font-bold uppercase">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-black text-slate-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Оқытушы</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit" class="p-2.5 bg-slate-50 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all group" title="Шығу">
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>
    </div>
</div>
        </aside>

        {{-- 2. MAIN CONTENT (Center) --}}
        <main id="mainContent" class="flex-1 lg:ml-80 lg:mr-80 min-h-screen p-4 sm:p-8 md:p-12 transition-all duration-300">
            {{-- Mobile Header (Тек мобильді нұсқада көрінеді) --}}
            <div class="lg:hidden flex justify-between items-center mb-6">
                <button onclick="toggleGroupsSidebar()" class="p-3 bg-white rounded-xl shadow-sm text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round"/></svg></button>
                <span class="font-black text-slate-800 uppercase tracking-widest text-[10px]">LMS Dashboard</span>
                <button onclick="toggleStudentsSidebar()" class="p-3 bg-white rounded-xl shadow-sm text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round"/></svg></button>
            </div>

            <div id="mainContentArea"></div>
        </main>

        {{-- 3. RIGHT SIDEBAR (Students) --}}
        <aside id="studentSidebar" class="fixed top-16 md:top-20 bottom-0 right-0 w-72 md:w-80 bg-slate-50 border-l border-slate-200 flex flex-col z-50 transition-transform duration-300 translate-x-full lg:translate-x-0 lg:bg-white">
          

            <div class="p-8 border-b border-slate-100 bg-white lg:pt-10">
                <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-indigo-600">Студенттер құрамы</h3>
                <div class="flex items-center gap-2 mt-2">
                    <div id="statusDot" class="w-2 h-2 rounded-full bg-slate-300 transition-colors"></div>
                    <p id="studentCount" class="text-xs text-slate-400 font-bold tracking-tight">{{ $students->count() }} студент</p>
                </div>
            </div>
            <div id="studentListContainer" class="flex-1 overflow-y-auto p-6 space-y-3 custom-scrollbar">
                {{-- Студенттер тізімі осында --}}
            </div>
        </aside>
    </div>

{{-- Мобильді оверлей --}}
<div id="sidebarOverlay" onclick="closeAllSidebars()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

{{-- MODALS (Бұрынғыдай қалады, бірақ Z-индекс реттелді) --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<script>
    function toggleGroupsSidebar() {
        const sidebar = document.getElementById('groupsSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    function toggleStudentsSidebar() {
        const sidebar = document.getElementById('studentSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('translate-x-full');
        overlay.classList.toggle('hidden');
    }

    function closeAllSidebars() {
        document.getElementById('groupsSidebar').classList.add('-translate-x-full');
        document.getElementById('studentSidebar').classList.add('translate-x-full');
        document.getElementById('sidebarOverlay').classList.add('hidden');
    }
</script>

<script>
    const lessons = @json($lessons);
    const students = @json($students);
    const baseStorageUrl = "{{ asset('storage') }}";
    let lessonSortOrder = 'newest';
    let currentTestLessonId = null;

    function renderStudentList() {
        const studentList = document.getElementById('studentListContainer');
        const studentCount = document.getElementById('studentCount');
        studentCount.innerText = `${students.length} студент тіркелген`;
        studentList.innerHTML = students.map(s => `
            <div onclick="showStudent(${s.id})" id="student-card-${s.id}"
                 class="flex items-center gap-3 p-2.5 bg-white border border-slate-100 rounded-xl hover:border-indigo-300 hover:shadow-md cursor-pointer transition-all group">
                <div class="w-8 h-8 shrink-0 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-[11px] group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    ${s.name.charAt(0)}
                </div>
                <span class="text-[12px] font-bold text-slate-700 group-hover:text-indigo-600 truncate tracking-tight">${s.name}</span>
            </div>
        `).join('');
    }

    function renderLessons() {
    const main = document.getElementById('mainContentArea');
    let sortedLessons = [...lessons];
    
    sortedLessons.sort((a,b) => lessonSortOrder === 'newest' ? new Date(b.created_at) - new Date(a.created_at) : new Date(a.created_at) - new Date(b.created_at));

    // Егер сабақ мүлдем жоқ болса, осы HTML шығады
    const emptyStateHtml = `
        <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center text-slate-300 mb-6 border border-slate-100">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="text-lg font-black text-slate-400 uppercase tracking-widest">Сабақтар жоқ</h3>
            <p class="text-slate-400 text-xs font-bold mt-2 uppercase tracking-tighter">Әлі сабақтар қосылмаған</p>
        </div>
    `;

    main.innerHTML = `
        <div class="max-w-4xl mx-auto pb-10 px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-widest">Python курсы</span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Сабақтар</h2>
                </div>
                ${sortedLessons.length > 0 ? `
                    <div class="flex bg-white p-1 rounded-xl shadow-sm border border-slate-200">
                        <button onclick="setSortOrder('newest')" id="sortNewestBtn" class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase transition-all">Жаңа</button>
                        <button onclick="setSortOrder('oldest')" id="sortOldestBtn" class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase transition-all">Ескі</button>
                    </div>
                ` : ''}
            </div>
            
            <div class="space-y-4">
                ${sortedLessons.length > 0 ? sortedLessons.map(lesson => `
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="pr-4">
                                <span class="text-[9px] font-black text-indigo-500 bg-indigo-50/50 px-2 py-1 rounded-md uppercase tracking-wider">
                                    ${new Date(lesson.created_at).toLocaleDateString()}
                                </span>
                                <h4 class="text-lg font-black text-slate-800 mt-2 tracking-tight leading-tight">${lesson.title}</h4>
                            </div>
                            
                            <div class="flex gap-1.5 shrink-0">
                                ${lesson.test ? `
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-2 py-2 rounded-lg uppercase tracking-wider border border-emerald-100">Тест қосылған</span>
                                        <button onclick="viewTest(${lesson.id})" class="p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-lg border border-emerald-100 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/></svg>
                                        </button>
                                    </div>
                                ` : `
                                    <button onclick="openTestModal(${lesson.id})" class="p-2 bg-amber-50 text-amber-500 hover:bg-amber-600 hover:text-white rounded-lg border border-amber-100 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-width="2"/></svg>
                                    </button>
                                `}
                                
                                <button onclick="deleteLesson(${lesson.id})" class="p-2 bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-600 rounded-lg border border-slate-100 hover:border-red-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                </button>
                            </div>
                        </div>
                        
                        <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 group-hover:line-clamp-none transition-all">${lesson.content}</p>
                        
                        ${lesson.pdf_path ? `
                            <a href="${baseStorageUrl}/${lesson.pdf_path}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 rounded-xl text-[10px] font-black text-white hover:bg-indigo-600 transition-all shadow-md">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-width="2"/></svg> 
                                PDF МАТЕРИАЛ
                            </a>
                        ` : ''}
                    </div>
                `).join('') : emptyStateHtml}
            </div>
        </div>
    `;
    
    if (sortedLessons.length > 0) {
        updateSortButtons();
    }
}

/**
 * Сабақты өшіру функциясы
 */
async function deleteLesson(lessonId) {
    if (!confirm('Бұл сабақты өшіруге сенімдісіз бе? Бұл әрекетті қайтару мүмкін емес.')) return;

    try {
        const response = await fetch(`/teacher/lessons/${lessonId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });

        if (response.ok) {
            window.location.reload();
        } else {
            alert('Қате орын алды. Сабақты өшіру мүмкін болмады.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Сервермен байланыс үзілді.');
    }
}

    // --- VIEW TEST LOGIC ---
function viewTest(lessonId) {
    const foundLesson = lessons.find(l => l.id === lessonId);
    if(!foundLesson || !foundLesson.test) return alert('Тест табылмады');

    const test = foundLesson.test;
    const container = document.getElementById('viewQuestionsContainer');
    document.getElementById('viewTestTitle').innerText = test.title;
    document.getElementById('viewTestMeta').innerText = `${test.questions.length} сұрақ`;

    container.innerHTML = test.questions.map((q, idx) => `
        <div class="bg-white p-4 md:p-5 rounded-[1.5rem] md:rounded-3xl shadow-sm border border-slate-100">
            <div class="flex gap-3 mb-3">
                <span class="w-6 h-6 shrink-0 bg-indigo-600 text-white rounded-md flex items-center justify-center font-black text-[10px] md:text-xs">
                    ${idx + 1}
                </span>
                <h5 class="text-sm md:text-base font-bold text-slate-800 leading-snug">${q.text}</h5>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                ${q.options.map((opt, optIdx) => `
                    <div class="p-3 md:p-4 rounded-xl md:rounded-2xl border-2 transition-all flex items-center justify-between gap-2
                        ${optIdx == q.correct 
                            ? 'border-emerald-500 bg-emerald-50 text-emerald-700' 
                            : 'border-slate-50 bg-slate-50/50 text-slate-500'}"
                    >
                        <span class="text-[11px] md:text-xs font-bold leading-tight">${opt}</span>
                        ${optIdx == q.correct 
                            ? '<svg class="w-4 h-4 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>' 
                            : ''}
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');

    document.getElementById('viewTestModal').classList.remove('hidden');
}

    function closeViewTestModal() {
        document.getElementById('viewTestModal').classList.add('hidden');
    }

    // --- CREATE TEST LOGIC ---
    function openTestModal(lessonId) {
        currentTestLessonId = lessonId;
        document.getElementById('testModal').classList.remove('hidden');
        document.getElementById('questionsList').innerHTML = '';
        document.getElementById('testTitle').value = '';
        addQuestion();
    }

    function closeTestModal() {
        document.getElementById('testModal').classList.add('hidden');
    }

function addQuestion() {
    const qIndex = document.querySelectorAll('.question-item').length;
    const html = `
        <div class="question-item bg-slate-50 p-4 md:p-5 rounded-[1.5rem] border border-slate-200 transition-all">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">Сұрақ #${qIndex + 1}</span>
                <button onclick="this.closest('.question-item').remove()" class="p-1.5 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                </button>
            </div>
            
            <input type="text" placeholder="Сұрақ мәтіні..." 
                class="q-text w-full modern-input px-4 py-2.5 rounded-xl mb-3 text-xs md:text-sm font-bold shadow-sm">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                ${[0, 1, 2, 3].map(i => `
                    <div class="flex items-center gap-2 bg-white p-2 rounded-xl border border-slate-100 shadow-sm">
                        <input type="radio" name="correct_${qIndex}" value="${i}" ${i === 0 ? 'checked' : ''} 
                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 shrink-0">
                        <input type="text" placeholder="Нұсқа ${i + 1}" 
                            class="q-option w-full px-2 py-1.5 text-[11px] font-medium border-none focus:ring-0 outline-none bg-transparent">
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    document.getElementById('questionsList').insertAdjacentHTML('beforeend', html);
}

    async function saveTest() {
        const questions = [];
        const items = document.querySelectorAll('.question-item');
        const testTitle = document.getElementById('testTitle').value;

        if (!testTitle) return alert('Тест атауын жазыңыз!');

        items.forEach((item, idx) => {
            const text = item.querySelector('.q-text').value;
            const options = Array.from(item.querySelectorAll('.q-option')).map(o => o.value);
            const correct = item.querySelector(`input[name="correct_${idx}"]:checked`).value;
            questions.push({ text, options, correct: parseInt(correct) });
        });

        try {
            const response = await fetch(`/teacher/lessons/${currentTestLessonId}/test`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ title: testTitle, questions })
            });

            if (response.ok) {
                alert('Тест сақталды!');
                location.reload();
            }
        } catch (e) { console.error(e); }
    }

   function showStudent(studentId) {
    const student = students.find(u => u.id === studentId);
    const main = document.getElementById('mainContentArea');

    document.querySelectorAll('[id^="student-card-"]').forEach(c => c.classList.remove('active-student-card'));
    const card = document.getElementById('student-card-' + studentId);
    if(card) card.classList.add('active-student-card');

    let html = `
        <div class="max-w-4xl mx-auto px-4 pb-10">
            <button onclick="renderLessons()" class="flex items-center gap-2 text-indigo-600 font-black text-[10px] md:text-xs uppercase mb-6 md:mb-10 hover:gap-4 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5"/></svg> Артқа қайту
            </button>

            <div class="bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] shadow-sm mb-6 md:mb-10 flex flex-col md:flex-row items-center text-center md:text-left gap-4 md:gap-8 border border-slate-100">
                <div class="w-16 h-16 md:w-24 md:h-24 bg-indigo-600 rounded-2xl md:rounded-[2rem] flex items-center justify-center text-white text-2xl md:text-3xl font-black shadow-xl shadow-indigo-100">
                    ${student.name.charAt(0)}
                </div>
                <div>
                    <h2 class="text-xl md:text-3xl font-black text-slate-900 tracking-tighter">${student.name}</h2>
                    <p class="text-slate-400 font-bold mt-1 uppercase text-[9px] md:text-[10px] tracking-widest text-center md:text-left">Студенттің жеке картасы</p>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2">Тапсырмалар мен нәтижелер</h3>
    `;

    let hasActivity = false;

    // 1. Assignments Loop
    lessons.forEach(l => {
        l.assignments?.forEach(a => {
            a.submissions?.filter(s => s.user.id === studentId).forEach(s => {
                hasActivity = true;
                html += `
                    <div class="p-4 md:p-6 bg-white border border-slate-100 rounded-[1.5rem] md:rounded-[2rem] flex justify-between items-center shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center gap-3 md:gap-6">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-slate-50 rounded-xl md:rounded-2xl flex items-center justify-center text-indigo-600 shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
                            </div>
                            <div>
                                <p class="text-[8px] md:text-[9px] font-black text-indigo-500 uppercase tracking-widest mb-0.5">${l.title}</p>
                                <h4 class="font-black text-slate-800 text-sm md:text-lg tracking-tight leading-tight">${a.title}</h4>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 md:gap-8">
                            <div class="text-right">
                                <p class="text-[8px] md:text-[9px] font-black text-slate-300 uppercase mb-0.5">Баға</p>
                                <p class="font-black text-base md:text-xl ${s.grade !== null ? 'text-emerald-500' : 'text-orange-400'}">
                                    ${s.grade !== null ? s.grade + '<span class="text-[10px] text-slate-300">/100</span>' : 'Күтуде'}
                                </p>
                            </div>
                            <a href="/teacher/submissions/${s.id}" class="bg-slate-900 text-white p-3 md:p-4 rounded-xl md:rounded-2xl hover:bg-indigo-600 transition-all shadow-md">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                `;
            });
        });
    });

    if (!hasActivity) {
        html += `<div class="p-16 text-center bg-white rounded-[2rem] border-2 border-dashed border-slate-100 text-slate-300 font-bold uppercase tracking-widest text-[10px]">Белсенділік жоқ</div>`;
    }

    main.innerHTML = html + `</div></div>`;
}

    function setSortOrder(order) {
        lessonSortOrder = order;
        renderLessons();
    }

    function updateSortButtons() {
        const nBtn = document.getElementById('sortNewestBtn');
        const oBtn = document.getElementById('sortOldestBtn');
        if(!nBtn || !oBtn) return;
        [nBtn, oBtn].forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg'));
        const active = lessonSortOrder === 'newest' ? nBtn : oBtn;
        active.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
    }

    function toggleGroupsSidebar() {
        const sidebar = document.getElementById('groupsSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('active');
        // Close student sidebar if open
        document.getElementById('studentSidebar').classList.add('translate-x-full');
    }

    function toggleStudentsSidebar() {
        const sidebar = document.getElementById('studentSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('translate-x-full');
        overlay.classList.toggle('active');
        // Close groups sidebar if open
        document.getElementById('groupsSidebar').classList.add('-translate-x-full');
    }

    function closeSidebars() {
        const groupsSidebar = document.getElementById('groupsSidebar');
        const studentSidebar = document.getElementById('studentSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        groupsSidebar.classList.add('-translate-x-full');
        studentSidebar.classList.add('translate-x-full');
        overlay.classList.remove('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderStudentList();
        renderLessons();
    });
</script>
<div id="testModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="flex items-end sm:items-center justify-center min-h-screen p-0 sm:p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" onclick="closeTestModal()"></div>
        
        <div class="relative bg-white w-full max-w-2xl rounded-t-[2rem] sm:rounded-[2rem] shadow-2xl overflow-hidden animate-in slide-in-from-bottom sm:zoom-in duration-300">
            
            <div class="p-5 md:p-6 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <div>
                    <h3 class="text-lg md:text-xl font-black text-slate-900 tracking-tight">Жаңа тест</h3>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Сұрақтар қосу</p>
                </div>
                <button onclick="closeTestModal()" class="p-2 md:p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round"/></svg>
                </button>
            </div>

            <div class="p-5 md:p-6 max-h-[75vh] sm:max-h-[70vh] overflow-y-auto custom-scrollbar space-y-6">
                <div>
                    <label class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] ml-1">Тесттің жалпы атауы</label>
                    <input type="text" id="testTitle" placeholder="Мысалы: Курс қорытындысы" 
                           class="w-full bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 px-5 py-3.5 rounded-xl mt-1.5 font-bold text-slate-700 text-sm">
                </div>

                <div id="questionsList" class="space-y-4"></div>

                <button onclick="addQuestion()" class="w-full py-3.5 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 font-black text-[9px] uppercase tracking-widest hover:border-indigo-300 hover:text-indigo-600 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/></svg>
                    Тағы сұрақ қосу
                </button>
            </div>

            <div class="p-5 md:p-6 bg-slate-50 border-t border-slate-100 flex gap-3">
                <button onclick="closeTestModal()" class="flex-1 py-3.5 rounded-xl bg-white border border-slate-200 text-slate-500 font-black text-[9px] uppercase tracking-widest hover:bg-slate-100 transition-all">Бас тарту</button>
                <button onclick="saveTest()" class="flex-[2] py-3.5 rounded-xl bg-indigo-600 text-white font-black text-[9px] uppercase tracking-widest shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-[0.98] transition-all">Жариялау</button>
            </div>
        </div>
    </div>
</div>

<div id="viewTestModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" onclick="closeViewTestModal()"></div>
        <div class="relative bg-slate-50 w-full max-w-3xl rounded-[2.5rem] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="p-8 bg-white border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 id="viewTestTitle" class="text-xl font-black text-slate-900 tracking-tight">---</h3>
                    <p id="viewTestMeta" class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">---</p>
                </div>
                <button onclick="closeViewTestModal()" class="p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round"/></svg>
                </button>
            </div>
            <div id="viewQuestionsContainer" class="p-8 max-h-[75vh] overflow-y-auto custom-scrollbar space-y-4 text-left">
                </div>
        </div>
    </div>
</div>
@endsection