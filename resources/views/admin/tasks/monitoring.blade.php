<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-slot name="header">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-sm font-semibold text-indigo-500">
                    TaskFlow Admin
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Monitoring Seluruh Task
                </h2>

            </div>


            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-indigo-50 px-3.5 py-1.5 text-sm font-semibold text-indigo-700 ring-1 ring-indigo-100">

                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>

                Read-Only Monitoring

            </span>

        </div>

    </x-slot>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-indigo-50/20 py-8">

        <div class="mx-auto w-full max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- TOP BAR --}}
            {{-- ================================================= --}}

            <div class="flex items-center justify-between gap-4">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="group inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition duration-200 hover:-translate-x-0.5 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                >

                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-0.5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                        />

                    </svg>

                    Dashboard Admin

                </a>


                <div class="hidden items-center gap-3 sm:flex">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 font-bold text-indigo-600">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-900">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Administrator
                        </p>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- HERO --}}
            {{-- ================================================= --}}

            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-[#111936] to-indigo-950 px-6 py-8 text-white shadow-xl shadow-indigo-950/20 sm:px-8 sm:py-10">

                <div class="relative z-10 max-w-3xl">

                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-indigo-200 ring-1 ring-white/10">

                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>

                        Monitoring Sistem

                    </div>


                    <h1 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">
                        Pantau Seluruh Task
                    </h1>


                    <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">

                        Admin dapat melihat kondisi task seluruh pengguna,
                        termasuk pemilik task, kategori, status, prioritas,
                        dan deadline tanpa mengambil alih pengelolaan task.

                    </p>


                    <div class="mt-6 flex flex-wrap gap-3">

                        <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white ring-1 ring-white/10">

                            <svg class="h-4 w-4 text-indigo-300"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />

                            </svg>

                            {{ $tasks->total() }} Task

                        </div>


                        <div class="inline-flex items-center gap-2 rounded-xl bg-emerald-500/10 px-4 py-2.5 text-sm font-semibold text-emerald-300 ring-1 ring-emerald-400/20">

                            <svg class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />

                            </svg>

                            Read-Only

                        </div>

                    </div>

                </div>


                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-indigo-400/10"></div>

                <div class="absolute -bottom-32 right-20 h-64 w-64 rounded-full bg-indigo-500/10"></div>

            </section>


            {{-- ================================================= --}}
            {{-- SEARCH & FILTER --}}
            {{-- ================================================= --}}

            <section class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">

                <div class="mb-5">

                    <h3 class="font-semibold text-gray-900">
                        Cari dan Filter Task
                    </h3>

                    <p class="mt-1 text-sm text-gray-400">
                        Gunakan pencarian atau filter untuk menemukan task tertentu.
                    </p>

                </div>


                <form
                    method="GET"
                    action="{{ route('admin.tasks.monitoring') }}"
                    class="grid grid-cols-1 gap-4 md:grid-cols-4"
                >

                    {{-- SEARCH --}}

                    <div class="md:col-span-2">

                        <label
                            for="search"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Pencarian
                        </label>

                        <input
                            id="search"
                            name="search"
                            type="text"
                            value="{{ $search }}"
                            placeholder="Cari judul, user, email, kategori..."
                            class="block w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 text-sm font-medium text-gray-900 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                    </div>


                    {{-- STATUS --}}

                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="belum"
                                {{ $status === 'belum' ? 'selected' : '' }}
                            >
                                Belum
                            </option>

                            <option
                                value="proses"
                                {{ $status === 'proses' ? 'selected' : '' }}
                            >
                                Proses
                            </option>

                            <option
                                value="selesai"
                                {{ $status === 'selesai' ? 'selected' : '' }}
                            >
                                Selesai
                            </option>

                        </select>

                    </div>


                    {{-- PRIORITY --}}

                    <div>

                        <label
                            for="priority"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Prioritas
                        </label>

                        <select
                            id="priority"
                            name="priority"
                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                            <option value="">
                                Semua Prioritas
                            </option>

                            <option
                                value="rendah"
                                {{ $priority === 'rendah' ? 'selected' : '' }}
                            >
                                Rendah
                            </option>

                            <option
                                value="sedang"
                                {{ $priority === 'sedang' ? 'selected' : '' }}
                            >
                                Sedang
                            </option>

                            <option
                                value="tinggi"
                                {{ $priority === 'tinggi' ? 'selected' : '' }}
                            >
                                Tinggi
                            </option>

                        </select>

                    </div>


                    {{-- BUTTON --}}

                    <div class="flex items-end gap-2 md:col-span-4">

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md"
                        >

                            Terapkan Filter

                        </button>


                        <a
                            href="{{ route('admin.tasks.monitoring') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition duration-200 hover:bg-gray-50 hover:text-gray-900"
                        >

                            Reset

                        </a>

                    </div>

                </form>

            </section>


            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


                <div class="flex flex-col gap-4 border-b border-gray-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div>

                        <h3 class="font-semibold text-gray-900">
                            Daftar Seluruh Task
                        </h3>

                        <p class="mt-1 text-xs text-gray-400">
                            Data task dari seluruh pengguna TaskFlow
                        </p>

                    </div>


                    <span class="inline-flex w-fit items-center rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                        {{ $tasks->total() }} task ditemukan

                    </span>

                </div>


                {{-- ================================================= --}}
                {{-- DESKTOP --}}
                {{-- ================================================= --}}

                <div class="hidden overflow-x-auto md:block">

                    <table class="min-w-full divide-y divide-gray-100">

                        <thead class="bg-slate-50/80">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Task
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Pemilik
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Kategori
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Deadline
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Priority
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-50 bg-white">


                            @forelse ($tasks as $task)

                                @php

                                    $taskUser = $task->user;

                                    $taskCategory = $task->category;

                                    $userName = $taskUser->name ?? 'User tidak ditemukan';

                                    $initial = strtoupper(substr($userName, 0, 1));

                                    /*
                                     * STATUS DATABASE TASKFLOW
                                     *
                                     * belum
                                     * proses
                                     * selesai
                                     */

                                    $statusValue = strtolower($task->status ?? '');

                                    $priorityValue = strtolower($task->priority ?? '');

                                    $isCompleted = $statusValue === 'selesai';

                                    $isInProgress = $statusValue === 'proses';

                                    $isPending = $statusValue === 'belum';

                                    $isHigh = $priorityValue === 'tinggi';

                                    $isMedium = $priorityValue === 'sedang';

                                    $isLow = $priorityValue === 'rendah';

                                    $isOverdue = $task->deadline
                                        && !$isCompleted
                                        && $task->deadline->isPast();

                                @endphp


                                <tr class="group transition duration-150 hover:bg-indigo-50/20">


                                    {{-- TASK --}}

                                    <td class="px-6 py-5">

                                        <div class="max-w-xs">

                                            <p class="truncate font-semibold text-gray-900">
                                                {{ $task->judul }}
                                            </p>

                                            @if ($task->deskripsi)

                                                <p class="mt-1 line-clamp-2 text-xs leading-5 text-gray-400">
                                                    {{ $task->deskripsi }}
                                                </p>

                                            @else

                                                <p class="mt-1 text-xs text-gray-300">
                                                    Tidak ada deskripsi
                                                </p>

                                            @endif

                                        </div>

                                    </td>


                                    {{-- USER --}}

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-slate-800 to-indigo-700 text-xs font-bold text-white">

                                                {{ $initial }}

                                            </div>


                                            <div class="min-w-0">

                                                <p class="max-w-36 truncate text-sm font-semibold text-gray-900">
                                                    {{ $userName }}
                                                </p>

                                                <p class="max-w-36 truncate text-xs text-gray-400">
                                                    {{ $taskUser->email ?? '-' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- CATEGORY --}}

                                    <td class="px-6 py-5">

                                        @if ($taskCategory)

                                            <span class="inline-flex items-center rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                                {{ $taskCategory->nama_kategori }}

                                            </span>

                                        @else

                                            <span class="text-xs text-gray-400">
                                                Tanpa kategori
                                            </span>

                                        @endif

                                    </td>


                                    {{-- DEADLINE --}}

                                    <td class="px-6 py-5">

                                        @if ($task->deadline)

                                            <div>

                                                <p class="text-sm font-semibold {{ $isOverdue ? 'text-rose-600' : 'text-gray-700' }}">

                                                    {{ $task->deadline->translatedFormat('d M Y') }}

                                                </p>


                                                @if ($isOverdue)

                                                    <span class="text-xs font-medium text-rose-500">
                                                        Terlambat
                                                    </span>

                                                @elseif (!$isCompleted && $task->deadline->isToday())

                                                    <span class="text-xs font-medium text-amber-600">
                                                        Hari ini
                                                    </span>

                                                @elseif (!$isCompleted && now()->diffInDays($task->deadline, false) <= 7)

                                                    <span class="text-xs font-medium text-amber-600">
                                                        Mendekati deadline
                                                    </span>

                                                @endif

                                            </div>

                                        @else

                                            <span class="text-xs text-gray-400">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- PRIORITY --}}

                                    <td class="px-6 py-5">

                                        @if ($isHigh)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>

                                                Tinggi

                                            </span>

                                        @elseif ($isMedium)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                Sedang

                                            </span>

                                        @elseif ($isLow)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                Rendah

                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">

                                                {{ ucfirst($task->priority ?? '-') }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}

                                    <td class="px-6 py-5">


                                        {{-- SELESAI --}}

                                        @if ($isCompleted)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-100">

                                                    <svg
                                                        class="h-2.5 w-2.5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="3"
                                                        viewBox="0 0 24 24"
                                                    >

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7"
                                                        />

                                                    </svg>

                                                </span>

                                                Selesai

                                            </span>


                                        {{-- PROSES --}}

                                        @elseif ($isInProgress)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                                Proses

                                            </span>


                                        {{-- BELUM --}}

                                        @elseif ($isPending)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                Belum

                                            </span>


                                        {{-- STATUS UNKNOWN --}}

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">

                                                {{ ucfirst($task->status ?? 'Tidak diketahui') }}

                                            </span>

                                        @endif

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6">

                                        <div class="flex flex-col items-center justify-center px-6 py-20 text-center">

                                            <p class="font-semibold text-gray-900">
                                                Tidak ada task ditemukan
                                            </p>

                                            <p class="mt-1 max-w-md text-sm text-gray-400">
                                                Belum ada task yang sesuai dengan pencarian atau filter.
                                            </p>

                                            <a
                                                href="{{ route('admin.tasks.monitoring') }}"
                                                class="mt-5 inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                            >
                                                Reset Filter
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE --}}
                {{-- ================================================= --}}

                <div class="divide-y divide-gray-100 md:hidden">


                    @forelse ($tasks as $task)

                        @php

                            $taskUser = $task->user;

                            $taskCategory = $task->category;

                            $userName = $taskUser->name ?? 'User tidak ditemukan';

                            $initial = strtoupper(substr($userName, 0, 1));

                            $statusValue = strtolower($task->status ?? '');

                            $isCompleted = $statusValue === 'selesai';

                            $isInProgress = $statusValue === 'proses';

                            $isPending = $statusValue === 'belum';

                            $isOverdue = $task->deadline
                                && !$isCompleted
                                && $task->deadline->isPast();

                        @endphp


                        <div class="p-5">


                            {{-- USER --}}

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-slate-800 to-indigo-700 text-sm font-bold text-white">

                                    {{ $initial }}

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate font-semibold text-gray-900">
                                        {{ $userName }}
                                    </p>

                                    <p class="truncate text-xs text-gray-400">
                                        {{ $taskUser->email ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- TASK --}}

                            <div class="mt-5">

                                <p class="font-bold text-gray-900">
                                    {{ $task->judul }}
                                </p>

                                @if ($task->deskripsi)

                                    <p class="mt-1 text-sm leading-5 text-gray-400">
                                        {{ $task->deskripsi }}
                                    </p>

                                @endif

                            </div>


                            {{-- META --}}

                            <div class="mt-4 flex flex-wrap gap-2">


                                @if ($taskCategory)

                                    <span class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                        {{ $taskCategory->nama_kategori }}

                                    </span>

                                @endif


                                <span class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">

                                    Priority:
                                    {{ ucfirst($task->priority ?? '-') }}

                                </span>


                                {{-- MOBILE STATUS --}}

                                @if ($isCompleted)

                                    <span class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                        Selesai
                                    </span>

                                @elseif ($isInProgress)

                                    <span class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                        Proses
                                    </span>

                                @elseif ($isPending)

                                    <span class="rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                        Belum
                                    </span>

                                @else

                                    <span class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">
                                        {{ ucfirst($task->status ?? '-') }}
                                    </span>

                                @endif

                            </div>


                            {{-- DEADLINE --}}

                            <div class="mt-4 flex items-center gap-2 text-sm {{ $isOverdue ? 'font-semibold text-rose-600' : 'text-gray-500' }}">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />

                                </svg>


                                @if ($task->deadline)

                                    Deadline:
                                    {{ $task->deadline->translatedFormat('d M Y') }}

                                    @if ($isOverdue)

                                        — Terlambat

                                    @endif

                                @else

                                    Deadline tidak tersedia

                                @endif

                            </div>

                        </div>


                    @empty

                        <div class="px-6 py-16 text-center">

                            <p class="font-semibold text-gray-900">
                                Tidak ada task ditemukan.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- PAGINATION --}}

                @if ($tasks->hasPages())

                    <div class="border-t border-gray-100 bg-slate-50/60 px-5 py-4 sm:px-6">

                        {{ $tasks->links() }}

                    </div>

                @endif

            </section>


            {{-- ================================================= --}}
            {{-- READ ONLY INFORMATION --}}
            {{-- ================================================= --}}

            <section class="rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-slate-50 px-5 py-5 shadow-sm sm:px-6">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="font-semibold text-indigo-950">
                            Monitoring bersifat Read-Only
                        </p>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">

                            Admin dapat melihat informasi task seluruh pengguna
                            untuk keperluan monitoring sistem, tetapi tidak dapat
                            menambah, mengubah, atau menghapus task milik pengguna.
                            Pengelolaan task tetap menjadi tanggung jawab masing-masing user.

                        </p>

                    </div>

                </div>

            </section>


        </div>

    </div>

</x-app-layout>