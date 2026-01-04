# Ringkasan Fitur CRM yang Telah Diimplementasikan

Berikut adalah daftar fitur yang telah berhasil dikembangkan beserta fungsinya:

## 1. Manajemen Perusahaan (Companies)
*   **Fungsi:** Modul ini berfungsi untuk mengelola data perusahaan klien atau mitra. Ini adalah entitas dasar yang sering dihubungkan dengan Leads, Contacts, dan Deals, berfungsi sebagai konteks organisasi untuk aktivitas penjualan.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Company` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['name', 'domain']` - Menyimpan nama perusahaan dan domain website (opsional).
    *   **Migration:** `2026_01_02_124229_create_companies_table.php`
        *   Struktur tabel: `id`, `name` (string), `domain` (string, nullable), `timestamps`.
    *   **Controller:** `App\Http\Controllers\CompanyController`
        *   Mengimplementasikan operasi CRUD (Create, Read, Update, Delete) standar untuk entitas perusahaan.
        *   **`index()`:** Menampilkan daftar semua perusahaan dengan paginasi (10 perusahaan per halaman).
        *   **`create()`:** Menampilkan form untuk menambah perusahaan baru.
        *   **`store(Request $request)`:** Menyimpan data perusahaan baru setelah validasi (`name` wajib, `domain` opsional).
        *   **`edit(Company $company)`:** Menampilkan form untuk mengedit detail perusahaan yang sudah ada.
        *   **`update(Request $request, Company $company)`:** Memperbarui data perusahaan setelah validasi.
        *   **`destroy(Company $company)`:** Menghapus data perusahaan dari database.
    *   **Views:**
        *   `resources/views/companies/index.blade.php`: Menampilkan tabel daftar perusahaan dengan tombol Edit dan Delete.
        *   `resources/views/companies/create.blade.php`: Form untuk menambah perusahaan baru dengan field Nama Perusahaan dan Domain Website.
        *   `resources/views/companies/edit.blade.php`: Form untuk mengedit detail perusahaan yang sudah ada.
    *   **Styling & UI:** Menggunakan komponen Blade (`x-app-layout`, `x-input-label`, `x-text-input`, `x-primary-button`) dan Tailwind CSS untuk tampilan yang konsisten dengan desain aplikasi lainnya.

## 2. Manajemen Leads (Prospek)
*   **Fungsi:** Modul ini dirancang untuk mengelola dan melacak prospek penjualan potensial dari berbagai sumber. Ini adalah langkah awal dalam pipeline penjualan, memungkinkan tim untuk mengkualifikasi dan menugaskan prospek.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Lead` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['company_id', 'name', 'email', 'phone', 'status', 'source', 'assigned_to', 'created_by']`.
        *   **Relasi:**
            *   `company()`: `belongsTo` `App\Models\Company`.
            *   `assignedTo()`: `belongsTo` `App\Models\User` (sebagai sales rep yang ditugaskan).
            *   `activities()`: `morphMany` `App\Models\Activity` (untuk melacak riwayat aktivitas lead).
    *   **Migration:** `2026_01_02_124259_create_leads_table.php`
        *   Struktur tabel: `id`, `company_id` (foreign key), `name` (string), `email` (string, nullable), `phone` (string, nullable), `company` (string, nullable - *catatan: kolom ini ada di migrasi tapi tidak di `$fillable` model, perlu diverifikasi atau diabaikan jika tidak digunakan*), `status` (string: `new`, `contacted`, `qualified`, `unqualified`), `source` (string: `web`, `referral`, `partner`, `other`), `assigned_to` (foreign key ke `users`), `created_by` (foreign key ke `users`), `timestamps`.
    *   **Controller:** `App\Http\Controllers\LeadController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas lead.
        *   **`index()`:** Menampilkan daftar semua lead dengan relasi `company` dan `assignedTo` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk menambah lead baru, menyediakan daftar `companies` dan `users` untuk dipilih.
        *   **`store(Request $request)`:** Menyimpan data lead baru setelah validasi. Menambahkan `created_by` berdasarkan user yang sedang login.
        *   **`edit(Lead $lead)`:** Menampilkan form untuk mengedit detail lead, dengan `activities` di-eager load untuk tampilan timeline.
        *   **`update(Request $request, Lead $lead)`:** Memperbarui data lead setelah validasi.
        *   **`destroy(Lead $lead)`:** Menghapus data lead.
    *   **Views:**
        *   `resources/views/leads/index.blade.php`: Menampilkan tabel daftar lead dengan tombol Edit dan Delete. Status lead ditampilkan dengan badge berwarna.
        *   `resources/views/leads/create.blade.php`: Form untuk menambah lead baru dengan field untuk nama, email, telepon, perusahaan, penanggung jawab, status, dan sumber.
        *   `resources/views/leads/edit.blade.php`: Form untuk mengedit detail lead. Telah diintegrasikan dengan **Activity Timeline** di bagian bawah untuk melacak interaksi dan menambahkan catatan.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi. Status lead ditampilkan dengan badge berwarna sesuai statusnya.
*   **Observer:** `App\Observers\LeadObserver` otomatis mencatat aktivitas pada event `created`, `updated` (khususnya perubahan `status` dan `assigned_to`), dan `deleted`.

## 3. Manajemen Contacts (Kontak)
*   **Fungsi:** Modul ini bertugas mengelola informasi detail kontak individu, yang sering kali merupakan prospek yang sudah lebih berkualitas, pelanggan eksisting, atau kontak kunci dari sebuah perusahaan.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Contact` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['company_id', 'lead_id', 'name', 'email', 'phone']`.
        *   **Relasi:**
            *   `company()`: `belongsTo` `App\Models\Company`.
            *   `activities()`: `morphMany` `App\Models\Activity` (untuk melacak riwayat aktivitas kontak).
    *   **Migration:** `2026_01_02_124305_create_contacts_table.php`
        *   Struktur tabel: `id`, `company_id` (foreign key, constrained), `lead_id` (foreign key, nullable, `nullOnDelete`), `name` (string), `email` (string, nullable), `phone` (string, nullable), `company` (string, nullable - *catatan: kolom ini ada di migrasi tapi tidak di `$fillable` model, perlu diverifikasi atau diabaikan jika tidak digunakan*), `timestamps`.
    *   **Controller:** `App\Http\Controllers\ContactController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas kontak.
        *   **`index()`:** Menampilkan daftar semua kontak dengan relasi `company` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk menambah kontak baru, menyediakan daftar `companies` untuk dipilih.
        *   **`store(Request $request)`:** Menyimpan data kontak baru setelah validasi.
        *   **`edit(Contact $contact)`:** Menampilkan form untuk mengedit detail kontak, dengan `activities` di-eager load untuk tampilan timeline.
        *   **`update(Request $request, Contact $contact)`:** Memperbarui data kontak setelah validasi.
        *   **`destroy(Contact $contact)`:** Menghapus data kontak.
    *   **Views:**
        *   `resources/views/contacts/index.blade.php`: Menampilkan tabel daftar kontak dengan tombol Edit dan Delete.
        *   `resources/views/contacts/create.blade.php`: Form untuk menambah kontak baru dengan field untuk nama, email, telepon, dan perusahaan.
        *   `resources/views/contacts/edit.blade.php`: Form untuk mengedit detail kontak. Telah diintegrasikan dengan **Activity Timeline** di bagian bawah untuk melacak interaksi dan menambahkan catatan.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi.
*   **Observer:** `App\Observers\ContactObserver` otomatis mencatat aktivitas pada event `created`, `updated` (pesan umum 'updated the contact details'), dan `deleted`.

## 4. Manajemen Deals (Penawaran)
*   **Fungsi:** Modul ini berfungsi untuk melacak dan mengelola setiap peluang penjualan dari tahap awal hingga penutupan (won/lost). Ini adalah inti dari pipeline penjualan CRM.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Deal` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['company_id', 'contact_id', 'title', 'value', 'stage', 'probability', 'expected_close_date', 'assigned_to']`.
        *   **Relasi:**
            *   `company()`: `belongsTo` `App\Models\Company`.
            *   `contact()`: `belongsTo` `App\Models\Contact`.
            *   `assignedTo()`: `belongsTo` `App\Models\User` (sebagai sales rep yang ditugaskan).
            *   `activities()`: `morphMany` `App\Models\Activity` (untuk melacak riwayat aktivitas deal).
    *   **Migration:** `2026_01_02_124306_create_deals_table.php`
        *   Struktur tabel: `id`, `company_id` (foreign key), `contact_id` (foreign key), `title` (string), `value` (decimal), `stage` (string: `qualification`, `proposal`, `negotiation`, `won`, `lost`), `probability` (integer), `expected_close_date` (date, nullable), `assigned_to` (foreign key ke `users`), `timestamps`.
    *   **Controller:** `App\Http\Controllers\DealController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas deal.
        *   **`index()`:** Menampilkan daftar semua deal dengan relasi `company`, `contact`, dan `assignedTo` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk menambah deal baru, menyediakan daftar `companies`, `contacts`, dan `users` untuk dipilih.
        *   **`store(Request $request)`:** Menyimpan data deal baru setelah validasi.
        *   **`edit(Deal $deal)`:** Menampilkan form untuk mengedit detail deal, dengan `activities` di-eager load untuk tampilan timeline.
        *   **`update(Request $request, Deal $deal)`:** Memperbarui data deal setelah validasi.
        *   **`destroy(Deal $deal)`:** Menghapus data deal.
    *   **Views:**
        *   `resources/views/deals/index.blade.php`: Menampilkan tabel daftar deal dengan tombol Edit dan Delete. Stage deal ditampilkan dengan badge berwarna.
        *   `resources/views/deals/create.blade.php`: Form untuk menambah deal baru dengan field untuk judul, perusahaan, kontak, penanggung jawab, nilai, stage, probabilitas, dan tanggal perkiraan penutupan.
        *   `resources/views/deals/edit.blade.php`: Form untuk mengedit detail deal. Telah diintegrasikan dengan **Activity Timeline** di bagian bawah untuk melacak interaksi dan menambahkan catatan.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi. Stage deal ditampilkan dengan badge berwarna sesuai statusnya.
*   **Observer:** `App\Observers\DealObserver` otomatis mencatat aktivitas pada event `created`, `updated` (khususnya perubahan `stage` dan `assigned_to`), dan `deleted`.

## 5. Manajemen Tasks (Tugas)
*   **Fungsi:** Modul ini memungkinkan pengguna untuk membuat, menetapkan, dan melacak tugas atau aktivitas yang terkait dengan berbagai entitas dalam CRM (Leads, Contacts, Deals). Ini membantu dalam pengelolaan alur kerja dan memastikan tindak lanjut yang tepat waktu.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Task` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['title', 'description', 'due_date', 'priority', 'status', 'assigned_to', 'related_type', 'related_id']`.
        *   **Relasi:**
            *   `assignedTo()`: `belongsTo` `App\Models\User`.
            *   `related()`: `morphTo()` - relasi polimorfik untuk menghubungkan tugas dengan `Lead`, `Contact`, atau `Deal`.
    *   **Migration:** `2026_01_02_124344_create_tasks_table.php`
        *   Struktur tabel: `id`, `title` (string), `description` (text, nullable), `due_date` (date, nullable), `priority` (string: `low`, `medium`, `high`), `status` (string: `open`, `in_progress`, `completed`), `assigned_to` (foreign key ke `users`), `related_type` (string), `related_id` (unsignedBigInteger), `timestamps`.
    *   **Controller:** `App\Http\Controllers\TaskController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas tugas.
        *   **`index()`:** Menampilkan daftar semua tugas dengan relasi `assignedTo` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk menambah tugas baru, menyediakan daftar `users`, `leads`, `contacts`, dan `deals` untuk dipilih. Menangani pemilihan `related_type` dan `related_id` secara dinamis.
        *   **`store(Request $request)`:** Menyimpan data tugas baru setelah validasi. Menampilkan validasi khusus untuk memastikan `related_type` dan `related_id` disediakan bersamaan atau tidak sama sekali (mirip dengan modul Documents).
        *   **`edit(Task $task)`:** Menampilkan form untuk mengedit detail tugas.
        *   **`update(Request $request, Task $task)`:** Memperbarui data tugas setelah validasi, dengan validasi khusus untuk relasi `related`.
        *   **`destroy(Task $task)`:** Menghapus data tugas.
    *   **Views:**
        *   `resources/views/tasks/index.blade.php`: Menampilkan tabel daftar tugas. Prioritas dan status tugas ditampilkan dengan badge berwarna. Kolom "Related To" menampilkan entitas terkait.
        *   `resources/views/tasks/create.blade.php`: Form untuk menambah tugas baru, termasuk dropdown dinamis untuk memilih entitas terkait (Lead, Contact, atau Deal).
        *   `resources/views/tasks/edit.blade.php`: Form untuk mengedit detail tugas yang sudah ada, dengan fungsionalitas dropdown dinamis yang sama.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi. Status dan prioritas tugas ditampilkan dengan badge berwarna.

## 6. Manajemen Sales Targets (Target Penjualan)
*   **Fungsi:** Modul ini memungkinkan penetapan dan pelacakan target penjualan bulanan untuk setiap user sales. Target ini penting untuk evaluasi kinerja dan perbandingan dengan pendapatan aktual di dashboard.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\SalesTarget` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['user_id', 'month', 'year', 'target_amount']`.
        *   **Relasi:**
            *   `user()`: `belongsTo` `App\Models\User`.
    *   **Migration:** `2026_01_02_124316_create_sales_targets_table.php`
        *   Struktur tabel: `id`, `user_id` (foreign key ke `users`), `month` (tinyInteger), `year` (year), `target_amount` (decimal), `timestamps`.
    *   **Controller:** `App\Http\Controllers\SalesTargetController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas target penjualan.
        *   **`index()`:** Menampilkan daftar semua target penjualan dengan relasi `user` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk menetapkan target baru. Menyediakan daftar `users`, daftar bulan, dan rentang tahun (saat ini + 5 tahun ke depan) untuk dipilih.
        *   **`store(Request $request)`:** Menyimpan target penjualan baru setelah validasi. Termasuk validasi untuk mencegah duplikasi target untuk user, bulan, dan tahun yang sama.
        *   **`edit(SalesTarget $salesTarget)`:** Menampilkan form untuk mengedit detail target penjualan yang sudah ada.
        *   **`update(Request $request, SalesTarget $salesTarget)`:** Memperbarui data target penjualan setelah validasi, termasuk validasi duplikasi (mengabaikan target yang sedang diedit).
        *   **`destroy(SalesTarget $salesTarget)`:** Menghapus data target penjualan.
    *   **Views:**
        *   `resources/views/sales_targets/index.blade.php`: Menampilkan tabel daftar target penjualan. Bulan ditampilkan dalam format nama bulan penuh.
        *   `resources/views/sales_targets/create.blade.php`: Form untuk menetapkan target penjualan baru dengan dropdown untuk user, bulan, tahun, dan input jumlah target.
        *   `resources/views/sales_targets/edit.blade.php`: Form untuk mengedit detail target penjualan yang sudah ada.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi.

## 7. Manajemen Revenues (Pendapatan)
*   **Fungsi:** Modul ini bertugas mencatat pendapatan aktual yang dihasilkan dari deal yang telah berhasil "won". Data pendapatan ini sangat krusial untuk laporan keuangan, analisis performa penjualan, dan perbandingan dengan target.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Revenue` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['deal_id', 'amount', 'revenue_date']`.
        *   **Relasi:**
            *   `deal()`: `belongsTo` `App\Models\Deal`.
    *   **Migration:** `2026_01_02_124311_create_revenues_table.php`
        *   Struktur tabel: `id`, `deal_id` (foreign key, constrained), `amount` (decimal), `revenue_date` (date), `timestamps`.
    *   **Controller:** `App\Http\Controllers\RevenueController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas pendapatan.
        *   **`index()`:** Menampilkan daftar semua pendapatan dengan relasi `deal` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk mencatat pendapatan baru. Hanya menampilkan deal dengan `stage` 'won' yang dapat dipilih.
        *   **`store(Request $request)`:** Menyimpan data pendapatan baru setelah validasi.
        *   **`edit(Revenue $revenue)`:** Menampilkan form untuk mengedit detail pendapatan, juga hanya menampilkan deal 'won'.
        *   **`update(Request $request, Revenue $revenue)`:** Memperbarui data pendapatan setelah validasi.
        *   **`destroy(Revenue $revenue)`:** Menghapus data pendapatan.
    *   **Views:**
        *   `resources/views/revenues/index.blade.php`: Menampilkan tabel daftar pendapatan dengan tombol Edit dan Delete. Menampilkan judul deal, jumlah, dan tanggal pendapatan.
        *   `resources/views/revenues/create.blade.php`: Form untuk mencatat pendapatan baru dengan dropdown untuk deal yang sudah 'won', input jumlah, dan tanggal pendapatan.
        *   `resources/views/revenues/edit.blade.php`: Form untuk mengedit detail pendapatan yang sudah ada.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi.

## 8. Manajemen Documents (Dokumen)
*   **Fungsi:** Modul ini menyediakan kemampuan untuk mengunggah, mengelola, dan menautkan dokumen penting (seperti proposal, kontrak, atau invoice) ke entitas CRM lain seperti Leads, Contacts, atau Deals. Fitur ini juga melacak versi dokumen.
*   **Penjelasan Teknis:**
    *   **Model:** `App\Models\Document` (menggunakan `HasFactory` untuk pembuatan data dummy).
        *   `$fillable`: `['file_name', 'file_path', 'related_type', 'related_id', 'uploaded_by', 'version']`.
        *   **Relasi:**
            *   `uploadedBy()`: `belongsTo` `App\Models\User`.
            *   `related()`: `morphTo()` - relasi polimorfik untuk menghubungkan dokumen dengan `Lead`, `Contact`, atau `Deal`.
    *   **Migration:** `2026_01_02_124402_create_documents_table.php`
        *   Struktur tabel: `id`, `file_name` (string), `file_path` (string), `related_type` (string), `related_id` (unsignedBigInteger), `uploaded_by` (foreign key ke `users`), `version` (integer, default 1), `timestamps`.
    *   **Controller:** `App\Http\Controllers\DocumentController`
        *   Mengimplementasikan operasi CRUD standar untuk entitas dokumen.
        *   **`index()`:** Menampilkan daftar semua dokumen dengan relasi `uploadedBy` yang di-eager load, dengan paginasi.
        *   **`create()`:** Menampilkan form untuk mengunggah dokumen baru. Menyediakan dropdown dinamis untuk memilih `related_type` (Lead, Contact, Deal) dan `related_id` yang sesuai.
        *   **`store(Request $request)`:** Mengunggah dan menyimpan dokumen baru setelah validasi (ukuran file, jenis file). Validasi khusus diterapkan untuk `related_type` dan `related_id` yang harus disediakan bersamaan atau tidak sama sekali.
        *   **`show(Document $document)`:** Mengunduh file dokumen.
        *   **`edit(Document $document)`:** Menampilkan form untuk mengedit detail dokumen. Memungkinkan penggantian file dan pembaruan relasi, dengan kenaikan nomor versi dokumen.
        *   **`update(Request $request, Document $document)`:** Memperbarui data dokumen setelah validasi, termasuk penanganan upload file baru dan penambahan versi.
        *   **`destroy(Document $document)`:** Menghapus data dokumen dan file terkait dari storage.
    *   **Views:**
        *   `resources/views/documents/index.blade.php`: Menampilkan tabel daftar dokumen dengan link untuk download, Edit, dan Delete. Menampilkan informasi file, relasi, pengunggah, versi, dan tanggal upload.
        *   `resources/views/documents/create.blade.php`: Form untuk mengunggah dokumen baru, dengan input file dan dropdown dinamis untuk menautkan dokumen ke entitas CRM.
        *   `resources/views/documents/edit.blade.php`: Form untuk mengedit dokumen yang sudah ada.
    *   **Styling & UI:** Menggunakan komponen Blade dan Tailwind CSS untuk konsistensi.
    *   **Fixes:** Perbaikan bug pada validasi `related_type` dan `related_id` di mana pesan error `Both related type and ID must be provided, or neither` muncul secara tidak tepat. Perbaikan bug pada tampilan `related_id` dropdown dinamis di form create/edit yang tidak terisi karena kesalahan escape backslash JavaScript.

## 9. Seeding Data
*   **Fungsi:** Modul seeding ini bertanggung jawab untuk mengisi database dengan data dummy yang realistis dan terstruktur. Ini sangat penting untuk pengembangan, pengujian, dan mendemonstrasikan fungsionalitas aplikasi tanpa harus memasukkan data secara manual.
*   **Penjelasan Teknis:**
    *   **Factories:**
        *   `UserFactory`: Membuat user dummy. Digunakan untuk admin dan user sales.
        *   `CompanyFactory`: Membuat data perusahaan dummy.
        *   `ContactFactory`: Membuat data kontak dummy, terkait dengan perusahaan yang sudah ada.
        *   `LeadFactory`: Membuat data lead dummy dengan informasi nama, email, telepon, perusahaan, status, sumber, dan menugaskan ke user sales. Tanggal pembuatan lead disebar selama setahun terakhir.
        *   `DealFactory`: Membuat data deal dummy dengan judul, nilai, stage, probabilitas, dan perkiraan tanggal penutupan. Terhubung ke perusahaan dan kontak. Stage deal (`qualification`, `proposal`, `negotiation`, `won`, `lost`) dan probabilitas diatur secara realistis. Tanggal pembuatan deal disebar selama setahun terakhir.
        *   `SalesTargetFactory`: Digunakan untuk membuat target penjualan dengan `user_id`, `month`, `year`, dan `target_amount`. *Catatan: Logika sequential targets sekarang diatur langsung di `DatabaseSeeder`.*
        *   `RevenueFactory`: Membuat data pendapatan dummy yang terkait dengan deal yang telah 'won'.
    *   **DatabaseSeeder (`database/seeders/DatabaseSeeder.php`):**
        *   **Urutan Eksekusi:**
            1.  Membuat satu user Admin spesifik (`admin@example.com`).
            2.  Membuat 4 user Sales tambahan.
            3.  Membuat 20 perusahaan dummy.
            4.  Membuat `SalesTarget` yang terstruktur: Untuk setiap user sales, dibuat target bulanan untuk 12 bulan terakhir (dengan rentang jumlah yang realistis), memastikan data tersedia untuk grafik dashboard.
            5.  Membuat 100 `Leads` dengan data acak, tanggal tersebar selama setahun terakhir, dan ditugaskan ke user sales serta perusahaan yang ada.
            6.  Membuat 50 `Contacts` dummy.
            7.  Membuat 80 `Deals` dummy. Setiap deal terhubung ke user sales, perusahaan, dan kontak yang sudah ada. Tanggal deal tersebar selama setahun terakhir.
            8.  **Pendapatan Otomatis:** Untuk setiap deal yang statusnya 'won', secara otomatis dibuat record `Revenue` yang sesuai dengan nilai deal dan tanggal penutupan deal sebagai `revenue_date`.
    *   **Instruksi Penggunaan:** Untuk mengisi database dengan data dummy, jalankan perintah `php artisan migrate:fresh --seed`. **Penting:** Perintah ini akan menghapus semua data yang ada di database sebelum mengisi yang baru.

## 10. Activity & Timeline
*   **Fungsi:** Melacak dan menampilkan semua riwayat aktivitas serta interaksi yang terkait dengan Leads, Contacts, dan Deals secara otomatis dan manual.
*   **Penjelasan Teknis:**
    *   **Backend:** Implementasi `Activity` Model dan Controller. Logging otomatis pada event `created`, `updated`, `deleted` untuk Leads, Deals, dan Contacts menggunakan Observers. Penambahan relasi polimorfik `activities()` pada model `Lead`, `Contact`, dan `Deal` untuk mengelola hubungan banyak-ke-banyak.
    *   **Frontend:** Penambahan link "Activities" di sidebar. Tampilan timeline global untuk semua aktivitas. Integrasi timeline aktivitas dan form penambahan catatan manual di halaman detail Leads, Contacts, dan Deals.

## 11. Reports & Analytics (Laporan Pendapatan)
*   **Fungsi:** Menghasilkan laporan pendapatan berdasarkan rentang tanggal tertentu dan memungkinkan ekspor ke format Excel.
*   **Penjelasan Teknis:**
    *   **Backend:** Implementasi `ReportController` dengan metode `revenueReport` dan `exportRevenue`. Integrasi library `maatwebsite/excel` untuk fungsionalitas ekspor Excel.
    *   **Frontend:** Halaman hub `/reports` untuk daftar laporan yang tersedia. Halaman khusus `/reports/revenue` untuk menampilkan form pemilihan tanggal, ringkasan pendapatan, dan daftar transaksi.
    *   **Fixes:** Perbaikan bug `Column not found` yang terjadi karena kesalahan nama kolom `date` yang seharusnya `revenue_date`.

## 12. Dashboard
*   **Fungsi:** Memberikan gambaran umum yang elegan dan informatif mengenai metrik penjualan utama, tren performa, dan status pipeline.
*   **Penjelasan Teknis:**
    *   **Backend:** Implementasi `DashboardController` untuk mengagregasi data KPI (Total Revenue, New Leads, Deals Won, Conversion Rate), data grafik (Revenue vs Target, Sales Pipeline), dan Quick Stats (Open Deals, Win Rate, Avg. Deal Size).
    *   **Frontend:** Desain ulang total `dashboard.blade.php` dengan layout grid responsif. Kartu KPI yang stylis dengan perbandingan persentase. Grafik interaktif menggunakan Chart.js (Line Chart untuk Revenue vs Target, Bar Chart untuk Sales Pipeline).
    *   **Styling:** Penggunaan palet warna proyek (hijau/emerald dan amber/emas) secara konsisten untuk tampilan yang elegan dan informatif.
    *   **Fixes:** Perbaikan error `SQLSTATE[42000]` terkait `only_full_group_by` pada query `SalesTarget`. Perbaikan masalah grafik memanjang tak terbatas.

## 13. Redesain Halaman Publik & Autentikasi
*   **Fungsi:** Meningkatkan estetika dan konsistensi branding pada halaman *landing page*, login, dan registrasi.
*   **Penjelasan Teknis:**
    *   **Halaman Welcome (`welcome.blade.php`):** Desain ulang menjadi *landing page* yang elegan dengan bagian *hero*, *features*, dan *call-to-action*.
    *   **Halaman Login (`login.blade.php`) & Registrasi (`register.blade.php`):** Desain ulang agar lebih modern, sesuai branding, dan elegan, dengan logo kustom, skema warna proyek, dan layout form yang halus.

---
