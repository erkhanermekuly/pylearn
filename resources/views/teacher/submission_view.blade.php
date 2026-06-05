@extends('layouts.app')

@section('content')
<style>
    .bg-submission { background: #f8fafc; }
    
    .glass-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .code-block {
        font-family: 'Fira Code', monospace;
        background: #1e293b;
        color: #e2e8f0;
        padding: 1.5rem;
        border-radius: 1rem;
        overflow-x: auto;
    }

    .grade-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
</style>

<div class="min-h-screen bg-submission p-4 lg:p-8">
    <main class="max-w-5xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <a href="/teacher" class="group flex items-center gap-2 text-indigo-600 font-black text-[10px] uppercase tracking-widest hover:text-indigo-800 transition-all">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ __('messages.common.back') }}
            </a>
            
            <span class="bg-indigo-50 text-indigo-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter">
                {{ __('messages.teacher.review_work') }}
            </span>
        </div>

        <div class="glass-card p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50 rounded-bl-full -z-10 opacity-50"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">
                        {{ $submission->user->name }}
                    </h2>
                    <p class="text-slate-500 font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2"/></svg>
                        {{ $submission->assignment->translate('title') }}
                    </p>
                </div>

                <div class="bg-white border-2 border-indigo-100 rounded-2xl p-4 text-center min-w-[140px]">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('messages.teacher.current_grade') }}</p>
                    <span class="text-3xl font-black {{ $submission->grade ? 'text-indigo-600' : 'text-slate-300' }}">
                        {{ $submission->grade ?? '---' }}
                    </span>
                    <span class="text-slate-400 font-bold">{{ __('messages.common.out_of_100') }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-black text-slate-800 text-sm uppercase tracking-wider flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
                            {{ __('messages.teacher.student_answer') }}
                        </h4>
                        @if ($submission->archive_path)
                            <a href="{{ asset('storage/' . $submission->archive_path) }}" class="flex items-center gap-2 bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5"/></svg>
                                {{ __('messages.teacher.download_archive') }}
                            </a>
                        @endif
                    </div>
                    
                    <pre class="code-block text-xs leading-relaxed">{{ $submission->code }}</pre>
                </div>

                <div class="glass-card p-6">
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider mb-6 pb-2 border-b border-slate-100">💬 {{ __('messages.teacher.comments') }}</h3>
                    
                    <div class="space-y-4">
                        @forelse ($submission->comments as $comment)
                            <div class="p-4 rounded-2xl {{ $comment->user_id == auth()->id() ? 'bg-indigo-50 border border-indigo-100 ml-8' : 'bg-slate-50 border border-slate-100 mr-8' }}">
                                <p class="text-slate-700 text-sm leading-relaxed mb-2">{{ $comment->comment }}</p>
                                <div class="flex items-center gap-2">
                                    <div class="w-4 h-4 bg-slate-200 rounded-full"></div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase">{{ $comment->user->name }}</span>
                                    <span class="text-[10px] text-slate-300">• {{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center py-4 text-slate-400 text-sm italic">{{ __('messages.teacher.no_comments') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="glass-card p-6 sticky top-6">
                    <h4 class="font-black text-slate-800 text-sm uppercase tracking-wider mb-6">{{ __('messages.teacher.grading_feedback') }}</h4>
                    
                    <form method="POST" action="{{ route('teacher.submission.update', $submission) }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('messages.teacher.feedback_label') }}</label>
                            <textarea name="feedback" rows="5" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 focus:outline-none transition-all text-sm font-medium" placeholder="{{ __('messages.teacher.feedback_placeholder') }}">{{ old('feedback', $submission->feedback) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('messages.teacher.grade_label') }}</label>
                            <div class="relative">
                                <input name="grade" type="number" min="49" max="100" value="{{ old('grade', $submission->grade) }}" 
                                       class="grade-input w-full p-4 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none transition-all text-xl font-black text-indigo-600"
                                       placeholder="0">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 font-bold">/100</span>
                            </div>
                            <p class="text-[10px] text-amber-500 mt-2 font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg>
                                {{ __('messages.teacher.grade_min_note') }}
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-100 uppercase text-xs tracking-[0.2em] flex items-center justify-center gap-2">
                            {{ __('messages.teacher.save_update') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </main>
</div>
@endsection
