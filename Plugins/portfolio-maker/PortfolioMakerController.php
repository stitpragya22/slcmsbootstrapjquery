<?php

namespace Plugins\PortfolioMaker;

use App\Controllers\BaseController;

class PortfolioMakerController extends BaseController
{
    /**
     * Public Portfolio Showcase Grid
     */
    public function index()
    {
        $db = \Config\Database::connect();
        $projects = [];

        if ($db->tableExists('cms_portfolio_projects')) {
            $projects = $db->table('cms_portfolio_projects')
                ->where('is_featured', 1)
                ->orderBy('completion_date', 'DESC')
                ->get()
                ->getResultArray();
        }

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Work & Portfolio - SLCMS</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
            <style>
                body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; color: #0f172a; }
                .portfolio-card { border-radius: 16px; border: 1px solid #e2e8f0; transition: all 0.25s ease; overflow: hidden; background: #fff; }
                .portfolio-card:hover { transform: translateY(-5px); box-shadow: 0 16px 32px -4px rgba(15,23,42,0.12); }
                .portfolio-thumb { height: 220px; width: 100%; object-fit: cover; }
            </style>
        </head>
        <body>
            <header class="bg-white border-bottom py-4 mb-5">
                <div class="container d-flex justify-content-between align-items-center">
                    <a href="' . base_url() . '" class="text-dark fw-bold text-decoration-none fs-4">
                        <i class="fas fa-layer-group text-primary me-2"></i>SLCMS <span class="badge bg-dark fs-6">Portfolio</span>
                    </a>
                    <div>
                        <a href="' . base_url() . '" class="btn btn-sm btn-outline-secondary me-2">Home</a>
                        <a href="' . base_url('marketplace') . '" class="btn btn-sm btn-primary">Marketplace</a>
                    </div>
                </div>
            </header>

            <div class="container pb-5">
                <div class="text-center max-w-700 mx-auto mb-5">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-bold mb-2">FEATURED WORK & CASE STUDIES</span>
                    <h1 class="fw-bold mb-2">Our Creative Portfolio</h1>
                    <p class="text-muted">A showcase of modern web applications, UI/UX designs, and enterprise systems.</p>
                </div>

                <div class="row g-4">';

        if (!empty($projects)) {
            foreach ($projects as $proj) {
                $img = $proj['cover_image'] ?: 'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?auto=format&fit=crop&w=800&q=80';

                $html .= '
                <div class="col-md-6 col-lg-4">
                    <div class="card portfolio-card h-100 shadow-sm">
                        <img src="' . esc($img) . '" class="portfolio-thumb" alt="' . esc($proj['title']) . '">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary-subtle text-primary border small">' . esc($proj['category']) . '</span>
                                <small class="text-muted"><i class="fas fa-user-tie me-1"></i>' . esc($proj['client_name'] ?? 'Client') . '</small>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">' . esc($proj['title']) . '</h5>
                            <p class="text-muted small flex-grow-1 mb-4">' . esc($proj['description']) . '</p>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>' . date('M Y', strtotime($proj['completion_date'])) . '</small>
                                ' . ($proj['project_url'] ? '<a href="' . esc($proj['project_url']) . '" target="_blank" class="btn btn-sm btn-outline-primary fw-bold"><i class="fas fa-external-link-alt me-1"></i>View Project</a>' : '') . '
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $html .= '<div class="col-12 text-center py-5 text-muted">No portfolio projects found.</div>';
        }

        $html .= '
                </div>
            </div>
        </body>
        </html>';

        $resp = $this->response ?? \Config\Services::response();
        return $resp->setContentType('text/html')->setBody($html);
    }
}
