<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-slate-50 via-gray-50 to-indigo-50/30 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">

            {{-- Header & Navigasi --}}
            <div class="mb-8 flex items-center justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600/10 text-indigo-600 flex items-center justify-center font-bold shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Task Baru</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Catat tugas baru untuk mempermudah alur kerja dan deadline Anda.</p>
                    </div>
                </div>
                <a href="{{ route('tasks.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200/80 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition shadow-sm hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-indigo-500/5 overflow-hidden">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    
                    <div class="p-6 md:p-8 space-y-6">

                        {{-- Judul Task --}}
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Judul Task <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                placeholder="Contoh: Mengerjakan laporan PKL" required
                                class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('judul') border-rose-400 @enderror">
                            @error('judul')
                                <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                Deskripsi <span class="text-xs font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                placeholder="Tuliskan detail atau catatan mengenai task ini..."
                                class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('deskripsi') border-rose-400 @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Row 1: Kategori & Status --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Kategori <span class="text-rose-500">*</span>
                                </label>
                                <select id="category_id" name="category_id" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('category_id') border-rose-400 @enderror">
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Status <span class="text-rose-500">*</span>
                                </label>
                                <select id="status" name="status" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('status') border-rose-400 @enderror">
                                    <option value="Belum" {{ old('status', 'Belum') === 'Belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="Proses" {{ old('status') === 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 2: Prioritas & Deadline --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                    </svg>
                                    Prioritas <span class="text-rose-500">*</span>
                                </label>
                                <select id="priority" name="priority" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('priority') border-rose-400 @enderror">
                                    <option value="Rendah" {{ old('priority') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="Sedang" {{ old('priority', 'Sedang') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="Tinggi" {{ old('priority') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                </select>
                                @error('priority')
                                    <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Deadline <span class="text-xs font-normal text-gray-400">(Opsional)</span>
                                </label>
                                <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}"
                                    class="w-full rounded-xl border-gray-200 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200 @error('deadline') border-rose-400 @enderror">
                                @error('deadline')
                                    <p class="text-xs text-rose-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Form Footer --}}
                    <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('tasks.index') }}" 
                           class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200/60 transition duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-semibold shadow-md shadow-indigo-500/20 hover:shadow-indigo-500/30 transition duration-200 focus:ring-4 focus:ring-indigo-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Task
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>