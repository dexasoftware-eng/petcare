<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user() ?? [];
$calls = $calls ?? [];
$availableVets = $availableVets ?? [];

// Calculate stats
$totalCalls = count($calls);
$connectedCalls = 0;
$videoCalls = 0;
$totalDurationSeconds = 0;

foreach ($calls as $c) {
    if (in_array($c['status'], ['connected', 'ended'])) {
        $connectedCalls++;
        
    }
    if (($c['call_type'] ?? '') === 'video') {
        $videoCalls++;
    }
    $totalDurationSeconds += (int)($c['duration_seconds'] ?? 0);
}

$durHours = floor($totalDurationSeconds / 3600);
$durMins = floor(($totalDurationSeconds % 3600) / 60);
$durSecs = $totalDurationSeconds % 60;
$durFormatted = $durHours > 0 ? "{$durHours}h {$durMins}m" : ($durMins > 0 ? "{$durMins}m {$durSecs}s" : "{$durSecs}s");
?>

<!-- 1. Hero Command Header -->
<div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
    <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
    <div class="row align-items-center position-relative z-1 g-4">
        <div class="col-lg-8">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-20 text-white small mb-3">
                <span class="d-inline-block rounded-circle bg-emerald-400" style="width: 8px; height: 8px; background-color: #34d399; box-shadow: 0 0 10px #34d399;"></span>
                <span class="fw-semibold">24/7 WebRTC Encrypted Telemedicine</span>
            </div>
            <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                Consultation &amp; Call Logs
            </h1>
            <p class="text-white text-opacity-80 mb-0" style="max-width: 600px; font-size: 14.5px; line-height: 1.6;">
                End-to-end encrypted clinical video and audio logs with verified veterinary doctors, specialists, and rescue shelters.
            </p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <button type="button" class="btn btn-admin-primary rounded-pill px-4 py-3 fw-bold shadow d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#quickConsultModal" style="font-size: 14px;">
                <i class="fa-solid fa-video"></i>
                <span>Start New Consultation</span>
            </button>
        </div>
    </div>
</div>

<!-- 2. Metric Highlight Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="admin-card p-3 p-md-4 h-100 border-0 shadow-sm rounded-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Total Sessions</span>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #eff6ff; color: #3b82f6;">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;"><?= $totalCalls ?></h3>
            <span class="text-muted small" style="font-size: 12px;">Lifetime call logs</span>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="admin-card p-3 p-md-4 h-100 border-0 shadow-sm rounded-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Connected</span>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #ecfdf5; color: #10b981;">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;"><?= $connectedCalls ?></h3>
            <span class="text-success small fw-semibold" style="font-size: 12px;">
                <i class="fa-solid fa-check me-1"></i> Completed sessions
            </span>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="admin-card p-3 p-md-4 h-100 border-0 shadow-sm rounded-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Video Calls</span>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #f5f3ff; color: #8b5cf6;">
                    <i class="fa-solid fa-video"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;"><?= $videoCalls ?></h3>
            <span class="text-muted small" style="font-size: 12px;">Telemedicine HD video</span>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="admin-card p-3 p-md-4 h-100 border-0 shadow-sm rounded-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Talk Time</span>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #fffbeb; color: #f59e0b;">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;"><?= $durFormatted ?></h3>
            <span class="text-muted small" style="font-size: 12px;">Total consultation time</span>
        </div>
    </div>
</div>

<!-- 3. Main Call Log Section -->
<div class="admin-card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <!-- Header & Filter Toolbar -->
    <div class="admin-card-header bg-white border-bottom p-3 p-md-4">
        <div class="row g-3 align-items-center justify-content-between">
            <div class="col-12 col-md-5">
                <div class="position-relative">
                    <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 13px;"></i>
                    <input type="text" id="callSearchInput" class="form-control rounded-pill ps-5 bg-light border-0" placeholder="Search by doctor, clinic, token, or role..." onkeyup="filterCallLogs()">
                </div>
            </div>
            <div class="col-12 col-md-7 d-flex flex-wrap gap-2 justify-content-md-end">
                <div class="btn-group rounded-pill p-1 bg-light border" role="group">
                    <button type="button" class="btn btn-sm rounded-pill px-3 active fw-semibold call-type-btn" data-type="all" onclick="filterByType('all', this)">All</button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 fw-semibold call-type-btn" data-type="video" onclick="filterByType('video', this)">
                        <i class="fa-solid fa-video me-1"></i> Video
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 fw-semibold call-type-btn" data-type="audio" onclick="filterByType('audio', this)">
                        <i class="fa-solid fa-phone me-1"></i> Audio
                    </button>
                </div>
                <select id="callStatusFilter" class="form-select form-select-sm rounded-pill bg-light border-0 px-3 w-auto fw-semibold" onchange="filterCallLogs()">
                    <option value="all">All Statuses</option>
                    <option value="connected">Connected &amp; Ended</option>
                    <option value="missed">Missed &amp; Rejected</option>
                    <option value="ringing">Ringing &amp; Initiating</option>
                </select>
            </div>
        </div>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($calls)): ?>
            <!-- Empty State -->
            <div class="text-center py-5 px-4">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3 text-muted" style="width: 76px; height: 76px; font-size: 32px;">
                    <i class="fa-solid fa-phone-slash"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">No Consultation Logs Found</h4>
                <p class="text-muted small mb-4" style="max-width: 460px; margin: 0 auto;">
                    You haven't initiated or received any telemedicine video or audio calls yet. Connect with a licensed doctor to begin care.
                </p>
                <button type="button" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#quickConsultModal">
                    <i class="fa-solid fa-video me-1"></i> Start a Consultation
                </button>
            </div>
        <?php else: ?>

            <!-- Desktop View Table (>=768px) -->
            <div class="d-none d-md-block table-responsive m-0">
                <table class="table table-hover align-middle m-0" id="callsDesktopTable">
                    <thead class="bg-light text-muted small border-bottom">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold">Consultation Contact</th>
                            <th class="py-3 fw-semibold">Mode &amp; Purpose</th>
                            <th class="py-3 fw-semibold">Security &amp; Status</th>
                            <th class="py-3 fw-semibold">Duration</th>
                            <th class="py-3 fw-semibold">Date &amp; Time</th>
                            <th class="py-3 text-end pe-4 fw-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($calls as $call):
                            $isCaller = (int)($call['caller_id'] ?? 0) === (int)($currentUser['id'] ?? 0);
                            $otherName = $isCaller ? ($call['receiver_name'] ?? 'Doctor / Specialist') : ($call['caller_name'] ?? 'Pet Parent');
                            $otherRole = $isCaller ? ($call['receiver_role'] ?? 'veterinarian') : ($call['caller_role'] ?? 'petowner');
                            $otherId = $isCaller ? (int)($call['receiver_id'] ?? 0) : (int)($call['caller_id'] ?? 0);
                            $callType = $call['call_type'] ?? 'video';
                            $status = $call['status'] ?? 'ended';
                            $dur = (int)($call['duration_seconds'] ?? 0);
                            $mins = floor($dur / 60);
                            $secs = $dur % 60;
                            $isActive = in_array($status, ['initiating', 'ringing', 'connected']);

                            $roleBadgeColor = match($otherRole) {
                                'veterinarian' => 'bg-indigo-subtle text-indigo border-indigo-subtle',
                                'shelter' => 'bg-emerald-subtle text-emerald border-emerald-subtle',
                                'vendor' => 'bg-amber-subtle text-amber border-amber-subtle',
                                default => 'bg-slate-subtle text-slate border-slate-subtle'
                            };
                        ?>
                            <tr class="call-row-item" 
                                data-search="<?= strtolower(ViewHelper::e($otherName . ' ' . $otherRole . ' ' . $call['session_token'] . ' ' . ($call['related_entity_type'] ?? ''))) ?>"
                                data-type="<?= $callType ?>"
                                data-status="<?= $status ?>">
                                
                                <!-- Contact Info -->
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle border d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow-sm" style="width: 42px; height: 42px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); color: #334155; font-size: 15px;">
                                            <?= strtoupper(substr($otherName, 0, 1)) ?>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold text-dark text-truncate" style="font-size: 14px;"><?= ViewHelper::e($otherName) ?></span>
                                                <span class="badge rounded-pill border px-2 py-0" style="font-size: 10px; background: #f1f5f9; color: #475569;">
                                                    <?= ucfirst(ViewHelper::e($otherRole)) ?>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="font-monospace text-muted small" style="font-size: 11px;">#<?= substr($call['session_token'], 0, 12) ?>...</span>
                                                <span class="text-muted" style="font-size: 10px;">&middot;</span>
                                                <span class="text-muted small" style="font-size: 11px;"><?= $isCaller ? '<i class="fa-solid fa-arrow-up-right text-primary me-1"></i>Outgoing' : '<i class="fa-solid fa-arrow-down-left text-success me-1"></i>Incoming' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Mode & Purpose -->
                                <td class="py-3">
                                    <div class="d-flex flex-column gap-1">
                                        <div>
                                            <?php if ($callType === 'video'): ?>
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1" style="font-size: 11.5px;">
                                                    <i class="fa-solid fa-video me-1"></i> HD Video
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1" style="font-size: 11.5px;">
                                                    <i class="fa-solid fa-phone me-1"></i> Audio Call
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-muted small text-capitalize" style="font-size: 11.5px;">
                                            <i class="fa-solid fa-tag me-1 text-muted" style="font-size: 10px;"></i><?= ViewHelper::e($call['related_entity_type'] ?? 'Consultation') ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Security & Status -->
                                <td class="py-3">
                                    <div class="d-flex flex-column gap-1">
                                        <div>
                                            <?php if ($status === 'connected' || $status === 'ended'): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
                                                    <i class="fa-solid fa-circle-check me-1"></i> <?= ucfirst($status) ?>
                                                </span>
                                            <?php elseif ($status === 'rejected' || $status === 'missed'): ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
                                                    <i class="fa-solid fa-phone-slash me-1"></i> <?= ucfirst($status) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
                                                    <i class="fa-solid fa-spinner fa-spin me-1"></i> In Progress
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-muted" style="font-size: 10.5px;">
                                            <i class="fa-solid fa-shield-halved text-success me-1"></i>WebRTC E2EE
                                        </span>
                                    </div>
                                </td>

                                <!-- Duration -->
                                <td class="py-3">
                                    <span class="font-monospace fw-semibold px-2 py-1 rounded bg-light border text-dark" style="font-size: 12px;">
                                        <?= sprintf('%02d:%02d', $mins, $secs) ?>
                                    </span>
                                </td>

                                <!-- Date & Time -->
                                <td class="py-3 text-muted small" style="font-size: 12.5px;">
                                    <div><?= date('M d, Y', strtotime($call['created_at'])) ?></div>
                                    <div class="text-muted" style="font-size: 11px;"><?= date('h:i A', strtotime($call['created_at'])) ?></div>
                                </td>

                                <!-- Action Buttons -->
                                <td class="py-3 text-end pe-4">
                                    <?php if ($isActive): ?>
                                        <a href="<?= ViewHelper::url('call/room/' . $call['session_token']) ?>" class="btn btn-sm btn-admin-primary rounded-pill px-3 fw-bold shadow-sm" style="font-size: 12px;">
                                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Enter Room
                                        </a>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-semibold shadow-sm" style="font-size: 12px;" onclick="PetGuardCall.initiateCall(<?= (int)$otherId ?>, '<?= $callType ?>', '<?= $call['related_entity_type'] ?? 'direct' ?>', <?= (int)($call['related_entity_id'] ?? 0) ?>)">
                                            <i class="fa-solid fa-rotate-right me-1"></i> Reconnect
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile View Cards Grid (<768px) -->
            <div class="d-md-none p-3" id="callsMobileContainer">
                <div class="row g-3">
                    <?php foreach ($calls as $call):
                        $isCaller = (int)($call['caller_id'] ?? 0) === (int)($currentUser['id'] ?? 0);
                        $otherName = $isCaller ? ($call['receiver_name'] ?? 'Doctor / Specialist') : ($call['caller_name'] ?? 'Pet Parent');
                        $otherRole = $isCaller ? ($call['receiver_role'] ?? 'veterinarian') : ($call['caller_role'] ?? 'petowner');
                        $otherId = $isCaller ? (int)($call['receiver_id'] ?? 0) : (int)($call['caller_id'] ?? 0);
                        $callType = $call['call_type'] ?? 'video';
                        $status = $call['status'] ?? 'ended';
                        $dur = (int)($call['duration_seconds'] ?? 0);
                        $mins = floor($dur / 60);
                        $secs = $dur % 60;
                        $isActive = in_array($status, ['initiating', 'ringing', 'connected']);
                    ?>
                        <div class="col-12 call-card-item" 
                            data-search="<?= strtolower(ViewHelper::e($otherName . ' ' . $otherRole . ' ' . $call['session_token'] . ' ' . ($call['related_entity_type'] ?? ''))) ?>"
                            data-type="<?= $callType ?>"
                            data-status="<?= $status ?>">
                            
                            <div class="admin-card p-3 border rounded-4 shadow-sm bg-white h-100">
                                <!-- Top Row: Contact & Badges -->
                                <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                                    <div class="d-flex align-items-center gap-2 min-w-0">
                                        <div class="rounded-circle border d-flex align-items-center justify-content-center flex-shrink-0 fw-bold" style="width: 38px; height: 38px; background: #f8fafc; color: #334155; font-size: 14px;">
                                            <?= strtoupper(substr($otherName, 0, 1)) ?>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="fw-bold text-dark text-truncate" style="font-size: 14px;"><?= ViewHelper::e($otherName) ?></div>
                                            <span class="badge rounded-pill border px-2 py-0" style="font-size: 9.5px; background: #f1f5f9; color: #475569;">
                                                <?= ucfirst(ViewHelper::e($otherRole)) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div>
                                        <?php if ($callType === 'video'): ?>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1" style="font-size: 10px;">
                                                <i class="fa-solid fa-video me-1"></i> Video
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1" style="font-size: 10px;">
                                                <i class="fa-solid fa-phone me-1"></i> Audio
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Middle Row: Metadata & Duration -->
                                <div class="row g-2 py-2 my-2 border-top border-bottom bg-light rounded-3 px-2 text-center" style="font-size: 11.5px;">
                                    <div class="col-4">
                                        <span class="text-muted d-block" style="font-size: 10px;">Status</span>
                                        <strong class="text-dark"><?= ucfirst($status) ?></strong>
                                    </div>
                                    <div class="col-4 border-start border-end">
                                        <span class="text-muted d-block" style="font-size: 10px;">Duration</span>
                                        <strong class="font-monospace text-dark"><?= sprintf('%02d:%02d', $mins, $secs) ?></strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted d-block" style="font-size: 10px;">Date</span>
                                        <strong class="text-dark"><?= date('M d', strtotime($call['created_at'])) ?></strong>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-3">
                                    <?php if ($isActive): ?>
                                        <a href="<?= ViewHelper::url('call/room/' . $call['session_token']) ?>" class="btn btn-sm btn-admin-primary rounded-pill w-100 fw-bold py-2 shadow-sm" style="font-size: 12.5px;">
                                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Join Active Consultation Room
                                        </a>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-sm btn-outline-brand rounded-pill w-100 fw-semibold py-2 shadow-sm" style="font-size: 12.5px;" onclick="PetGuardCall.initiateCall(<?= (int)$otherId ?>, '<?= $callType ?>', '<?= $call['related_entity_type'] ?? 'direct' ?>', <?= (int)($call['related_entity_id'] ?? 0) ?>)">
                                            <i class="fa-solid fa-rotate-right me-1"></i> Reconnect Call
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<!-- 4. Quick Consultation Launcher Modal -->
<div class="modal fade" id="quickConsultModal" tabindex="-1" aria-labelledby="quickConsultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header text-white p-4 border-0" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
                <div>
                    <h5 class="modal-title fw-bold m-0" id="quickConsultModalLabel" style="font-family: 'Anybody', sans-serif;">
                        <i class="fa-solid fa-video me-2 text-brand"></i> Instant Telemedicine Consultation
                    </h5>
                    <p class="text-white text-opacity-75 small m-0 mt-1">Connect immediately with a verified veterinary physician.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="startConsultForm" onsubmit="handleStartConsultSubmit(event)">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Select Verified Doctor / Specialist *</label>
                        <select id="consultDoctorSelect" class="form-select rounded-3 py-2" required>
                            <option value="">-- Choose Veterinary Practitioner --</option>
                            <?php foreach ($availableVets as $vet): ?>
                                <option value="<?= (int)$vet['id'] ?>" data-name="<?= ViewHelper::e($vet['name']) ?>">
                                    <?= ViewHelper::e($vet['name']) ?> &middot; <?= ViewHelper::e($vet['specialization'] ?? $vet['clinic_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Consultation Mode *</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="consultMode" id="modeVideo" value="video" checked>
                                <label class="btn btn-outline-primary w-100 rounded-3 p-3 text-center d-flex flex-column align-items-center gap-1" for="modeVideo">
                                    <i class="fa-solid fa-video fa-lg"></i>
                                    <span class="fw-bold" style="font-size: 13px;">HD Video Call</span>
                                    <span class="text-muted" style="font-size: 10px;">Visual Clinical Exam</span>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="consultMode" id="modeAudio" value="audio">
                                <label class="btn btn-outline-secondary w-100 rounded-3 p-3 text-center d-flex flex-column align-items-center gap-1" for="modeAudio">
                                    <i class="fa-solid fa-phone fa-lg"></i>
                                    <span class="fw-bold" style="font-size: 13px;">Audio Consultation</span>
                                    <span class="text-muted" style="font-size: 10px;">Voice Triage &amp; Q&amp;A</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold text-dark">Consultation Purpose</label>
                        <select id="consultPurposeSelect" class="form-select rounded-3">
                            <option value="routine_checkup">Routine Health Consultation</option>
                            <option value="emergency_triage">Emergency Symptom Triage</option>
                            <option value="post_op_followup">Post-Surgery &amp; Recovery Follow-up</option>
                            <option value="nutrition_advice">Diet &amp; Nutrition Advice</option>
                            <option value="prescription_refill">Prescription Review</option>
                        </select>
                    </div>

                    <div class="p-3 bg-light rounded-3 border mt-3">
                        <div class="d-flex align-items-center gap-2 text-dark small fw-semibold">
                            <i class="fa-solid fa-lock text-success"></i>
                            <span>End-to-End Cryptographic Security</span>
                        </div>
                        <p class="text-muted small m-0 mt-1" style="font-size: 11px;">
                            Sessions are transmitted via secure direct peer-to-peer WebRTC streaming with STUN/TURN encryption.
                        </p>
                    </div>
                </div>

                <div class="modal-footer p-3 bg-light border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm" id="btnLaunchCall">
                        <i class="fa-solid fa-phone-volume me-1"></i> Start Secure Call
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentActiveType = 'all';

function filterByType(type, btn) {
    currentActiveType = type;
    document.querySelectorAll('.call-type-btn').forEach(b => b.classList.remove('active', 'btn-primary'));
    if (btn) btn.classList.add('active');
    filterCallLogs();
}

function filterCallLogs() {
    const searchVal = (document.getElementById('callSearchInput')?.value || '').trim().toLowerCase();
    const statusVal = document.getElementById('callStatusFilter')?.value || 'all';

    // Filter Desktop rows
    document.querySelectorAll('#callsDesktopTable .call-row-item').forEach(row => {
        const itemSearch = row.getAttribute('data-search') || '';
        const itemType = row.getAttribute('data-type') || '';
        const itemStatus = row.getAttribute('data-status') || '';

        let matchSearch = !searchVal || itemSearch.includes(searchVal);
        let matchType = currentActiveType === 'all' || itemType === currentActiveType;
        let matchStatus = true;

        if (statusVal === 'connected') {
            matchStatus = itemStatus === 'connected' || itemStatus === 'ended';
        } else if (statusVal === 'missed') {
            matchStatus = itemStatus === 'missed' || itemStatus === 'rejected';
        } else if (statusVal === 'ringing') {
            matchStatus = itemStatus === 'ringing' || itemStatus === 'initiating';
        }

        if (matchSearch && matchType && matchStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Filter Mobile cards
    document.querySelectorAll('#callsMobileContainer .call-card-item').forEach(card => {
        const itemSearch = card.getAttribute('data-search') || '';
        const itemType = card.getAttribute('data-type') || '';
        const itemStatus = card.getAttribute('data-status') || '';

        let matchSearch = !searchVal || itemSearch.includes(searchVal);
        let matchType = currentActiveType === 'all' || itemType === currentActiveType;
        let matchStatus = true;

        if (statusVal === 'connected') {
            matchStatus = itemStatus === 'connected' || itemStatus === 'ended';
        } else if (statusVal === 'missed') {
            matchStatus = itemStatus === 'missed' || itemStatus === 'rejected';
        } else if (statusVal === 'ringing') {
            matchStatus = itemStatus === 'ringing' || itemStatus === 'initiating';
        }

        if (matchSearch && matchType && matchStatus) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

function handleStartConsultSubmit(e) {
    e.preventDefault();
    const doctorId = document.getElementById('consultDoctorSelect').value;
    if (!doctorId) {
        PetGuardToast.warning('Please select a doctor to begin consultation.');
        return;
    }

    const mode = document.querySelector('input[name="consultMode"]:checked')?.value || 'video';
    const purpose = document.getElementById('consultPurposeSelect').value;

    const modalEl = document.getElementById('quickConsultModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }

    PetGuardCall.initiateCall(doctorId, mode, purpose);
}
</script>
