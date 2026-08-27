<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user();
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-phone-volume text-brand me-2"></i> Telemedicine & Support Call Logs</h2>
        <p class="admin-page-subtitle">Encrypted WebRTC consultation records and duration history.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list-check text-brand me-2"></i> Recent Call Sessions</h3>
        <span class="badge bg-light text-dark border"><?= count($calls ?? []) ?> Total Records</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($calls)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-phone-slash fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No call history found</h5>
                <p class="small text-muted m-0">When you conduct audio/video consultations with veterinarians or shelters, records will appear here.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Call Session</th>
                            <th>Participant</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Date & Time</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($calls as $call): 
                            $isCaller = (int)$call['caller_id'] === (int)$currentUser['id'];
                            $otherName = $isCaller ? $call['receiver_name'] : $call['caller_name'];
                            $otherRole = $isCaller ? $call['receiver_role'] : $call['caller_role'];
                            $otherId = $isCaller ? $call['receiver_id'] : $call['caller_id'];
                        ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark font-monospace small"><?= ViewHelper::e($call['session_token']) ?></div>
                                    <span class="badge bg-light text-secondary border px-2 py-0" style="font-size: 10px;"><?= ViewHelper::e($call['related_entity_type'] ?? 'direct') ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle bg-light text-dark border fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%; font-size: 12px;">
                                            <?= strtoupper(substr($otherName ?? 'U', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px;"><?= ViewHelper::e($otherName) ?></div>
                                            <div class="small text-muted text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($otherRole) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($call['call_type'] === 'video'): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1"><i class="fa-solid fa-video me-1"></i> Video</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1"><i class="fa-solid fa-phone me-1"></i> Audio</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $statusMap = [
                                        'connected' => 'badge-success',
                                        'ended' => 'badge-neutral',
                                        'rejected' => 'badge-danger',
                                        'missed' => 'badge-danger',
                                        'initiating' => 'badge-amber',
                                        'ringing' => 'badge-amber'
                                    ];
                                    $badgeClass = $statusMap[$call['status']] ?? 'badge-neutral';
                                    ?>
                                    <span class="admin-badge <?= $badgeClass ?> text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($call['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $dur = (int)($call['duration_seconds'] ?? 0);
                                    $mins = floor($dur / 60);
                                    $secs = $dur % 60;
                                    ?>
                                    <span class="font-monospace small"><?= sprintf('%02d:%02d', $mins, $secs) ?></span>
                                </td>
                                <td class="small text-muted">
                                    <?= date('M d, Y · h:i A', strtotime($call['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-brand rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$otherId ?>, '<?= $call['call_type'] ?>', '<?= $call['related_entity_type'] ?>', <?= (int)($call['related_entity_id'] ?? 0) ?>)">
                                        <i class="fa-solid fa-phone me-1"></i> Reconnect
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
