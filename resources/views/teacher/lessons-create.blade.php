@extends('layouts.app')

@section('content')
<style>
    .premium-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }
    .input-field {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        transition: all 0.2s ease;
    }
    .input-field:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.05);
        outline: none;
    }
    .section-title {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
    }
</style>
<div class="lg:hidden flex justify-between items-center p-5 bg-white border-b sticky top-0 z-[60] shadow-sm">
    <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-indigo-600 font-bold rounded-xl px-4 py-2 text-sm transition-all shadow-sm hover:shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
    
    <div class="flex flex-col items-center text-center">
        <span class="font-black text-indigo-600 tracking-tighter text-sm uppercase">{{ __('messages.teacher.panel') }}</span>
        <span id="mobileGroupName" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ __('messages.teacher.mobile_add_lesson') }}</span>
    </div>

    <div class="w-12"></div> 
</div>
<div class="min-h-screen bg-[#f1f5f9] pt-6 pb-12 px-4 sm:px-6">
    
    <div class="max-w-3xl mx-auto">

        <div class="premium-card overflow-hidden">
            <div class="p-6 sm:p-10 border-b border-slate-100 bg-white">
                <h1 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">{{ __('messages.teacher.save_new_lesson') }}</h1>
                <p class="text-slate-400 text-xs font-bold mt-1 uppercase tracking-wider">{{ __('messages.teacher.work_panel') }}</p>
            </div>

            <form method="POST" action="{{ route('teacher.lessons.store') }}" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-8">
                @csrf
                
                <div class="space-y-5" style="margin-top: -5px;">
                    <h2 class="section-title">{{ __('messages.teacher.section_basics') }}</h2>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 ml-1">{{ __('messages.teacher.lesson_title') }}</label>
                        <input name="lesson_title" type="text" placeholder="{{ __('messages.teacher.lesson_title_placeholder') }}" required 
                            class="w-full p-4 input-field font-bold text-sm text-slate-700 placeholder:text-slate-300">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 ml-1">{{ __('messages.teacher.lesson_content') }}</label>
                        <textarea name="lesson_content" rows="5" placeholder="{{ __('messages.teacher.lesson_content_placeholder') }}" required 
                            class="w-full p-4 input-field font-medium text-sm text-slate-600 resize-none placeholder:text-slate-300"></textarea>
                    </div>
                </div>

                <div class="space-y-5 pt-4">
                    <h2 class="section-title">{{ __('messages.teacher.section_materials') }}</h2>
                    
                    <div class="relative">
                        <input name="lesson_pdf" type="file" id="pdf-upload" class="hidden" accept="application/pdf">
                        <label for="pdf-upload" class="flex items-center justify-between w-full p-4 input-field cursor-pointer group">
                            <span id="file-label" class="text-sm font-bold text-slate-400 group-hover:text-indigo-500 transition-colors">{{ __('messages.teacher.upload_pdf') }}</span>
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </label>
                        <p id="file-name" class="mt-2 text-[10px] font-black text-emerald-500 uppercase px-2 hidden">{{ __('messages.teacher.file_ready') }}</p>
                    </div>
                </div>

                <div class="space-y-5 pt-4">
                    <div class="flex items-center gap-2">
                        <h2 class="section-title text-indigo-600">{{ __('messages.teacher.section_homework') }}</h2>
                        <div class="h-px flex-1 bg-indigo-50"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <input name="assignment_title" type="text" placeholder="{{ __('messages.teacher.assignment_title_placeholder') }}" required 
                            class="w-full p-4 input-field font-bold text-sm text-slate-700 placeholder:text-slate-300">
                        
                        <textarea name="assignment_description" rows="3" placeholder="{{ __('messages.teacher.assignment_desc_placeholder') }}" required 
                            class="w-full p-4 input-field font-medium text-sm text-slate-600 resize-none placeholder:text-slate-300"></textarea>
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl py-4 transition-all shadow-lg shadow-indigo-100 uppercase text-xs tracking-[0.2em] active:scale-[0.98]">
                        {{ __('messages.teacher.publish') }}
                    </button>
                    <p class="text-center mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('messages.teacher.auto_save_note') }}</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('pdf-upload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const label = document.getElementById('file-label');
        const status = document.getElementById('file-name');
        if (fileName) {
            label.innerText = fileName;
            label.classList.replace('text-slate-400', 'text-slate-700');
            status.classList.remove('hidden');
        }
    });
</script>
@endsection
