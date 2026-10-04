# Project Context: Cat Adoption System
- Framework: Laravel 13, PHP 8.3+
- Paradigma: Clean Code, DRY (Don't Repeat Yourself), SOLID Principles.
- Saat ini: Landing Page dan Login Page sudah selesai. User ber-role 'admin' dan 'adopter'.

# Folder Structure & Architecture Rules
Patuhi struktur folder ini dengan ketat untuk memisahkan tanggung jawab (Separation of Concerns):
1. `app/Http/Controllers/Admin` & `app/Http/Controllers/User` -> Controller harus sangat tipis (Thin Controllers). Hanya memanggil Service dan me-return Response/View.
2. `app/Services/` -> Simpan semua logika bisnis di sini (misal: `CatService.php`, `AdoptionService.php`).
3. `app/Http/Requests/` -> Semua validasi form WAJIB menggunakan Form Request, jangan gunakan `$request->validate()` di Controller.
4. `app/Models/` -> Gunakan Eloquent dengan relasi yang tepat. Tuliskan `fillable` dan *casting* tipe data.

# Database Schema & Models
## 1. User
- Kolom: id, name, email, password, role (enum: admin, adopter), phone_number.
- Relasi: HasMany ke model Adoption.

## 2. Cat (S1-1, S2-2)
- Kolom: id, name, breed, age_in_months, condition, photo_path, status (enum: available, adopted).
- Relasi: HasMany ke model Adoption.

## 3. Adoption (S1-3, S1-4, S2-4, S2-5)
- Kolom: id, user_id, cat_id, adoption_reason, status (enum: pending, approved, rejected, completed), order_code (unique string), pickup_datetime.
- Relasi: BelongsTo User, BelongsTo Cat.

# Functional Requirements Map
- [S1-2, S2-3] WhatsApp Link: Gunakan format `https://wa.me/{nomor_admin}?text=...` di level View/Blade. Jangan simpan nomor hardcode di view, gunakan `config()` atau database.
- [S1-4] Verifikasi: Fitur admin untuk mencocokkan `order_code` dengan data Adoption, mengubah status menjadi `completed`.
- [S1-5] PDF Export: Gunakan package `barryvdh/laravel-dompdf` untuk mencetak laporan rekapitulasi.