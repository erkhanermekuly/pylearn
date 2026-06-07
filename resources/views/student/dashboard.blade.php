@extends('layouts.app')

@section('content')
<style>
    .gradient-text {
        background: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="dashboard-shell min-h-screen flex">
    <div class="dash-scene" aria-hidden="true">
        <div class="dash-grid-plane"></div>
        <div class="dash-orb dash-orb-1"></div>
        <div class="dash-orb dash-orb-2"></div>
        <div class="dash-orb dash-orb-3"></div>
        <div class="dash-orb dash-orb-4"></div>
        <div class="dash-shape-ring"></div>
        <div class="dash-shape-ring dash-shape-ring-2"></div>
        <div class="dash-shape-cube">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
        <div class="dash-shape-diamond"></div>
    </div>
    <main class="dash-content flex-1 p-4 sm:p-6 md:p-10 max-w-6xl mx-auto w-full">

        @php
            $userSubmissions = $lessons->flatMap(fn($lesson) => $lesson->assignments)
                ->map(fn($assignment) => $assignment->submission)
                ->filter(fn($submission) => $submission !== null && $submission->user_id === auth()->id());
            $gradedSubmissions = $userSubmissions->filter(fn($submission) => $submission->grade !== null);
            $averageGrade = $gradedSubmissions->count() > 0 ? round($gradedSubmissions->avg('grade'), 1) : null;

            $testIds = $lessons->whereNotNull('test')->pluck('test.id');
            $testResults = auth()->user()->testResults()->whereIn('test_id', $testIds)->get();
            $averageTestScore = $testResults->count() > 0 ? round($testResults->avg('score'), 1) : null;
            
            function gradeToLetter($grade) {
                if ($grade >= 90) return 'A';
                if ($grade >= 80) return 'B';
                if ($grade >= 70) return 'C';
                if ($grade >= 60) return 'D';
                return 'F';
            }
            $letterGrade = $averageGrade !== null ? gradeToLetter($averageGrade) : null;

            function gradeTailwindColor($letter) {
                return match ($letter) {
                    'A' => 'bg-emerald-500', 'B' => 'bg-blue-500', 'C' => 'bg-amber-500',
                    'D' => 'bg-orange-500', 'F' => 'bg-rose-500', default => 'bg-slate-400',
                };
            }
            $statusColor = $letterGrade ? gradeTailwindColor($letterGrade) : 'bg-slate-400';
        @endphp

        <a href="{{ route('student.code-game') }}" class="block dash-stat-card rounded-[1.5rem] md:rounded-[2rem] p-5 md:p-6 border mb-6 md:mb-8 group hover:-translate-y-0.5 transition-transform">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-xl shadow-lg shadow-indigo-200">🧩</div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-widest text-indigo-500 mb-1">{{ __('messages.code_game.badge') }}</p>
                        <h3 class="text-lg md:text-xl font-black text-slate-800 group-hover:text-indigo-600 transition-colors">{{ __('messages.code_game.title') }}</h3>
                        <p class="text-xs text-slate-500 mt-1">{{ __('messages.code_game.dashboard_teaser') }}</p>
                    </div>
                </div>
                <span class="shrink-0 px-4 py-2 rounded-xl bg-indigo-600 text-white text-[10px] font-black uppercase tracking-wider group-hover:bg-indigo-700 transition-colors">{{ __('messages.common.start') }}</span>
            </div>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-12">
            <div class="md:col-span-2 dash-stat-card rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-8 border shadow-[0_20px_50px_rgba(0,0,0,0.06)] flex justify-between items-center relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] mb-2">{{ __('messages.student.assignment_grade') }}</h3>
                    @if ($averageGrade !== null)
                        <div class="flex items-baseline space-x-2">
                            <span class="text-4xl md:text-5xl font-black text-slate-800 tracking-tighter">{{ $averageGrade }}</span>
                            <span class="text-slate-400 text-lg font-bold">{{ __('messages.common.out_of_100') }}</span>
                        </div>
                        <p class="text-slate-500 text-[10px] md:text-xs mt-3 font-medium">{{ __('messages.student.graded_count', ['count' => $gradedSubmissions->count()]) }}</p>
                    @else
                        <p class="text-slate-400 italic text-sm">{{ __('messages.student.not_graded_yet') }}</p>
                    @endif
                </div>
                
                @if ($letterGrade)
                    <div class="relative z-10 h-16 w-16 md:h-20 md:w-20 rounded-2xl rotate-12 flex items-center justify-center text-white text-2xl md:text-3xl font-black {{ $statusColor }} shadow-xl">
                        <span class="-rotate-12">{{ $letterGrade }}</span>
                    </div>
                @endif
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-indigo-50/50 rounded-full blur-3xl"></div>
            </div>

            <div class="dash-stat-card rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-8 border shadow-[0_20px_50px_rgba(0,0,0,0.06)] flex flex-col justify-center relative overflow-hidden">
                <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] mb-2">{{ __('messages.student.test_average') }}</h3>
                @if ($averageTestScore !== null)
                    <div class="flex items-baseline space-x-1">
                        <span class="text-3xl md:text-4xl font-black text-indigo-600 tracking-tighter">{{ $averageTestScore }}%</span>
                    </div>
                    <p class="text-slate-500 text-[10px] mt-2">{{ __('messages.student.tests_submitted', ['count' => $testResults->count()]) }}</p>
                @else
                    <p class="text-slate-400 italic text-xs">{{ __('messages.student.tests_not_started') }}</p>
                @endif
                <div class="absolute -left-4 -top-4 w-16 h-16 bg-blue-50/50 rounded-full blur-2xl"></div>
            </div>

            <div class="dash-stat-card rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-8 border shadow-[0_20px_50px_rgba(0,0,0,0.06)] flex flex-col justify-center relative overflow-hidden">
                @php
                    $totalAssignments = $lessons->flatMap(fn($lesson) => $lesson->assignments)->count();
                    $totalDone = $lessons->flatMap(fn($lesson) => $lesson->assignments)
                        ->filter(fn($assignment) => $assignment->submission !== null)->count();
                    $overallProgress = $totalAssignments > 0 ? round(($totalDone / $totalAssignments) * 100) : 0;
                @endphp
                <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] mb-2">{{ __('messages.student.overall_progress') }}</h3>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-2xl md:text-3xl font-black text-slate-800">{{ $overallProgress }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 shadow-inner">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all duration-1000" style="width: {{ $overallProgress }}%"></div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto no-scrollbar mb-8 md:mb-10 -mx-4 px-4 sm:mx-0 sm:px-0">
            <div class="flex items-center space-x-2 md:space-x-3 bg-slate-200/50 p-1 rounded-xl md:rounded-2xl w-max border border-slate-200 shadow-sm">
                <button data-filter="all" class="filter-btn px-4 md:px-8 py-2 md:py-3 rounded-lg md:rounded-xl text-[10px] md:text-sm font-black transition-all duration-300 bg-white shadow-md text-indigo-600 whitespace-nowrap">
                    {{ __('messages.common.all') }}
                </button>
                <button data-filter="done" class="filter-btn px-4 md:px-8 py-2 md:py-3 rounded-lg md:rounded-xl text-[10px] md:text-sm font-black transition-all duration-300 text-slate-500 hover:bg-white/50 whitespace-nowrap">
                    {{ __('messages.student.filter_done') }}
                </button>
                <button data-filter="notdone" class="filter-btn px-4 md:px-8 py-2 md:py-3 rounded-lg md:rounded-xl text-[10px] md:text-sm font-black transition-all duration-300 text-slate-500 hover:bg-white/50 whitespace-nowrap">
                    {{ __('messages.student.filter_not_done') }}
                </button>
            </div>
        </div>

        <div id="lessonsContainer" class="grid gap-6 md:gap-8">
            @foreach ($lessons as $lesson)
                @php
                    $hasDone = $lesson->assignments->contains(fn($a) => $a->submission !== null);
                    $hasNotDone = $lesson->assignments->contains(fn($a) => $a->submission === null);
                    $status = ($hasDone && $hasNotDone) ? 'all' : ($hasDone ? 'done' : 'notdone');
                @endphp

                <div class="lesson-item premium-card group p-5 md:p-8 rounded-[1.5rem] md:rounded-[2.5rem]" data-status="{{ $status }}">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6 md:mb-8">
                        <div class="flex-1 w-full">
                            <div class="flex items-center space-x-3 mb-2 md:mb-3">
                                <span class="text-[8px] md:text-[10px] font-black uppercase tracking-[0.3em] text-indigo-500 bg-indigo-50 px-2 py-0.5 md:py-1 rounded-full border border-indigo-100">{{ __('messages.lesson.label') }}</span>
                                <span class="text-[9px] md:text-[10px] font-bold text-slate-400 italic">{{ $lesson->created_at->format('d.m.Y') }}</span>
                            </div>
                            <a href="{{ route('student.lessons.show', $lesson->id) }}">
                                <h4 class="text-xl md:text-2xl font-black text-slate-800 group-hover:text-indigo-600 transition-colors tracking-tight line-clamp-2 md:line-clamp-none">{{ $lesson->translate('title') }}</h4>
                            </a>
                        </div>
                        @if ($lesson->pdf_path)
                            <a href="{{ asset('storage/' . $lesson->pdf_path) }}" target="_blank" class="flex w-full md:w-auto items-center justify-center space-x-2 px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl md:rounded-2xl text-slate-600 font-bold hover:bg-indigo-600 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="text-[10px] md:text-xs">{{ __('messages.student.material_pdf') }}</span>
                            </a>
                        @endif
                    </div>

                    <p class="text-slate-500 text-xs md:text-sm leading-relaxed mb-6 md:mb-10 max-w-3xl">{{ Str::limit($lesson->translate('content'), 150) }}</p>

                    <div class="pt-6 md:pt-8 border-t border-slate-100">
                        <h5 class="text-[9px] md:text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-4 md:mb-6 flex items-center">
                            <span class="w-6 md:w-8 h-[2px] bg-slate-200 mr-2 md:mr-3"></span>
                            {{ __('messages.student.assignment_tasks') }}
                        </h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
    @foreach ($lesson->assignments as $assignment)
        @php
            $submission = $assignment->submission;
            $isSubmitted = $submission !== null;
            $isGraded = $isSubmitted && $submission->grade !== null;
        @endphp

        <div class="flex items-center justify-between p-3 md:p-4 rounded-xl md:rounded-2xl bg-slate-50 border border-slate-100 shadow-sm">
            <div class="flex items-center space-x-3">
                <div class="w-2.5 h-2.5 rounded-full 
                    @if($isGraded) 
                        bg-emerald-500 
                    @elseif($isSubmitted) 
                        bg-amber-400 animate-pulse 
                    @else 
                        bg-slate-300 
                    @endif">
                </div>
                
                <span class="text-[11px] md:text-sm font-bold text-slate-700 truncate max-w-[120px] md:max-w-none">
                    {{ $assignment->translate('title') }}
                </span>
            </div>

            <div class="flex items-center">
                @if ($isSubmitted)
                    @if ($isGraded)
                        <span class="text-[9px] md:text-[11px] font-black bg-white px-2 md:px-4 py-1 rounded-lg md:rounded-xl shadow-sm border border-slate-100 text-emerald-600">
                            {{ $submission->grade }} {{ __('messages.common.out_of_100') }}
                        </span>
                    @else
                        <span class="text-[9px] md:text-[11px] font-black bg-amber-100 px-2 md:px-4 py-1 rounded-lg md:rounded-xl shadow-sm border border-amber-200 text-amber-700">
                            {{ __('messages.student.under_review') }}
                        </span>
                    @endif
                @else
                    <span class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-tighter">
                        {{ __('messages.student.not_done') }}
                    </span>
                @endif
            </div>
        </div>
    @endforeach

    @if($lesson->test)
        @php 
            $currentTestResult = auth()->user()->testResults()->where('test_id', $lesson->test->id)->first(); 
        @endphp
        <div class="flex items-center justify-between p-3 md:p-4 rounded-xl md:rounded-2xl bg-indigo-50 border border-indigo-100 shadow-sm">
            <div class="flex items-center space-x-3">
                <div class="w-2.5 h-2.5 rounded-full {{ $currentTestResult ? 'bg-indigo-600' : 'bg-amber-500 animate-pulse' }}"></div>
                <div class="flex flex-col">
                    <span class="text-[11px] md:text-sm font-black text-indigo-900">📝 {{ __('messages.student.test_label') }}</span>
                    <span class="text-[7px] md:text-[9px] uppercase font-bold text-indigo-400 tracking-widest">{{ __('messages.student.knowledge_check') }}</span>
                </div>
            </div>
            @if ($currentTestResult)
                <span class="text-[9px] md:text-[11px] font-black bg-white px-2 md:px-4 py-1 rounded-lg md:rounded-xl shadow-sm text-indigo-600">
                    {{ $currentTestResult->score }}%
                </span>
            @else
                <a href="{{ route('student.test.show', $lesson->test->id) }}" class="text-[8px] md:text-[10px] font-black bg-indigo-600 text-white px-3 py-1.5 rounded-lg md:rounded-xl shadow-md uppercase tracking-tighter hover:bg-indigo-700 transition-colors">
                    {{ __('messages.common.start') }}
                </a>
            @endif
        </div>
    @endif
</div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div id="noLessonsMessage" class="hidden text-center py-20 md:py-32 theme-card rounded-[2rem] md:rounded-[3rem] border shadow-xl">
            <div class="bg-indigo-50 w-16 h-16 md:w-24 md:h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-300">
                <svg class="w-8 h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-lg md:text-xl font-black text-slate-800 mb-2">{{ __('messages.student.nothing_found') }}</h3>
            <p class="text-slate-500 font-medium text-xs md:text-sm">{{ __('messages.student.no_tasks_in_category') }}</p>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const lessons = document.querySelectorAll('.lesson-item');
        const noLessonsMessage = document.getElementById('noLessonsMessage');

        function updateVisibility(filter) {
            let visibleCount = 0;
            lessons.forEach(lesson => {
                const status = lesson.getAttribute('data-status');
                if (filter === 'all' || status === filter || status === 'all') {
                    lesson.style.display = 'block';
                    visibleCount++;
                } else {
                    lesson.style.display = 'none';
                }
            });
            noLessonsMessage.classList.toggle('hidden', visibleCount > 0);
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow-md', 'text-indigo-600');
                    btn.classList.add('text-slate-500');
                });
                button.classList.add('bg-white', 'shadow-md', 'text-indigo-600');
                button.classList.remove('text-slate-500');
                updateVisibility(button.getAttribute('data-filter'));
            });
        });
    });
</script>
@endsection
