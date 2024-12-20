<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm vấn đề mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Thêm vấn đề mới</h1>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="computer_id" class="form-label">Máy tính</label>
                <select id="computer_id" name="computer_id" class="form-select">
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="reported_by" class="form-label">Người báo cáo</label>
                <input type="text" id="reported_by" name="reported_by" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="reported_date" class="form-label">Ngày báo cáo</label>
                <input type="datetime-local" id="reported_date" name="reported_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="urgency" class="form-label">Mức độ</label>
                <select id="urgency" name="urgency" class="form-select">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select id="status" name="status" class="form-select">
                    <option value="Open">Open</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="{{ route('issues.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>