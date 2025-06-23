
judul : BookNest Katalog Buku Digital – Jelajahi, dan Dapatkan Buku Favoritmu

Nama : Zaskia
Nim  : D0223311


Framework Web Based
2025

Katalog Buku Digital
Katalog Buku Digital adalah platform berbasis web yang menyediakan koleksi buku digital dengan berbagai genre yang dapat diakses dengan mudah. Aplikasi ini memungkinkan pengguna untuk mencari,  memberi ulasan, serta menandai buku favorit. Sistem ini mendukung tiga jenis role pengguna:

- **Penulis**: Dapat menambahkan, mengedit, dan menghapus buku yang mereka unggah.
- **User**: Pengguna dapat mencari buku, membaca buku, dan memberikan ulasan serta rating.
- **Admin**: Pengelola aplikasi yang dapat mengatur pengguna dan mengelola konten buku.

Fitur Utama
- **Autentikasi Pengguna**: Pengguna dapat mendaftar, masuk, dan mengelola profil mereka.
- **Pengelolaan Buku**: Penulis dapat mengunggah buku, mengedit, dan menghapusnya. Buku yang diunggah dilengkapi dengan sampul, deskripsi, dan kategori.
- **Pencarian Buku**: Pengguna dapat mencari buku berdasarkan judul, penulis, kategori, atau genre untuk menemukan buku yang mereka inginkan.
- **Manajemen Pengguna**: Admin memiliki hak untuk menambah, menghapus, dan mengelola peran pengguna dalam aplikasi.
- **Role Management**: Setiap peran (Penulis, User, Admin) memiliki hak akses yang berbeda sesuai dengan fungsinya dalam sistem.

Deskripsi Role Pengguna
- **Penulis**
Penulis memiliki kontrol penuh terhadap buku yang mereka unggah. Mereka dapat menambahkan buku baru, mengedit informasi buku (seperti judul, deskripsi, sampul), serta menghapus buku yang tidak lagi relevan.
- **User**
Pengguna dapat menjelajahi katalog buku, mencari buku berdasarkan kriteria tertentu, membaca buku yang tersedia, dan memberikan ulasan serta rating pada buku yang mereka baca. Mereka juga dapat menandai buku favorit untuk koleksi pribadi mereka.
- **Admin**
Admin bertanggung jawab atas pengelolaan sistem secara keseluruhan. Mereka dapat mengelola pengguna, memastikan semua buku yang diunggah sesuai dengan pedoman, serta memonitor aktivitas dalam platform. Admin juga dapat mengelola konten buku, termasuk menambah atau menghapus buku jika diperlukan.

--Struktur Tabel--

## Tabel Users (Pengguna)

| **Field**    | **Tipe Data**                        | **Deskripsi**                            |
|--------------|--------------------------------------|------------------------------------------|
| `id`         | INT AUTO_INCREMENT PRIMARY KEY       | ID unik untuk setiap pengguna            |
| `name`       | VARCHAR(255)                         | Nama pengguna                            |
| `email`      | VARCHAR(255) UNIQUE                  | Alamat email pengguna                    |
| `password`   | VARCHAR(255)                         | Password pengguna                        |
| `role`       | ENUM('admin', 'author', 'user')      | Peran pengguna (admin, author, user)     |
| `created_at` | TIMESTAMP                            | Waktu saat pengguna dibuat               |
| `updated_at` | TIMESTAMP                            | Waktu saat pengguna terakhir diperbarui  |

---

## Tabel categories (Kategori)

| **Field**    | **Tipe Data**                     | **Deskripsi**                  |
|--------------|-----------------------------------|--------------------------------|
| `id`         | INT AUTO_INCREMENT PRIMARY KEY    | ID unik kategori               |
| `name`       | VARCHAR(255)                      | Nama kategori                  |
| `created_at` | TIMESTAMP                         | Waktu kategori dibuat          |
| `updated_at` | TIMESTAMP                         | Waktu kategori diperbarui      |

---

## Tabel books (Buku)

| **Field**     | **Tipe Data**                     | **Deskripsi**                               |
|---------------|-----------------------------------|---------------------------------------------|
| `id`          | INT AUTO_INCREMENT PRIMARY KEY    | ID unik buku                                |
| `user_id`     | INT                               | ID penulis (Foreign Key ke users.id)        |
| `category_id` | INT NULLABLE                      | ID kategori (Foreign Key ke categories.id)  | 
| `title`       | VARCHAR(255)                      | Judul buku                                  |
| `description` | TEXT                              | Deskripsi buku                              |
| `cover_image` | VARCHAR(255) NULLABLE             | URL atau path gambar sampul buku            |
| `created_at`  | TIMESTAMP                         | Waktu buku ditambahkan                      |
| `updated_at`  | TIMESTAMP                         | Waktu data buku diperbarui                  |

---

## Tabel book_reviews (Ulasan Buku)

| **Field**    | **Tipe Data**                     | **Deskripsi**                                  |
|--------------|-----------------------------------|------------------------------------------------|
| `id`         | INT AUTO_INCREMENT PRIMARY KEY    | ID unik ulasan                                 |
| `user_id`    | INT                               | ID pengguna (Foreign Key ke users.id)          |
| `book_id`    | INT                               | ID buku (Foreign Key ke books.id)              |
| `rating`     | INT                               | Rating buku (misal 1-5)                        |
| `review`     | TEXT                              | Isi ulasan                                     |
| `created_at` | TIMESTAMP                         | Waktu ulasan dibuat                            |
| `updated_at` | TIMESTAMP                         | Waktu ulasan diperbarui                        |

---

## Tabel favorites (Favorit)

| **Field**    | **Tipe Data**                     | **Deskripsi**                                    |
|--------------|-----------------------------------|--------------------------------------------------|
| `id`         | INT AUTO_INCREMENT PRIMARY KEY    | ID unik favorit                                  |
| `user_id`    | INT                               | ID pengguna (Foreign Key ke users.id)            |
| `book_id`    | INT                               | ID buku (Foreign Key ke books.id)                |
| `created_at` | TIMESTAMP                         | Waktu favorit ditambahkan                        |
| `updated_at` | TIMESTAMP                         | Waktu favorit diperbarui                         |

---

## Tabel transactions (Transaksi)

| **Field**           | **Tipe Data**                             | **Deskripsi**                               |
|---------------------|-------------------------------------------|---------------------------------------------|
| `id`                | INT AUTO_INCREMENT PRIMARY KEY            | ID unik transaksi                           |
| `user_id`           | INT                                       | ID pengguna (Foreign Key ke users.id)       |
| `book_id`           | INT                                       | ID buku (Foreign Key ke books.id)           |
| `status`            | ENUM('pending', 'completed', 'cancelled') | Status transaksi (default: pending)         |
| `transaction_date`  | TIMESTAMP                                 | Waktu transaksi (default current timestamp) |
| `created_at`        | TIMESTAMP                                 | Waktu transaksi dibuat                      |
| `updated_at`        | TIMESTAMP                                 | Waktu transaksi diperbarui                  |

---

## Penjelasan Relasi Antar Tabel

1. Relasi antara tabel users dan books — One-to-Many
Satu pengguna (penulis) bisa menulis banyak buku. Setiap buku hanya punya satu penulis.

2. Relasi antara tabel categories dan books — One-to-Many
Satu kategori dapat berisi banyak buku. Setiap buku hanya masuk dalam satu kategori.

3. Relasi antara tabel books dan book_reviews — One-to-Many
Satu buku bisa memiliki banyak ulasan dari berbagai pengguna. Setiap ulasan hanya untuk satu buku.

4. Relasi antara tabel users dan book_reviews — One-to-Many
Satu pengguna bisa membuat banyak ulasan. Setiap ulasan dibuat oleh satu pengguna.

5. Relasi antara tabel users dan favorites — One-to-Many
Satu pengguna bisa menandai banyak buku sebagai favorit. Setiap favorit tercatat untuk satu pengguna.

6. Relasi antara tabel books dan favorites — One-to-Many
Satu buku bisa ditandai sebagai favorit oleh banyak pengguna. Setiap favorit mengacu ke satu buku.

7. Relasi antara tabel users dan transactions — One-to-Many
Satu pengguna bisa melakukan banyak transaksi pembelian. Setiap transaksi terkait dengan satu pengguna.

8. Relasi antara tabel books dan transactions — One-to-Many
Satu buku bisa muncul di banyak transaksi pembelian oleh berbagai pengguna. Setiap transaksi hanya melibatkan satu buku.



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
