
<x-layouts.admin-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>العقارات</h3>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">+ إنشاء عقار</a>
  </div>

  <table class="table table-bordered table-striped text-right bg-white">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>النوع</th>
        <th>المساحة</th>
        <th>السعر</th>
        <th>الخيارات</th>
      </tr>
    </thead>
    <tbody>
      @forelse($properties as $property)
        <tr>
          <td>{{ $property->id }}</td>
          <td>{{ $property->name }}</td>
          <td>{{ $property->type }}</td>
          <td>{{ $property->area }} م²</td>
          <td>${{ number_format($property->price, 2) }}</td>
          <td>
            <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-warning">تعديل</a>
            <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">حذف</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6">لا توجد عقارات حالياً</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $properties->links() }}
  </div>
</x-layouts.admin-app>
