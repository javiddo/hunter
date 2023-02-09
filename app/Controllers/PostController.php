<?php
namespace App\Controllers;
use App\Models\PostModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class PostController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('post_add');
    }

    public function store()
    {
        $session = session();
        $postModel = new PostModel();

        helper(['form']);
        $rules = [
            'title'          => 'required|min_length[2]|max_length[50]',
            'description'         => 'required|min_length[4]|max_length[100]',
            'content'      => 'required|min_length[4]',
        ];

        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'title'     => $this->request->getVar('title'),
                'description'    => $this->request->getVar('description'),
                'content' => $this->request->getVar('content'),
                'owner_id' => $session->get('id')
            ];
            $postModel->save($data);
            return redirect()->to('/profile');
        }else{
            $data['validation'] = $this->validator;
            echo view('post_add', $data);
        }
    }

    public function edit($id)
    {
        $session = session();
        $db = \Config\Database::connect();
        $builder = $db->table('posts');
        $post = $builder->getWhere(['id'=> $id, 'owner_id'=>$session->get('id')])->getFirstRow();

        if(!$post)
        {
            echo 'Post not found';
            exit;
        }

        $data['id'] = $post->id;
        $data['title'] = $post->title;
        $data['description'] = $post->description;
        $data['content'] = $post->content;
        echo view('post_edit', $data);
    }

    public function update()
    {
        $session = session();
        $db = db_connect();
        $postModel = new PostModel($db);

        $id	= $this->request->getPost('id');
        $title	= $this->request->getPost('title');
        $description	= $this->request->getPost('description');
        $content		= $this->request->getPost('content');

        $data = [
            'title'		    => $title,
            'description'	=> $description,
            'content'		=> $content,
        ];

        $result = $postModel->update($id, $data);
        if($result) {
            $session->setFlashdata('msg', 'Post updated successfully.');
            return redirect()->to('/profile');
        } else {
            echo "Something went wrong";
        }
    }
}