<?php
namespace App\Controllers;
use App\Models\PostModel;
use CodeIgniter\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $session = session();
        echo "Hello : ".$session->get('name');
        echo '<hr>';
        echo '<form action="/profile"><input type="text" name="keyword"></form>';
        echo '<hr>';

        $db = \Config\Database::connect();
        $builder = $db->table('posts');
        $posts = $builder->getWhere(['owner_id'=> $session->get('id')])->getResult();

        if(isset($_GET['keyword']))
        {
            $posts = $builder->like('title', $this->request->getVar('keyword'))->getWhere(['owner_id'=> $session->get('id')])->getResult();
        }
        foreach ($posts as $p)
        {
            echo '<a href="post_edit/'.$p->id.'">'.$p->title . '</a><br>';
        }
    }
}