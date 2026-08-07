<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard TaskFlow
        </h2>
    </x-slot>


    @php
        $totalTasks     = $totalTasks ?? 0;
        $completedTasks = $completedTasks ?? 0;
        $dueSoonCount   = $dueSoonCount ?? 0;
        $tasks          = $tasks ?? collect();

        
        $categoryStyles = [
            'Sekolah' => ['bar' => 'bg-indigo-500', 'badge' => 'bg-indigo-50 text-indigo-700'],
            'UKK'     => ['bar' => 'bg-violet-500', 'badge' => 'bg-violet-50 text-violet-700'],
            'Pribadi' => ['bar' => 'bg-teal-500',   'badge' => 'bg-teal-50 text-teal-700'],
        ];

        $priorityStyles = [
            'LOW'    => ['dot' => 'bg-emerald-500', 'text' => 'text-emerald-700', 'bg' => 'bg-emerald-50'],
            'MEDIUM' => ['dot' => 'bg-amber-500',   'text' => 'text-amber-700',   'bg' => 'bg-amber-50'],
            'HIGH'   => ['dot' => 'bg-rose-500',    'text' => 'text-rose-700',    'bg' => 'bg-rose-50'],
        ];
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 space-y-6">

            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Halo, {{ Auth::user()->name }} 👋
                    </h2>
                    <p class="text-gray-500 mt-1">
                        @if ($dueSoonCount > 0)
                            Kamu punya <span class="font-semibold text-rose-600">{{ $dueSoonCount }} tugas</span> yang mendekati deadline hari ini.
                        @else
                            Semua tugas aman, nggak ada deadline mendesak hari ini.
                        @endif
                    </p>
                </div>
                @if ($dueSoonCount > 0)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 text-rose-600 text-sm font-medium px-3 py-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Perlu perhatian
                    </span>
                @endif
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Tugas</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalTasks }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Sudah Selesai</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $completedTasks }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Deadline H-1</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $dueSoonCount }}</p>
                    </div>
                </div>

            </div>

            {{-- Daftar Task --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="flex justify-between items-center px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <h3 class="text-xs font-semibold tracking-wide text-gray-400 uppercase">
                            Daftar Tugas Aktif
                        </h3>
                        <span class="text-xs font-medium bg-gray-100 text-gray-500 rounded-full px-2 py-0.5">
                            {{ $tasks->count() }}
                        </span>
                    </div>

                    <a href="{{ route('tasks.create') }}"
                       class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tambah Tugas Baru
                    </a>
                </div>

                @forelse ($tasks as $task)
                    @php
                        $cat    = $categoryStyles[$task->category] ?? ['bar' => 'bg-gray-300', 'badge' => 'bg-gray-50 text-gray-600'];
                        $prio   = $priorityStyles[$task->priority] ?? null;
                        $isDone = $task->status === 'selesai';
                    @endphp
                    <div class="group flex items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition">

                        <span class="w-1.5 self-stretch rounded-full {{ $cat['bar'] }}"></span>

                        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-5 h-5 rounded-md border-2 flex items-center justify-center transition
                                       {{ $isDone ? 'bg-emerald-500 border-emerald-500' : 'border-gray-300 hover:border-indigo-400' }}">
                                @if ($isDone)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                @endif
                            </button>
                        </form>

                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 {{ $isDone ? 'line-through text-gray-400' : '' }}">
                                {{ $task->title }}
                            </p>
                            <span class="inline-block mt-1 text-xs font-medium {{ $cat['badge'] }} rounded-full px-2 py-0.5">
                                {{ $task->category }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            @if ($prio)
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium {{ $prio['text'] }} {{ $prio['bg'] }} rounded-full px-2.5 py-1">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $prio['dot'] }}"></span>
                                    {{ ucfirst(strtolower($task->priority)) }}
                                </span>
                            @endif

                            <span class="text-xs text-gray-400">
                                {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M') : 'Tanpa deadline' }}
                            </span>

                            @if ($isDone)
                                <span class="inline-flex items-center text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1">
                                    Selesai
                                </span>
                            @endif

                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Hapus tugas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="opacity-0 group-hover:opacity-100 text-gray-300 hover:text-rose-500 transition p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center text-center py-16 px-6">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-gray-900 font-medium">Belum ada tugas</p>
                        <p class="text-gray-400 text-sm mt-1">Yuk tambahkan tugas pertamamu supaya nggak kelewat deadline.</p>
                        <a href="{{ route('tasks.create') }}"
                           class="inline-flex items-center gap-1.5 mt-4 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            + Tambah Tugas Baru
                        </a>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>