<!DOCTYPE html>
<html lang="en">
    <head>
        @include('template.head')
    </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @php
          $currentRole = (Auth::check() && Auth::user()->getRoleNames()->isNotEmpty()) ? Auth::user()->getRoleNames()->first() : 'admin';
      @endphp
      @if(view()->exists('components.' . $currentRole . '.sidebar'))
          @include('components.' . $currentRole . '.sidebar')
      @else
          @include('components.admin.sidebar')
      @endif
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            @include('template.logo-header')
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          @include('template.navbar-header')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            {{-- Start from here. --}}
            @yield('content')
          </div>
        </div>

        <footer class="footer">
          @include('template.footer')
        </footer>
      </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; background-color: var(--card-bg, #ffffff);">
          <div class="modal-body text-center p-4">
            <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
              <i class="fas fa-sign-out-alt fa-2x"></i>
            </div>
            <h5 class="fw-bold mb-2 text-dark" id="logoutConfirmModalLabel">Konfirmasi Keluar</h5>
            <p class="text-muted mb-4" style="font-size: 0.86rem; line-height: 1.5;">
              Apakah Anda yakin ingin keluar dari sistem <strong>SIMILA</strong>? Anda perlu login kembali untuk mengakses akun.
            </p>
            <div class="d-flex justify-content-center gap-2">
              <button type="button" class="btn btn-light rounded-pill px-4 fw-medium" data-bs-dismiss="modal" style="font-size: 0.85rem; border: 1px solid var(--border-color, #e2e8f0);">
                Batal
              </button>
              <button type="button" id="confirmLogoutSubmitBtn" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" style="font-size: 0.85rem; background: linear-gradient(135deg, #ef4444, #dc2626); border: none;">
                <i class="fas fa-sign-out-alt me-1"></i> Ya, Keluar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('template.script')
   
   {{-- Stack for page-specific scripts --}}
   @stack('scripts')
  </body>
</html>