<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Notification Center
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Semua pemberitahuan mengenai tugasmu.
                </p>
            </div>

            @if ($unreadCount > 0)

                <form
                    method="POST"
                    action="{{ route('notifications.read-all') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700"
                    >
                        Tandai Semua Dibaca
                    </button>
                </form>

            @endif
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-4xl p-6 lg:p-8">


            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="mb-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-2xl"
                    >
                        🔔
                    </div>

                    <div>

                        <h1 class="text-lg font-semibold text-gray-900">
                            Notifikasi
                        </h1>

                        <p class="text-sm text-gray-500">

                            @if ($unreadCount > 0)

                                Kamu memiliki
                                <span class="font-semibold text-indigo-600">
                                    {{ $unreadCount }}
                                </span>
                                notifikasi yang belum dibaca.

                            @else

                                Semua notifikasi sudah dibaca.

                            @endif

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- NOTIFICATION LIST --}}
            {{-- ========================================================= --}}

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                @forelse ($notifications as $notification)

                    @php

                        $isUnread = is_null($notification->read_at);

                        $taskId = $notification->data['task_id'] ?? null;

                        $judul = $notification->data['judul']
                            ?? 'Notifikasi TaskFlow';

                        $message = $notification->data['message']
                            ?? 'Ada pemberitahuan baru.';

                        $deadline = $notification->data['deadline']
                            ?? null;

                    @endphp


                    <div
                        class="
                            flex gap-4 border-b border-gray-100 px-6 py-5
                            last:border-0
                            transition
                            {{ $isUnread
                                ? 'bg-indigo-50/40'
                                : 'bg-white' }}
                            hover:bg-gray-50
                        "
                    >

                        {{-- ICON --}}

                        <div class="shrink-0">

                            <div
                                class="
                                    flex h-11 w-11 items-center justify-center rounded-xl
                                    {{ $isUnread
                                        ? 'bg-indigo-100 text-indigo-600'
                                        : 'bg-gray-100 text-gray-400' }}
                                "
                            >
                                ⏰
                            </div>

                        </div>


                        {{-- CONTENT --}}

                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <div class="flex items-center gap-2">

                                        <h3
                                            class="
                                                truncate text-sm
                                                {{ $isUnread
                                                    ? 'font-semibold text-gray-900'
                                                    : 'font-medium text-gray-700' }}
                                            "
                                        >
                                            {{ $judul }}
                                        </h3>


                                        @if ($isUnread)

                                            <span
                                                class="h-2 w-2 shrink-0 rounded-full bg-indigo-600"
                                                title="Belum dibaca"
                                            ></span>

                                        @endif

                                    </div>


                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $message }}
                                    </p>


                                    @if ($deadline)

                                        <p class="mt-2 text-xs font-medium text-rose-600">

                                            Deadline:
                                            {{ \Carbon\Carbon::parse($deadline)->translatedFormat('d F Y') }}

                                        </p>

                                    @endif


                                    <p class="mt-2 text-xs text-gray-400">

                                        {{ $notification->created_at->diffForHumans() }}

                                    </p>

                                </div>


                                {{-- ACTION --}}

                                @if ($taskId)

                                    <form
                                        method="POST"
                                        action="{{ route('notifications.read', $notification->id) }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="shrink-0 whitespace-nowrap text-xs font-medium text-indigo-600 transition hover:text-indigo-800"
                                        >
                                            Lihat Tugas →
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- ================================================= --}}
                    {{-- EMPTY STATE --}}
                    {{-- ================================================= --}}

                    <div class="px-6 py-16 text-center">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-2xl"
                        >
                            🔔
                        </div>


                        <h3 class="mt-5 font-semibold text-gray-900">
                            Belum ada notifikasi
                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm text-gray-400">
                            Notifikasi mengenai deadline tugasmu akan muncul di sini.
                        </p>


                        <a
                            href="{{ route('dashboard') }}"
                            class="mt-5 inline-flex rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700"
                        >
                            Kembali ke Dashboard
                        </a>

                    </div>

                @endforelse

            </div>


            {{-- ========================================================= --}}
            {{-- BACK TO DASHBOARD --}}
            {{-- ========================================================= --}}

            @if ($notifications->count() > 0)

                <div class="mt-6 text-center">

                    <a
                        href="{{ route('dashboard') }}"
                        class="text-sm font-medium text-indigo-600 transition hover:text-indigo-800"
                    >
                        ← Kembali ke Dashboard
                    </a>

                </div>

            @endif


        </div>

    </div>

</x-app-layout>