<?php 
// plugins/TaskManagerPlugin/TaskManagerPluginController.php

namespace App\Plugins\TaskManagerPlugin;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
class TaskManagerPluginController extends Controller
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        // Assign the injected request object to the class property
        $this->request = $request;
    }
    public function index()
    {
        $model = new TaskManagerPluginModel();
        $data['tasks'] = $model->findAll();
        return view('App\Plugins\TaskManagerPlugin\Views\task_list', $data);
    }

    public function create()
    {
        helper('form');

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'max_length[1000]'
        ])) {
            $model = new TaskManagerPluginModel();
            $model->insert([
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ]);
        }

        return view('App\Plugins\TaskManagerPlugin\Views\create_task');
    }
}
