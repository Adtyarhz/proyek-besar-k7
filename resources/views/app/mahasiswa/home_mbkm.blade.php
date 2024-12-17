@extends('layouts.mahasiswa')

@section('title', 'Informasi MBKM')

@section('content')
<style>
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

  .header {
    background: linear-gradient(to right, #6ba3d6, #4a90e2);
    color: white;
    padding: 40px 20px;
    text-align: center;
    border-radius: 10px;
    margin: 20px;
  }
</style>

<!-- Information Section -->
<div class="info-section bg-light py-5">
  <div class="container" style="margin-top: 50px">
    <!-- Header Section -->
    <div class="container d-flex align-items-center justify-content-center mb-4" style="flex-wrap: nowrap">
      <!-- Gambar -->
      <div class="me-4">
        <a href="https://pusatinformasi.kampusmerdeka.kemdikbud.go.id/hc/id" target="_blank">
          <img alt="Kampus Merdeka Indonesia Jaya logo" height="100"
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Logo_Kampus_Merdeka_Kemendikbud.png/800px-Logo_Kampus_Merdeka_Kemendikbud.png"
            class="img-fluid" />
        </a>
      </div>

      <!-- Teks -->
      <div>
        <p class="text-muted mb-0" style="font-size: 20px; max-width: 600px">
          Merdeka Belajar Kampus Merdeka (MBKM) adalah kebijakan yang
          dicanangkan oleh Kementerian Pendidikan, Kebudayaan, Riset, dan
          Teknologi (Kemendikbudristek) Indonesia. MBKM menawarkan berbagai
          program yang memungkinkan mahasiswa untuk mengembangkan
          keterampilan sesuai dengan minat dan bakat mereka, serta
          memperoleh pengalaman praktis di luar kampus.
        </p>
      </div>
    </div>
    <br />
    <hr class="divider mb-5" style="border-top: 6px solid #f89b21" />

    <!-- Info Boxes Section -->
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="info-box shadow p-4 h-100 bg-white rounded">
          <div class="text-center mb-3">
            <i class="fas fa-handshake fa-3x text-primary"></i>
          </div>
          <h5 class="text-center" style="color: #003366">MBKM Mitra</h5>
          <p class="text-muted">
            MBKM Mitra adalah program yang dilaksanakan oleh perguruan
            tinggi bekerja sama dengan mitra eksternal yang telah disetujui
            atau didaftarkan oleh Kemendikbudristek. Mitra eksternal ini
            bisa berupa perusahaan, organisasi, startup, lembaga pemerintah,
            atau institusi lainnya yang telah menjalin kerja sama resmi
            dengan universitas atau Kemendikbudristek.
          </p>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="info-box shadow p-4 h-100 bg-white rounded">
          <div class="text-center mb-3">
            <i class="fas fa-briefcase fa-3x text-success"></i>
          </div>
          <h5 class="text-center" style="color: #003366">MBKM Non Mitra</h5>
          <p class="text-muted">
            MBKM Non Mitra adalah program yang tidak secara langsung
            difasilitasi oleh mitra resmi yang terdaftar di
            Kemendikbudristek. Namun, mahasiswa dapat memilih untuk magang
            atau terlibat dalam proyek yang diselenggarakan oleh organisasi
            atau perusahaan yang tidak memiliki kerja sama formal dengan
            kampus atau Kemendikbudristek.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tujuan Section -->
<div class="header">
  <h2>Tujuan MBKM </h2>
  <div class="row">
    <div class="col-md-12">
      <p>
        1. Meningkatkan kompetensi lulusan sehingga mahasiswa memiliki
        keterampilan yang siap kerja.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        2. Mendorong pembelajaran fleksibel dengan memfasilitasi mahasiswa
        untuk mengambil pembelajaran di luar program studi atau di luar
        kampus.
      </p>
    </div>
    <div class="col-md-12">
      <p>
        3. Meningkatkan daya saing lulusan melalui pengalaman kerja nyata.
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