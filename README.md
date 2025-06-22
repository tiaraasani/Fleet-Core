# Fleet Core - Aplikasi Pemesanan Kendaraan

## Deskripsi
Fleet Core  adalah aplikasi backend pemesanan kendaraan dengan fitur approval berjenjang. Dibangun menggunakan Laravel 12 dan menggunakan autentikasi berbasis JWT (JSON Web Token). Backend ini menyediakan API endpoint yang dapat diakses melalui Postman untuk melakukan berbagai operasi seperti registrasi, login, membuat pemesanan kendaraan, persetujuan, dan ekspor data laporan.

## Teknologi yang Digunakan

- **PHP Version**: 8.4
- **Framework**: Laravel 12
- **Database**: MariaDB (Versi yang disarankan: 10.5+)
- **Autentikasi**: JWT (JSON Web Token)
- **Tool Pengujian API**: Postman

## Panduan Penggunaan

### Instalasi
1. Clone repositori:
```bash
git clone https://github.com/tiaraasani/Fleet-Core.git
cd Fleet-Core
```

2. Install dependencies:
```bash
composer install
```

3. Copy `.env.example` ke `.env` dan sesuaikan konfigurasi database:
```bash
cp .env.example .env
php artisan key:generate
```

4. Jalankan migrasi dan seeder (opsional):
```bash
php artisan migrate --seed
```

5. Jalankan server:
```bash
php artisan serve
```

---

## API Endpoint (Contoh Request di Postman)

**1. Register**
- `POST /api/auth/register`
- Body (form-data): `name`, `email`, `password`, `password_confirmation`

**2. Login**
- `POST /api/auth/login`
- Body (form-data): `email`, `password`
- Response: `access_token`, digunakan sebagai Bearer Token

**3. Create Order**
- `POST /api/orders`
- Headers: Authorization: Bearer `<token>`
- Body (JSON):
```json
{
  "vehicle_id": 3,
  "driver_id": 1,
  "date": "2025-06-22",
  "destination": "Tambang A",
  "approver_ids": [2, 3]
}
```

**4. Approve Order**
- `POST /api/approvals/{id}/approve`
- Headers: Authorization: Bearer `<token>`

**5. Pending Approvals**
- `GET /api/approvals/pending`
- Headers: Authorization: Bearer `<token>`

**6. Delete Order**
- `DELETE /api/orders/{id}`
- Headers: Authorization: Bearer `<token>`

**7. Update Order**
- `PUT /api/orders/{id}`
- Headers: Authorization: Bearer `<token>`
- Body:
```json
{
  "destination": "Jakarta Selatan",
  "date": "2025-07-01"
}
```

**8. Export Report**
- `GET /api/reports/export?start=YYYY-MM-DD&end=YYYY-MM-DD`
- Headers: Authorization: Bearer `<token>`

---

## Daftar Akun Testing

| Role       | Email               | Password  |
|------------|---------------------|-----------|
| Admin      | admin@gmail.com     | 12345678  |
| Approver 1 | approver1@gmail.com | 12345678  |
| Driver     | driver1@gmail.com   | 12345678  |

---

## dokumentasi

Diagram ERD dan Flowchart dapat dilihat di folder **public**

## Kontak

Untuk pertanyaan lebih lanjut, silakan hubungi nabila.mutiarasani@gmail.com


