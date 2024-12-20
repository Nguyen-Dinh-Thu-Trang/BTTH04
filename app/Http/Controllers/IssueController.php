<?php

namespace App\Http\Controllers;
use App\Models\computer;
use App\Models\issue;
use Illuminate\Http\Request;
use PHPUnit\Runner\Baseline\Issue as BaselineIssue;

class IssueController extends Controller
{
    // Hiển thị danh sách có phân trang 10 bản ghi
    public function index()
    {
        $issues = issue::join('computers',  'issues.computer_id', '=', 'computers.id') // join: kết hợp bảng issue với computer, cột computer_id ở bảng issues kết nối (=) với cột id trong bảng computers
        ->select(
            'issues.id',
            'computers.computer_name',
            'computers.model',
            'issues.reported_by',
            'issues.reported_date',
            'issues.urgency',
            'issues.status'
            
        ) // hiển thị dữ liệu các cột
        ->paginate(10);
        return view('issues.index', compact('issues'));
    }

    // Hiển thị form thêm vấn đề mới
    public function create()
    {
        $computers = computer::all();
        return view('issues.create', compact('computers'));

    }

    // Lưu vấn đề mớI
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'computer_name' => 'required|string|max:50', // trường computer_name bắt buộc, kiểu string, kí tự tối đa 50
            'model' => 'required|string|max:100',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date_format:Y-m-d H:i:s',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|boolean'
        ]);

        // Tạo một bản ghi mới trong issues
        issue::create([
            'computer_id' => $validated['computer_id'],
            'computer_name' => $validated['computer_name'],
            'model' => $validated['model'],
            'reported_by' => $validated['reported_by'],
            'reported_date' => $validated['reported_date'],
            'urgency' => $validated['urgency'],            
            'status' => 'Open', // Mặc định trạng thái ban đầu là Open
        ]);

        // Chuyển hướng về danh sách báo thêm thành công
        return redirect()->route('issues.index')->with('success', 'Thêm vấn đề thành công!');
    }

    // Hiển thị chi tiết một vấn đề cụ thể
    public function show(string $id)
    {
        // Tìm vấn đề dựa trên id, kết hợp với thông tin từ bảng computers
        $issues = issue::join('computers',  'issues.computer_id', '=', 'computers.id') // join: kết hợp bảng issue với computer, cột computer_id ở bảng issues kết nối (=) với cột id trong bảng computers
        ->select(
            'issues.id',
            'computers.computer_name',
            'computers.model',
            'issues.reported_by',
            'issues.reported_date',
            'issues.urgency',
            'issues.status'
        )
        ->where('issues.id', $id) // Lọc vấn đề theo id
        ->firstOrFail(); // Trả về bản ghi đầu tiên hoặc lỗi nếu không tìm thấy

    // Trả về view để hiển thị chi tiết vấn đề
    return view('issues.show', compact('issues'));
    }

    // Hiển thị form chỉnh sửa
    public function edit(string $id)
    {
        $issue = issue::findOrFail($id); // Tìm vấn đề theo id
        $computers = computer::all(); // Lấy danh sách máy tính
        return view('issues.edit', compact('issue', 'computers'));
    }

    // Cập nhật thông tin vấn đề
    public function update(Request $request, string $id)
    {
        // Kiểm tra dữ liệu đầu vào
        $validated = $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'computer_name' => 'required|string|max:50', // trường computer_name bắt buộc, kiểu string, kí tự tối đa 50
            'model' => 'required|string|max:100',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date_format:Y-m-d H:i:s',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved'        
        ]);

        // Tìm đối tượng cần cập nhật
        $issues = Issue::findOrFail($id);

        // Cập nhật thông tin
        $issues->update($validated);
    
        // Điều hướng trở lại trang index với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Cập nhật vấn đề thành công!');
    }

    // Xoá vấn đề
    public function destroy(string $id)
    {
        $issues = Issue::findOrFail($id);
        $issues->delete();

        return redirect()->route('issues.index')->with('success', 'Đồ án đã được xóa thành công!');

    }
}
