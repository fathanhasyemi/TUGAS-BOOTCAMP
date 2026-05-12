
// document.title ='fathan haha'
// const body = document.body
// const btn1 = document.getElementById('btn1')
// const btn2 = document.getElementById('btn2')

// const defaultText = 'KLIK SAYA'
// btn1.textContent = defaultText
// btn2.textContent= defaultText

// btn1.style.border = 'none'

// function kliktombol() {
//     btn1.style.background = 'aqua'
//     const newText = document.createElement ('p')
//     newText.textContent = 'nah tepicik'
//     body.append(newText)
// }

// function gantiText() {
//     btn1.textContent = 'fafafa'
// }

// function gantiApa() {
//     btn1.textContent = defaultText
// }

// function satu() {
//     btn2.style.border = 'none'
//     const tekshanyar = document.createElement('h1')
//     tekshanyar.id = 'tekshanyar'
//     tekshanyar.textContent = 'mantaapp'
//     body.append (tekshanyar)

// }

// function dua(){
//     btn2.textContent = 'beubah'
// }

// function tiga() {
//     btn2.textContent = defaultText
//     const tekshanyar = document.gogetElementById ('tekshanyar')
//     if (tekshanyar) {
//         tekshanyar.style.color = 'red'
//     }
// }

// function sapa(nama) {
//     console.log('halo '+nama)
// }

// sapa('fathan')
// sapa('fafa')

// function tambah (a, b) {
//     return a + b
// }

// alert(tambah(2, 3))



    // 1. Data Produk (20 Item)
    const products = [
        { id: 1, nama: "Laptop Pro 14", harga: 15000000, kategori: "Elektronik", deskripsi: "Laptop kencang untuk desain.", gambar: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400" },

        { id: 2, nama: "Kaos Polos Cotton", harga: 75000, kategori: "Pakaian", deskripsi: "Bahan adem dan nyaman.", gambar: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400" },

        { id: 3, nama: "Jam Tangan Digital", harga: 350000, kategori: "Aksesoris", deskripsi: "Tahan air hingga 50m.", gambar: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400" },

        { id: 4, nama: "Blender Turbo", harga: 450000, kategori: "Rumah Tangga", deskripsi: "Menghaluskan bumbu dalam sekejap.", gambar: "https://images.unsplash.com/photo-1585238342024-78d387f4a707?w=400" },

        { id: 5, nama: "Smartphone 5G", harga: 4200000, kategori: "Elektronik", deskripsi: "Layar AMOLED 120Hz.", gambar: "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400" },

        { id: 6, nama: "Jaket Denim", harga: 250000, kategori: "Pakaian", deskripsi: "Gaya klasik sepanjang masa.", gambar: "https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?w=400" },

        { id: 7, nama: "Kacamata Hitam", harga: 120000, kategori: "Aksesoris", deskripsi: "Proteksi UV maksimal.", gambar: "https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400" },

        { id: 8, nama: "Lampu Meja LED", harga: 85000, kategori: "Rumah Tangga", deskripsi: "Terang dan hemat energi.", gambar: "https://images.unsplash.com/photo-1534073828943-f801091bb18c?w=400" },

        { id: 9, nama: "Mouse Gaming RGB", harga: 300000, kategori: "Elektronik", deskripsi: "DPI tinggi untuk gaming.", gambar: "https://images.unsplash.com/photo-1527814732934-9ad92a39e9d2?w=400" },

        { id: 10, nama: "Celana Chino", harga: 180000, kategori: "Pakaian", deskripsi: "Slim fit dan elastis.", gambar: "https://images.unsplash.com/photo-1542272604-787c3835535d?w=400" },

        { id: 11, nama: "Tas Ransel Canvas", harga: 220000, kategori: "Aksesoris", deskripsi: "Kapasitas besar 20L.", gambar: "https://images.unsplash.com/photo-1553062407-98eeb94c6a62?w=400" },

        { id: 12, nama: "Panci Anti Lengket", harga: 150000, kategori: "Rumah Tangga", deskripsi: "Mudah dibersihkan.", gambar: "https://images.unsplash.com/photo-1584990344616-122ae7c52139?w=400" },

        { id: 13, nama: "Headphone Wireless", harga: 890000, kategori: "Elektronik", deskripsi: "Suara jernih Bass mantap.", gambar: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400" },
        
        { id: 14, nama: "Kemeja Flanel", harga: 135000, kategori: "Pakaian", deskripsi: "Motif kotak-kotak trendi.", gambar: "https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=400" },

        { id: 15, nama: "Topi Baseball", harga: 50000, kategori: "Aksesoris", deskripsi: "Adjustable size.", gambar: "https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=400" },

        { id: 16, nama: "Air Fryer", harga: 750000, kategori: "Rumah Tangga", deskripsi: "Masak tanpa minyak.", gambar: "https://images.unsplash.com/photo-1626075133944-49525208e67f?w=400" },

        { id: 17, nama: "Keyboard Mekanik", harga: 550000, kategori: "Elektronik", deskripsi: "Blue switch tactile feel.", gambar: "https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=400" },

        { id: 18, nama: "Sepatu Sneakers", harga: 450000, kategori: "Pakaian", deskripsi: "Nyaman untuk jalan santai.", gambar: "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400" },

        { id: 19, nama: "Dompet Kulit", harga: 110000, kategori: "Aksesoris", deskripsi: "Kulit asli tahan lama.", gambar: "https://images.unsplash.com/photo-1627123424574-724758594e93?w=400" },

        { id: 20, nama: "Vacuum Cleaner", harga: 980000, kategori: "Rumah Tangga", deskripsi: "Daya hisap kuat.", gambar: "https://images.unsplash.com/photo-1558317374-067fb5f30001?w=400" }
        
    ];

    const productDisplay = document.getElementById('productDisplay');
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');

    // 2. Fungsi untuk menampilkan data (Render)
    function displayProducts(filteredProducts) {
        productDisplay.innerHTML = ""; // Kosongkan container

        if (filteredProducts.length === 0) {
            productDisplay.innerHTML = `<div class="col-12 text-center text-muted">Produk tidak ditemukan.</div>`;
            return;
        }

// style nya

        filteredProducts.forEach(product => {
            const card = `
                <div class="col">
                    <div class="card product-card shadow-sm border-0">
                        <span class="badge bg-primary category-badge">${product.kategori}</span>
                        <img src="${product.gambar}" class="card-img-top" alt="${product.nama}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">${product.nama}</h5>
                            <p class="text-primary fw-bold">Rp ${product.harga.toLocaleString('id-ID')}</p>
                            <p class="card-text text-secondary small">${product.deskripsi}</p>
                            <button class="btn btn-outline-dark mt-auto btn-sm">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            `;
            productDisplay.innerHTML += card;
        });
    }

    // 3 & 4. Fungsi Filter dan Search Terintegrasi
    function filterProducts() {
        const searchText = searchInput.value.toLowerCase();
        const categoryValue = categoryFilter.value;

        const filtered = products.filter(product => {
            const matchesSearch = product.nama.toLowerCase().includes(searchText);
            const matchesCategory = categoryValue === "all" || product.kategori === categoryValue;
            
            return matchesSearch && matchesCategory;
        });

        displayProducts(filtered);
    }

    // Event Listeners
    searchInput.addEventListener('input', filterProducts);
    categoryFilter.addEventListener('change', filterProducts);

    // Initial Render
    displayProducts(products);








