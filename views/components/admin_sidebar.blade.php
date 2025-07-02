
<!-- components/admin-sidebar.blade.php -->
<aside class="position-fixed top-0 bottom-0 bg-dark text-white p-3" style="width:250px;">
  <h4 class="text-white">القائمة</h4>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">لوحة التحكم</a></li>
    <li class="nav-item"><a href="{{ route('admin.properties.index') }}" class="nav-link text-white">العقارات</a></li>
    <li class="nav-item"><a href="{{ route('admin.discounts.index') }}" class="nav-link text-white">الخصومات</a></li>
    <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link text-white">المستخدمون</a></li>
    <li class="nav-item"><a href="{{ route('admin.bookings.index') }}" class="nav-link text-white">الحجوزات</a></li>
    <li class="nav-item"><a href="{{ route('admin.requests.index') }}" class="nav-link text-white">الطلبات</a></li>
    <li class="nav-item"><a href="{{ route('admin.contract.index') }}" class="nav-link text-white">العقود</a></li>
  </ul>
</aside>
