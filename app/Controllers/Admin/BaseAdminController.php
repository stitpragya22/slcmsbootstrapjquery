<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseAdminController extends BaseController
{
    protected $currentUser;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->currentUser = auth()->user();
    }

    /**
     * Upload an image safely using CI4 file service
     */
    protected function uploadImage(string $fieldName, string $folder = 'images', int $maxSizeKb = 5120): ?string
    {
        $file = $this->request->getFile($fieldName);
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext = strtolower($file->getExtension());

        if (!in_array($ext, $allowedExts, true)) {
            return null;
        }

        if ($file->getSizeByUnit('kb') > $maxSizeKb) {
            return null;
        }

        $targetPath = FCPATH . 'uploads/' . trim($folder, '/');
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($targetPath, $newName);

        return $newName;
    }

    /**
     * Upload a file safely using CI4 file service
     */
    protected function uploadFile(string $fieldName, string $folder = 'files', array $allowedExts = ['pdf', 'doc', 'docx', 'zip', 'xlsx', 'csv'], int $maxSizeKb = 10240): ?string
    {
        $file = $this->request->getFile($fieldName);
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $ext = strtolower($file->getExtension());
        if (!in_array($ext, $allowedExts, true)) {
            return null;
        }

        if ($file->getSizeByUnit('kb') > $maxSizeKb) {
            return null;
        }

        $targetPath = FCPATH . 'uploads/' . trim($folder, '/');
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($targetPath, $newName);

        return $newName;
    }

    protected function flashSuccess(string $message): void
    {
        session()->setFlashdata('mtype', 'success');
        session()->setFlashdata('message', $message);
    }

    protected function flashError(string $message): void
    {
        session()->setFlashdata('mtype', 'danger');
        session()->setFlashdata('message', $message);
    }
}
