judul : BookNest Katalog Buku Digital

Nama : Zaskia
Nim  : D0223311


Framework Web Based
2025

Katalog Buku Digital
Katalog Buku Digital adalah sebuah aplikasi berbasis web yang memungkinkan pengelolaan koleksi buku digital secara efektif. Sistem ini mendukung tiga jenis role pengguna:

- **Penulis**: Dapat menambahkan, mengedit, dan menghapus buku yang telah mereka unggah.
- **User**: Pengguna  dapat mencari buku, membaca buku dan memberikan ulasan/reting .
- **Admin**: Pengelola aplikasi yang dapat mengatur pengguna dan mengelola konten buku.

Fitur utama dari aplikasi ini termasuk:
- Pengelolaan buku oleh penulis.
- Pencarian buku oleh pengguna.
- Sistem manajemen pengguna dan hak akses oleh admin.

## Fitur Utama

- **Autentikasi Pengguna**: Pengguna dapat mendaftar, masuk, dan mengelola profil mereka.
- **Pengelolaan Buku**: Penulis dapat mengunggah buku, mengedit, dan menghapusnya.
- **Pencarian Buku**: Pengguna dapat mencari buku berdasarkan judul, penulis, atau kategori.
- **Manajemen Pengguna**: Admin dapat menambah, menghapus, dan mengelola peran pengguna dalam aplikasi.
- **Role Management**: Penulis, pengguna, dan admin memiliki hak akses yang berbeda sesuai dengan peran mereka.

1. Tabel Users (Pengguna)

| **Field**   | **Tipe Data**                    | **Deskripsi**                                |
| ----------- | -------------------------------- | -------------------------------------------- |
| id          | INT AUTO\_INCREMENT              | ID unik untuk setiap pengguna                |
| name        | VARCHAR(255)                     | Nama pengguna                                |
| email       | VARCHAR(255) UNIQUE              | Alamat email pengguna                        |
| password    | VARCHAR(255)                     | Password pengguna                            |
| role        | ENUM('penulis', 'user', 'admin') | Peran pengguna (penulis, user, admin)        |
| created\_at | TIMESTAMP                        | Waktu saat pengguna dibuat                   |
| updated\_at | TIMESTAMP                        | Waktu saat pengguna terakhir diperbarui      |


2. Tabel Books (Buku)
Tabel ini menyimpan informasi tentang buku yang ada dalam katalog.

| **Field**       | **Tipe Data**       | **Deskripsi**                            |
| --------------- | ------------------- | ---------------------------------------- |
| id              | INT AUTO\_INCREMENT | ID unik untuk setiap buku                |
| title           | VARCHAR(255)        | Judul buku                               |
| author\_id      | INT                 | ID penulis (referensi ke tabel `users`)  |
| genre           | VARCHAR(100)        | Genre atau kategori buku                 |
| description     | TEXT                | Deskripsi buku                           |
| cover\_image    | VARCHAR(255)        | URL atau path gambar sampul buku         |
| published\_year | INT                 | Tahun terbit buku                        |
| created\_at     | TIMESTAMP           | Waktu saat buku ditambahkan              |
| updated\_at     | TIMESTAMP           | Waktu saat data buku terakhir diperbarui |


3. Tabel book_reviews (Ulasan Buku)
Menyimpan ulasan yang diberikan oleh pengguna untuk setiap buku.

| **Field**    | **Tipe Data** | **Deskripsi**                                               |
| ------------ | ------------- | ----------------------------------------------------------- |
| id           | INT           | ID unik ulasan (Primary Key)                                |
| book_id      | INT           | ID buku yang diulas (Foreign Key ke `books.id`)             |
| user_id      | INT           | ID pengguna yang memberi ulasan (Foreign Key ke `users.id`) |
| rating       | INT           | Rating buku (misalnya, 1-5)                                 |
| review       | TEXT          | Isi ulasan                                                  |
| created_at   | TIMESTAMP     | Waktu ulasan dibuat                                         |


4. Tabel categories (Kategori)
Menyimpan kategori untuk buku (misalnya, Fiksi, Non-fiksi, Sains, dll.).

| **Field**     | **Tipe Data** | **Deskripsi**                  |
| ------------- | ------------- | ------------------------------ |
| id            | INT           | ID unik kategori (Primary Key) |
| name          | VARCHAR       | Nama kategori                  |
| description   | TEXT          | Deskripsi kategori             |


5. Tabel favorites (Favorit)
Menyimpan data buku yang telah ditandai sebagai favorit oleh pengguna.

| **Field** | **Tipe Data** | **Deskripsi**                                                     |
| --------- | ------------- | ----------------------------------------------------------------- |
| id        | INT           | ID unik favorit (Primary Key)                                     |
| user_id   | INT           | ID pengguna yang menandai favorit (Foreign Key ke `users.id`)     |
| book_id   | INT           | ID buku yang ditandai sebagai favorit (Foreign Key ke `books.id`) |


6. Tabel logs (Log Aktivitas)
Menyimpan log aktivitas pengguna (misalnya, login, pencarian buku, dll.).

| **Field**   | **Tipe Data** | **Deskripsi**                                                        |
| ----------- | ------------- | -------------------------------------------------------------------- |
| id          | INT           | ID unik log (Primary Key)                                            |
| user_id     | INT           | ID pengguna yang melakukan aktivitas (Foreign Key ke `users.id`)     |
| action      | VARCHAR       | Deskripsi tindakan yang dilakukan (misalnya "Login", "Mencari buku") |
| timestamp   | TIMESTAMP     | Waktu saat aktivitas dilakukan                                       |



Relasi Antar Tabel: 
1. users → books: One-to-Many. Seorang pengguna (penulis) dapat menulis banyak buku.
 
2. books → book_reviews: One-to-Many. Setiap buku dapat memiliki banyak ulasan.

3. users → book_reviews: One-to-Many. Setiap pengguna dapat memberikan banyak ulasan.

4. books → categories: Many-to-One. Setiap buku dapat memiliki satu kategori, tetapi satu kategori bisa  memiliki banyak buku.

5. users → favorites: One-to-Many. Setiap pengguna dapat menandai banyak buku sebagai favorit.

6. books → favorites: One-to-Many. Setiap buku dapat ditandai favorit oleh banyak pengguna.

7. users → logs: One-to-Many. Setiap pengguna dapat memiliki banyak entri log aktivitas.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
