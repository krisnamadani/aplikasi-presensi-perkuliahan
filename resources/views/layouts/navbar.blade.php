<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Aplikasi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/presensi">Presensi</a>
        </li>
      </ul>
      <span class="navbar-text ms-auto">
        <form action="/logout" method="POST" style="display: inline;">
          @csrf
          <a href="javascript:void(0)" onclick="this.closest('form').submit()" class="nav-link" style="font-size: 16px; text-decoration: none;">Logout</a>
        </form>
      </span>
    </div>
  </div>
</nav>
