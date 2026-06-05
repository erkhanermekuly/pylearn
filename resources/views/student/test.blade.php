@extends('layouts.app')

@section('content')
<style>
    input[type="radio"]:checked + span { color: #4f46e5; }
    input[type="radio"]:checked ~ .check-icon { display: block; }
    .option-card:has(input[type="radio"]:checked) {
        border-color: #4f46e5;
        background-color: #f5f3ff;
        transform: scale(1.01);
    }
    .option-card:active { transform: scale(0.98); }

    @media (max-width: 640px) {
        .option-card { padding: 1rem !important; }
    }
</style>

<div class="min-h-screen pb-24 md:pb-8 bg-slate-50/50 py-4 sm:py-8 px-2 sm:px-4">
    <div class="max-w-3xl mx-auto">

        @php
            $results = session('test_results');
            $isFullScore = $results && $results['score'] == 100;
        @endphp

        {{-- НӘТИЖЕ ПАНЕЛІ --}}
        @if($results)
            <div class="mb-6 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-10 shadow-2xl border-2 {{ $isFullScore ? 'border-emerald-100' : 'border-indigo-100' }} overflow-hidden relative">
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 {{ $isFullScore ? 'bg-emerald-500' : 'bg-indigo-600' }} rounded-full flex items-center justify-center text-white text-2xl sm:text-4xl font-black mb-4 shadow-xl ring-8 {{ $isFullScore ? 'ring-emerald-50' : 'ring-indigo-50' }}">
                        {{ $results['score'] }}%
                    </div>

                    <h3 class="text-xl sm:text-2xl font-black text-slate-800 mb-2">
                        {{ $isFullScore ? 'Керемет нәтиже! 🎉' : 'Тест аяқталды' }}
                    </h3>

                    @if(!$isFullScore && !empty($results['wrong_questions']))
                        <div class="w-full mt-6 space-y-3">
                            <p class="text-rose-500 font-black uppercase text-[10px] tracking-widest">
                                Мына сұрақтарды қайталаңыз:
                            </p>

                            @foreach($results['wrong_questions'] as $wrong)
                                <div class="p-3 bg-rose-50 rounded-xl border border-rose-100 text-left">
                                    <div class="flex items-start gap-3">
                                        <span class="bg-rose-500 text-white w-6 h-6 rounded-lg flex items-center justify-center shrink-0 font-bold text-xs">
                                            {{ $wrong['index'] + 1 }}
                                        </span>

                                        <div class="min-w-0 flex-1">
                                            <p class="text-rose-900 font-bold text-xs sm:text-sm truncate">
                                                Қате жіберілді
                                            </p>
                                            <p class="text-rose-600 text-[10px] sm:text-xs italic font-medium">
                                                Тақырып: {{ $wrong['topic'] }}
                                            </p>

                                            {{-- ✅ Кнопка ИИ --}}
                                            <div class="mt-2">
                                                <button
                                                    type="button"
                                                    class="js-ai-btn text-[10px] sm:text-xs font-black px-3 py-2 rounded-lg bg-white border border-rose-200 hover:border-indigo-200 transition-colors"
                                                    data-qindex="{{ $wrong['index'] }}"
                                                    data-uopt="{{ $wrong['user_option'] ?? -1 }}"
                                                    data-url="{{ route('student.test.ai_explain', $test->id) }}"
                                                >
                                                    🤖 ИИ түсіндірме
                                                </button>
                                            </div>

                                            {{-- ✅ Панель ответа ИИ --}}
                                            <div class="js-ai-panel mt-3 hidden">
                                                <div class="js-ai-status text-[11px] text-slate-500">
                                                    Жүктелуде…
                                                </div>
                                                <pre class="js-ai-text mt-2 whitespace-pre-wrap text-[12px] text-slate-800"></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <p class="mt-6 text-slate-400 text-xs font-medium italic">
                            Қателермен жұмыс істеп, тестті қайта тапсырып көріңіз 👇
                        </p>
                    @elseif($isFullScore)
                        <p class="text-slate-500 text-sm sm:text-base max-w-sm mx-auto mt-2">
                            Сіз бұл тақырыпты толық меңгердіңіз! Енді келесі сабаққа өте аласыз.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <a href="{{ route('student.lessons.show', $test->lesson->id) }}"
                               class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg text-center">
                                Курсқа қайту
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- ТЕСТ ФОРМАСЫ (Тек 100% болмағанда көрінеді) --}}
        @if(!$isFullScore)
            <div class="sticky top-2 sm:top-4 z-20 mb-4 sm:mb-6">
                <div class="bg-white/90 backdrop-blur-md rounded-xl sm:rounded-2xl p-3 sm:p-5 shadow-lg border border-slate-200/60 flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <h2 class="text-xs sm:text-sm md:text-base font-black text-slate-800 tracking-tight truncate">{{ $test->title }}</h2>
                        <p class="text-[8px] sm:text-[9px] font-bold text-indigo-500 uppercase tracking-wider mt-0.5 truncate">{{ $test->lesson->title }}</p>
                    </div>
                    <div class="flex flex-col items-end shrink-0">
                        <span id="progress-text" class="text-[10px] sm:text-xs font-black text-indigo-600 tabular-nums">0 / {{ count($test->questions) }}</span>
                        <div class="w-16 sm:w-24 bg-slate-100 h-1.5 rounded-full mt-1 overflow-hidden">
                            <div id="progress-bar" class="bg-indigo-600 h-full transition-all duration-500 ease-out" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-slate-200/40 overflow-hidden border border-slate-100">
                <form id="test-form" action="{{ route('student.test.submit', $test->id) }}" method="POST" class="p-4 sm:p-8 md:p-12 space-y-8 sm:space-y-12">
                    @csrf

                    @foreach($test->questions as $index => $q)
                        <div class="question-block space-y-4 sm:space-y-6" data-question="{{ $index + 1 }}">
                            <div class="flex gap-3 sm:gap-4">
                                <span class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 bg-slate-50 text-slate-400 rounded-lg sm:rounded-xl flex items-center justify-center font-black text-xs sm:text-sm border border-slate-100">
                                    {{ $index + 1 }}
                                </span>
                                <h4 class="text-sm sm:text-lg md:text-xl font-bold text-slate-800 leading-snug pt-1">
                                    {{ $q['text'] }}
                                </h4>
                            </div>

                            <div class="space-y-2.5 sm:space-y-3 sm:ml-14">
                                @foreach($q['options'] as $optIndex => $option)
                                    <label class="option-card group relative flex items-center p-4 border-2 border-slate-100 rounded-xl sm:rounded-2xl cursor-pointer hover:border-indigo-100 hover:bg-slate-50/50 transition-all duration-200">
                                        <div class="relative flex items-center shrink-0">
                                            <input type="radio" name="answers[{{ $index }}]" value="{{ $optIndex }}" required onchange="updateProgress()" class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600">
                                        </div>
                                        <span class="ml-3 sm:ml-4 text-slate-600 font-bold text-xs sm:text-base leading-tight">
                                            {{ $option }}
                                        </span>
                                        <div class="check-icon hidden ml-auto text-indigo-600">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-8 sm:pt-10 border-t border-slate-100">
                        <button type="submit" onclick="return confirmSubmission()" class="group relative w-full bg-slate-900 text-white font-black py-4 sm:py-5 rounded-xl sm:rounded-2xl shadow-xl hover:bg-indigo-600 transition-all duration-300 uppercase tracking-widest text-[10px] sm:text-xs overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-2">Тестті аяқтау</span>
                            <div class="absolute inset-0 bg-indigo-700 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>

<script>
    function updateProgress() {
        const total = {{ count($test->questions) }};
        const checked = document.querySelectorAll('input[type="radio"]:checked').length;
        const percent = (checked / total) * 100;
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        if(progressBar) progressBar.style.width = percent + '%';
        if(progressText) progressText.innerText = checked + ' / ' + total;
    }

    function confirmSubmission() {
        const total = {{ count($test->questions) }};
        const checked = document.querySelectorAll('input[type="radio"]:checked').length;
        if (checked < total) {
            return confirm('Сізде ' + (total - checked) + ' жауапсыз сұрақ қалды. Жібере бересіз бе?');
        }
        return confirm('Жауаптарды жіберуге сенімдісіз бе?');
    }

    window.onload = updateProgress;

    // ✅ ИИ разбор: lazy + cache + abort (без лагов)
    (() => {
        const cache = new Map();      // key: q|u -> markdown
        const inflight = new Map();   // key -> AbortController
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        function setPanel(panel, {loading, text}) {
            panel.classList.remove('hidden');
            const status = panel.querySelector('.js-ai-status');
            const pre = panel.querySelector('.js-ai-text');
            if (status) status.textContent = loading ? 'Жүктелуде…' : '';
            if (pre && text != null) pre.textContent = text;
        }

        document.addEventListener('click', async (e) => {
            const btn = e.target.closest('.js-ai-btn');
            if (!btn) return;

            const qindex = btn.dataset.qindex;
            const uopt = btn.dataset.uopt;
            const url = btn.dataset.url;
            const lang = "{{ app()->getLocale() === 'ru' ? 'ru' : 'kk' }}";

            const wrap = btn.parentElement?.parentElement;
            const panel = wrap ? wrap.querySelector('.js-ai-panel') : null;
            if (!panel) return;

            const key = qindex + '|' + uopt;

            // toggle close
            if (!panel.classList.contains('hidden')) {
                panel.classList.add('hidden');
                if (inflight.has(key)) {
                    inflight.get(key).abort();
                    inflight.delete(key);
                }
                return;
            }

            // cache hit
            if (cache.has(key)) {
                setPanel(panel, {loading: false, text: cache.get(key)});
                return;
            }

            if (inflight.has(key)) return;

            const ac = new AbortController();
            inflight.set(key, ac);

            setPanel(panel, {loading: true, text: ''});

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        ...(csrf ? {'X-CSRF-TOKEN': csrf} : {}),
                    },
                    body: JSON.stringify({
                        question_index: Number(qindex),
                        user_option: Number(uopt),
                        lang,
                    }),
                    signal: ac.signal,
                });

                if (!res.ok) throw new Error('AI error: ' + res.status);

                const data = await res.json();
                const text = data?.markdown ?? 'Жауап жоқ.';

                cache.set(key, text);
                requestAnimationFrame(() => setPanel(panel, {loading: false, text}));
            } catch (err) {
                if (err.name === 'AbortError') return;
                requestAnimationFrame(() => setPanel(panel, {loading: false, text: 'Қате. Қайта көріңіз.'}));
            } finally {
                inflight.delete(key);
            }
        }, {passive: true});
    })();
</script>
@endsection
