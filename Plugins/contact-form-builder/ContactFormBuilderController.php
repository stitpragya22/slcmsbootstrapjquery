<?php

namespace Plugins\ContactFormBuilder;

use App\Controllers\BaseController;

class ContactFormBuilderController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $leads = [];

        if ($db->tableExists('cms_leads')) {
            $leads = $db->table('cms_leads')->orderBy('created_at', 'DESC')->get()->getResultArray();
        }

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Contact Form & Leads Manager - SLCMS Plugin</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        </head>
        <body class="bg-light p-4">
            <div class="container max-w-1000">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-envelope-open-text me-2"></i>Inbound Customer Inquiries & Leads</h5>
                        <a href="' . base_url('admin/marketplace') . '" class="btn btn-sm btn-outline-secondary">&larr; Marketplace</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>IP Address</th>
                                        <th>Received At</th>
                                    </tr>
                                </thead>
                                <tbody>';

        if (!empty($leads) && count($leads) > 0) {
            $i = 1;
            foreach ($leads as $lead) {
                $html .= '
                <tr>
                    <td>' . $i++ . '</td>
                    <td><strong>' . esc($lead['name']) . '</strong></td>
                    <td><a href="mailto:' . esc($lead['email']) . '">' . esc($lead['email']) . '</a></td>
                    <td>' . esc($lead['subject'] ?? 'General') . '</td>
                    <td><small class="text-muted">' . esc(substr($lead['message'], 0, 50)) . '...</small></td>
                    <td><code>' . esc($lead['ip_address'] ?? '127.0.0.1') . '</code></td>
                    <td><small class="text-muted">' . esc($lead['created_at']) . '</small></td>
                </tr>';
            }
        } else {
            $html .= '
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>
                        No inquiries received yet. Submit an inquiry through the form endpoint to test!
                    </td>
                </tr>';
        }

        $html .= '
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>';

        return $html;
    }

    public function submit()
    {
        $name    = trim((string) $this->request->getPost('name'));
        $email   = trim((string) $this->request->getPost('email'));
        $subject = trim((string) $this->request->getPost('subject') ?? 'Inquiry');
        $message = trim((string) $this->request->getPost('message'));

        if (empty($name) || empty($email) || empty($message)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Name, email, and message are required.']);
        }

        $db = \Config\Database::connect();
        if ($db->tableExists('cms_leads')) {
            $db->table('cms_leads')->insert([
                'name'       => $name,
                'email'      => $email,
                'subject'    => $subject,
                'message'    => $message,
                'ip_address' => $this->request->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Thank you! Your message has been received.']);
    }
}
