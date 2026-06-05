@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50/50 py-10 px-4">
    <div class="max-w-3xl mx-auto">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-800 flex items-center">
                <span class="p-2 bg-indigo-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </span>
                Оқылған хабарламалар
            </h2>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-slate-200">
                Барлығы: {{ $readNotifications->total() }}
            </span>
        </div>

        @if($readNotifications->count())
            <ul class="space-y-4">
                @foreach($readNotifications as $notification)
                    <li class="group bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_15px_30px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                        
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-slate-200 group-hover:bg-indigo-500 transition-colors"></div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1 pl-2">
                                <div class="text-slate-700 font-medium leading-relaxed mb-1">
                                    {{ $notification->data['message'] }}
                                </div>
                                <div class="flex items-center text-slate-400 text-[11px] font-bold uppercase tracking-tighter">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $notification->created_at->diffForHumans() }}
                                    <span class="mx-2">•</span>
                                    {{ $notification->created_at->format('d.m.Y H:i') }}
                                </div>
                            </div>

                            <div class="shrink-0">
                                @if(isset($notification->data['lesson_id']))
                                    <a href="{{ route('student.lessons.show', $notification->data['lesson_id']) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                        Өту
                                        <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                @elseif(isset($notification->data['submission_id']))
                                    <a href="{{ route('teacher.submission.view', $notification->data['submission_id']) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-800 hover:text-white transition-all shadow-sm">
                                        Көру
                                        <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-10 px-2">
                {{ $readNotifications->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[2rem] border border-dashed border-slate-300 shadow-inner">
                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Оқылған хабарламалар әлі жоқ</p>
            </div>
        @endif
    </div>
</div>
@endsection