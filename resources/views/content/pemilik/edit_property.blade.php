@extends('layouts.app')

@section('content')
        <div class="max-w-3xl mx-auto py-6 px-4">
            <h1 class="text-2xl font-bold mb-4 text-gray-700 dark:text-gray-300">Edit Properti</h1>
        
            <!-- Form Update -->
            <form action="{{ route('pemilik.property.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

        <!-- Nama Properti -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Properti</label>
            <input type="text" name="nama_properti" value="{{ old('nama_properti', $property->nama_properti) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:ring-blue-500 transition duration-200"
                   required>
        </div>

        <!-- Harga dan Kamar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500 dark:text-gray-400">Rp</span>
                    <input type="number" name="harga" value="{{ old('harga', $property->harga) }}" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200"
                           required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Kamar</label>
                <input type="number" name="jumlah_kamar" value="{{ old('jumlah_kamar', $property->jumlah_kamar) }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200"
                       required>
            </div>
        </div>

        <!-- Tipe dan Sewa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe</label>
                <select name="tipe" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200">
                    @foreach (['putra','putri','campur','kontrakan','kost'] as $tipe)
                        <option value="{{ $tipe }}" {{ $property->tipe == $tipe ? 'selected' : '' }}>{{ ucfirst($tipe) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Sewa</label>
                <select name="sewa_jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200">
                    @foreach (['bulanan','tahunan'] as $jenis)
                        <option value="{{ $jenis }}" {{ $property->sewa_jenis == $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="kelurahan" value="{{ old('kelurahan', $property->alamatProperty->kelurahan) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200" 
                       placeholder="Kelurahan">
                <input type="text" name="jalan" value="{{ old('jalan', $property->alamatProperty->jalan) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200" 
                       placeholder="Jalan">
                <input type="text" name="rt" value="{{ old('rt', $property->alamatProperty->rt) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200" 
                       placeholder="RT">
                <input type="text" name="rw" value="{{ old('rw', $property->alamatProperty->rw) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200" 
                       placeholder="RW">
            </div>
        </div>

        <!-- Virtual Tour -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link Virtual Tour (Opsional)</label>
            <input type="url" name="link_VT" value="{{ old('link_VT', $property->fotos->first()?->link_VT) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 transition duration-200" 
                   placeholder="https://example.com/virtual-tour">
        </div>

        <!-- Fasilitas -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fasilitas</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($allFasilitas as $fasilitas)
                    <label class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                        <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas->id }}"
                               class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:accent-blue-500"
                               {{ $property->fasilitas->contains($fasilitas->id) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $fasilitas->nama_fasilitas }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Upload Foto Baru -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload Foto Baru (maks 2MB)</label>
            <div class="relative group border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-blue-500 dark:hover:border-blue-500 transition duration-200"
                id="file-upload-container">
                <input type="file" name="fotos[]" multiple accept="image/*" 
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    id="file-input"
                    onchange="updateFileList(this)">
                <div class="pointer-events-none" id="upload-placeholder">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-medium text-blue-600 dark:text-blue-400">Upload foto</span> atau drag & drop
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG maks. 2MB per file</p>
                </div>
                <div id="file-list" class="mt-4 text-left hidden"></div>
            </div>
        </div>

        <script>
            function updateFileList(input) {
                const fileList = document.getElementById('file-list');
                const placeholder = document.getElementById('upload-placeholder');
                const container = document.getElementById('file-upload-container');
                
                fileList.innerHTML = '';
                placeholder.classList.add('hidden');
                fileList.classList.remove('hidden');
                container.classList.remove('border-dashed');
            
                if (input.files.length > 0) {
                    const files = Array.from(input.files);
                    const list = document.createElement('div');
                    
                    files.forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded-lg mb-2';
                        fileItem.innerHTML = `
                            <span class="text-sm text-gray-700 dark:text-gray-300 truncate">${file.name}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">${(file.size/1024/1024).toFixed(2)}MB</span>
                        `;
                        list.appendChild(fileItem);
                    });
            
                    const changeButton = document.createElement('button');
                    changeButton.type = 'button';
                    changeButton.className = 'mt-4 text-sm text-blue-600 dark:text-blue-400 hover:underline';
                    changeButton.textContent = 'Ubah File';
                    changeButton.onclick = () => document.getElementById('file-input').click();
                    
                    fileList.appendChild(list);
                    fileList.appendChild(changeButton);
                } else {
                    placeholder.classList.remove('hidden');
                    fileList.classList.add('hidden');
                    container.classList.add('border-dashed');
                }
            }
            </script>

        <!-- Foto Lama -->
        @if($property->fotos->isNotEmpty())
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Lama (Centang yang ingin dihapus, lalu Simpan)</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($property->fotos as $foto)
                        <label class="relative group cursor-pointer rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                            <div class="p-1 bg-white dark:bg-gray-600 rounded-lg border border-gray-200 dark:border-gray-500">
                                <img src="{{ asset('storage/' . $foto->file_path) }}" 
                                     class="w-24 h-24 object-cover rounded-md">
                                <div class="absolute top-2 right-2 bg-white dark:bg-gray-700 rounded-full p-1 shadow">
                                    <input type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}" 
                                           class="w-5 h-5 text-red-500 border-gray-300 rounded focus:ring-red-500 dark:bg-gray-600 dark:border-gray-500">
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
    <!-- Form Delete - DI LUAR FORM UPDATE -->
    <form action="{{ route('pemilik.property.destroy', $property->id) }}" method="POST" 
        class="mt-4"
        onsubmit="return confirm('Yakin ingin menghapus properti ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            Hapus Properti
        </button>
    </form>
</div>
@endsection