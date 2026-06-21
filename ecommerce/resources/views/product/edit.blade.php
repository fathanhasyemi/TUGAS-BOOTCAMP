<x-app-layout>
    <div class="py-12" style="background-color: #F9FAFB;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 32px; border: 1px solid #F3F4F6;">
                
                <div style="margin-bottom: 24px; border-bottom: 1px solid #F3F4F6; padding-bottom: 16px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Edit Product</h3>
                    <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px; margin-bottom: 0;">Perbarui rincian informasi data produk Anda.</p>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('name') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="category_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Category</label>
                            <select name="category_id" id="category_id" required
                                    style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none; background-color: white;">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('price') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="stock" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                                   style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 14px; color: #111827; font-size: 0.9rem; outline: none;">
                            @error('stock') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="description" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 6px;">Description</label>
                        <textarea name="description" id="description" rows="5" required
                                  style="width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 12px 14px; color: #111827; font-size: 0.9rem; outline: none; line-height: 1.5;">{{ old('description', $product->description) }}</textarea>
                        @error('description') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 32px;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 8px;">Product Image</label>
                        <div style="display: flex; gap: 20px; align-items: center; border: 1px solid #E5E7EB; border-radius: 8px; padding: 16px; background-color: #F9FAFB;">
                            <div>
                                <p style="font-size: 0.75rem; color: #6B7280; margin-bottom: 6px; font-weight: 600;">Current Image:</p>
                                
                                @if($product->image && str_contains($product->image, 'uploads/'))
                                    <img src="{{ asset($product->image) }}" alt="Current" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #D1D5DB;">
                                @elseif($product->image)
                                    <img src="{{ asset('images/' . $product->image) }}" alt="Current" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #D1D5DB;">
                                @else
                                    <div style="width: 80px; height: 80px; background-color: #E5E7EB; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #6B7280;">No Pic</div>
                                @endif
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: #6B7280; margin-bottom: 6px; font-weight: 600;">Upload New Image (Optional):</p>
                                <input type="file" name="image" id="image" accept="image/*" style="font-size: 0.875rem; color: #4B5563;">
                            </div>
                        </div>
                        @error('image') <p style="color: #EF4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px;">
                        <a href="{{ route('products.index') }}" style="background-color: #F3F4F6; color: #4B5563; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
                            Cancel
                        </a>
                        <button type="submit" style="background-color: #F59E0B; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);">
                            UPDATE PRODUCT
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>