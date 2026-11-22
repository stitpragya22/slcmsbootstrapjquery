<?php

namespace Plugins\WebpMediaCompressor;

use App\Controllers\BaseController;

class WebpMediaCompressorController extends BaseController
{
    public function index()
    {
        $uploadDir = FCPATH . 'uploads/';
        $images = [];

        if (is_dir($uploadDir)) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($uploadDir));
            foreach ($files as $file) {
                if ($file->isFile()) {
                    $ext = strtolower($file->getExtension());
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
                        $relPath = str_replace(FCPATH, '', $file->getPathname());
                        $images[] = [
                            'path'     => $relPath,
                            'filename' => $file->getFilename(),
                            'size'     => round($file->getSize() / 1024, 2) . ' KB',
                            'ext'      => $ext,
                            'url'      => base_url($relPath),
                        ];
                    }
                }
            }
        }

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>WebP Media Compressor - SLCMS Plugin</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        </head>
        <body class="bg-light p-4">
            <div class="container max-w-1000">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-image me-2"></i>Media Gallery & WebP Image Optimizer</h5>
                        <a href="' . base_url('admin/marketplace') . '" class="btn btn-sm btn-outline-secondary">&larr; Marketplace</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info border-0 rounded-3 small mb-4">
                            <i class="fas fa-info-circle me-1"></i>Found <strong>' . count($images) . '</strong> image asset(s) in <code>public/uploads/</code>.
                        </div>
                        <div class="row g-3">';

        if (!empty($images)) {
            foreach ($images as $img) {
                $html .= '
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 border text-center p-2">
                        <img src="' . esc($img['url']) . '" class="img-fluid rounded mb-2" style="max-height: 120px; object-fit: contain;">
                        <small class="fw-bold text-truncate d-block" title="' . esc($img['filename']) . '">' . esc($img['filename']) . '</small>
                        <small class="text-muted">' . esc($img['size']) . ' <span class="badge bg-secondary">' . strtoupper($img['ext']) . '</span></small>
                    </div>
                </div>';
            }
        } else {
            $html .= '<p class="text-muted text-center py-4">No uploaded images found in <code>public/uploads/</code>.</p>';
        }

        $html .= '
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>';

        return $html;
    }
}
