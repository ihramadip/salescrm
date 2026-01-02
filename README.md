# SalesPro CRM

SalesPro CRM adalah aplikasi **Customer Relationship Management (CRM)** berbasis **Laravel + Blade + Breeze** yang dirancang untuk membantu tim sales dalam mengelola leads, contacts, deals, serta memantau performa penjualan secara real-time melalui dashboard analitik.

---

## 🚀 Tech Stack

- **Backend**: Laravel
- **Frontend**: Blade Template Engine
- **Auth Scaffolding**: Laravel Breeze
- **Database**: MySQL / PostgreSQL
- **Charts**: Chart.js / ApexCharts
- **Styling**: Tailwind CSS
- **Icons**: Heroicons / Lucide
- **Authentication**: Session-based (Laravel Auth)

---

## 🔐 Authentication & Authorization

Menggunakan Laravel Breeze sebagai fondasi autentikasi.

### Fitur:
- Login
- Register
- Logout
- Reset Password
- Email Verification (optional)
- Middleware authentication

### Role (Recommended):
- Admin
- Sales Manager
- Sales Executive

---

## 📊 Sales Dashboard

Dashboard berfungsi sebagai pusat monitoring performa penjualan.

### Key Performance Indicators (KPI)

| Metric | Description |
|------|-------------|
| Total Revenue | Total pendapatan yang diperoleh |
| Active Leads | Jumlah prospek aktif |
| Conversion Rate | Persentase lead menjadi deal |
| Deals Closed | Total deal yang berhasil ditutup |

Setiap KPI dilengkapi dengan:
- Perbandingan bulan sebelumnya
- Indikator naik/turun (%)

---

## 📈 Revenue Performance

Menampilkan grafik:
- **Actual Revenue vs Target Revenue**
- Periode bulanan
- Visualisasi tren performa sales

**Use Case:**
- Monitoring pencapaian target
- Evaluasi performa bulanan

---

## 🔄 Sales Pipeline

Visualisasi tahapan penjualan berdasarkan jumlah deal aktif:

1. Prospecting
2. Qualified
3. Proposal
4. Negotiation
5. Closed

**Manfaat:**
- Mengidentifikasi bottleneck pipeline
- Analisis distribusi deal
- Forecast penjualan

---

## 📂 Modules

### 1️⃣ Leads Management

Mengelola data prospek yang masuk.

**Fitur:**
- CRUD Leads
- Status Lead (New, Contacted, Qualified, Unqualified)
- Source Lead (Website, Referral, Campaign)
- Assign lead ke sales
- Convert lead ke Contact / Deal

---

### 2️⃣ Contacts Management

Database pelanggan dan relasi bisnis.

**Fitur:**
- CRUD Contacts
- Informasi detail (email, phone, company)
- Relasi ke Leads dan Deals
- Riwayat aktivitas

---

### 3️⃣ Deals Management

Manajemen peluang penjualan.

**Fitur:**
- CRUD Deals
- Deal value
- Deal stage
- Expected closing date
- Probability & forecast revenue
- Assign deal ke sales

---

### 4️⃣ Reports & Analytics

Laporan penjualan berbasis data.

**Jenis laporan:**
- Revenue per periode
- Performance per sales
- Conversion rate
- Win/Loss analysis

**Export:**
- Excel
- PDF

---

### 5️⃣ Documents Management

Manajemen dokumen penjualan.

**Fitur:**
- Upload proposal, kontrak, invoice
- Relasi dokumen ke deal / contact
- Versioning (optional)

---

## ⚡ Quick Stats

Statistik cepat yang selalu tampil:
- Open Deals
- Win Rate
- Average Deal Size

---

## 🔍 Global Search

Pencarian cepat untuk:
- Leads
- Contacts
- Deals

Mendukung:
- Keyword search
- Filter basic

---

## 🔔 Notifications (Recommended)

- Lead assigned
- Deal closed
- Task overdue
- Follow-up reminder

Teknologi:
- Laravel Notifications
- Email / In-App Notification

---

## 📝 Activity & Timeline (Recommended)

Setiap entitas (Lead, Contact, Deal) memiliki:
- Log aktivitas
- Call log
- Meeting
- Notes
- Timestamp & user

---

## ⏰ Task & Reminder System (Recommended)

- Create task
- Assign ke sales
- Due date & priority
- Reminder otomatis

---

## 📧 Email Integration (Recommended)

- Kirim email langsung dari CRM
- Email templates
- Tracking open & reply

---

## 📦 Import & Export Data (Recommended)

- Import Leads (CSV / Excel)
- Export laporan (Excel / PDF)

---

## 🔐 Audit Log (Advanced)

- Tracking perubahan data
- User & timestamp
- Cocok untuk compliance

---

## 🏢 Multi-Tenant Support (Advanced)

- Multi company dalam satu sistem
- Isolasi data per tenant
- Subdomain / Company-based access

---

## 📱 Responsive & API Ready

- Responsive design
- REST API ready
- Mobile app friendly

---

1. Warna Utama (Primary Color)
🟢 Green / Mint Green

Ini adalah warna dominan di seluruh UI.

Peran:

Primary brand color

Status positif (growth, success, increase)

Highlight elemen penting (KPI, grafik, active state)

Karakter:

Tenang

Profesional

Finansial / bisnis

Tidak agresif (bukan hijau neon)

Contoh penggunaan:

KPI icons background

Grafik revenue

Bar chart pipeline

Active menu (Overview)

📌 Makna UX:
Hijau = “kinerja sehat”, cocok untuk sales & finance dashboard.

2. Warna Sekunder
🟢 Soft Mint / Light Green

Digunakan sebagai:

Background card icon

Bar chart tahap awal funnel

Area chart fill

Fungsi:

Memberi depth tanpa mengganggu fokus

Menandai data volume besar (Prospecting)

📌 UX:
Memberi rasa progression dari light → dark (funnel stages).

3. Warna Aksen (Accent)
🔴 Red (Negatif)

Digunakan sangat minim.

Contoh:

-2.4% vs last month (Deals Closed)

Fungsi:

Alert

Penurunan performa

📌 Best practice:
Dipakai hemat → efeknya kuat saat muncul.

🟡 Yellow / Gold (Target Line)

Digunakan pada:

Garis target di grafik revenue (dashed line)

Fungsi:

Pembanding (benchmark)

Netral, tidak positif / negatif

📌 UX Insight:

Kuning = perhatian tanpa alarm

4. Warna Netral (Foundation Colors)
⚪ White

Background utama

Card background

Fungsi:

Ruang bernapas (negative space)

Fokus ke data

⚫ Dark Gray / Soft Black

Digunakan untuk:

Heading

Angka KPI

Label utama

📌 Bukan hitam murni → lebih nyaman di mata.

⚪ Light Gray

Digunakan untuk:

Divider

Axis chart

Secondary text

Border card

📌 Membantu hierarki tanpa visual noise.

5. Sistem Warna Funnel (Pipeline by Stage)

Urutan warna bar chart:

Prospecting → hijau sangat muda

Qualified → hijau muda

Proposal → hijau sedang

Negotiation → hijau lebih gelap

Closed → hijau paling gelap

Makna:

Progress visual → makin gelap = makin dekat ke closing

Secara psikologis terasa “naik level”

📌 Ini sangat bagus secara UX & storytelling data.

6. Konsistensi & Kematangan Design System

Ciri desain warna ini:
✅ Monokromatik (variasi satu warna utama)
✅ Aman untuk enterprise
✅ Mudah di-scale
✅ Tidak melelahkan mata

Ini tipikal:

SaaS B2B

CRM / ERP

Finance / Analytics tools

7. Ringkasan Singkat

Warna pada desain ini bukan dekorasi, tapi sistem komunikasi.

Hijau → growth & health

Gradasi → progress

Merah → exception

Putih & abu → fokus data

admin1@gmail.com
adminsatu