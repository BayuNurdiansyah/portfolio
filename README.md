# Portfolio Website — Ahmad Bayu Nurdiansyah

Website portfolio pribadi berbasis PHP Native + MySQL dengan fitur CRUD di panel admin.

## Tech Stack
- PHP Native
- MySQL (phpMyAdmin)
- Bootstrap 5
- jQuery
- Font Awesome

## Cara Menjalankan

### Kebutuhan
- XAMPP / Laragon (PHP 7.4+, MySQL)

### Langkah

1. Clone atau copy folder `portfolio` ke dalam `htdocs` (XAMPP) atau `www` (Laragon)

2. Import database:
   - Buka phpMyAdmin → http://localhost/phpmyadmin
   - Buat database baru bernama `portfolio_db`
   - Jalankan query SQL dari file dokumentasi

3. Konfigurasi koneksi database di `config/db.php`:
```php
   $host     = 'localhost';
   $user     = 'root';
   $password = '';        // sesuaikan jika ada password
   $database = 'portfolio_db';
```

4. Jalankan XAMPP → Start Apache & MySQL

5. Buka browser → http://localhost/portfolio

> Folder `assets/img/` dan `assets/img/techstack/` akan dibuat otomatis oleh sistem saat pertama kali mengakses halaman admin.

---

## Halaman Website

| Halaman | URL |
|---|---|
| Home / Biodata | http://localhost/portfolio/ |
| Riwayat Pendidikan | http://localhost/portfolio/pendidikan.php |
| Riwayat Pekerjaan | http://localhost/portfolio/pekerjaan.php |
| Riwayat Organisasi | http://localhost/portfolio/organisasi.php |
| Tech Stack | http://localhost/portfolio/techstack.php |
| Admin Login | http://localhost/portfolio/admin/login.php |
| Admin Dashboard | http://localhost/portfolio/admin/dashboard.php |

---

## Login Admin

| Field | Value |
|---|---|
| Username | `admin` |
| Password | `super123` |

> Akses admin panel di: **http://localhost/portfolio/admin/login.php**

---

## Fitur Admin

| Menu | Fitur |
|---|---|
| Dashboard | Ringkasan data + akses cepat semua menu |
| Profil | Upload & ganti foto profil |
| Pendidikan | Tambah, Edit, Hapus riwayat pendidikan |
| Pekerjaan | Tambah, Edit, Hapus riwayat pekerjaan |
| Organisasi | Tambah, Edit, Hapus riwayat organisasi |
| Tech Stack | Tambah, Edit, Hapus tech stack + upload logo lokal |

---

Dibuat untuk keperluan UTS mata kuliah Pemrograman Web.  
**Universitas Mercu Buana Yogyakarta - 2026**