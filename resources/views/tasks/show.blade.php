<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a
                href="{{ route('dashboard') }}"
                class="text-gray-400 hover:text-indigo-600 transition"
            >
                ←
            </a>

            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Detail Tugas
            </h2>
        </div>
    </x-slot>

    @php
        $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';

        $categoryStyles = [
            'Sekolah' => [
                'bar' => 'bg-indigo-500',
                'badge' => 'bg-indigo-50 text-indigo-700',
            ],
            'Proyek' => [
                'bar' => 'bg-violet-500',
                'badge' => 'bg-violet-50 text-violet-700',
            ],
            'Pribadi' => [
                'bar' => 'bg-teal-500',
                'badge' => 'bg-teal-50 text-teal-700',
            ],
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

        $category = $categoryStyles[$categoryName] ?? [
            'bar' => 'bg-gray-300',
            'badge' => 'bg-gray-50 text-gray-600',
        ];

        $priority = $priorityStyles[$task->priority] ?? null;
        $isDone = $task->status === 'Selesai';
    @endphp

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                {{-- Warna kategori --}}
                <div class="h-2 {{ $category['bar'] }}"></div>

                <div class="p-6 md:p-8">

                    {{-- Header detail --}}
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5">

                        <div>
                            <span class="inline-block {{ $category['badge'] }} text-xs font-medium rounded-full px-3 py-1 mb-3">
                                {{ $categoryName }}
                            </span>

                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $task->judul }}
                            </h1>

                            @if ($isDone)
                                <span class="inline-flex items-center mt-3 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-full px-3 py-1">
                                    Tugas selesai
                                </span>
                            @else
                                <span class="inline-flex items-center mt-3 text-sm font-medium text-amber-700 bg-amber-50 rounded-full px-3 py-1">
                                    Belum selesai
                                </span>
                            @endif
                        </div>

                        {{-- Tombol aksi --}}
                        <div class="flex items-center gap-2 shrink-0">
                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="inline-flex items-center rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 transition"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Hapus tugas ini?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 text-sm font-medium px-4 py-2 transition"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Informasi tugas --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

                        {{-- Prioritas --}}
                        <div class="rounded-xl bg-gray-50 p-4">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Prioritas
                            </p>

                            @if ($priority)
                                <div class="inline-flex items-center gap-2 mt-2 text-sm font-semibold {{ $priority['text'] }}">
                                    <span class="w-2 h-2 rounded-full {{ $priority['dot'] }}"></span>
                                    {{ ucfirst(strtolower($task->priority)) }}
                                </div>
                            @else
                                <p class="mt-2 text-sm font-semibold text-gray-700">
                                    Tidak ada
                                </p>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="rounded-xl bg-gray-50 p-4">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Status
                            </p>

                            <p class="mt-2 text-sm font-semibold text-gray-700">
                                {{ $task->status ?? 'Belum ditentukan' }}
                            </p>
                        </div>

                        {{-- Deadline --}}
                        <div class="rounded-xl bg-gray-50 p-4">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Deadline
                            </p>

                            <p class="mt-2 text-sm font-semibold text-gray-700">
                                @if ($task->deadline)
                                    {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
                                @else
                                    Tanpa deadline
                                @endif
                            </p>
                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-8 border-t border-gray-100 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Deskripsi Tugas
                        </h2>

                        @if (!empty($task->deskripsi))
                            <div class="mt-3 text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $task->deskripsi }}
                            </div>
                        @else
                            <p class="mt-3 text-gray-400">
                                Belum ada deskripsi untuk tugas ini.
                            </p>
                        @endif
                    </div>

                    {{-- Waktu dibuat dan diperbarui --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8 border-t border-gray-100 pt-6">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Dibuat pada
                            </p>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ $task->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Terakhir diperbarui
                            </p>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ $task->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Kembali --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition"
                        >
                            ← Kembali ke dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>