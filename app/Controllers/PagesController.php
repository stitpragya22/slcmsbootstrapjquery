<?php

namespace App\Controllers;

use App\Models\CmsPageModel;

class PagesController extends BaseController
{
    protected CmsPageModel $pageModel;

    public function __construct()
    {
        $this->pageModel = new CmsPageModel();
    }

    /**
     * List all custom pages
     */
    public function index()
    {
        $pages = $this->pageModel->orderBy('created_at', 'DESC')->findAll();

        return view('admin/pages/index', [
            'pages' => $pages,
            'title' => 'Custom Pages Management',
        ]);
    }

    /**
     * Show create page form
     */
    public function create()
    {
        return view('admin/pages/create', [
            'title' => 'Create New Custom Page',
        ]);
    }

    /**
     * Store new page
     */
    public function store()
    {
        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'slug'  => 'required|min_length[2]|max_length[255]|is_unique[cms_pages.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('slug'), '-', true);

        $this->pageModel->insert([
            'title'            => $this->request->getPost('title'),
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'is_published'     => $this->request->getPost('is_published') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/pages'))->with('message', 'Page created successfully!');
    }

    /**
     * Show edit page form
     */
    public function edit(int $id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to(base_url('admin/pages'))->with('error', 'Page not found.');
        }

        return view('admin/pages/edit', [
            'page'  => $page,
            'title' => 'Edit Custom Page: ' . $page['title'],
        ]);
    }

    /**
     * Update existing page
     */
    public function update(int $id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to(base_url('admin/pages'))->with('error', 'Page not found.');
        }

        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'slug'  => "required|min_length[2]|max_length[255]|is_unique[cms_pages.slug,id,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('slug'), '-', true);

        $this->pageModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'is_published'     => $this->request->getPost('is_published') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/pages'))->with('message', 'Page updated successfully!');
    }

    /**
     * Delete page
     */
    public function delete(int $id)
    {
        $page = $this->pageModel->find($id);
        if ($page) {
            $this->pageModel->delete($id);
            return redirect()->to(base_url('admin/pages'))->with('message', 'Page deleted successfully.');
        }

        return redirect()->to(base_url('admin/pages'))->with('error', 'Page not found.');
    }

    /**
     * Toggle published state
     */
    public function toggle(int $id)
    {
        $page = $this->pageModel->find($id);
        if ($page) {
            $newStatus = $page['is_published'] ? 0 : 1;
            $this->pageModel->update($id, ['is_published' => $newStatus]);
            return redirect()->to(base_url('admin/pages'))->with('message', 'Status updated successfully.');
        }

        return redirect()->to(base_url('admin/pages'))->with('error', 'Page not found.');
    }
}
