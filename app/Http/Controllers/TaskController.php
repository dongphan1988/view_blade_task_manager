<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request){
        //Khởi tạo mới đối tượng task, gán các trường tương ứng với request gửi lên từ trình duyệt
        $task = new Task();
        $task->title = $request->inputTitle;
        $task->content = $request->inputContent;

        // Nếu file không tồn tại thì trường image gán bằng NULL
        if (!$request->hasFile('inputFile')) {
            $task->image = $request->inputFile;
        } else {
            $file = $request->file('inputFile');

            //Lấy ra định dạng và tên mới của file từ request
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = $request->inputFileName;

            // Gán tên mới cho file trước khi lưu lên server
            $newFileName = "$fileName.$fileExtension";

            //Lưu file vào thư mục storage/app/public/image với tên mới
            $request->file('inputFile')->storeAs('public/images', $newFileName);

            // Gán trường image của đối tượng task với tên mới
            $task->image = $newFileName;
        }
        $task->save();

//        $message = "Tạo Task $request->inputTitle thành công!";
//        Session::flash('create-success', $message);

        return redirect()->route('tasks.index', compact('message'));
    }
}
