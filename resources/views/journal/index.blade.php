@extends('layouts.app')

@section('content')
<style>
    .journal-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .journal-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .table-header {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }

    @media (max-width: 640px) {
        .responsive-table thead { display: none; }
        .responsive-table tr { 
            display: block; 
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .responsive-table td { 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 0.5rem 0 !important;
            border: none !important;
            text-align: right !important;
        }
        .responsive-table td::before {
            content: attr(data-label);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #94a3b8;
            margin-right: 1rem;
        }
    }
</style>
<div class="lg:hidden flex justify-between items-center p-5 bg-white border-b sticky top-0 z-[60] shadow-sm">
    <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-indigo-600 font-bold rounded-xl px-4 py-2 text-sm transition-all shadow-sm hover:shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
    
    <div class="flex flex-col items-center text-center">
        <span class="font-black text-indigo-600 tracking-tighter text-sm uppercase">{{ __('messages.teacher.panel') }}</span>
        <span id="mobileGroupName" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ __('messages.journal.title') }}</span>
    </div>

    <div class="w-12"></div> 
</div>
<div class="min-h-screen bg-[#f1f5f9] pt-6 pb-12 px-4 sm:px-6 lg:px-10">
    <div class="max-w-5xl mx-auto">

        @forelse ($lessons as $lesson)
            <div class="journal-card mb-8 overflow-hidden">
                <div class="p-5 sm:p-8 border-b border-slate-100 relative bg-white">
                    <div class="inline-block bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg font-black text-[9px] uppercase mb-3">
                        {{ __('messages.common.python') }}
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-slate-800 tracking-tight leading-tight">{{ $lesson->translate('title') }}</h3>
                    
                    <div class="flex flex-wrap gap-5 mt-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase font-black text-slate-400 leading-none">{{ __('messages.journal.students') }}</p>
                                <p class="text-sm font-black text-slate-700">{{ $students->count() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase font-black text-slate-400 leading-none">{{ __('messages.journal.submitted') }}</p>
                                <p class="text-sm font-black text-emerald-600">
                                    {{ $lesson->assignments->sum(fn($assignment) => $assignment->submissions->count()) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full responsive-table">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-4 text-left text-slate-500 font-black text-[10px] uppercase tracking-widest">{{ __('messages.journal.student_col') }}</th>
                                <th class="px-8 py-4 text-center text-slate-500 font-black text-[10px] uppercase tracking-widest">{{ __('messages.journal.grade_col') }}</th>
                                <th class="px-8 py-4 text-right text-slate-500 font-black text-[10px] uppercase tracking-widest">{{ __('messages.journal.status_col') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($lesson->assignments as $assignment)
                                @forelse ($assignment->submissions as $submission)
                                    <tr class="hover:bg-slate-50/80 transition-colors bg-white">
                                        <td data-label="{{ __('messages.journal.student_col') }}" class="px-8 py-4 font-bold text-slate-700 text-sm">
                                            {{ $submission->user->name }}
                                        </td>
                                        <td data-label="{{ __('messages.journal.grade_col') }}" class="px-8 py-4 text-center">
                                            @if($submission->grade !== null)
                                                <span class="text-base font-black text-indigo-600">{{ $submission->grade }}</span><span class="text-[10px] text-slate-300 ml-0.5">/100</span>
                                            @else
                                                <span class="text-slate-400 italic text-xs">{{ __('messages.journal.pending') }}</span>
                                            @endif
                                        </td>
                                        <td data-label="{{ __('messages.journal.status_col') }}" class="px-8 py-4 text-right">
                                            @if ($submission->grade === null)
                                                <span class="badge bg-amber-100 text-amber-600">{{ __('messages.journal.checking') }}</span>
                                            @else
                                                <span class="badge bg-emerald-100 text-emerald-600">{{ __('messages.journal.graded') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-8 py-6 text-center text-slate-400 italic text-xs">{{ __('messages.journal.no_submission') }}</td>
                                    </tr>
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @php
                    $allSubmissionsUserIds = $lesson->assignments->flatMap->submissions->pluck('user_id');
                    $studentsWithNoSubmissions = $students->whereNotIn('id', $allSubmissionsUserIds);
                @endphp

                <div class="p-6 sm:p-8 bg-slate-50/50 border-t border-slate-100">
                    @if ($studentsWithNoSubmissions->isEmpty())
                        <div class="flex items-center gap-2 text-emerald-600 font-bold text-xs uppercase tracking-tighter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                            {{ __('messages.journal.all_submitted') }}
                        </div>
                    @else
                        <h4 class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-3">{{ __('messages.journal.not_submitted') }}</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($studentsWithNoSubmissions as $user)
                                <span class="bg-white border border-red-100 text-red-500 px-3 py-1.5 rounded-lg text-[10px] font-extrabold shadow-sm">
                                    {{ $user->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-16 journal-card bg-white">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
                </div>
                <p class="text-slate-400 font-black uppercase tracking-widest text-[10px]">{{ __('messages.journal.no_data') }}</p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $lessons->links() }}
        </div>
    </div>
</div>

@endsection
