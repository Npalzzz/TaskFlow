<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskFlow') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- Panel kiri: branding --}}
        <div class="relative lg:w-[42%] xl:w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-600 to-blue-700 text-white px-8 sm:px-12 py-10 flex flex-col justify-between overflow-hidden">

            {{-- Dekorasi blob, murni dekoratif --}}
            <div class="pointer-events-none absolute -top-24 -right-20 w-72 h-72 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 -left-16 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>

            {{-- Logo --}}
            <a href="/" class="relative flex items-center gap-2.5">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.5l7 2.7v5.4c0 4.6-3 8-7 9-4-1-7-4.4-7-9V5.2l7-2.7z" fill="white" fill-opacity="0.15" stroke="white" stroke-width="1.4"/>
                    <path d="M8.5 12.3l2.4 2.4 4.4-4.9" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="leading-tight">
                    <p class="font-bold tracking-wide">TASKFLOW</p>
                    <p class="text-[10px] tracking-[0.2em] text-indigo-200">SINCE 2026</p>
                </div>
            </a>

            {{-- Headline --}}
            <div class="relative mt-10">
                <h1 class="text-2xl sm:text-3xl font-bold leading-snug">
                    Kelola Tugas Sekolah<br class="hidden sm:block"> &amp; Reminder Tanpa Ribet
                </h1>
            </div>

            {{-- Mockup mini task card, mengambil bahasa visual dari dashboard --}}
            <div class="relative hidden lg:block h-56 mt-6">
                <div class="absolute left-2 top-2 w-60 -rotate-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 p-4 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="w-5 h-5 shrink-0 rounded-md bg-emerald-400 flex items-center justify-center">
                            <svg class="w-3 h-3 text-indigo-900" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </span>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-2 w-28 bg-white/60 rounded-full"></div>
                            <div class="h-2 w-16 bg-white/30 rounded-full"></div>
                        </div>
                    </div>
                </div>
                <div class="absolute right-0 top-20 w-56 rotate-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 p-4 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="w-5 h-5 shrink-0 rounded-md border-2 border-white/50"></span>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-2 w-24 bg-white/60 rounded-full"></div>
                            <div class="h-2 w-14 bg-white/30 rounded-full"></div>
                        </div>
                        <span class="text-[9px] font-semibold bg-rose-400 text-white rounded-full px-1.5 py-0.5">H-1</span>
                    </div>
                </div>
                <div class="absolute left-8 top-40 w-52 -rotate-2 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 p-4 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="w-5 h-5 shrink-0 rounded-md bg-emerald-400 flex items-center justify-center">
                            <svg class="w-3 h-3 text-indigo-900" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </span>
                        <div class="h-2 w-20 bg-white/60 rounded-full"></div>
                    </div>
                </div>
            </div>

            {{-- Tagline bawah --}}
            <p class="relative mt-6 text-indigo-100">
                Gak ada lagi cerita lupa ngerjain PR!
            </p>
        </div>

        {{-- Panel kanan: form --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12 bg-white">
            <div class="w-full max-w-sm">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $heading ?? '' }}</h2>
                    <p class="text-gray-500 mt-1">{{ $subheading ?? '' }}</p>
                </div>

                <div class="bg-gray-100 rounded-3xl p-6 sm:p-8">
                    {{ $slot }}
                </div>

            </div>
        </div>

    </div>
</body>
</html>