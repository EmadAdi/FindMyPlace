
<!-- components/admin-navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
  <span class="navbar-brand mb-0 h1">لوحة التحكم</span>
  <div class="ms-auto">
    <span class="text-muted">مرحبًا، {{ Auth::user()->name }}</span>
  </div>
</nav>
