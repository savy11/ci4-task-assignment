<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'title', 'description', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'title'       => 'required|min_length[3]',
        'description' => 'permit_empty|max_length[500]',
        'status'      => 'required|in_list[pending,completed]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}