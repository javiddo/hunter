<?php
namespace App\Models;
use CodeIgniter\Model;

class PostModel extends Model{
    protected $table = 'posts';

    protected $allowedFields = [
        'id',
        'title',
        'description',
        'content',
        'owner_id',
        'created_at'
    ];

    public function getPosts($slug = false)
    {
        return $this->all();
    }
}