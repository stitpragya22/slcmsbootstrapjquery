<?php
// plugins/TaskManagerPlugin/TaskManagerPluginModel.php

namespace Plugins\TaskManagerPlugin;

use CodeIgniter\Model;

class TaskManagerPluginModel extends Model
{
    protected $table = 'tasks';
    protected $allowedFields = ['title', 'description'];

    public function __construct()
    {
        parent::__construct();

        // Check if the 'tasks' table exists
        if (!$this->db->tableExists($this->table)) {
            // If the table doesn't exist, create it
            $this->createTasksTable();
        }
    }

    private function createTasksTable()
    {
        $this->db->query(
            'CREATE TABLE tasks (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }
}
