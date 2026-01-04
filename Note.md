# Ringkasan Fitur CRM yang Telah Diimplementasikan

Berikut adalah daftar fitur yang telah berhasil dikembangkan beserta fungsinya:

## 1. Manajemen Perusahaan (Companies)
*   **Fungsi:** Mengelola data perusahaan, termasuk menambah, melihat, mengedit, dan menghapus catatan perusahaan. Merupakan entitas dasar yang terhubung dengan Leads, Contacts, dan Deals.

## 2. Manajemen Leads (Prospek)
*   **Fungsi:** Melacak dan mengelola prospek penjualan potensial. Memungkinkan pembuatan, tampilan, pengeditan, dan penghapusan data lead, dengan detail seperti nama, email, telepon, status, sumber, dan penugasan ke user.

## 3. Manajemen Contacts (Kontak)
*   **Fungsi:** Mengelola informasi kontak individu. Mirip dengan Leads, namun biasanya untuk prospek yang lebih berkualitas atau pelanggan yang sudah ada. Terhubung dengan perusahaan.

## 4. Manajemen Deals (Penawaran)
*   **Fungsi:** Melacak proses penjualan dari awal hingga akhir. Memungkinkan pembuatan deal dengan judul, nilai, tahapan (stage), probabilitas, perkiraan tanggal penutupan, dan user yang ditugaskan. Terhubung dengan perusahaan dan kontak.

## 5. Manajemen Tasks (Tugas)
*   **Fungsi:** Mengelola tugas dan aktivitas yang terkait dengan berbagai entitas CRM (Leads, Contacts, Deals). Memiliki detail seperti judul, deskripsi, tanggal jatuh tempo, prioritas, status, dan user yang ditugaskan. Mendukung relasi polimorfik.

## 6. Manajemen Sales Targets (Target Penjualan)
*   **Fungsi:** Menetapkan dan melacak target penjualan untuk user berdasarkan bulan dan tahun. Penting untuk manajemen kinerja tim.

## 7. Manajemen Revenues (Pendapatan)
*   **Fungsi:** Mencatat pendapatan aktual yang dihasilkan dari deal yang telah "won". Terhubung langsung dengan deal, mencatat jumlah dan tanggal pendapatan.

## 8. Manajemen Documents (Dokumen)
*   **Fungsi:** Mengunggah dan mengelola dokumen-dokumen penting yang terkait dengan Leads, Contacts, atau Deals. Mendukung penyimpanan file, relasi polimorfik, dan pelacakan versi dokumen.

## 9. Seeding Data
*   **Fungsi:** Penyiapan data dummy untuk `Users`, `Companies`, `Contacts`, `Leads`, `Deals`, `Tasks`, `SalesTargets`, dan `Revenues`. Ini mempermudah pengujian dan pengembangan, memastikan dropdown serta tabel terisi dengan data contoh.

---
