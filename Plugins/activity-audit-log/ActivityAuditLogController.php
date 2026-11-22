<?php

namespace Plugins\ActivityAuditLog;

use App\Controllers\BaseController;

class ActivityAuditLogController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $logs = [];

        if ($db->tableExists('cms_audit_logs')) {
            $logs = $db->table('cms_audit_logs')->orderBy('created_at', 'DESC')->limit(100)->get()->getResultArray();
        }

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Audit Logs - SLCMS Plugin</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        </head>
        <body class="bg-light p-4">
            <div class="container max-w-1000">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-history me-2"></i>Security & Activity Audit Trail</h5>
                        <a href="' . base_url('admin/marketplace') . '" class="btn btn-sm btn-outline-secondary">&larr; Marketplace</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Event / Action</th>
                                        <th>Details</th>
                                        <th>IP Address</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>';

        if (!empty($logs) && count($logs) > 0) {
            $i = 1;
            foreach ($logs as $log) {
                $html .= '
                <tr>
                    <td>' . $i++ . '</td>
                    <td><strong>' . esc($log['user_email']) . '</strong></td>
                    <td><span class="badge bg-primary">' . esc($log['action']) . '</span></td>
                    <td><small class="text-muted">' . esc($log['details']) . '</small></td>
                    <td><code>' . esc($log['ip_address']) . '</code></td>
                    <td><small class="text-muted">' . esc($log['created_at']) . '</small></td>
                </tr>';
            }
        } else {
            $html .= '
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        <i class="fas fa-shield-alt fa-2x mb-2 d-block text-secondary"></i>
                        No audit events recorded yet. Lifecycle events will appear here automatically!
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
}
