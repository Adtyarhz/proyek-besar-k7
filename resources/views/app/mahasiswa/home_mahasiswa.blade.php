@extends('layouts.mahasiswa')

@section('title', 'Beranda')

@section('content')
<!-- Carousel Section -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img alt="Campus view" src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Plaza_IT_Del.jpg"
        class="d-block w-100" />
    </div>
    <div class="carousel-item">
      <img alt="Alternate campus view" src="https://www.del.ac.id/wp-content/uploads/2024/09/A3A0079-1024x683.jpg"
        class="d-block w-100" />
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Content -->
<div class="content">
  <div class="container">
    <h2 class="text-center">Jumlah Mahasiswa</h2>
    <div class="row student-count">
      <div class="col-3">
        <div class="count-item">
          <p>Angkatan 2021</p>
          <i class="fas fa-users"></i>
          <p>250</p>
        </div>
      </div>
      <div class="col-3">
        <div class="count-item">
          <p>Angkatan 2022</p>
          <i class="fas fa-users"></i>
          <p>300</p>
        </div>
      </div>
      <div class="col-3">
        <div class="count-item">
          <p>Angkatan 2023</p>
          <i class="fas fa-users"></i>
          <p>200</p>
        </div>
      </div>
      <div class="col-3">
        <div class="count-item">
          <p>Angkatan 2024</p>
          <i class="fas fa-users"></i>
          <p>220</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!---Section Persebaran-->
<div class="container2">
  <h2>Persebaran Mahasiswa KP</h2>
  <div class="charts-row">
    <div class="chart-container">
      <canvas id="barChart1"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="barChart2"></canvas>
    </div>
  </div>
</div>
@endsection