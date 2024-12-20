<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa vấn đề</title>
</head>
<body>
    <h1>Chỉnh sửa vấn đề</h1>
    <form action="{{ route('issues.update', $issue->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="computer_id">Tên máy tính:</label>
        <select name="computer_id">
            @foreach($computers as $computer)
                <option value="{{ $computer->id }}" {{ $issue->computer_id == $computer->id ? 'selected' : '' }}>
                    {{ $computer->computer_name }}
                </option>
            @endforeach
        </select>
        
        <label for="reported_by">Người báo cáo:</label>
        <input type="text" name="reported_by" value="{{ $issue->reported_by }}">
        
        <label for="description">Mô tả:</label>
        <textarea name="description">{{ $issue->description }}</textarea>
        
        <label for="urgency">Mức độ:</label>
        <select name="urgency">
            <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
            <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
        </select>
        
        <label for="status">Trạng thái:</label>
        <select name="status">
            <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
            <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
        </select>
        
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>