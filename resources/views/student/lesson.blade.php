@extends('layouts.app')

@section('content')
<style>
    :root { --topbar-height: 64px; }

    #ai-chat-body::-webkit-scrollbar { width: 4px; }
    #ai-chat-body::-webkit-scrollbar-track { background: transparent; }
    #ai-chat-body::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    @media (min-width: 1024px) {
        #ai-sidebar-container {
            position: sticky;
            top: calc(var(--topbar-height) + 1rem);
            height: calc(100vh - var(--topbar-height) - 2rem);
        }
    }
    @media (max-width: 1023px) {
        #ai-sidebar { height: calc(100vh - var(--topbar-height)) !important; top: var(--topbar-height) !important; }
        #chat-overlay { top: var(--topbar-height) !important; height: calc(100vh - var(--topbar-height)) !important; }
    }

    .mb-safe { margin-bottom: env(safe-area-inset-bottom); }
</style>

<div class="min-h-screen bg-slate-50/50 py-4 md:py-8 px-2 md:px-4">
    <div class="max-w-[1440px] mx-auto flex flex-col lg:flex-row gap-6 items-start">

        <main class="w-full lg:w-2/3 space-y-4 md:space-y-6">
            <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] border border-slate-200 shadow-[0_20px_50px_rgba(0,0,0,0.06)] overflow-hidden">

                <div class="p-5 md:p-10 lg:p-12 border-b border-slate-50">
                    <div class="mb-6">
                        <a href="/student/dashboard" class="inline-flex items-center text-indigo-600 font-bold text-xs md:text-sm hover:bg-indigo-50 px-3 py-2 rounded-xl transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            {{ __('messages.common.back') }}
                        </a>
                    </div>

                    <article>
                        <h2 class="text-2xl md:text-4xl font-black text-slate-800 mb-4 md:mb-6 tracking-tight leading-tight">
                            {{ $lesson->translate('title') }}
                        </h2>

                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed mb-8 whitespace-pre-line text-sm md:text-base">
                            {{ $lesson->translate('content') }}
                        </div>

                        @if ($lesson->pdf_path)
                            <a href="{{ asset('storage/' . $lesson->pdf_path) }}" target="_blank"
                               class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                {{ __('messages.student.download_pdf') }}
                            </a>
                        @endif
                    </article>
                </div>

                <div class="p-5 md:p-10 lg:p-12 bg-slate-50/30">
                    <h3 class="text-lg md:text-xl font-black text-slate-800 mb-6 md:mb-8 flex items-center">
                        <span class="w-1.5 h-6 md:w-2 md:h-8 bg-indigo-600 rounded-full mr-3 md:mr-4"></span>
                        {{ __('messages.student.assignments_and_grading') }}
                    </h3>

                    @forelse ($lesson->assignments as $assignment)
                        @php $submission = $assignment->submission ?? null; @endphp

                        <div class="mb-6 md:mb-10 bg-white p-5 md:p-8 rounded-2xl md:rounded-[2rem] border border-slate-200 shadow-sm">
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6 md:mb-8">
                                <div class="flex-1">
                                    <h4 class="text-lg md:text-xl font-black text-slate-800 mb-2">{{ $assignment->translate('title') }}</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-medium leading-relaxed">{{ $assignment->translate('description') }}</p>
                                </div>
                            </div>

                            @if ($submission)
                                <div class="space-y-4 md:space-y-6">
                                    <div class="bg-slate-50 p-4 md:p-6 rounded-2xl border border-slate-100 shadow-inner overflow-hidden">
                                        <label class="block mb-2 text-slate-400 text-[9px] font-black uppercase tracking-widest">{{ __('messages.student.your_answer') }}</label>
                                        <pre class="whitespace-pre-wrap text-xs md:text-sm">{{ $submission->code }}</pre>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
                                    @csrf
                                    <textarea name="code" rows="6" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-indigo-500 focus:bg-white transition-all text-xs md:text-sm font-mono" placeholder="{{ __('messages.student.code_placeholder') }}"></textarea>

                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div class="flex-1">
                                            <label class="block font-black text-slate-700 text-[10px] uppercase tracking-widest mb-2">{{ __('messages.student.archive_label') }}</label>
                                            <input type="file" name="archive" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-600 cursor-pointer">
                                        </div>
                                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-indigo-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-lg hover:bg-indigo-700 transition-all">
                                            {{ __('messages.student.submit') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-center py-6 text-slate-400 italic text-sm">{{ __('messages.student.no_written_assignments') }}</p>
                    @endforelse

                    @if($lesson->test)
                        @php $testResult = auth()->user()->testResults()->where('test_id', $lesson->test->id)->first(); @endphp
                        <div class="mt-8 rounded-[2rem] p-6 md:p-8 text-white shadow-xl" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-4 text-center sm:text-left">
                                    <div class="hidden sm:flex w-14 h-14 bg-white/20 backdrop-blur-lg rounded-2xl items-center justify-center text-2xl shrink-0">
                                        {{ $testResult ? '🏆' : '🧩' }}
                                    </div>
                                    <div>
                                        <h4 class="text-lg md:text-xl font-black">{{ __('messages.student.lesson_test') }}</h4>
                                        <p class="text-indigo-100 text-xs md:text-sm opacity-90 italic">
                                            {{ $testResult ? __('messages.student.test_completed') : __('messages.student.check_knowledge') }}
                                        </p>
                                    </div>
                                </div>

                                @if($testResult)
                                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 px-8 py-4 rounded-2xl text-center w-full sm:w-auto">
                                        <span class="block text-[9px] font-black uppercase text-indigo-100 mb-1">{{ __('messages.student.result') }}</span>
                                        <span class="text-3xl md:text-4xl font-black">{{ $testResult->score }}%</span>
                                    </div>
                                @else
                                    <a href="{{ route('student.test.show', $lesson->id) }}" class="w-full sm:w-auto text-center px-10 py-4 bg-white text-indigo-600 font-black text-xs uppercase tracking-widest rounded-2xl hover:scale-105 transition-all">
                                        {{ __('messages.common.start') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <aside id="ai-sidebar" class="fixed inset-y-0 right-0 w-full sm:w-[400px] lg:w-1/3 z-[60] lg:z-0 transform translate-x-full lg:translate-x-0 lg:static lg:block transition-transform duration-300 ease-in-out">
            <div id="chat-overlay" class="lg:hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm -z-10 opacity-0 pointer-events-none transition-opacity duration-300"></div>

            <div id="ai-sidebar-container" class="bg-white lg:rounded-[2.5rem] border-l lg:border border-slate-100 shadow-2xl flex flex-col h-full overflow-hidden">
                <div class="p-5 md:p-6 bg-indigo-600 flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-black text-sm md:text-base tracking-tight">{{ __('messages.student.ai_assistant') }}</h4>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                                <span class="text-indigo-100 text-[9px] font-black uppercase tracking-widest">{{ __('messages.student.ai_online') }}</span>
                            </div>
                        </div>
                    </div>
                    <button id="close-chat-mobile" class="lg:hidden text-white/80 hover:text-white p-2" type="button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div id="ai-chat-body" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 bg-slate-50/50">
                    <div class="flex flex-col gap-2 max-w-[90%]">
                        <div class="bg-white border border-slate-200 p-3 md:p-4 rounded-2xl rounded-tl-none shadow-sm text-sm text-slate-700 leading-relaxed font-medium">
                            {{ __('messages.student.ai_greeting') }}
                        </div>
                    </div>
                </div>

                <div class="p-4 md:p-6 bg-white border-t border-slate-100 shrink-0 mb-safe">
                    <form id="ai-chat-form" class="relative" data-url="{{ route('student.ai.chat', $lesson->id) }}">
                        @csrf
                        <textarea id="ai-input" rows="1" placeholder="{{ __('messages.student.ai_question_placeholder') }}"
                                  class="w-full pl-4 pr-12 py-4 bg-slate-100 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all resize-none shadow-inner"></textarea>
                        <button id="ai-send" type="submit"
                                class="absolute right-2 bottom-2 p-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

    </div>
</div>

<button id="open-chat-mobile" class="lg:hidden fixed bottom-6 right-6 w-14 h-14 bg-indigo-600 text-white rounded-2xl shadow-2xl flex items-center justify-center z-50 hover:scale-110 active:scale-95 transition-all">
    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <span class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"></span>
</button>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('ai-sidebar');
    const openBtn = document.getElementById('open-chat-mobile');
    const closeBtn = document.getElementById('close-chat-mobile');
    const overlay = document.getElementById('chat-overlay');

    const form = document.getElementById('ai-chat-form');
    const input = document.getElementById('ai-input');
    const body = document.getElementById('ai-chat-body');
    const sendBtn = document.getElementById('ai-send');

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const i18n = {
        preparing: @json(__('messages.student.ai_preparing')),
        emptyReply: @json(__('messages.student.ai_empty_reply')),
        error: @json(__('messages.student.ai_error')),
    };

    const scrollToBottom = () => {
        if (!body) return;
        requestAnimationFrame(() => { body.scrollTop = body.scrollHeight; });
    };

    const toggleChat = () => {
        sidebar.classList.toggle('translate-x-full');
        overlay.classList.toggle('opacity-0');
        overlay.classList.toggle('pointer-events-none');

        const isOpen = !sidebar.classList.contains('translate-x-full');
        document.body.style.overflow = isOpen ? 'hidden' : '';
        if (isOpen) scrollToBottom();
    };

    openBtn?.addEventListener('click', toggleChat);
    closeBtn?.addEventListener('click', toggleChat);
    overlay?.addEventListener('click', toggleChat);

    const appendBubble = (text, who) => {
        if (!body) return null;

        const wrap = document.createElement('div');
        wrap.className = 'flex flex-col gap-2 ' + (who === 'me' ? 'items-end' : 'items-start');

        const bubble = document.createElement('div');
        bubble.className =
            (who === 'me'
                ? 'bg-indigo-600 text-white'
                : 'bg-white border border-slate-200 text-slate-700'
            ) +
            ' p-3 md:p-4 rounded-2xl shadow-sm text-sm leading-relaxed font-medium max-w-[90%] whitespace-pre-wrap';

        bubble.textContent = text;

        wrap.appendChild(bubble);
        body.appendChild(wrap);
        scrollToBottom();
        return bubble;
    };

    form?.addEventListener('submit', async (e) => {
        e.preventDefault();

        const url = form.getAttribute('data-url');
        const message = (input.value || '').trim();
        if (!url || !message) return;

        input.value = '';
        input.style.height = '';
        appendBubble(message, 'me');

        sendBtn.disabled = true;

        const loading = appendBubble(i18n.preparing, 'ai');

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf || '',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ message }),
            });

            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();

            if (loading) loading.textContent = data.reply || i18n.emptyReply;
            else appendBubble(data.reply || i18n.emptyReply, 'ai');
        } catch (err) {
            if (loading) loading.textContent = i18n.error;
        } finally {
            sendBtn.disabled = false;
        }
    });

    input?.addEventListener('input', () => {
        input.style.height = '';
        input.style.height = Math.min(input.scrollHeight, 160) + 'px';
    }, { passive: true });

    scrollToBottom();
});
</script>
@endsection
