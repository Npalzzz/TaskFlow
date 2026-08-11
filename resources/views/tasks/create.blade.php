<x-app-layout>
    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">

            {{-- Header & Navigasi --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Task Baru</h1>
                    <p class="text-sm text-gray-500 mt-1">Catat tugas baru untuk mempermudah alur kerja dan deadline Anda.</p>
                </div>
                <a href="{{ route('tasks.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition shadow-sm">
                    ← Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    
                    <div class="p-6 md:p-8 space-y-6">

                        {{-- Judul Task --}}
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Task <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                placeholder="Contoh: Mengerjakan laporan PKL" required
                                class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('judul') border-rose-400 @enderror">
                            @error('judul')
                                <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi <span class="text-xs font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                placeholder="Tuliskan detail atau catatan mengenai task ini..."
                                class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('deskripsi') border-rose-400 @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                       
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori <span class="text-rose-500">*</span>
                                </label>
                                <select id="category_id" name="category_id" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('category_id') border-rose-400 @enderror">
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status <span class="text-rose-500">*</span>
                                </label>
                                <select id="status" name="status" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('status') border-rose-400 @enderror">
                                    <option value="Belum" {{ old('status', 'Belum') === 'Belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="Proses" {{ old('status') === 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 2: Prioritas & Deadline --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Prioritas <span class="text-rose-500">*</span>
                                </label>
                                <select id="priority" name="priority" required
                                    class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('priority') border-rose-400 @enderror">
                                    <option value="Rendah" {{ old('priority') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="Sedang" {{ old('priority', 'Sedang') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="Tinggi" {{ old('priority') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                </select>
                                @error('priority')
                                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Deadline <span class="text-xs font-normal text-gray-400">(Opsional)</span>
                                </label>
                                <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}"
                                    class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('deadline') border-rose-400 @enderror">
                                @error('deadline')
                                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Form Footer --}}
                    <div class="px-6 py-4 bg-gray-50/80 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('tasks.index') }}" 
                           class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200/60 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium shadow-sm transition focus:ring-2 focus:ring-indigo-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5L9.5 17 19 7.5"/>
                            </svg>
                            Simpan Task
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>