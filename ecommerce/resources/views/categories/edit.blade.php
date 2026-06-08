<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #F9FAFB;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 28px; border: 1px solid #F3F4F6;">
                
                <div style="margin-bottom: 20px;">
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #111827; margin: 0;">Ubah Nama Kategori</h3>
                    <p style="font-size: 0.85rem; color: #6B7280; margin-top: 4px;">Perbarui data kategori #{{ $category->id }} agar tetap relevan dengan produk baru.</p>
                </div>

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 24px;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 8px;">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                               style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none; transition: border-color 0.2s;">
                        
                        @error('name')
                            <p style="color: #EF4444; font-size: 0.8rem; margin-top: 6px; font-weight: 500;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px;">
                        <a href="{{ route('admin.categories.index') }}" style="background-color: #F3F4F6; color: #4B5563; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none; text-align: center; transition: 0.2s;">
                            Cancel
                        </a>
                        <button type="submit" style="background-color: #F59E0B; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2); transition: 0.2s;">
                            UPDATE
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- @csrf: Token keamanan wajib Laravel agar form-mu aman dari serangan hacker/keamanan siber.

@method('PUT'): HTML asli bawaan browser tidak mendukung method PUT secara langsung, jadi baris pintar Laravel ini wajib disuntikkan di form edit untuk mengubah method POST menjadi perintah update di backend.

value="{{ old('name', $category->name) }}": Trik cerdas untuk otomatis menampilkan nama kategori yang mau diedit saat form dibuka. -->