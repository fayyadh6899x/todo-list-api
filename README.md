# API To-Do List Manajemen Media Sosial 

API CRUD untuk mengelola daftar tugas postingan di media sosial. API ini dibangun menggunakan **Laravel 10** dan dilengkapi dengan **dokumentasi Swagger**.

## Fitur
- Membuat, Membaca, Memperbarui, dan Menghapus (CRUD).
- Dokumentasi API dengan Swagger.
- Menggunakan framework Laravel versi 10.

## Teknologi yang Digunakan
- **Backend:** Laravel 10
- **Database:** MySQL
- **Dokumentasi API:** Swagger (menggunakan `l5-swagger`)

## Instalasi

### 1. Clone Repository
```sh
git clone https://github.com/fayyadh6899x/todo-list-api
cd todo-list-api
```

### 2. Install Dependensi
```sh
composer install
```

### 3. Konfigurasi Lingkungan
Salin file `.env.example` menjadi `.env` dan perbarui detail database:
```sh
cp .env.example .env
```
Perbarui file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasks
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```sh
php artisan key:generate
```

### 5. Jalankan Migrasi
```sh
php artisan migrate
```

### 6. Jalankan Aplikasi
```sh
php artisan serve
```
Aplikasi API sekarang berjalan di `http://127.0.0.1:8000`.

## Endpoint API

### Base URL: `http://127.0.0.1:8000/api`

Metode = GET | Endpoint = '/tasks' | Mendapatkan semua item tugas yang ada |,
Metode = GET | Endpoint = '/tasks{id}' | Mendapatkan semua item tugas tertentu |,
Metode = POST | Endpoint = '/tasks' | Membuat item tugas terbaru |,
Metode = PUT | Endpoint = '/tasks{id}' | Memperbarui tugas tertentu |,
Metode = DELETE | Endpoint = '/tasks{id}' | Menghapus tugas tertentu |

### Contoh Permintaan (Membuat Item Tugas)
```sh
POST /api/tasks
```
```json
{
  "title": "Posting Media Sosial",
  "brand": "Maju Mundur Jaya",
  "platform": "Instagram",
  "due_date": "2025-02-25",
  "payment": 100,
  "status": "pending",
  "priority" : "medium",
  "category" : "Regular Post"

}
```

## Dokumentasi Swagger
Setelah proyek berjalan, akses dokumentasi API di:
```
http://127.0.0.1:8000/api/documentation
```
## Done!

