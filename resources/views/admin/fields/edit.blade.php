@php /** @var \App\Models\SportsField $field */ @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StomSport - Edit Field - {{ $field->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f2f1, #e3f2fd);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .edit-wrapper {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 1100px;
            margin: auto;
        }

        /* ✅ PHẦN ẢNH - KHÔNG CÒN NỀN XANH */
        .edit-image {
            position: relative;
            overflow: hidden;
            padding: 0;
            min-height: 100%;
        }

        .edit-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .edit-image div {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            text-shadow: 0 0 8px rgba(0, 0, 0, 0.7);
            z-index: 2;
        }

        .form-side {
            padding: 40px 50px;
        }

        .form-side h3 {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn-primary {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
        }

        .btn-secondary {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="edit-wrapper row g-0">
            <!-- Image Side -->
            <div class="col-md-5 edit-image">
                @php
                $imagePath = $field->image
                ? $field->image
                : asset('images/fields/' . strtolower($field->sport_type) . '.jpg');
                @endphp

                <img id="fieldImage" src="{{ $imagePath }}" alt="{{ $field->sport_type }}"
                    style="width: 100%; height: 100%; object-fit: cover; display: block;">

                <div style="position: absolute; bottom: 20px; left: 20px; color: white; text-shadow: 0 0 8px rgba(0,0,0,0.7);">
                    <h1 style="font-weight: 600; font-size: 2rem; margin-bottom: 5px;">Chỉnh sửa sân thể thao</h1>
                    <p id="sportTypeText" style="font-size: 1.1rem; margin: 0;">{{ ucfirst($field->sport_type) }}</p>
                </div>
            </div>


            <!-- Form Side -->
            <div class="col-md-7 form-side">
                <h3 class="mb-3">{{ $field->name }}</h3>
                <form method="POST" action="{{ route('admin.fields.update', $field->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên sân</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $field->name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Loại thể thao</label>
                            @php $sportOptions = ['football','cricket','badminton','paddle','tabletennis','basketball','tennis']; @endphp
                            <select name="sport_type" class="form-select" required>
                                @foreach($sportOptions as $opt)
                                <option value="{{ $opt }}" {{ old('sport_type', $field->sport_type) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="text" class="form-control" name="location" value="{{ old('location', $field->location) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address', $field->address) }}">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kích thước</label>
                            @php $sizeOptions = ['Full Size','Half Size','Mini','Single Court','Double Court']; @endphp
                            <select name="size" class="form-select">
                                @foreach($sizeOptions as $opt)
                                <option value="{{ $opt }}" {{ old('size', $field->size) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Bề mặt sân</label>
                            @php $surfaceOptions = ['Indoor Court','Outdoor Court','Turf','Grass','Hardcourt','Clay']; @endphp
                            <select name="surface" class="form-select">
                                @foreach($surfaceOptions as $opt)
                                <option value="{{ $opt }}" {{ old('surface', $field->surface) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ old('status', $field->status) === 'active' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="maintenance" {{ old('status', $field->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="unavailable" {{ old('status', $field->status) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Loại</label>
                        @php $typeOptions = ['indoor','outdoor']; @endphp
                        <select name="type" class="form-select" required>
                            @foreach($typeOptions as $opt)
                            <option value="{{ $opt }}" {{ old('type', $field->type) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thời gian mở cửa</label>
                            <input type="time" class="form-control" name="opening_time" value="{{ old('opening_time', \Carbon\Carbon::parse($field->opening_time)->format('H:i')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thời gian đóng cửa</label>
                            <input type="time" class="form-control" name="closing_time" value="{{ old('closing_time', \Carbon\Carbon::parse($field->closing_time)->format('H:i')) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Giá thuê cơ bản (90 phút)</label>
                        <input type="number" min="0" step="1" class="form-control" name="price_per_90min" value="{{ old('price_per_90min', (int) $field->price_per_90min) }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.fields.index') }}" class="btn btn-secondary px-4">Hủy</a>
                        <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sportSelect = document.querySelector("select[name='sport_type']");
        const imageElement = document.getElementById("fieldImage");
        const sportText = document.getElementById("sportTypeText");

        sportSelect.addEventListener("change", function() {
            const selected = this.value.toLowerCase();

            // Đường dẫn ảnh trong thư mục public/images/fields/
            const newImagePath = "{{ asset('images/fields') }}/" + selected + ".jpg";

            // Cập nhật ảnh & tên hiển thị
            imageElement.src = newImagePath;
            sportText.textContent = selected.charAt(0).toUpperCase() + selected.slice(1);
        });
    });
</script>

</html>