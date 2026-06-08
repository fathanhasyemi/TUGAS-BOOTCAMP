<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #F9FAFB;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 32px; border: 1px solid #F3F4F6;">
                
                <div style="margin-bottom: 24px; border-bottom: 1px solid #F3F4F6; padding-bottom: 16px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Informasi Produk</h3>
                    <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px; margin-bottom: 0;">Isi data katalog produk baru dengan lengkap dan unggah foto terbaik produk Anda.</p>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Product Name</label>
                            <input type="text" name="name" id="name" placeholder="E.g., Sepatu Sneakers Hitam" value="{{ old('name') }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('name') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="category_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Category</label>
                            <select name="category_id" id="category_id" required
                                    style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none; background-color: white;">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label for="price" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Price (Rp)</label>
                            <input type="number" name="price" id="price" placeholder="E.g., 150000" value="{{ old('price') }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('price') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="stock" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" placeholder="E.g., 50" value="{{ old('stock') }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('stock') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="description" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Description</label>
                        <textarea name="description" id="description" rows="5" placeholder="Tulis deskripsi lengkap produk di sini..." required
                                  style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 12px 14px; color: #111827; font-size: 0.9rem; outline: none; line-height: 1.5;">{{ old('description') }}</textarea>
                        @error('description') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 32px;">
                        <label for="image" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Product Image</label>
                        <div style="border: 2px dashed #D1D5DB; border-radius: 8px; padding: 16px; text-align: center; background-color: #F9FAFB;">
                            <input type="file" name="image" id="image" accept="image/*" required style="font-size: 0.875rem; color: #4B5563;">
                            <p style="font-size: 0.75rem; color: #9CA3AF; margin-top: 6px; margin-bottom: 0;">Format yang didukung: JPG, JPEG, PNG (Maks. 2MB)</p>
                        </div>
                        @error('image') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px;">
                        <a href="{{ route('admin.products.index') }}" style="background-color: #F3F4F6; color: #4B5563; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none; text-align: center;">
                            Cancel
                        </a>
                        <button type="submit" style="background-color: #10B981; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);">
                            SAVE PRODUCT
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>