<?php

namespace Plugins\SeoOptimizer;

use App\Controllers\BaseController;

class SeoOptimizerController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $modules = [];
        if ($db->tableExists('cms_modules')) {
            $modules = $db->table('cms_modules')->where('is_active', 1)->get()->getResultArray();
        }

        $sitemapUrl = base_url('addons/seo-optimizer/sitemap');
        $robotsUrl  = base_url('addons/seo-optimizer/robots');

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>SEO Master - SLCMS Plugin</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        </head>
        <body class="bg-light p-4">
            <div class="container max-w-800">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-search me-2"></i>SEO Master & Sitemap Generator</h5>
                        <a href="' . base_url('admin/marketplace') . '" class="btn btn-sm btn-outline-secondary">&larr; Marketplace</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card border p-3 h-100">
                                    <h6 class="fw-bold mb-2"><i class="fas fa-sitemap text-success me-2"></i>Dynamic XML Sitemap</h6>
                                    <p class="text-muted small">Auto-generated XML sitemap incorporating active CMS modules and pages.</p>
                                    <a href="' . $sitemapUrl . '" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-1"></i>View sitemap.xml
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border p-3 h-100">
                                    <h6 class="fw-bold mb-2"><i class="fas fa-robot text-info me-2"></i>Virtual robots.txt</h6>
                                    <p class="text-muted small">Standard search-engine crawler directives for Googlebot & Bingbot.</p>
                                    <a href="' . $robotsUrl . '" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-1"></i>View robots.txt
                                    </a>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3">Indexed Active Modules in Sitemap (' . count($modules) . ')</h6>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-home me-2 text-primary"></i>Homepage (<code>/</code>)</span>
                                <span class="badge bg-success">Priority 1.0</span>
                            </li>';

        foreach ($modules as $m) {
            $html .= '
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fas fa-' . esc($m['icon'] ?: 'folder') . ' me-2 text-secondary"></i>' . esc($m['name']) . ' (<code>/' . esc($m['slug']) . '</code>)</span>
                <span class="badge bg-primary">Priority 0.8</span>
            </li>';
        }

        $html .= '
                        </ul>
                    </div>
                </div>
            </div>
        </body>
        </html>';

        return $html;
    }

    public function sitemap()
    {
        $db = \Config\Database::connect();
        $urls = [
            ['loc' => base_url(), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => base_url('marketplace'), 'priority' => '0.9', 'changefreq' => 'daily'],
        ];

        if ($db->tableExists('cms_modules')) {
            $modules = $db->table('cms_modules')->where('is_active', 1)->get()->getResultArray();
            foreach ($modules as $m) {
                $urls[] = [
                    'loc' => base_url('admin/' . $m['slug']),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . esc($u['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $u['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return $this->response->setContentType('application/xml')->setBody($xml);
    }

    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /writable/\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . base_url('addons/seo-optimizer/sitemap') . "\n";

        return $this->response->setContentType('text/plain')->setBody($content);
    }
}
