<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-indigo-600">
                    TaskFlow
                </p>

                <h2 class="mt-1 text-2xl font-bold text-gray-900">
                    Daftar Task
                </h2>
            </div>

            <a
                href="{{ route('tasks.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
            >
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
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Tambah Task
            </a>
        </div>
    </x-slot>

    @php
        $tasks = $tasks ?? collect();

        $categoryStyles = [
            'Sekolah' => 'bg-indigo-50 text-indigo-700',
            'Proyek' => 'bg-violet-50 text-violet-700',
            'Pribadi' => 'bg-teal-50 text-teal-700',
        ];

        $priorityStyles = [
            'Rendah' => [
                'dot' => 'bg-emerald-500',
                'text' => 'text-emerald-700',
                'bg' => 'bg-emerald-50',
            ],
            'Sedang' => [
                'dot' => 'bg-amber-500',
                'text' => 'text-amber-700',
                'bg' => 'bg-amber-50',
            ],
            'Tinggi' => [
                'dot' => 'bg-rose-500',
                'text' => 'text-rose-700',
                'bg' => 'bg-rose-50',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-6">

            {{-- Header halaman --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 p-6 text-white shadow-sm md:p-8">
                <div class="relative z-10 flex flex-col justify-between gap-5 md:flex-row md:items-center">
                    <div>
                        <p class="text-sm font-medium text-indigo-100">
                            Kelola semua tugasmu
                        </p>

                        <h1 class="mt-2 text-3xl font-bold tracking-tight">
                            Daftar Task
                        </h1>

                        <p class="mt-2 max-w-xl text-sm text-indigo-100 md:text-base">
                            Pantau, edit, dan kelola tugas agar tidak ada deadline yang terlewat.
                        </p>
                    </div>

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-4xl backdrop-blur-sm">
                        📋
                    </div>
                </div>

                <div class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-400/20"></div>
            </div>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </div>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Ringkasan daftar --}}
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">
                        Semua Tugas
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Berikut daftar tugas yang tersimpan di TaskFlow.
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-gray-600 shadow-sm ring-1 ring-gray-100">
                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                    {{ $tasks->count() }} task
                </div>
            </div>

            {{-- Daftar task --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header tabel --}}
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Daftar Tugas
                            </h3>

                            <p class="text-xs text-gray-400">
                                Kelola tugas yang sedang berjalan
                            </p>
                        </div>
                    </div>

                    <span class="hidden rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500 sm:inline-block">
                        {{ $tasks->count() }} data
                    </span>
                </div>

                @forelse ($tasks as $task)
                    @php
                        $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';

                        $categoryClass = $categoryStyles[$categoryName]
                            ?? 'bg-gray-100 text-gray-600';

                        $priority = $priorityStyles[$task->priority] ?? [
                            'dot' => 'bg-gray-400',
                            'text' => 'text-gray-600',
                            'bg' => 'bg-gray-100',
                        ];

                        $isDone = strtolower($task->status ?? '') === 'selesai';

                        $statusClass = $isDone
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'bg-amber-50 text-amber-700';
                    @endphp

                    {{-- Tampilan desktop --}}
                    <div class="hidden border-b border-gray-50 px-6 py-5 transition last:border-0 hover:bg-gray-50/70 md:block">
                        <div class="flex items-center gap-4">

                            {{-- Nomor task --}}
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-sm font-bold text-gray-500">
                                #{{ $task->id }}
                            </div>

                            {{-- Judul dan kategori --}}
                            <div class="min-w-0 flex-1">
                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="block truncate font-semibold text-gray-900 transition hover:text-indigo-600"
                                >
                                    {{ $task->judul }}
                                </a>

                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $categoryClass }}">
                                        {{ $categoryName }}
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $priority['text'] }} {{ $priority['bg'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $priority['dot'] }}"></span>
                                        {{ $task->priority ?? 'Tanpa prioritas' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="w-28 shrink-0">
                                <p class="mb-1 text-[11px] font-medium uppercase tracking-wide text-gray-400">
                                    Status
                                </p>

                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                    {{ $task->status ?? 'Belum ditentukan' }}
                                </span>
                            </div>

                            {{-- Deadline --}}
                            <div class="w-32 shrink-0">
                                <p class="mb-1 text-[11px] font-medium uppercase tracking-wide text-gray-400">
                                    Deadline
                                </p>

                                <p class="text-sm font-medium text-gray-700">
                                    @if ($task->deadline)
                                        {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                                    @else
                                        <span class="text-gray-400">
                                            Tanpa deadline
                                        </span>
                                    @endif
                                </p>
                            </div>

                            {{-- Aksi --}}
                            <div class="flex shrink-0 items-center gap-2">
                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    title="Lihat detail"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 transition hover:bg-indigo-100"
                                >
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
                                            d="M2.25 12s3.75-6 9.75-6 9.75 6 9.75 6-3.75 6-9.75 6-9.75-6-9.75-6z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>
                                </a>

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    title="Edit task"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100"
                                >
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
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.68 1.105 1.105-3.68a4.5 4.5 0 011.13-1.897l9.622-9.622z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 7.125L16.875 4.5"
                                        />
                                    </svg>
                                </a>

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus task ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus task"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition hover:bg-rose-100"
                                    >
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
                                                d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tampilan mobile --}}
                    <div class="border-b border-gray-50 px-5 py-5 last:border-0 md:hidden">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-xs font-bold text-gray-500">
                                #{{ $task->id }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="font-semibold text-gray-900 hover:text-indigo-600"
                                >
                                    {{ $task->judul }}
                                </a>

                                <div class="mt-2 flex flex-wrap gap-2">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $categoryClass }}">
                                        {{ $categoryName }}
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $priority['text'] }} {{ $priority['bg'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $priority['dot'] }}"></span>
                                        {{ $task->priority ?? 'Tanpa prioritas' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3 rounded-xl bg-gray-50 p-3">
                            <div>
                                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                                    Status
                                </p>

                                <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                    {{ $task->status ?? 'Belum ditentukan' }}
                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                                    Deadline
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-700">
                                    @if ($task->deadline)
                                        {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                                    @else
                                        Tanpa deadline
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <a
                                href="{{ route('tasks.show', $task) }}"
                                class="flex-1 rounded-lg bg-indigo-50 px-3 py-2 text-center text-xs font-semibold text-indigo-600 transition hover:bg-indigo-100"
                            >
                                Lihat Detail
                            </a>

                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-600 transition hover:bg-amber-100"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('tasks.destroy', $task) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus task ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rounded-lg bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-100"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    {{-- Tampilan ketika belum ada task --}}
                    <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">
                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-5 font-semibold text-gray-900">
                            Belum ada task
                        </h3>

                        <p class="mt-1 max-w-sm text-sm text-gray-400">
                            Yuk tambahkan task pertamamu agar semua kegiatan bisa lebih teratur.
                        </p>

                        <a
                            href="{{ route('tasks.create') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah Task Pertama
                        </a>
                    </div>
                @endforelse

            </div>

            {{-- Informasi bawah --}}
            <div class="rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 text-indigo-600">
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
                        <p class="text-sm font-medium text-indigo-900">
                            Tips mengelola task
                        </p>

                        <p class="mt-1 text-sm text-indigo-700">
                            Gunakan prioritas dan deadline agar tugas lebih mudah dipantau.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>