<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Daftar Task
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-5">
                <a href="{{ route('tasks.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Tambah Task
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-3">ID</th>
                            <th class="border px-4 py-3">Judul</th>
                            <th class="border px-4 py-3">Kategori</th>
                            <th class="border px-4 py-3">Prioritas</th>
                            <th class="border px-4 py-3">Status</th>
                            <th class="border px-4 py-3">Deadline</th>
                            <th class="border px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($tasks as $task)

                        <tr>

                            <td class="border px-4 py-3">
                                {{ $task->id }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $task->judul }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $task->category->nama_kategori ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $task->priority }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $task->status }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $task->deadline }}
                            </td>

                            <td class="border px-4 py-3">

                                <a href="{{ url('/tasks/'.$task->id.'/edit') }}"
                                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                      method="POST"
                                      style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded"
                                        onclick="return confirm('Yakin ingin menghapus task ini?')">

                                        🗑 Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="border px-4 py-6 text-center">
                                Belum ada task.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>