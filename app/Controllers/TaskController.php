<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class TaskController extends ResourceController
{
    use ResponseTrait;

    protected TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $tasks = $this->taskModel->where('user_id', $userId)->findAll();

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->respond($tasks);
        }
        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function showCreateForm()
    {
        return view('tasks/create');
    }

    public function create()
    {
        $rules = [
            'title'       => 'required|min_length[3]',
            'description' => 'permit_empty|max_length[500]',
            'status'      => 'required|in_list[pending,completed]',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'user_id'     => session()->get('user_id'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?? '',
            'status'      => $this->request->getPost('status'),
        ];

        $id = $this->taskModel->insert($data);

        if ($id) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respondCreated(['message' => 'Task created', 'id' => $id]);
            }
            return redirect()->to('/tasks')->with('success', 'Task created successfully!');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->failServerError('Failed to create task');
        }
        return redirect()->back()->with('error', 'Failed to create task');
    }

    public function showEditForm($id = null)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        return view('tasks/edit', ['task' => $task]);
    }

    public function show($id = null)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failNotFound('Task not found');
            }
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->respond($task);
        }
        return view('tasks/view', ['task' => $task]);
    }

    public function update($id = null)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failNotFound('Task not found');
            }
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        $rules = [
            'title'       => 'required|min_length[3]',
            'description' => 'permit_empty|max_length[500]',
            'status'      => 'required|in_list[pending,completed]',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?? '',
            'status'      => $this->request->getPost('status'),
        ];

        $success = $this->taskModel->update($id, $data);

        if ($success) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respondUpdated(['message' => 'Task updated']);
            }
            return redirect()->to('/tasks')->with('success', 'Task updated successfully!');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->failServerError('Failed to update task');
        }
        return redirect()->back()->with('error', 'Failed to update task');
    }

    public function delete($id = null)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failNotFound('Task not found');
            }
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        $success = $this->taskModel->delete($id);

        if ($success) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respondDeleted(['message' => 'Task deleted']);
            }
            return redirect()->to('/tasks')->with('success', 'Task deleted successfully!');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->failServerError('Failed to delete task');
        }
        return redirect()->to('/tasks')->with('error', 'Failed to delete task');
    }
}