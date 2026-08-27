/**
 * Pet Guard — Unified Core JavaScript Engine
 * Custom Modals, Toast Notifications, AJAX Handler, WebRTC Calling, Messaging & Table Filtering
 */

(function (window, document) {
    'use strict';

    // ==========================================
    // 1. PET GUARD TOAST ENGINE
    // ==========================================
    const PetGuardToast = {
        container: null,

        init() {
            if (!this.container) {
                this.container = document.createElement('div');
                this.container.className = 'petguard-toast-container';
                this.container.setAttribute('aria-live', 'polite');
                document.body.appendChild(this.container);
            }
        },

        show(type, title, message, duration = 4000) {
            this.init();

            const toast = document.createElement('div');
            toast.className = `petguard-toast toast-${type} animate-slide-in`;

            const iconMap = {
                success: 'fa-circle-check',
                error: 'fa-circle-exclamation',
                warning: 'fa-triangle-exclamation',
                info: 'fa-circle-info'
            };

            toast.innerHTML = `
                <div class="toast-icon"><i class="fa-solid ${iconMap[type] || 'fa-bell'}"></i></div>
                <div class="toast-content">
                    ${title ? `<div class="toast-title">${this.escapeHtml(title)}</div>` : ''}
                    <div class="toast-message">${this.escapeHtml(message)}</div>
                </div>
                <button type="button" class="toast-close" aria-label="Close" title="Close"><i class="fa-solid fa-xmark" style="font-size: 13px;"></i></button>
                <div class="toast-progress"><div class="toast-progress-bar"></div></div>
            `;

            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => this.dismiss(toast));

            this.container.appendChild(toast);

            // Auto dismiss
            if (duration > 0) {
                const progressBar = toast.querySelector('.toast-progress-bar');
                if (progressBar) {
                    progressBar.style.transition = `width ${duration}ms linear`;
                    setTimeout(() => progressBar.style.width = '0%', 10);
                }
                setTimeout(() => this.dismiss(toast), duration);
            }

            return toast;
        },

        dismiss(toast) {
            if (!toast || toast.classList.contains('dismissing')) return;
            toast.classList.add('dismissing');
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (toast.parentElement) toast.parentElement.removeChild(toast);
            }, 300);
        },

        success(msg, title = 'Success') { return this.show('success', title, msg); },
        error(msg, title = 'Error') { return this.show('error', title, msg, 6000); },
        warning(msg, title = 'Attention') { return this.show('warning', title, msg, 5000); },
        info(msg, title = 'Information') { return this.show('info', title, msg); },

        escapeHtml(str) {
            if (!str) return '';
            return String(str).replace(/[&<>"']/g, m => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[m]));
        }
    };

    // ==========================================
    // 2. PET GUARD CUSTOM MODAL ENGINE
    // ==========================================
    const PetGuardModal = {
        activeModal: null,

        create(options = {}) {
            this.closeAll();

            const {
                type = 'info', // 'confirm', 'danger', 'form', 'info', 'incoming-call', 'drawer'
                title = 'Notice',
                message = '',
                htmlContent = null,
                confirmText = 'Confirm',
                confirmClass = 'btn-admin-primary',
                cancelText = 'Cancel',
                showCancel = true,
                onConfirm = null,
                onCancel = null,
                size = 'normal' // 'small', 'normal', 'large', 'fullscreen'
            } = options;

            const backdrop = document.createElement('div');
            backdrop.className = 'petguard-modal-backdrop';

            const modalWrapper = document.createElement('div');
            modalWrapper.className = `petguard-modal-wrapper modal-${type} modal-${size}`;

            const iconMap = {
                danger: 'fa-triangle-exclamation text-danger',
                confirm: 'fa-circle-question text-brand',
                warning: 'fa-circle-exclamation text-warning',
                success: 'fa-circle-check text-success',
                info: 'fa-circle-info text-info',
                'incoming-call': 'fa-phone-volume text-success animate-pulse'
            };

            const headerIcon = iconMap[type] ? `<i class="fa-solid ${iconMap[type]} me-2"></i>` : '';

            modalWrapper.innerHTML = `
                <div class="petguard-modal-dialog">
                    <div class="petguard-modal-header">
                        <h4 class="petguard-modal-title">${headerIcon}${PetGuardToast.escapeHtml(title)}</h4>
                        <button type="button" class="petguard-modal-close" aria-label="Close">&times;</button>
                    </div>
                    <div class="petguard-modal-body">
                        ${message ? `<p class="petguard-modal-message">${PetGuardToast.escapeHtml(message)}</p>` : ''}
                        ${htmlContent || ''}
                    </div>
                    <div class="petguard-modal-footer">
                        ${showCancel ? `<button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold btn-cancel d-inline-flex align-items-center justify-content-center gap-1">${cancelText}</button>` : ''}
                        <button type="button" class="btn ${confirmClass} rounded-pill px-4 py-2 fw-bold btn-confirm shadow-sm d-inline-flex align-items-center justify-content-center gap-1">${confirmText}</button>
                    </div>
                </div>
            `;

            backdrop.appendChild(modalWrapper);
            document.body.appendChild(backdrop);
            document.body.style.overflow = 'hidden';

            // Events
            const closeBtn = modalWrapper.querySelector('.petguard-modal-close');
            const cancelBtn = modalWrapper.querySelector('.btn-cancel');
            const confirmBtn = modalWrapper.querySelector('.btn-confirm');

            const closeModal = () => {
                backdrop.classList.add('closing');
                setTimeout(() => {
                    if (backdrop.parentElement) backdrop.parentElement.removeChild(backdrop);
                    document.body.style.overflow = '';
                    PetGuardModal.activeModal = null;
                }, 200);
            };

            if (closeBtn) closeBtn.addEventListener('click', () => {
                if (onCancel) onCancel();
                closeModal();
            });

            if (cancelBtn) cancelBtn.addEventListener('click', () => {
                if (onCancel) onCancel();
                closeModal();
            });

            if (confirmBtn) confirmBtn.addEventListener('click', async (e) => {
                if (onConfirm) {
                    const originalText = confirmBtn.innerHTML;
                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span>Processing...`;
                    try {
                        const result = await onConfirm(modalWrapper);
                        if (result !== false) {
                            closeModal();
                        } else {
                            confirmBtn.disabled = false;
                            confirmBtn.innerHTML = originalText;
                        }
                    } catch (err) {
                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalText;
                    }
                } else {
                    closeModal();
                }
            });

            backdrop.addEventListener('click', (e) => {
                if (e.target === backdrop) {
                    if (onCancel) onCancel();
                    closeModal();
                }
            });

            setTimeout(() => backdrop.classList.add('active'), 10);
            this.activeModal = { backdrop, modalWrapper, closeModal };
            return this.activeModal;
        },

        confirm(options) {
            if (typeof options === 'string') {
                options = { message: options };
            }
            return new Promise((resolve) => {
                this.create({
                    type: 'confirm',
                    title: options.title || 'Please Confirm',
                    message: options.message || 'Are you sure you want to proceed?',
                    confirmText: options.confirmText || 'Confirm',
                    confirmClass: options.confirmClass || 'btn-admin-primary',
                    cancelText: options.cancelText || 'Cancel',
                    onConfirm: () => { resolve(true); return true; },
                    onCancel: () => { resolve(false); }
                });
            });
        },

        danger(options) {
            if (typeof options === 'string') {
                options = { message: options };
            }
            return new Promise((resolve) => {
                this.create({
                    type: 'danger',
                    title: options.title || 'Delete Confirmation',
                    message: options.message || 'This action cannot be undone. Are you sure?',
                    confirmText: options.confirmText || 'Delete Permanently',
                    confirmClass: 'btn-danger',
                    cancelText: options.cancelText || 'Cancel',
                    onConfirm: () => { resolve(true); return true; },
                    onCancel: () => { resolve(false); }
                });
            });
        },

        closeAll() {
            if (this.activeModal) {
                this.activeModal.closeModal();
            }
            document.querySelectorAll('.petguard-modal-backdrop').forEach(el => {
                if (el.parentElement) el.parentElement.removeChild(el);
            });
            document.body.style.overflow = '';
        }
    };

    // ==========================================
    // 3. PET GUARD AJAX ENGINE
    // ==========================================
    const PetGuardAjax = {
        resolveUrl(url) {
            if (!url || url.startsWith('http://') || url.startsWith('https://') || url.startsWith('//')) {
                return url;
            }
            let base = window.PetGuardAppBase;
            if (!base) {
                const pathParts = window.location.pathname.split('/').filter(Boolean);
                if (pathParts.length > 0 && pathParts[0] === 'petcaretw') {
                    base = '/petcaretw/';
                } else {
                    base = '/';
                }
            }
            base = base.endsWith('/') ? base : base + '/';
            const cleanUrl = url.startsWith('/') ? url.substring(1) : url;
            return base + cleanUrl;
        },

        async request(url, options = {}) {
            const csrfToken = window.PetGuardCsrf 
                || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                || document.querySelector('input[name="_csrf"]')?.value 
                || '';

            const defaults = {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            };

            if (csrfToken) {
                defaults.headers['X-CSRF-Token'] = csrfToken;
            }

            const config = { ...defaults, ...options };
            config.headers = { ...defaults.headers, ...options.headers };

            if (config.body && typeof config.body === 'object' && !(config.body instanceof FormData)) {
                if (csrfToken && !config.body._csrf && !config.body.csrf_token) {
                    config.body._csrf = csrfToken;
                }
                config.headers['Content-Type'] = 'application/json';
                config.body = JSON.stringify(config.body);
            } else if (config.body instanceof FormData && csrfToken) {
                if (!config.body.has('_csrf') && !config.body.has('csrf_token')) {
                    config.body.append('_csrf', csrfToken);
                }
            }

            try {
                const targetUrl = this.resolveUrl(url);
                const response = await fetch(targetUrl, config);
                const contentType = response.headers.get('content-type') || '';

                if (contentType.includes('application/json')) {
                    const json = await response.json();
                    if (!response.ok || json.success === false) {
                        const errorMsg = json.message || 'Operation failed. Please try again.';
                        return { ok: false, status: response.status, data: json, message: errorMsg, errors: json.errors || {} };
                    }
                    return { ok: true, status: response.status, data: json.data || json, message: json.message || '' };
                } else {
                    const text = await response.text();
                    return { ok: response.ok, status: response.status, data: text, message: '' };
                }
            } catch (error) {
                console.error('PetGuard AJAX Network Error:', error);
                return { ok: false, status: 0, message: 'Network connection error. Please check your connection.', errors: {} };
            }
        },

        get(url, params = {}) {
            const query = new URLSearchParams(params).toString();
            const fullUrl = query ? `${url}?${query}` : url;
            return this.request(fullUrl, { method: 'GET' });
        },

        post(url, data = {}) {
            const isFormData = data instanceof FormData;
            return this.request(url, {
                method: 'POST',
                body: data
            });
        },

        // Helper to bind forms with automated loading states and inline error rendering
        bindForm(formSelector, options = {}) {
            const form = typeof formSelector === 'string' ? document.querySelector(formSelector) : formSelector;
            if (!form) return;

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Clear previous errors
                form.querySelectorAll('.petguard-field-error').forEach(el => el.remove());
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn ? submitBtn.innerHTML : '';
                const loadingText = options.loadingText || 'Saving...';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status"></span>${loadingText}`;
                }

                const formData = new FormData(form);
                const url = form.getAttribute('action') || window.location.href;
                const method = (form.getAttribute('method') || 'POST').toUpperCase();

                const res = await PetGuardAjax.request(url, { method, body: formData });

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }

                if (res.ok) {
                    PetGuardToast.success(res.message || 'Saved successfully.');
                    if (options.onSuccess) {
                        options.onSuccess(res.data, form);
                    } else if (options.redirect) {
                        setTimeout(() => window.location.href = options.redirect, 800);
                    } else if (options.reload) {
                        setTimeout(() => window.location.reload(), 800);
                    } else if (options.resetForm) {
                        form.reset();
                    }
                } else {
                    PetGuardToast.error(res.message || 'Please fix the highlighted errors.');

                    // Render inline errors next to field inputs
                    if (res.errors && typeof res.errors === 'object') {
                        Object.keys(res.errors).forEach(fieldName => {
                            const input = form.querySelector(`[name="${fieldName}"], [name="${fieldName}[]"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'petguard-field-error text-danger small mt-1';
                                errorDiv.innerHTML = `<i class="fa-solid fa-circle-exclamation me-1"></i>${res.errors[fieldName]}`;
                                input.parentNode.appendChild(errorDiv);
                            }
                        });
                    }

                    if (options.onError) {
                        options.onError(res);
                    }
                }
            });
        }
    };

    // ==========================================
    // 4. WEBRTC TELEMEDICINE & AUDIO ENGINE
    // ==========================================
    const PetGuardAudioEngine = {
        ctx: null,
        dialTimer: null,
        ringTimer: null,

        getCtx() {
            try {
                if (!this.ctx || this.ctx.state === 'closed') {
                    const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                    if (AudioContextClass) this.ctx = new AudioContextClass();
                }
                if (this.ctx && this.ctx.state === 'suspended') {
                    this.ctx.resume();
                }
            } catch (e) {
                console.warn('AudioContext initialization error:', e);
            }
            return this.ctx;
        },

        // 1. WhatsApp-Style Outgoing Dial Ringback Tone (Caller side)
        startDialTone() {
            this.stopAll();
            const playPulse = () => {
                try {
                    const ctx = this.getCtx();
                    if (!ctx) return;
                    const now = ctx.currentTime;

                    // Dual frequency phone ringback tone: 440Hz + 480Hz
                    const osc1 = ctx.createOscillator();
                    const osc2 = ctx.createOscillator();
                    const gain = ctx.createGain();

                    osc1.type = 'sine';
                    osc1.frequency.value = 440;
                    osc2.type = 'sine';
                    osc2.frequency.value = 480;

                    gain.gain.setValueAtTime(0, now);
                    gain.gain.linearRampToValueAtTime(0.05, now + 0.05);
                    gain.gain.setValueAtTime(0.05, now + 1.2);
                    gain.gain.linearRampToValueAtTime(0, now + 1.3);

                    osc1.connect(gain);
                    osc2.connect(gain);
                    gain.connect(ctx.destination);

                    osc1.start(now);
                    osc2.start(now);
                    osc1.stop(now + 1.35);
                    osc2.stop(now + 1.35);
                } catch (e) {}
            };

            playPulse();
            this.dialTimer = setInterval(playPulse, 3200);
        },

        // 2. High Quality Melodic Chime Ringtone (Incoming Modal)
        startRingtone() {
            this.stopAll();
            const playChime = () => {
                try {
                    const ctx = this.getCtx();
                    if (!ctx) return;
                    const now = ctx.currentTime;

                    // Melodic chime sequence: E5 (659.25Hz), G#5 (830.61Hz), B5 (987.77Hz), E6 (1318.51Hz)
                    const notes = [
                        { f: 659.25, t: 0 },
                        { f: 830.61, t: 0.18 },
                        { f: 987.77, t: 0.36 },
                        { f: 1318.51, t: 0.54 }
                    ];

                    notes.forEach(({ f, t }) => {
                        const osc = ctx.createOscillator();
                        const gain = ctx.createGain();
                        osc.type = 'sine';
                        osc.frequency.value = f;

                        const startTime = now + t;
                        gain.gain.setValueAtTime(0, startTime);
                        gain.gain.linearRampToValueAtTime(0.08, startTime + 0.04);
                        gain.gain.exponentialRampToValueAtTime(0.001, startTime + 0.6);

                        osc.connect(gain);
                        gain.connect(ctx.destination);
                        osc.start(startTime);
                        osc.stop(startTime + 0.65);
                    });
                } catch (e) {}
            };

            playChime();
            this.ringTimer = setInterval(playChime, 2400);
        },

        stopAll() {
            if (this.dialTimer) {
                clearInterval(this.dialTimer);
                this.dialTimer = null;
            }
            if (this.ringTimer) {
                clearInterval(this.ringTimer);
                this.ringTimer = null;
            }
        }
    };

    const PetGuardCall = {
        sessionToken: null,
        peerConnection: null,
        localStream: null,
        screenStream: null,
        pollInterval: null,
        timerInterval: null,
        callSeconds: 0,
        isCaller: false,
        isCallActive: false,
        callTimeoutTimer: null,
        currentStatus: 'initiating', // 'initiating', 'ringing', 'connected', 'ended'
        iceServers: [
            { urls: 'stun:stun.l.google.com:19302' },
            { urls: 'stun:stun1.l.google.com:19302' },
            { urls: 'stun:stun2.l.google.com:19302' }
        ],

        // Request a new call session
        async initiateCall(receiverId, callType = 'video', relatedType = 'appointment', relatedId = null) {
            PetGuardToast.info('Initiating secure encrypted call...', 'Calling');

            const res = await PetGuardAjax.post('call/request', {
                receiver_id: receiverId,
                call_type: callType,
                related_entity_type: relatedType,
                related_entity_id: relatedId
            });

            if (res.ok && res.data && res.data.session_token) {
                window.location.href = PetGuardAjax.resolveUrl(`call/room/${res.data.session_token}`);
            } else {
                PetGuardToast.error(res.message || 'Unable to connect call session.');
            }
        },

        // Incoming call listener for all pages
        startIncomingCallListener(intervalMs = 4000) {
            setInterval(async () => {
                // Do not check if already in an active room
                if (window.location.pathname.includes('/call/room')) return;

                const res = await PetGuardAjax.get('call/check-incoming');
                if (res.ok && res.data && res.data.incoming_call) {
                    const call = res.data.incoming_call;
                    this.showIncomingCallModal(call);
                }
            }, intervalMs);
        },

        showIncomingCallModal(call) {
            if (PetGuardModal.activeModal && PetGuardModal.activeModal.sessionToken === call.session_token) return;

            // Audio ringtone
            PetGuardAudioEngine.startRingtone();

            const isVideo = call.call_type === 'video';
            const role = (call.caller_role || 'veterinarian').toUpperCase();
            const initial = (call.caller_name || 'D').charAt(0).toUpperCase();

            const html = `
                <div class="incoming-call-box text-center py-2">
                    <div class="incoming-call-avatar-wrap position-relative mx-auto mb-3">
                        <div class="incoming-call-ring ring-1"></div>
                        <div class="incoming-call-ring ring-2"></div>
                        <div class="incoming-call-avatar-inner bg-brand text-white fw-bold shadow-lg d-flex align-items-center justify-content-center mx-auto">
                            ${initial}
                        </div>
                        <div class="incoming-call-badge-type position-absolute bottom-0 end-0 rounded-circle shadow-sm d-flex align-items-center justify-content-center bg-white border">
                            <i class="fa-solid ${isVideo ? 'fa-video text-primary' : 'fa-phone text-success'}" style="font-size: 13px;"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">${PetGuardToast.escapeHtml(call.caller_name || 'Clinical Doctor')}</h4>
                    <div class="mb-2">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <i class="fa-solid fa-user-doctor me-1"></i> ${PetGuardToast.escapeHtml(role)}
                        </span>
                    </div>
                    <p class="text-muted small mb-1">Incoming ${isVideo ? 'Telemedicine Video Consultation' : 'Clinical Audio Call'} &middot; <span class="fw-semibold text-dark text-capitalize">${PetGuardToast.escapeHtml(call.related_entity_type || 'Appointment')}</span></p>
                    <div class="text-success small fw-semibold d-inline-flex align-items-center gap-1">
                        <span class="spinner-grow spinner-grow-sm text-success" style="width: 8px; height: 8px;" role="status"></span>
                        Encrypted Medical Line Ringing...
                    </div>
                </div>
            `;

            const modal = PetGuardModal.create({
                type: 'incoming-call',
                title: `Incoming ${isVideo ? 'Video Consultation' : 'Audio Call'}`,
                htmlContent: html,
                confirmText: `<i class="fa-solid ${isVideo ? 'fa-video' : 'fa-phone'} me-1"></i> Accept & Join`,
                confirmClass: 'btn-success fw-bold px-4 py-2 shadow-sm',
                cancelText: '<i class="fa-solid fa-phone-slash me-1"></i> Decline',
                showCancel: true,
                onConfirm: async () => {
                    PetGuardAudioEngine.stopAll();
                    await PetGuardAjax.post(`call/${call.session_token}/accept`);
                    window.location.href = PetGuardAjax.resolveUrl(`call/room/${call.session_token}`);
                    return true;
                },
                onCancel: async () => {
                    PetGuardAudioEngine.stopAll();
                    await PetGuardAjax.post(`call/${call.session_token}/decline`);
                }
            });

            if (modal) modal.sessionToken = call.session_token;
        },

        // WebRTC Active Call Initializer
        async initCallRoom(sessionToken, isCaller) {
            this.sessionToken = sessionToken;
            this.isCaller = isCaller;
            this.isCallActive = true;

            // Prevent accidental refresh from dropping the call without confirmation
            window.addEventListener('beforeunload', this.handleBeforeUnload);

            const localVideo = document.getElementById('localVideo');
            const remoteVideo = document.getElementById('remoteVideo');

            // 1. Setup Status UI
            this.updateStatusBadge(isCaller ? 'initiating' : 'ringing');

            // If caller, start dial ringback tone
            if (isCaller) {
                PetGuardAudioEngine.startDialTone();

                // 40-second timeout for unattended calls
                this.callTimeoutTimer = setTimeout(async () => {
                    if (this.currentStatus !== 'connected') {
                        PetGuardAudioEngine.stopAll();
                        this.updateStatusBadge('missed');
                        await PetGuardAjax.post(`call/${this.sessionToken}/timeout`);
                        PetGuardToast.warning('Recipient is currently unavailable. Please try again later.');
                    }
                }, 40000);
            }

            // 2. Get User Media Stream
            try {
                this.localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                if (localVideo) localVideo.srcObject = this.localStream;
            } catch (err) {
                console.warn('Camera/Mic permission warning:', err);
                PetGuardToast.warning('Could not access camera/mic. Switched to view-only mode.');
            }

            // 3. Setup PeerConnection
            this.peerConnection = new RTCPeerConnection({ iceServers: this.iceServers });

            if (this.localStream) {
                this.localStream.getTracks().forEach(track => {
                    this.peerConnection.addTrack(track, this.localStream);
                });
            }

            this.peerConnection.ontrack = (event) => {
                if (remoteVideo && event.streams[0]) {
                    remoteVideo.srcObject = event.streams[0];
                    const placeholder = document.getElementById('remotePlaceholder');
                    if (placeholder) placeholder.style.display = 'none';
                }
            };

            this.peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    PetGuardAjax.post(`call/${this.sessionToken}/signal`, {
                        type: 'ice-candidate',
                        candidate: JSON.stringify(event.candidate),
                        is_caller: isCaller ? 1 : 0
                    });
                }
            };

            // 4. Offer / Answer negotiation
            if (isCaller) {
                const offer = await this.peerConnection.createOffer();
                await this.peerConnection.setLocalDescription(offer);
                await PetGuardAjax.post(`call/${this.sessionToken}/signal`, {
                    type: 'offer',
                    sdp: JSON.stringify(offer),
                    is_caller: 1
                });
            }

            // 5. Start Signaling Polling with WhatsApp-Style State Transitions
            this.pollInterval = setInterval(async () => {
                const res = await PetGuardAjax.get(`call/${this.sessionToken}/poll-signal`);
                if (!res.ok || !res.data) return;

                const session = res.data.session;
                if (!session) return;

                // Status Transition: initiating -> ringing -> connected -> ended
                if (session.status !== this.currentStatus) {
                    this.updateStatusBadge(session.status);
                }

                if (session.status === 'connected') {
                    PetGuardAudioEngine.stopAll();
                    if (this.callTimeoutTimer) {
                        clearTimeout(this.callTimeoutTimer);
                        this.callTimeoutTimer = null;
                    }
                    if (!this.timerInterval) {
                        this.startCallTimer();
                    }
                }

                if (session.status === 'ended' || session.status === 'rejected' || session.status === 'missed') {
                    clearInterval(this.pollInterval);
                    PetGuardAudioEngine.stopAll();
                    this.isCallActive = false;
                    window.removeEventListener('beforeunload', this.handleBeforeUnload);

                    if (session.status === 'rejected') {
                        PetGuardToast.warning('Consultation was declined by the participant.');
                    } else if (session.status === 'missed') {
                        PetGuardToast.warning('No answer. Recipient is currently unavailable.');
                    } else {
                        PetGuardToast.info('The consultation has ended.');
                    }
                    setTimeout(() => window.location.href = PetGuardAjax.resolveUrl('portal'), 1800);
                    return;
                }

                // If receiver and offer is ready
                if (!isCaller && session.offer_sdp && !this.peerConnection.remoteDescription) {
                    const offer = JSON.parse(session.offer_sdp);
                    await this.peerConnection.setRemoteDescription(new RTCSessionDescription(offer));
                    const answer = await this.peerConnection.createAnswer();
                    await this.peerConnection.setLocalDescription(answer);
                    await PetGuardAjax.post(`call/${this.sessionToken}/signal`, {
                        type: 'answer',
                        sdp: JSON.stringify(answer),
                        is_caller: 0
                    });
                }

                // If caller and answer is ready
                if (isCaller && session.answer_sdp && !this.peerConnection.remoteDescription) {
                    const answer = JSON.parse(session.answer_sdp);
                    await this.peerConnection.setRemoteDescription(new RTCSessionDescription(answer));
                }

                // Process ICE candidates
                const candidateJson = isCaller ? session.receiver_ice_candidates : session.caller_ice_candidates;
                if (candidateJson) {
                    try {
                        const candidates = JSON.parse(candidateJson);
                        if (Array.isArray(candidates)) {
                            candidates.forEach(async (cand) => {
                                try {
                                    await this.peerConnection.addIceCandidate(new RTCIceCandidate(cand));
                                } catch (e) {}
                            });
                        }
                    } catch (e) {}
                }
            }, 1800);
        },

        handleBeforeUnload(e) {
            e.preventDefault();
            e.returnValue = 'You are in an active medical consultation. Leaving will disconnect your video stream.';
            return e.returnValue;
        },

        updateStatusBadge(status) {
            this.currentStatus = status;
            const badgeEl = document.getElementById('callStatusBadge');
            if (!badgeEl) return;

            if (status === 'initiating') {
                badgeEl.innerHTML = `
                    <span class="spinner-grow spinner-grow-sm text-info" style="width: 8px; height: 8px;" role="status"></span>
                    <span>Calling...</span>
                `;
            } else if (status === 'ringing') {
                badgeEl.innerHTML = `
                    <i class="fa-solid fa-phone-volume text-success animate-pulse"></i>
                    <span>Ringing...</span>
                `;
            } else if (status === 'connected') {
                badgeEl.innerHTML = `
                    <span class="spinner-grow spinner-grow-sm text-success" style="width: 8px; height: 8px;" role="status"></span>
                    <span class="text-success fw-bold">Connected (HD)</span>
                    <span class="text-muted ms-1">&middot;</span>
                    <span id="callTimerDisplay" class="font-monospace fw-bold text-white">00:00</span>
                `;
            } else if (status === 'missed') {
                badgeEl.innerHTML = `
                    <span class="text-warning fw-bold"><i class="fa-solid fa-phone-slash me-1"></i> No Answer</span>
                `;
            } else if (status === 'rejected') {
                badgeEl.innerHTML = `
                    <span class="text-danger fw-bold"><i class="fa-solid fa-phone-slash me-1"></i> Declined</span>
                `;
            } else if (status === 'ended') {
                badgeEl.innerHTML = `
                    <span class="text-muted fw-bold"><i class="fa-solid fa-check-double me-1"></i> Consultation Ended</span>
                `;
            }
        },

        startCallTimer() {
            const timerEl = document.getElementById('callTimerDisplay');
            this.callSeconds = 0;
            this.timerInterval = setInterval(() => {
                this.callSeconds++;
                const mins = String(Math.floor(this.callSeconds / 60)).padStart(2, '0');
                const secs = String(this.callSeconds % 60).padStart(2, '0');
                const liveTimerEl = document.getElementById('callTimerDisplay');
                if (liveTimerEl) liveTimerEl.textContent = `${mins}:${secs}`;
            }, 1000);
        },

        toggleAudio(btn) {
            if (!this.localStream) return;
            const audioTrack = this.localStream.getAudioTracks()[0];
            if (audioTrack) {
                audioTrack.enabled = !audioTrack.enabled;
                btn.classList.toggle('btn-danger', !audioTrack.enabled);
                btn.classList.toggle('btn-light', audioTrack.enabled);
                btn.innerHTML = audioTrack.enabled ? '<i class="fa-solid fa-microphone"></i>' : '<i class="fa-solid fa-microphone-slash"></i>';
                btn.title = audioTrack.enabled ? 'Mute Microphone' : 'Unmute Microphone';
                PetGuardToast.info(audioTrack.enabled ? 'Microphone unmuted' : 'Microphone muted');
            }
        },

        toggleVideo(btn) {
            if (!this.localStream) return;
            const videoTrack = this.localStream.getVideoTracks()[0];
            if (videoTrack) {
                videoTrack.enabled = !videoTrack.enabled;
                btn.classList.toggle('btn-danger', !videoTrack.enabled);
                btn.classList.toggle('btn-light', videoTrack.enabled);
                btn.innerHTML = videoTrack.enabled ? '<i class="fa-solid fa-video"></i>' : '<i class="fa-solid fa-video-slash"></i>';
                btn.title = videoTrack.enabled ? 'Turn Off Camera' : 'Turn On Camera';
                PetGuardToast.info(videoTrack.enabled ? 'Camera turned on' : 'Camera turned off');
            }
        },

        async toggleScreenShare(btn) {
            if (!this.peerConnection) return;
            try {
                if (!this.screenStream) {
                    this.screenStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
                    const screenTrack = this.screenStream.getVideoTracks()[0];
                    const sender = this.peerConnection.getSenders().find(s => s.track && s.track.kind === 'video');
                    if (sender) {
                        sender.replaceTrack(screenTrack);
                    }
                    const localVideo = document.getElementById('localVideo');
                    if (localVideo) localVideo.srcObject = this.screenStream;

                    btn.classList.add('btn-primary');
                    btn.classList.remove('btn-light');
                    btn.title = 'Stop Screen Share';
                    PetGuardToast.success('Screen sharing started.');

                    screenTrack.onended = () => {
                        this.stopScreenShare(btn);
                    };
                } else {
                    this.stopScreenShare(btn);
                }
            } catch (err) {
                console.warn('Screen share error:', err);
            }
        },

        stopScreenShare(btn) {
            if (this.screenStream) {
                this.screenStream.getTracks().forEach(t => t.stop());
                this.screenStream = null;
            }
            if (this.localStream) {
                const videoTrack = this.localStream.getVideoTracks()[0];
                const sender = this.peerConnection.getSenders().find(s => s.track && s.track.kind === 'video');
                if (sender && videoTrack) {
                    sender.replaceTrack(videoTrack);
                }
                const localVideo = document.getElementById('localVideo');
                if (localVideo) localVideo.srcObject = this.localStream;
            }
            if (btn) {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-light');
                btn.title = 'Share Screen';
            }
            PetGuardToast.info('Screen sharing stopped.');
        },

        toggleFullscreen() {
            const container = document.querySelector('.webrtc-call-container');
            if (!document.fullscreenElement) {
                if (container && container.requestFullscreen) {
                    container.requestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        },

        async endCall() {
            const confirmed = await PetGuardModal.confirm({
                title: 'End Consultation Call',
                message: 'Are you sure you want to end this active consultation call?',
                confirmText: '<i class="fa-solid fa-phone-slash me-1"></i> End Call',
                confirmClass: 'btn-danger fw-bold'
            });

            if (confirmed) {
                this.isCallActive = false;
                window.removeEventListener('beforeunload', this.handleBeforeUnload);
                PetGuardAudioEngine.stopAll();

                if (this.localStream) {
                    this.localStream.getTracks().forEach(t => t.stop());
                }
                if (this.screenStream) {
                    this.screenStream.getTracks().forEach(t => t.stop());
                }
                if (this.peerConnection) {
                    this.peerConnection.close();
                }
                clearInterval(this.pollInterval);
                clearInterval(this.timerInterval);
                if (this.callTimeoutTimer) clearTimeout(this.callTimeoutTimer);

                await PetGuardAjax.post(`call/${this.sessionToken}/end`, {
                    duration_seconds: this.callSeconds
                });

                PetGuardToast.info('Consultation completed.');
                setTimeout(() => window.location.href = PetGuardAjax.resolveUrl('portal'), 600);
            }
        }
    };

    // ==========================================
    // 5. LIVE SEARCH & DEBOUNCE HELPER
    // ==========================================
    function debounce(func, wait = 300) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Expose PetGuard Globals to window
    window.PetGuardToast = PetGuardToast;
    window.PetGuardModal = PetGuardModal;
    window.PetGuardAjax = PetGuardAjax;
    window.PetGuardCall = PetGuardCall;
    window.PetGuardDebounce = debounce;

    // Auto initialize incoming call listener on document load
    document.addEventListener('DOMContentLoaded', () => {
        PetGuardToast.init();
        PetGuardCall.startIncomingCallListener(5000);
    });

})(window, document);
