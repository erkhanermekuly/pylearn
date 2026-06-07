@extends('layouts.app')

@section('content')
<style>
    .code-line {
        background: color-mix(in srgb, var(--dash-glass) 88%, var(--bg-card));
        border: 1px solid var(--border-color);
        backdrop-filter: blur(12px);
        cursor: grab;
        user-select: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .code-line:active { cursor: grabbing; }
    .code-line.dragging {
        opacity: 0.55;
        transform: scale(1.02);
        box-shadow: var(--dash-card-shadow);
    }
    .code-line.drag-over {
        border-color: var(--accent);
        box-shadow: 0 0 0 2px color-mix(in srgb, var(--accent) 25%, transparent);
    }
    .code-line.correct {
        border-color: #10b981;
        background: color-mix(in srgb, #10b981 12%, var(--bg-card));
    }
    .code-line.wrong {
        border-color: #f59e0b;
        background: color-mix(in srgb, #f59e0b 10%, var(--bg-card));
    }
    .code-preview {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 0.8125rem;
        line-height: 1.6;
    }
    .game-badge {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }
</style>

<div class="dashboard-shell min-h-screen flex">
    <div class="dash-scene" aria-hidden="true">
        <div class="dash-grid-plane"></div>
        <div class="dash-orb dash-orb-2"></div>
        <div class="dash-orb dash-orb-4"></div>
        <div class="dash-shape-ring dash-shape-ring-2"></div>
    </div>

    <main class="dash-content flex-1 p-4 sm:p-6 md:p-10 max-w-3xl mx-auto w-full">
        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 text-indigo-600 font-black text-[10px] md:text-xs uppercase mb-6 hover:gap-3 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('messages.common.back') }}
        </a>

        <div class="flex flex-wrap items-start justify-between gap-4 mb-8">
            <div>
                <span class="game-badge inline-block text-[9px] font-black uppercase tracking-[0.25em] text-white px-3 py-1 rounded-full mb-3">{{ __('messages.code_game.badge') }}</span>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight" style="color: var(--text-primary)">{{ __('messages.code_game.title') }}</h1>
                <p class="text-sm mt-2 max-w-xl" style="color: var(--text-secondary)">{{ __('messages.code_game.subtitle') }}</p>
            </div>
            <div class="dash-stat-card rounded-2xl px-5 py-4 border text-center min-w-[120px]">
                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ __('messages.code_game.score') }}</p>
                <p class="text-2xl font-black text-indigo-600"><span id="scoreValue">0</span>/<span id="scoreTotal">{{ count($puzzles) }}</span></p>
            </div>
        </div>

        <div id="gameCard" class="dash-stat-card rounded-[1.75rem] md:rounded-[2rem] border p-5 md:p-8 shadow-lg">
            <div class="flex items-center justify-between gap-3 mb-2">
                <span id="puzzleCounter" class="text-[10px] font-black uppercase tracking-widest text-indigo-500"></span>
                <button type="button" id="shuffleBtn" class="text-[10px] font-black uppercase tracking-wider text-slate-400 hover:text-indigo-600 transition-colors">
                    {{ __('messages.code_game.shuffle') }}
                </button>
            </div>
            <h2 id="puzzleTitle" class="text-lg md:text-xl font-black mb-1" style="color: var(--text-primary)"></h2>
            <p id="puzzleHint" class="text-xs mb-6" style="color: var(--text-secondary)"></p>

            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">{{ __('messages.code_game.instruction') }}</p>

            <div id="linesContainer" class="space-y-2 mb-6"></div>

            <div id="feedback" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

            <div class="flex flex-wrap gap-3">
                <button type="button" id="checkBtn" class="flex-1 min-w-[140px] py-3.5 rounded-xl bg-indigo-600 text-white font-black text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                    {{ __('messages.code_game.check') }}
                </button>
                <button type="button" id="nextBtn" class="hidden flex-1 min-w-[140px] py-3.5 rounded-xl bg-emerald-600 text-white font-black text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition-all">
                    {{ __('messages.code_game.next') }}
                </button>
                <button type="button" id="resetBtn" class="py-3.5 px-5 rounded-xl border font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all" style="border-color: var(--border-color); color: var(--text-secondary)">
                    {{ __('messages.code_game.reset') }}
                </button>
            </div>
        </div>

        <div id="gameComplete" class="hidden dash-stat-card rounded-[2rem] border p-10 text-center mt-6">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 text-2xl">🎉</div>
            <h3 class="text-xl font-black mb-2" style="color: var(--text-primary)">{{ __('messages.code_game.complete_title') }}</h3>
            <p class="text-sm mb-6" style="color: var(--text-secondary)">{{ __('messages.code_game.complete_text') }}</p>
            <a href="{{ route('student.dashboard') }}" class="inline-block py-3 px-8 rounded-xl bg-indigo-600 text-white font-black text-[10px] uppercase tracking-widest">{{ __('messages.code_game.back_dashboard') }}</a>
        </div>
    </main>
</div>

@php
    $gameI18n = [
        'puzzleOf' => __('messages.code_game.puzzle_of'),
        'correct' => __('messages.code_game.correct'),
        'incorrect' => __('messages.code_game.incorrect'),
        'tryAgain' => __('messages.code_game.try_again'),
        'moveUp' => __('messages.code_game.move_up'),
        'moveDown' => __('messages.code_game.move_down'),
    ];
@endphp

<script>
document.addEventListener('DOMContentLoaded', () => {
    const puzzles = @json($puzzles);
    const i18n = @json($gameI18n);

    let currentIndex = 0;
    let solved = new Set();
    let dragSrcIndex = null;

    const els = {
        counter: document.getElementById('puzzleCounter'),
        title: document.getElementById('puzzleTitle'),
        hint: document.getElementById('puzzleHint'),
        container: document.getElementById('linesContainer'),
        feedback: document.getElementById('feedback'),
        checkBtn: document.getElementById('checkBtn'),
        nextBtn: document.getElementById('nextBtn'),
        resetBtn: document.getElementById('resetBtn'),
        shuffleBtn: document.getElementById('shuffleBtn'),
        scoreValue: document.getElementById('scoreValue'),
        gameComplete: document.getElementById('gameComplete'),
        gameCard: document.getElementById('gameCard'),
    };

    function updateScore() {
        els.scoreValue.textContent = solved.size;
    }

    function getCurrentLines() {
        return [...els.container.querySelectorAll('.code-line')].map(el => el.dataset.line);
    }

    function renderLines(lines) {
        els.container.innerHTML = '';
        lines.forEach((line, index) => {
            const row = document.createElement('div');
            row.className = 'code-line rounded-xl px-4 py-3 flex items-center gap-3 code-preview';
            row.draggable = true;
            row.dataset.line = line;
            row.innerHTML = `
                <span class="text-slate-300 font-black text-xs w-5 shrink-0">${index + 1}</span>
                <code class="flex-1 text-slate-800 dark:text-slate-100 whitespace-pre-wrap break-all">${escapeHtml(line)}</code>
                <div class="flex flex-col gap-0.5 shrink-0">
                    <button type="button" class="move-up p-1 text-slate-400 hover:text-indigo-600" title="${i18n.moveUp}" aria-label="${i18n.moveUp}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    <button type="button" class="move-down p-1 text-slate-400 hover:text-indigo-600" title="${i18n.moveDown}" aria-label="${i18n.moveDown}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
            `;

            row.addEventListener('dragstart', () => {
                dragSrcIndex = [...els.container.children].indexOf(row);
                row.classList.add('dragging');
            });
            row.addEventListener('dragend', () => {
                row.classList.remove('dragging');
                els.container.querySelectorAll('.code-line').forEach(el => el.classList.remove('drag-over'));
                renumberLines();
            });
            row.addEventListener('dragover', e => {
                e.preventDefault();
                row.classList.add('drag-over');
            });
            row.addEventListener('dragleave', () => row.classList.remove('drag-over'));
            row.addEventListener('drop', e => {
                e.preventDefault();
                row.classList.remove('drag-over');
                if (dragSrcIndex === null) return;
                const items = [...els.container.children];
                const targetIndex = items.indexOf(row);
                if (dragSrcIndex !== targetIndex) {
                    els.container.insertBefore(items[dragSrcIndex], targetIndex > dragSrcIndex ? row.nextSibling : row);
                    renumberLines();
                }
                dragSrcIndex = null;
            });

            row.querySelector('.move-up').addEventListener('click', () => moveLine(row, -1));
            row.querySelector('.move-down').addEventListener('click', () => moveLine(row, 1));

            els.container.appendChild(row);
        });
        renumberLines();
    }

    function moveLine(row, direction) {
        const sibling = direction === -1 ? row.previousElementSibling : row.nextElementSibling;
        if (!sibling) return;
        if (direction === -1) {
            els.container.insertBefore(row, sibling);
        } else {
            els.container.insertBefore(sibling, row);
        }
        renumberLines();
        hideFeedback();
    }

    function renumberLines() {
        els.container.querySelectorAll('.code-line').forEach((el, i) => {
            el.querySelector('span').textContent = i + 1;
            el.classList.remove('correct', 'wrong');
        });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function hideFeedback() {
        els.feedback.classList.add('hidden');
        els.nextBtn.classList.add('hidden');
        els.checkBtn.classList.remove('hidden');
    }

    function loadPuzzle(index) {
        if (index >= puzzles.length) {
            els.gameCard.classList.add('hidden');
            els.gameComplete.classList.remove('hidden');
            return;
        }

        currentIndex = index;
        const puzzle = puzzles[index];
        els.counter.textContent = i18n.puzzleOf.replace(':current', index + 1).replace(':total', puzzles.length);
        els.title.textContent = puzzle.title;
        els.hint.textContent = puzzle.hint;
        renderLines([...puzzle.shuffled]);
        hideFeedback();
        els.gameCard.classList.remove('hidden');
        els.gameComplete.classList.add('hidden');
    }

    function shuffleCurrent() {
        const puzzle = puzzles[currentIndex];
        let shuffled = [...puzzle.shuffled];
        do {
            shuffled.sort(() => Math.random() - 0.5);
        } while (JSON.stringify(shuffled) === JSON.stringify(puzzle.solution) && shuffled.length > 1);
        renderLines(shuffled);
        hideFeedback();
    }

    els.checkBtn.addEventListener('click', () => {
        const puzzle = puzzles[currentIndex];
        const current = getCurrentLines();
        const isCorrect = JSON.stringify(current) === JSON.stringify(puzzle.solution);

        els.container.querySelectorAll('.code-line').forEach((el, i) => {
            el.classList.toggle('correct', isCorrect);
            el.classList.toggle('wrong', !isCorrect && current[i] !== puzzle.solution[i]);
        });

        els.feedback.classList.remove('hidden');
        if (isCorrect) {
            els.feedback.className = 'mb-6 p-4 rounded-xl text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-200';
            els.feedback.textContent = i18n.correct;
            solved.add(puzzle.id);
            updateScore();
            els.checkBtn.classList.add('hidden');
            els.nextBtn.classList.remove('hidden');
        } else {
            els.feedback.className = 'mb-6 p-4 rounded-xl text-sm font-bold bg-amber-50 text-amber-800 border border-amber-200';
            els.feedback.textContent = i18n.incorrect;
        }
    });

    els.nextBtn.addEventListener('click', () => loadPuzzle(currentIndex + 1));
    els.resetBtn.addEventListener('click', () => {
        renderLines([...puzzles[currentIndex].shuffled]);
        hideFeedback();
    });
    els.shuffleBtn.addEventListener('click', shuffleCurrent);

    loadPuzzle(0);
});
</script>
@endsection
