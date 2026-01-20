<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Validation\Exceptions\ValidationException;

class AuthController extends ResourceController
{
    use ResponseTrait;

    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // NEW: Show register form (web)
    public function showRegisterForm()
    {
        return view('auth/register', ['errors' => session()->getFlashdata('errors') ?? []]);
    }

    public function register()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',  // NEW: Confirm field
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            // Web: Flash errors and redirect back
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userId = $this->userModel->insert($data);

        if ($userId) {
            session()->set('user_id', $userId);
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respond(['message' => 'User registered successfully', 'user_id' => $userId]);
            }
            return redirect()->to('/tasks')->with('success', 'Registered successfully!');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->failServerError('Failed to register user');
        }
        return redirect()->back()->with('error', 'Failed to register user');
    }

    // NEW: Show login form (web)
    public function showLoginForm()
    {
        return view('auth/login', ['errors' => session()->getFlashdata('errors') ?? []]);
    }

    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respond(['message' => 'Login successful', 'user_id' => $user['id']]);
            }
            return redirect()->to('/tasks')->with('success', 'Logged in successfully!');
        }

        if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
            return $this->failUnauthorized('Invalid credentials');
        }
        return redirect()->back()->withInput()->with('error', 'Invalid credentials');
    }

    public function logout() { session()->destroy(); return redirect()->to('/login'); }
}