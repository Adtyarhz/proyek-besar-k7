@extends('layouts.mahasiswa')

@section('title', 'Informasi MBKM')

@section('content')
<style>
  html,
  body {
    height: 100%;
    /* Membuat tinggi halaman 100% */
    margin: 0;
    /* Menghapus margin default */
    display: flex;
    /* Menjadikan layout menggunakan flexbox */
    flex-direction: column;
    /* Mengatur layout secara vertikal */
  }

  body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
  }

  .navbar {
    background: linear-gradient(90deg, #0073e6, #003366);
  }

  .navbar-brand img {
    height: 50px;
  }

  .navbar-nav .nav-link {
    color: white !important;
    margin-right: 20px;
  }

  .navbar-nav .nav-link:hover {
    color: #cccccc !important;
  }

  .navbar .fa-bell {
    color: white;
    font-size: 24px;
    margin-right: 15px;
    /* Jarak antar ikon bel dan profil */
  }

  .navbar .fa-user-circle {
    color: white;
    font-size: 24px;
  }

  .navbar .notification-bell {
    position: relative;
  }

  .navbar .notification-badge {
    position: absolute;
    top: -10px;
    right: -5px;
    background-color: red;
    color: white;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 50%;
  }

  .navbar-toggler-icon {
    background-color: white;
    /* Menambahkan warna putih pada toggle icon */
  }

  /* Dropdown Styling */
  .navbar-nav .dropdown-menu {
    background-color: #003366;
  }

  .navbar-nav .dropdown-item {
    color: white;
  }

  .navbar-nav .dropdown-item:hover {
    background-color: #00508b;
  }

  .header {
    background: linear-gradient(to right, #6ba3d6, #4a90e2);
    color: white;
    padding: 40px 20px;
    text-align: center;
    border-radius: 10px;
    margin: 20px;
  }

  .header h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }

  .header p {
    font-size: 1.1rem;
  }

  .content {
    padding: 20px;
    text-align: center;
    margin: 20px;
    flex-grow: 1;
    /* Konten akan mengisi sisa ruang yang tersedia */
  }

  .carousel {
    max-width: 600px;
    margin: 0 auto;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .carousel img {
    max-width: 100%;
    height: auto;
  }

  .footer {
    background-color: #003366;
    /* Warna biru tua */
    padding: 20px 0;
    margin-top: auto;
    /* Menjaga footer tetap berada di bawah */
  }

  .footer h5 {
    font-weight: bold;
    font-size: 18px;
  }

  .footer p {
    font-size: 14px;
    margin: 0;
    color: #cccccc;
  }

  .footer a {
    text-decoration: none;
    color: white;
    transition: color 0.3s ease;
  }

  .footer .fab,
  .footer .fas {
    margin-right: 10px;
    transition: transform 0.3s ease;
  }

  .footer .fab:hover,
  .footer .fas:hover {
    transform: scale(1.2);
    /* Efek zoom saat hover */
  }

  .footer small {
    color: #aaaaaa;
    font-size: 12px;
  }

  .info-section {
    background: linear-gradient(to bottom,
        #e6f7ff,
        #ffffff);
    /* Gradien halus */
    padding: 50px 0;
  }

  .info-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
  }

  .info-box h5 {
    font-weight: bold;
    margin-bottom: 15px;
    font-size: 18px;
  }

  .info-box p {
    font-size: 14px;
    line-height: 1.6;
  }

  .img-fluid {
    max-width: 75%;
    height: auto;
  }
</style>

<!-- Information Section -->
<div class="info-section bg-light py-5">
  <div class="container" style="margin-top: 50px">
    <!-- Header Section -->
    <div class="container d-flex align-items-center justify-content-center mb-4" style="flex-wrap: nowrap">
      <!-- Gambar -->
      <div class="me-4">
        <img alt="Kampus Merdeka Indonesia Jaya logo" height="100"
          src="https://img.freepik.com/free-photo/programming-background-with-person-working-with-codes-computer_23-2150010125.jpg?t=st=1732605007~exp=1732608607~hmac=2bfac168aa63b3360a40e01a3762eb6b29ae57c413d0d6533c2e1d99a3f9e7ac&w=996"
          class="img-fluid" />
      </div>
      <!-- Teks -->
      <div>
        <p class="text-muted mb-0" style="font-size: 20px; max-width: 600px">
          Kerja Praktik (KP) adalah program pendidikan yang memberikan
          kesempatan bagi mahasiswa untuk mendapatkan pengalaman langsung di
          dunia industri atau lingkungan kerja profesional.
        </p>
      </div>
    </div>
    <br />
    <hr class="divider mb-5" style="border-top: 6px solid #f89b21" />
  </div>
</div>

<!-- Tujuan Section -->
<div class="header">
  <h2>Tujuan MBKM</h2>
  <div class="row">
    <div class="col-md-12">
      <p>
        <strong>1. Penerapan Teori ke Praktik:</strong> Mahasiswa dapat
        mengaplikasikan ilmu dan teori yang telah dipelajari di kampus ke
        dalam situasi nyata di dunia kerja.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        <strong>2. Pengembangan Keterampilan Profesional:</strong> Mahasiswa
        dapat mengembangkan soft skills dan hard skills, seperti komunikasi,
        manajemen waktu, pemecahan masalah, dan kerja tim.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        <strong>3. Pengenalan Dunia Kerja:</strong> Kerja praktik membantu
        mahasiswa memahami budaya kerja, struktur organisasi, dan etika
        profesional di tempat kerja.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        <strong>4. Memperluas Jaringan:</strong> Kesempatan untuk membangun
        relasi profesional dengan para praktisi di bidang terkait, yang bisa
        bermanfaat di masa depan, terutama dalam mencari pekerjaan.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        <strong>5. Mempersiapkan Karir:</strong> Mahasiswa dapat
        mengeksplorasi minat dan bidang yang ingin mereka tekuni setelah
        lulus, sekaligus meningkatkan daya saing di pasar kerja.
      </p>
    </div>
  </div>
</div>

<br />
<h3 class="text-center">Beberapa contoh Mitra dan Non Mitra</h3>
<div class="content">
  <div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
    <div class="carousel-indicators">
      <button aria-current="true" aria-label="Slide 1" class="active" data-bs-slide-to="0"
        data-bs-target="#carouselExampleIndicators" type="button"></button>
      <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleIndicators"
        type="button"></button>
      <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators"
        type="button"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img alt="Illustration of a modern city with buildings and trees" class="d-block w-100" height="400"
          src="https://i.ytimg.com/vi/GqEsw_losvE/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDgK60mad6TCYEPASbfqlyKscWO_A"
          width="600" />
      </div>
      <div class="carousel-item">
        <img alt="Illustration of a modern city with buildings and trees" class="d-block w-100" height="400"
          src="https://awsimages.detik.net.id/visual/2020/10/07/penghargaan-best-companies-to-work-for-yang-diterima-tokopedia-diberikan-atas-penilaian-karyawan-berdasarkan-metode-survei-tot-2_169.jpeg?w=650"
          width="600" />
      </div>
      <div class="carousel-item">
        <img alt="Illustration of a modern city with buildings and trees" class="d-block w-100" height="400"
          src="https://cdn0-production-images-kly.akamaized.net/LcyJlUBCIAy_fKJ7C_-GyWy6p1w=/800x450/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/956582/original/095526500_1439608365-Telkom.jpg"
          width="600" />
      </div>
    </div>
    <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
      type="button">
      <span aria-hidden="true" class="carousel-control-prev-icon"> </span>
      <span class="visually-hidden"> Previous </span>
    </button>
    <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators"
      type="button">
      <span aria-hidden="true" class="carousel-control-next-icon"> </span>
      <span class="visually-hidden"> Next </span>
    </button>
  </div>
</div>
@endsection