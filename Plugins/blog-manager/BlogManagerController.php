<?php

namespace Plugins\BlogManager;

use App\Controllers\BaseController;

class BlogManagerController extends BaseController
{
    /**
     * Public Blog Directory & Feed
     */
    public function index()
    {
        $db = \Config\Database::connect();
        $posts = [];

        if ($db->tableExists('cms_blog_posts')) {
            $posts = $db->table('cms_blog_posts')
                ->where('is_published', 1)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();
        }

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Blog & Insights - SLCMS</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
            <style>
                body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; color: #0f172a; }
                .blog-card { border-radius: 16px; border: 1px solid #e2e8f0; transition: all 0.2s; overflow: hidden; background: #fff; }
                .blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px -4px rgba(15,23,42,0.1); }
                .blog-thumb { height: 200px; width: 100%; object-fit: cover; }
            </style>
        </head>
        <body>
            <header class="bg-white border-bottom py-4 mb-5">
                <div class="container d-flex justify-content-between align-items-center">
                    <a href="' . base_url() . '" class="text-dark fw-bold text-decoration-none fs-4">
                        <i class="fas fa-layer-group text-primary me-2"></i>SLCMS <span class="badge bg-primary fs-6">Blog</span>
                    </a>
                    <div>
                        <a href="' . base_url() . '" class="btn btn-sm btn-outline-secondary me-2">Home</a>
                        <a href="' . base_url('marketplace') . '" class="btn btn-sm btn-primary">Marketplace</a>
                    </div>
                </div>
            </header>

            <div class="container pb-5">
                <div class="text-center max-w-700 mx-auto mb-5">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-bold mb-2">ARTICLES & UPDATES</span>
                    <h1 class="fw-bold mb-2">Latest Insights & Stories</h1>
                    <p class="text-muted">Explore in-depth articles on architecture, plugin development, and web engineering.</p>
                </div>

                <div class="row g-4">';

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $img = $post['featured_image'] ?: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=800&q=80';
                $readUrl = base_url('addons/blog-manager/read/' . esc($post['slug']));

                $html .= '
                <div class="col-md-6 col-lg-4">
                    <div class="card blog-card h-100 shadow-sm">
                        <img src="' . esc($img) . '" class="blog-thumb" alt="' . esc($post['title']) . '">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-primary border small">' . esc($post['category']) . '</span>
                                <small class="text-muted"><i class="fas fa-eye me-1"></i>' . (int)$post['views_count'] . '</small>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">
                                <a href="' . $readUrl . '" class="text-dark text-decoration-none">' . esc($post['title']) . '</a>
                            </h5>
                            <p class="text-muted small flex-grow-1 mb-4">' . esc($post['excerpt']) . '</p>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted">By <strong>' . esc($post['author_name']) . '</strong></small>
                                <a href="' . $readUrl . '" class="btn btn-sm btn-outline-primary fw-bold">Read Article &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $html .= '<div class="col-12 text-center py-5 text-muted">No blog posts found.</div>';
        }

        $html .= '
                </div>
            </div>
        </body>
        </html>';

        $resp = $this->response ?? \Config\Services::response();
        return $resp->setContentType('text/html')->setBody($html);
    }

    /**
     * Single Article Reader View
     */
    public function read(string $slug = '')
    {
        $db = \Config\Database::connect();
        $post = null;

        if ($db->tableExists('cms_blog_posts') && !empty($slug)) {
            $post = $db->table('cms_blog_posts')->where('slug', $slug)->where('is_published', 1)->get()->getRowArray();
            if ($post) {
                // Increment views
                $db->table('cms_blog_posts')->where('id', $post['id'])->increment('views_count', 1);
            }
        }

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Blog post '{$slug}' not found.");
        }

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . esc($post['title']) . ' - SLCMS Blog</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
            <style>
                body { font-family: "Plus Jakarta Sans", sans-serif; background-color: #f8fafc; color: #0f172a; line-height: 1.8; }
                .article-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; }
                .article-cover { width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 30px; }
            </style>
        </head>
        <body>
            <header class="bg-white border-bottom py-3 mb-5">
                <div class="container d-flex justify-content-between align-items-center">
                    <a href="' . base_url('addons/blog-manager') . '" class="text-dark fw-bold text-decoration-none">
                        &larr; Back to All Articles
                    </a>
                    <a href="' . base_url() . '" class="btn btn-sm btn-outline-secondary">Home</a>
                </div>
            </header>

            <div class="container pb-5">
                <article class="article-container shadow-sm">
                    <span class="badge bg-primary mb-2">' . esc($post['category']) . '</span>
                    <h1 class="fw-bold mb-3">' . esc($post['title']) . '</h1>
                    <div class="d-flex align-items-center gap-3 text-muted small mb-4 pb-3 border-bottom">
                        <span><i class="fas fa-user me-1"></i>' . esc($post['author_name']) . '</span>
                        <span>&bull;</span>
                        <span><i class="fas fa-calendar-alt me-1"></i>' . date('F j, Y', strtotime($post['created_at'])) . '</span>
                        <span>&bull;</span>
                        <span><i class="fas fa-eye me-1"></i>' . (int)$post['views_count'] . ' views</span>
                    </div>

                    ' . ($post['featured_image'] ? '<img src="' . esc($post['featured_image']) . '" class="article-cover" alt="' . esc($post['title']) . '">' : '') . '

                    <div class="article-content fs-5 text-secondary">
                        ' . $post['content'] . '
                    </div>

                    <div class="pt-4 mt-5 border-top text-center">
                        <a href="' . base_url('addons/blog-manager') . '" class="btn btn-primary px-4">
                            <i class="fas fa-arrow-left me-1"></i> Back to Blog Directory
                        </a>
                    </div>
                </article>
            </div>
        </body>
        </html>';

        $resp = $this->response ?? \Config\Services::response();
        return $resp->setContentType('text/html')->setBody($html);
    }
}
