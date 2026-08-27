<x-app-layout>
<x-slot name="header">
    <div></div>
</x-slot>

@php
    $totalTasks = $totalTasks ?? 0;
    $completedTasks = $completedTasks ?? 0;
    $dueSoonCount = $dueSoonCount ?? 0;
    $overdueCount = $overdueCount ?? 0;

    $tasks = $tasks ?? collect();
    $priorityTasks = $priorityTasks ?? collect();

    $categories = $categories ?? collect();

    $notifications = $notifications ?? collect();
    $unreadNotificationsCount = $unreadNotificationsCount ?? 0;

    $search = $search ?? '';
    $sort = $sort ?? 'latest';
    $category = $category ?? 'all';
@endphp

{{-- ========================================================= --}}
{{-- CUSTOM ANIMATIONS --}}
{{-- ========================================================= --}}
<style>
    @keyframes wave {
        0% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-8deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
        60%, 100% { transform: rotate(0deg); }
    }
    .animate-wave {
        animation: wave 2.5s infinite;
        transform-origin: 70% 70%;
    }
</style>

{{-- ========================================================= --}}
{{-- LAYOUT --}}
{{-- ========================================================= --}}
<div class="min-h-screen bg-slate-50" x-data="{ mobileMenuOpen: false }">

    {{-- ================================================= --}}
    {{-- MOBILE MENU (SLIDE-OVER) --}}
    {{-- ================================================= --}}
    <div x-show="mobileMenuOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true" style="display: none;">
        
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

        <div class="fixed inset-0 flex">
            <div x-show="mobileMenuOpen"
                 @click.outside="mobileMenuOpen = false"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative mr-16 flex w-full max-w-xs flex-1 flex-col bg-white shadow-xl">
                 
                 <div class="absolute right-0 top-0 -mr-12 pt-4">
                     <button @click="mobileMenuOpen = false" type="button" class="ml-1 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 hover:bg-white/20 focus:outline-none">
                         <span class="sr-only">Tutup menu</span>
                         <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>

                 <div class="flex h-20 shrink-0 items-center border-b border-gray-100 px-6">
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>
                        <p class="text-xs text-slate-400">Kelola Tugas Sekolah Tanpa Ribet!</p>
                    </div>
                 </div>

                 <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4"/>
                        </svg>
                        Daftar Tugas
                    </a>
                    <a href="{{ route('tasks.create') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Tambah Tugas
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                        Kategori
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
                        </svg>
                        Profil
                    </a>
                 </nav>

                 <div class="border-t border-gray-100 p-4">
                    <div class="mb-3 flex items-center gap-3 px-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600">
                            Keluar
                        </button>
                    </form>
                 </div>
            </div>
        </div>
    </div>

    <div class="flex w-full">
        {{-- ================================================= --}}
        {{-- SIDEBAR DESKTOP --}}
        {{-- ================================================= --}}
        <aside class="hidden w-64 shrink-0 p-6 lg:block lg:p-8">
            <div class="sticky top-6 flex h-[calc(100vh-3rem)] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                
                <div class="flex h-20 items-center border-b border-gray-100 px-6">
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>
                        <p class="text-xs text-slate-400">Kelola Tugas Sekolah Tanpa Ribet!</p>
                    </div>
                </div>

                <nav class="flex-1 space-y-1 px-4 py-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4"/></svg>
                        Daftar Tugas
                    </a>
                    <a href="{{ route('tasks.create') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tambah Tugas
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                        Kategori
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/></svg>
                        Profil
                    </a>
                </nav>

                <div class="border-t border-gray-100 p-4">
                    <div class="mb-3 flex items-center gap-3 px-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ================================================= --}}
        {{-- CONTENT --}}
        {{-- ================================================= --}}
        <main class="min-w-0 flex-1">
            <div class="p-6 lg:p-8">

                {{-- ================================================= --}}
                {{-- TOP BAR --}}
                {{-- ================================================= --}}
                <div class="mb-6 flex items-center justify-between lg:justify-end">
                    <div class="flex items-center gap-3 lg:hidden">
                        <button type="button" @click="mobileMenuOpen = true" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600">
                            <span class="sr-only">Buka menu utama</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>
                    </div>

                    <div x-data="notificationCentre()" x-init="init()" class="relative">
                        <button type="button" @click="open = !open" @click.outside="open = false" class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600" aria-label="Notifikasi">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 00-12 0v.75c0 2.114-.748 4.057-1.993 5.572a23.85 23.85 0 005.454 1.31m5.396 0a24.255 24.255 0 01-5.396 0m5.396 0a3 3 0 11-5.396 0"/>
                            </svg>
                            <template x-if="unreadCount > 0">
                                <span class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white ring-2 ring-white" x-text="unreadCount > 99 ? '99+' : unreadCount"></span>
                            </template>
                        </button>

                        <div x-show="open" x-transition style="display: none;" class="absolute right-0 z-50 mt-3 w-80 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl sm:w-96">
                            <div class="flex items-center justify-between border-b border-gray-100 bg-gray-50 px-5 py-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                    <p class="text-xs text-gray-400">Pengingat tugas terbaru</p>
                                </div>
                                <template x-if="unreadCount > 0">
                                    <span class="rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-600" x-text="unreadCount + ' belum dibaca'"></span>
                                </template>
                            </div>

                            <div class="max-h-96 overflow-y-auto">
                                <template x-for="notification in notifications" :key="notification.id">
                                    <a :href="notification.task_id ? '{{ url('/tasks') }}/' + notification.task_id : '{{ route('notifications.index') }}'" @click="markAsRead(notification)" class="flex gap-3 border-b border-gray-50 px-5 py-4 transition last:border-0" :class="notification.read_at ? 'bg-white hover:bg-gray-50' : 'bg-indigo-50/50 hover:bg-indigo-50'">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl" :class="notification.read_at ? 'bg-gray-100 text-gray-400' : 'bg-rose-100 text-rose-600'">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.5 13A1.5 1.5 0 004.09 19h15.82a1.5 1.5 0 001.3-2.25l-7.5-13a1.5 1.5 0 00-2.6 0z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="line-clamp-2 text-sm" :class="notification.read_at ? 'font-medium text-gray-600' : 'font-semibold text-gray-900'" x-text="notification.message || 'Ada notifikasi baru.'"></p>
                                            <template x-if="notification.deadline">
                                                <p class="mt-1 text-xs text-gray-400" x-text="'Deadline: ' + formatDeadline(notification.deadline)"></p>
                                            </template>
                                            <p class="mt-1 text-[11px] text-gray-400" x-text="formatTime(notification.created_at)"></p>
                                        </div>
                                        <template x-if="!notification.read_at">
                                            <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-indigo-600"></span>
                                        </template>
                                    </a>
                                </template>

                                <template x-if="notifications.length === 0">
                                    <div class="px-5 py-10 text-center">
                                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 00-12 0v.75c0 2.114-.748 4.057-1.993 5.572a23.85 23.85 0 005.454 1.31m5.396 0a24.255 24.255 0 01-5.396 0m5.396 0a3 3 0 11-5.396 0"/>
                                            </svg>
                                        </div>
                                        <p class="mt-3 text-sm font-medium text-gray-700">Tidak ada notifikasi</p>
                                        <p class="mt-1 text-xs text-gray-400">Semua pengingat akan muncul di sini.</p>
                                    </div>
                                </template>
                            </div>
                            <div class="border-t border-gray-100 bg-gray-50 p-3">
                                <a href="{{ route('notifications.index') }}" class="flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100 hover:text-indigo-700">
                                    Lihat semua notifikasi →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SCRIPT POLLING NOTIFICATION --}}
                <script>
                    function notificationCentre() {
                        return {
                            open: false,
                            notifications: [],
                            unreadCount: 0,
                            pollingInterval: null,

                            init() {
                                this.fetchNotifications();
                                this.pollingInterval = setInterval(() => {
                                    this.fetchNotifications();
                                }, 10000);
                            },

                            async fetchNotifications() {
                                try {
                                    const response = await fetch('{{ route('notifications.latest') }}', {
                                        method: 'GET',
                                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                                        credentials: 'same-origin',
                                    });
                                    if (!response.ok) throw new Error('Gagal mengambil notification.');
                                    const data = await response.json();
                                    this.notifications = data.notifications ?? [];
                                    this.unreadCount = data.unread_count ?? 0;
                                } catch (error) {
                                    console.error('Notification polling error:', error);
                                }
                            },

                            async markAsRead(notification) {
                                if (notification.read_at) return;
                                try {
                                    const response = await fetch('{{ url('/notifications') }}/' + notification.id + '/read-ajax', {
                                        method: 'POST',
                                        headers: {
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        },
                                        credentials: 'same-origin',
                                    });
                                    if (!response.ok) throw new Error('Gagal menandai notification.');
                                    const data = await response.json();
                                    notification.read_at = new Date().toISOString();
                                    this.unreadCount = data.unread_count ?? 0;
                                } catch (error) {
                                    console.error('Mark notification as read error:', error);
                                }
                            },

                            formatDeadline(deadline) {
                                if (!deadline) return '';
                                return new Date(deadline).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
                            },

                            formatTime(dateString) {
                                if (!dateString) return '';
                                const date = new Date(dateString);
                                const diff = Math.floor((new Date() - date) / 1000);

                                if (diff < 60) return 'Baru saja';
                                if (diff < 3600) return Math.floor(diff / 60) + ' menit yang lalu';
                                if (diff < 86400) return Math.floor(diff / 3600) + ' jam yang lalu';
                                if (diff < 604800) return Math.floor(diff / 86400) + ' hari yang lalu';
                                
                                return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                            },

                            destroy() {
                                if (this.pollingInterval) clearInterval(this.pollingInterval);
                            },
                        };
                    }
                </script>

                {{-- ================================================= --}}
                {{-- WELCOME BANNER (NEW) --}}
                {{-- ================================================= --}}
                <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 shadow-2xl shadow-indigo-900/20 md:p-10">
                    <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-indigo-500/40 blur-[80px] transition-opacity duration-500 hover:opacity-70"></div>
                    <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-violet-600/30 blur-[80px]"></div>
                    
                    <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">
                        <div>
                            <p class="text-xs font-bold tracking-widest text-indigo-400 uppercase">Welcome Back</p>
                            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white md:text-4xl">
                                Halo, {{ Auth::user()->name }}! <span class="wave-emoji inline-block animate-wave">👋</span>
                            </h1>
                            <p class="mt-4 max-w-xl text-sm leading-relaxed text-slate-400 md:text-base">
                                Siap untuk menyelesaikan tugas hari ini? Kelola proyek dan aktivitas pribadimu dengan lebih teratur.
                            </p>
                        </div>
                        <div class="hidden shrink-0 md:block">
                            <a href="{{ route('tasks.create') }}" class="group relative inline-flex items-center gap-2 rounded-2xl bg-indigo-500 px-6 py-3.5 text-sm font-semibold text-white transition-all hover:bg-indigo-400 hover:shadow-[0_0_30px_rgba(99,102,241,0.5)] hover:-translate-y-0.5">
                                <svg class="h-5 w-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Tambah Task
                            </a>
                        </div>
                    </div>
                </div>

              {{-- ========================================================= --}}
{{-- DEADLINE ALERT --}}
{{-- ========================================================= --}}

{{-- OVERDUE ALERT --}}
@if ($overdueCount > 0)
    <div class="mt-6 overflow-hidden rounded-[2rem] border border-red-200 bg-white shadow-sm">

        {{-- HEADER ALERT --}}
        <div class="flex items-center gap-3 border-b border-red-200 bg-red-50 px-6 py-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-xl">
                🚨
            </div>

            <div>
                <p class="font-bold text-red-900">
                    @if ($overdueCount == 1)
                        Ada 1 tugas melewati deadline!
                    @else
                        Ada {{ $overdueCount }} tugas melewati deadline!
                    @endif
                </p>

                <p class="mt-0.5 text-sm font-medium text-red-600">
                    Segera selesaikan tugas yang sudah melewati batas waktu.
                </p>
            </div>
        </div>

        {{-- DAFTAR TUGAS OVERDUE --}}
        <div>
            @foreach ($overdueTasks as $task)
                @php
                    $deadline = \Carbon\Carbon::parse($task->deadline);
                    $daysOverdue = $deadline->startOfDay()->diffInDays(now()->startOfDay());
                    $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';
                @endphp

                <div class="flex items-center gap-4 border-b border-red-50 px-6 py-4 transition-colors last:border-0 hover:bg-red-50/50">

                    {{-- ICON --}}
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        !
                    </div>

                    {{-- TASK INFO --}}
                    <div class="min-w-0 flex-1">
                        <a href="{{ route('tasks.show', $task) }}"
                           class="block truncate font-semibold text-gray-900 transition-colors hover:text-red-600">
                            {{ $task->judul }}
                        </a>

                        <div class="mt-1 flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-bold text-slate-500">
                                {{ strtoupper($categoryName) }}
                            </span>

                            <span class="text-xs font-medium text-red-500">
                                Deadline: {{ $deadline->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- STATUS OVERDUE --}}
                    <div class="hidden shrink-0 sm:block">
                        @if ($daysOverdue == 1)
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                Terlambat 1 hari
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                Terlambat {{ $daysOverdue }} hari
                            </span>
                        @endif
                    </div>

                    {{-- DETAIL BUTTON --}}
                    <a href="{{ route('tasks.show', $task) }}"
                       class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-500 transition-all hover:bg-red-100 hover:text-red-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>

                </div>
            @endforeach
        </div>

    </div>
@endif

{{-- DEADLINE MENDATANG --}}
@if ($dueSoonCount > 0)
    <div class="mt-6 flex items-center gap-3 rounded-[2rem] border border-rose-100 bg-rose-50 px-6 py-5 text-rose-700">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-xl">
            ⚠️
        </div>

        <div>
            <p class="font-bold text-rose-900">
                Ada tugas yang mendekati deadline!
            </p>

            <p class="mt-0.5 text-sm font-medium text-rose-600">
                {{ $dueSoonCount }} tugas memiliki deadline dalam 7 hari ke depan.
            </p>
        </div>
    </div>
@elseif ($overdueCount == 0)
    <div class="mt-6 flex items-center gap-3 rounded-[2rem] border border-emerald-100 bg-emerald-50 px-6 py-5 text-emerald-600">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-xl">
            ✓
        </div>

        <div>
            <p class="font-bold text-emerald-900">
                Semua aman terkendali
            </p>

            <p class="mt-0.5 text-sm font-medium text-emerald-700">
                Tidak ada deadline yang mendesak dalam 7 hari ke depan.
            </p>
        </div>
    </div>
@endif

                {{-- ================================================= --}}
                {{-- STATISTICS (NEW BENTO BOX) --}}
                {{-- ================================================= --}}
                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white/60 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5 hover:border-indigo-300 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                        <div class="absolute -right-6 -top-6 h-32 w-32 rounded-full bg-indigo-50 transition-transform duration-700 group-hover:scale-150"></div>
                        <div class="relative z-10 flex items-start justify-between">
                            <div>
                                <p class="text-sm font-semibold tracking-wide text-slate-500 transition-colors group-hover:text-indigo-600">Total Tugas</p>
                                <p class="mt-3 text-4xl font-black tracking-tight text-slate-800">{{ $totalTasks }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 transition-transform group-hover:rotate-12 group-hover:scale-110">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white/60 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5 hover:border-emerald-300 hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.1)]">
                        <div class="absolute -right-6 -top-6 h-32 w-32 rounded-full bg-emerald-50 transition-transform duration-700 group-hover:scale-150"></div>
                        <div class="relative z-10 flex items-start justify-between">
                            <div>
                                <p class="text-sm font-semibold tracking-wide text-slate-500 transition-colors group-hover:text-emerald-600">Sudah Selesai</p>
                                <p class="mt-3 text-4xl font-black tracking-tight text-slate-800">{{ $completedTasks }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 transition-transform group-hover:rotate-12 group-hover:scale-110">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white/60 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5 hover:border-rose-300 hover:shadow-[0_20px_40px_-15px_rgba(244,63,94,0.1)]">
                        <div class="absolute -right-6 -top-6 h-32 w-32 rounded-full bg-rose-50 transition-transform duration-700 group-hover:scale-150"></div>
                        <div class="relative z-10 flex items-start justify-between">
                            <div>
                                <p class="text-sm font-semibold tracking-wide text-slate-500 transition-colors group-hover:text-rose-600">Deadline H-7</p>
                                <p class="mt-3 text-4xl font-black tracking-tight text-slate-800">{{ $dueSoonCount }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-600 transition-transform group-hover:rotate-12 group-hover:scale-110">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- PRIORITY DEADLINE --}}
                {{-- ================================================= --}}
                @if ($priorityTasks->count() > 0)
                    <div class="mt-6 overflow-hidden rounded-[2rem] border border-rose-100 bg-white shadow-sm">
                        <div class="border-b border-rose-100 bg-rose-50/50 px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">⏰</div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Prioritas Deadline</h3>
                                    <p class="text-xs font-medium text-gray-500">Tugas dengan deadline maksimal 7 hari ke depan</p>
                                </div>
                            </div>
                        </div>

                        @foreach ($priorityTasks as $task)
                            @php
                                $deadline = \Carbon\Carbon::parse($task->deadline);
                                $daysLeft = now()->startOfDay()->diffInDays($deadline->startOfDay(), false);
                            @endphp

                            <div class="flex items-center gap-4 border-b border-gray-50 px-6 py-4 transition-colors hover:bg-gray-50/80 last:border-0">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('tasks.show', $task) }}" class="block truncate font-semibold text-gray-900 transition-colors hover:text-indigo-600">
                                        {{ $task->judul }}
                                    </a>
                                    <p class="mt-1 text-xs font-medium text-gray-400">Deadline: {{ $deadline->translatedFormat('d F Y') }}</p>
                                </div>

                                @if ($daysLeft == 0)
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700">Hari ini</span>
                                @elseif ($daysLeft == 1)
                                    <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">Besok</span>
                                @else
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">H-{{ $daysLeft }}</span>
                                @endif

                                <a href="{{ route('tasks.show', $task) }}" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-all hover:bg-indigo-100 hover:text-indigo-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- ================================================= --}}
                {{-- TASK LIST (NEW STYLE) --}}
                {{-- ================================================= --}}
                <div class="mt-6 overflow-hidden rounded-[2rem] border border-gray-100 bg-white shadow-sm">
                    <div class="border-b border-gray-100 px-6 py-5">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-xl text-indigo-600">📋</div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-gray-900">
                                            {{ $search || $category !== 'all' ? 'Hasil Filter' : 'Daftar Tugas' }}
                                        </h3>
                                        @if (!$search && $category === 'all')
                                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-500">{{ $totalTasks }}</span>
                                        @endif
                                    </div>
                                    <p class="text-xs font-medium text-gray-400">
                                        @if ($search && $category !== 'all')
                                            Hasil pencarian "{{ $search }}" pada kategori terpilih
                                        @elseif ($search)
                                            Hasil untuk "{{ $search }}"
                                        @elseif ($category !== 'all')
                                            Tugas berdasarkan kategori
                                        @else
                                            Kelola dan pantau tugasmu
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex w-full flex-col gap-2 lg:w-auto">
                                <div class="flex w-full flex-col gap-2 sm:flex-row">
                                    <form action="{{ route('dashboard') }}" method="GET" class="flex min-w-0 flex-1">
                                        <input type="hidden" name="sort" value="{{ $sort }}">
                                        @if ($category !== 'all') <input type="hidden" name="category" value="{{ $category }}"> @endif

                                        <div class="relative w-full">
                                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari task..." class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm font-medium outline-none transition-all focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                                            <svg class="absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                                            </svg>
                                        </div>
                                        <button type="submit" class="ml-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition-all hover:-translate-y-0.5 hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/30">Cari</button>
                                    </form>

                                    <form action="{{ route('dashboard') }}" method="GET">
                                        @if ($search) <input type="hidden" name="search" value="{{ $search }}"> @endif
                                        @if ($category !== 'all') <input type="hidden" name="category" value="{{ $category }}"> @endif
                                        <select name="sort" onchange="this.form.submit()" class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm font-medium text-slate-600 outline-none transition-all focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 sm:w-auto">
                                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>🆕 Task Terbaru</option>
                                            <option value="deadline" {{ $sort === 'deadline' ? 'selected' : '' }}>⏰ Deadline Terdekat</option>
                                        </select>
                                    </form>

                                    <form action="{{ route('dashboard') }}" method="GET">
                                        @if ($search) <input type="hidden" name="search" value="{{ $search }}"> @endif
                                        <input type="hidden" name="sort" value="{{ $sort }}">
                                        <select name="category" onchange="this.form.submit()" class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm font-medium text-slate-600 outline-none transition-all focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 sm:w-auto">
                                            <option value="all">📂 Semua Kategori</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ (string) $category === (string) $cat->id ? 'selected' : '' }}>📁 {{ $cat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </form>

                                    @if ($search || $category !== 'all')
                                        <a href="{{ route('dashboard', ['sort' => $sort]) }}" class="flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 transition-all hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200">Reset</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @forelse ($tasks as $task)
                        @php
                            $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';
                            $isDone = $task->status === 'Selesai';
                        @endphp

                        <div class="group flex items-center gap-4 border-b border-slate-100 px-6 py-4 transition-all duration-200 last:border-0 hover:border-l-4 hover:border-l-indigo-500 hover:bg-slate-50/80 hover:shadow-inner">
                            <div class="min-w-0 flex-1 pl-2">
                                <a href="{{ route('tasks.show', $task) }}" class="block truncate font-bold text-lg transition-colors {{ $isDone ? 'text-slate-400 line-through' : 'text-slate-800 group-hover:text-indigo-600' }}">
                                    {{ $task->judul }}
                                </a>
                                <div class="mt-1.5 flex items-center gap-3">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-200/50 px-2.5 py-1 text-[11px] font-bold tracking-wide text-slate-600">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                        {{ strtoupper($categoryName) }}
                                    </span>
                                    @if ($task->deadline)
                                        <span class="text-xs font-semibold text-slate-400">Tenggat: {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex shrink-0 items-center gap-4">
                                @if ($task->priority)
                                    @php
                                        $priorityClass = match ($task->priority) {
                                            'Rendah' => 'bg-emerald-100/50 text-emerald-700 border-emerald-200',
                                            'Sedang' => 'bg-amber-100/50 text-amber-700 border-amber-200',
                                            'Tinggi' => 'bg-rose-100/50 text-rose-700 border-rose-200',
                                            default => 'bg-slate-100/50 text-slate-600 border-slate-200',
                                        };
                                    @endphp
                                    <span class="hidden rounded-full border px-3 py-1 text-xs font-bold sm:inline-flex {{ $priorityClass }}">
                                        {{ strtoupper($task->priority) }}
                                    </span>
                                @endif

                                @if ($isDone)
                                    <span class="hidden rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 lg:inline-flex">SELESAI</span>
                                @endif

                                <a href="{{ route('tasks.show', $task) }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 opacity-0 transition-all duration-300 hover:bg-indigo-100 hover:text-indigo-700 group-hover:-translate-x-1 group-hover:opacity-100">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    @empty
                        <div class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-[2rem] bg-slate-50 text-2xl text-slate-400 border border-slate-100">🔎</div>
                            <p class="mt-4 font-bold text-slate-800">
                                @if ($search || $category !== 'all') Task tidak ditemukan @else Belum ada tugas @endif
                            </p>
                            <p class="mt-1 text-sm font-medium text-slate-400">
                                @if ($search && $category !== 'all')
                                    Tidak ada task yang cocok dengan "{{ $search }}" pada kategori tersebut.
                                @elseif ($search)
                                    Tidak ada task yang cocok dengan "{{ $search }}".
                                @elseif ($category !== 'all')
                                    Tidak ada task pada kategori tersebut.
                                @else
                                    Yuk tambahkan tugas pertamamu sekarang!
                                @endif
                            </p>

                            @if ($search || $category !== 'all')
                                <a href="{{ route('dashboard', ['sort' => $sort]) }}" class="mt-5 inline-flex rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition-all hover:-translate-y-0.5 hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/30">Reset Filter</a>
                            @else
                                <a href="{{ route('tasks.create') }}" class="mt-5 inline-flex rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition-all hover:-translate-y-0.5 hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/30">+ Tambah Tugas Baru</a>
                            @endif
                        </div>
                    @endforelse

                    @if (!$search && $category === 'all' && $totalTasks > 5)
                        <div class="border-t border-slate-100 bg-slate-50/50 px-6 py-4 text-center">
                            <a href="{{ route('tasks.index') }}" class="text-sm font-bold text-indigo-600 transition-colors hover:text-indigo-800">Lihat semua {{ $totalTasks }} tugas →</a>
                        </div>
                    @endif
                </div>

                {{-- ================================================= --}}
                {{-- TIPS --}}
                {{-- ================================================= --}}
                <div class="mt-6 flex gap-4 rounded-[2rem] border border-indigo-100/50 bg-indigo-50/50 px-6 py-5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">💡</div>
                    <div>
                        <p class="font-bold text-indigo-900">Tips Mengelola Tugas</p>
                        <p class="mt-0.5 text-sm font-medium text-indigo-700">Gunakan label prioritas, kategori, dan deadline untuk menentukan tugas mana yang harus dikerjakan terlebih dahulu agar waktumu lebih efisien.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
</x-app-layout>