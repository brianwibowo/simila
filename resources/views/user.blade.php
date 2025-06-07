<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Terima Kasih</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

  <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card p-5 text-center">
      <h1 class="mb-3 text-success">✅ Terima Kasih, {{ Auth::user()->name }}!</h1>
      <p class="lead">
        @if (Auth::user()->getRoleNames()->first() !== 'user')
            Pengajuan Akun sebagai {{ Auth::user()->getRoleNames()->first() }} berhasil, silahkan login ulang<br>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger mt-5">Logout</button>
            </form>
        @else
            Pengajuan akun berhasil. Silakan tunggu konfirmasi dari admin.<br>
        @endif
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
