<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Edit Task
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

            <form action="{{ route('tasks.update', $task) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $task->judul) }}"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="w-full border rounded px-3 py-2">{{ old('deskripsi', $task->deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="w-full border rounded px-3 py-2">

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ $task->category_id == $category->id ? 'selected' : '' }}>

                                {{ $category->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Deadline
                    </label>

                    <input
                        type="date"
                        name="deadline"
                        value="{{ old('deadline', $task->deadline) }}"
                        class="w-full border rounded px-3 py-2">

                </div>

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Prioritas
                    </label>

                    <select
                        name="priority"
                        class="w-full border rounded px-3 py-2">

                        <option value="Rendah" {{ $task->priority == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ $task->priority == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ $task->priority == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>

                    </select>

                </div>

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded px-3 py-2">

                        <option value="Belum" {{ $task->status == 'Belum' ? 'selected' : '' }}>Belum</option>
                        <option value="Proses" {{ $task->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ $task->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>

                    </select>

                </div>

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded">

                    Simpan Perubahan

                </button>

            </form>

        </div>

    </div>

</x-app-layout>