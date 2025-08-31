)
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">ویرایش کاربر</h1>
        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1">نام</label>
                <input type="text" name="name" value="{{ $user->name }}" class="border p-2 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">ایمیل</label>
                <input type="email" name="email" value="{{ $user->email }}" class="border p-2 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">تلفن</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="border p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label class="block mb-1">بیوگرافی</label>
                <textarea name="bio" class="border p-2 rounded w-full">{{ $user->bio }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1">آواتار</label>
                <input type="file" name="avatar" class="border p-2 rounded w-full">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="Avatar" class="w-20 h-20 mt-2">
                @endif
            </div>
            <div class="mb-4">
                <label class="block mb-1">وضعیت</label>
                <select name="status" class="border p-2 rounded w-full">
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1">نقش‌ها</label>
                @foreach ($roles as $role)
                    <label><input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}> {{ $role->name }}</label>
                @endforeach
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">ذخیره</button>
        </form>
    </div>
