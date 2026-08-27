<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-shield-cat text-warning"></i>
            <span>Universal Pet Registry</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">Cryptographic QR Passport</span>
        </div>
        <h2 class="portal-hero-title">Register New Companion 🐕</h2>
        <p class="portal-hero-subtitle">Official PetGuard Universal Registration &amp; Cryptographic QR Digital Passport Generation.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/pets') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Pets</span>
        </a>
    </div>
</div>

<!-- 2. Registration Form Layout -->
<form action="<?= ViewHelper::url('portal/pets/create') ?>" method="POST" enctype="multipart/form-data" id="registerPetForm">
    <?= ViewHelper::csrfField() ?>
    <input type="hidden" name="preset_avatar" id="selectedPresetAvatar" value="img/avatars/avatar-dog.svg">

    <div class="row g-4">
        
        <!-- Left Column: Live Card Preview & Avatar Animation Selector -->
        <div class="col-lg-4">
            
            <!-- Live Digital Passport Preview Card -->
            <div class="admin-card p-4 text-center mb-4 position-sticky" style="top: 90px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 text-uppercase fw-bold" style="font-size: 11px;">
                        <i class="fa-solid fa-shield-halved me-1"></i> New Passport
                    </span>
                    <span class="badge bg-light text-dark border font-monospace" style="font-size: 11px;">AUTO-GENERATED</span>
                </div>

                <!-- Animated Avatar Preview Container -->
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <div class="rounded-4 p-3 border shadow-sm d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: #fff8e5; transition: all 0.3s ease;">
                        <img src="<?= ViewHelper::asset('img/avatars/avatar-dog.svg') ?>" alt="Pet Preview" id="petLiveAvatarPreview" class="img-fluid" style="max-height: 90px; object-fit: contain;">
                    </div>
                    <label for="avatarFileInput" class="btn btn-sm btn-admin-primary rounded-circle position-absolute shadow" style="bottom: -5px; right: -5px; width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;" title="Upload Custom Photo/Animation">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                    <input type="file" id="avatarFileInput" name="avatar_file" accept="image/*" class="d-none">
                </div>

                <h4 class="fw-bold text-dark mb-1" id="previewPetName">Buddy</h4>
                <div class="text-muted small mb-2" id="previewPetSpeciesBreed">Dog &bull; Golden Retriever</div>
                
                <div class="p-3 bg-light rounded-3 border text-start small mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Age:</span>
                        <strong class="text-dark" id="previewPetAge">2 Years</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Gender:</span>
                        <strong class="text-dark" id="previewPetGender">Male</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Weight:</span>
                        <strong class="text-dark" id="previewPetWeight">15 kg</strong>
                    </div>
                </div>

                <!-- Animated Avatar Presets Picker -->
                <div class="text-start">
                    <label class="form-label small fw-bold text-dark mb-2">Or Choose Animated Icon:</label>
                    <div class="d-flex gap-2 justify-content-center flex-wrap" id="presetAvatarGrid">
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn active shadow-sm" data-avatar="img/avatars/avatar-dog.svg" data-species="Dog" style="width: 50px; height: 50px; background: #fff8e5;" title="Dog">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-dog.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Dog">
                        </button>
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn shadow-sm" data-avatar="img/avatars/avatar-cat.svg" data-species="Cat" style="width: 50px; height: 50px; background: #fff8e5;" title="Cat">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-cat.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Cat">
                        </button>
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn shadow-sm" data-avatar="img/avatars/avatar-rabbit.svg" data-species="Rabbit" style="width: 50px; height: 50px; background: #fff8e5;" title="Rabbit">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-rabbit.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Rabbit">
                        </button>
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn shadow-sm" data-avatar="img/avatars/avatar-bird.svg" data-species="Bird" style="width: 50px; height: 50px; background: #fff8e5;" title="Bird">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-bird.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Bird">
                        </button>
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn shadow-sm" data-avatar="img/avatars/avatar-hamster.svg" data-species="Hamster" style="width: 50px; height: 50px; background: #fff8e5;" title="Hamster">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-hamster.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Hamster">
                        </button>
                        <button type="button" class="btn btn-light border p-1 rounded-4 preset-avatar-btn shadow-sm" data-avatar="img/avatars/avatar-horse.svg" data-species="Horse" style="width: 50px; height: 50px; background: #fff8e5;" title="Horse">
                            <img src="<?= ViewHelper::asset('img/avatars/avatar-horse.svg') ?>" class="w-100 h-100 object-fit-contain" alt="Horse">
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Registration Form Fields -->
        <div class="col-lg-8">
            
            <!-- Card 1: Companion Bio & Identification -->
            <div class="admin-card p-4 mb-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-paw text-brand me-2"></i> 1. Pet Bio & Identification</h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Pet Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="petNameInput" class="form-control rounded-3" placeholder="e.g. Milo, Luna, Charlie" value="<?= ViewHelper::old('name') ?>" required>
                    </div>

                    <!-- Species Quick Selector -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Animal Type / Species <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="species" id="petSpeciesSelect" class="form-select rounded-3" required>
                                <option value="Dog" selected>🐶 Dog (Canine)</option>
                                <option value="Cat">🐱 Cat (Feline)</option>
                                <option value="Rabbit">🐰 Rabbit (Lagomorph)</option>
                                <option value="Bird">🦜 Bird (Avian)</option>
                                <option value="Hamster">🐹 Hamster / Pocket Pet</option>
                                <option value="Horse">🐴 Horse (Equine)</option>
                                <option value="Reptile">🦎 Reptile / Amphibian</option>
                                <option value="Other">🐾 Other Companion Animal</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Breed <span class="text-danger">*</span></label>
                        <input type="text" name="breed" id="petBreedInput" class="form-control rounded-3" placeholder="e.g. Golden Retriever, Persian, Mixed" value="<?= ViewHelper::old('breed', 'Golden Retriever') ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Gender <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="gender" id="genderMale" value="Male" checked autocomplete="off">
                            <label class="btn btn-outline-secondary flex-grow-1 rounded-3 py-2 fw-semibold" for="genderMale">
                                <i class="fa-solid fa-mars text-primary me-1"></i> Male
                            </label>

                            <input type="radio" class="btn-check" name="gender" id="genderFemale" value="Female" autocomplete="off">
                            <label class="btn btn-outline-secondary flex-grow-1 rounded-3 py-2 fw-semibold" for="genderFemale">
                                <i class="fa-solid fa-venus text-danger me-1"></i> Female
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Smart Birthday & Custom Calendar Age Calculator -->
            <div class="admin-card p-4 mb-4" style="position: relative; z-index: 50; overflow: visible;">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-cake-candles text-brand me-2"></i> 2. Birthday & Smart Age Calculator</h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Date of Birth (DOB)</label>
                        <div class="pg-datepicker-container" id="petBirthdayContainer">
                            <div class="pg-datepicker-input-wrap">
                                <input type="text" id="petBirthdayDisplay" class="form-control rounded-3" placeholder="Select Birthday from Calendar..." readonly>
                                <input type="hidden" name="birthday" id="petBirthdayInput" value="<?= ViewHelper::old('birthday') ?>">
                                <i class="fa-solid fa-calendar-days calendar-icon"></i>
                            </div>
                            
                            <!-- Custom Luxury Calendar Popover -->
                            <div class="pg-calendar-popover" id="pgCalendarPopover">
                                
                                <!-- Life-Stage Presets -->
                                <div class="pg-calendar-presets">
                                    <button type="button" class="pg-calendar-preset-btn" data-months="3">🍼 Puppy/Kitten (3 mo)</button>
                                    <button type="button" class="pg-calendar-preset-btn" data-months="12">🎾 Young (1 yr)</button>
                                    <button type="button" class="pg-calendar-preset-btn" data-months="36">🐕 Adult (3 yrs)</button>
                                    <button type="button" class="pg-calendar-preset-btn" data-months="96">🐾 Senior (8 yrs)</button>
                                </div>

                                <!-- Month & Year Controls -->
                                <div class="pg-calendar-header">
                                    <button type="button" class="pg-calendar-nav-btn" id="pgCalPrevMonth" title="Previous Month">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <div class="pg-calendar-title">
                                        <select id="pgCalMonthSelect" class="pg-calendar-select">
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                        <select id="pgCalYearSelect" class="pg-calendar-select"></select>
                                    </div>
                                    <button type="button" class="pg-calendar-nav-btn" id="pgCalNextMonth" title="Next Month">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>

                                <!-- Weekday Headers -->
                                <div class="pg-calendar-weekdays">
                                    <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                                </div>

                                <!-- Day Matrix Grid -->
                                <div class="pg-calendar-days" id="pgCalDaysGrid"></div>

                                <!-- Action Buttons -->
                                <div class="pg-calendar-footer">
                                    <button type="button" class="btn btn-sm btn-link text-muted p-0 text-decoration-none" id="pgCalClearBtn">Clear</button>
                                    <button type="button" class="btn btn-sm btn-link text-brand fw-bold p-0 text-decoration-none" id="pgCalTodayBtn">Today</button>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted" id="ageCalculationNote">Click to open luxury calendar or pick a life-stage.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Current Age <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="age" id="petAgeInput" class="form-control rounded-3" placeholder="e.g. 2 Years, 6 Months" value="2 Years" required>
                            <span class="input-group-text bg-light text-muted small"><i class="fa-solid fa-calculator text-brand"></i></span>
                        </div>
                        <small class="text-muted" id="ageCalculationNote">Auto-calculated from birthday or entered directly.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Weight (kg) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="weight" id="petWeightInput" class="form-control rounded-3" placeholder="e.g. 15 kg or 4.2" value="15 kg" required>
                            <span class="input-group-text bg-light text-muted">kg</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Color & Distinguishing Markings</label>
                        <input type="text" name="color" class="form-control rounded-3" placeholder="e.g. Golden brown with white patch on chest">
                    </div>
                </div>
            </div>

            <!-- Card 3: Clinical Biometrics & Emergency Data -->
            <div class="admin-card p-4 mb-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-shield-virus text-brand me-2"></i> 3. Clinical Identification & Dietary Safety</h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">ISO Microchip ID</label>
                        <input type="text" name="microchip_id" class="form-control rounded-3 font-monospace" placeholder="e.g. 985141002345678">
                        <small class="text-muted">15-digit standard ISO 11784/11785 veterinary microchip identifier.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-dark">Blood Group</label>
                        <select name="blood_group" class="form-select rounded-3">
                            <option value="">Select blood group (if known)</option>
                            <option value="DEA 1.1+ (Canine)">DEA 1.1+ (Canine)</option>
                            <option value="DEA 1.1- (Universal Canine)">DEA 1.1- (Universal Canine)</option>
                            <option value="Type A (Feline)">Type A (Feline)</option>
                            <option value="Type B (Feline)">Type B (Feline)</option>
                            <option value="Type AB (Feline)">Type AB (Feline)</option>
                            <option value="Universal / Not Tested">Not Tested</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Allergies & Medical Cautions</label>
                        <input type="text" name="allergies" class="form-control rounded-3" placeholder="e.g. Penicillin allergy, Chicken intolerance, Sensitive skin">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Diet & Daily Feeding Instructions</label>
                        <textarea name="diet_instructions" class="form-control rounded-3" rows="2" placeholder="e.g. 1.5 cups dry kibble twice daily with fresh water. Avoid grain products."></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button Footer (5-Screen Optimized) -->
            <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3">
                    <a href="<?= ViewHelper::url('portal/pets') ?>" class="btn btn-outline-secondary rounded-pill px-4 py-2 d-inline-flex align-items-center justify-content-center gap-2 fw-semibold order-2 order-sm-1" style="min-height: 48px; font-size: 14px;">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back to Family Pets</span>
                    </a>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4 py-2 d-inline-flex align-items-center justify-content-center gap-2 fw-bold shadow-sm order-1 order-sm-2" style="min-height: 48px; font-size: 14.5px;">
                        <i class="fa-solid fa-qrcode fs-5"></i>
                        <span>Register Companion &amp; Generate QR Passport</span>
                        <i class="fa-solid fa-arrow-right ms-1 d-none d-md-inline"></i>
                    </button>
                </div>
            </div>

        </div>

    </div>
</form>

<!-- Interactive Live Age Calculation & Avatar Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('petNameInput');
    const speciesSelect = document.getElementById('petSpeciesSelect');
    const breedInput = document.getElementById('petBreedInput');
    const birthdayInput = document.getElementById('petBirthdayInput');
    const ageInput = document.getElementById('petAgeInput');
    const weightInput = document.getElementById('petWeightInput');
    const avatarFileInput = document.getElementById('avatarFileInput');
    const selectedPresetAvatar = document.getElementById('selectedPresetAvatar');
    const petLiveAvatarPreview = document.getElementById('petLiveAvatarPreview');
    const presetBtns = document.querySelectorAll('.preset-avatar-btn');

    // Live preview elements
    const previewPetName = document.getElementById('previewPetName');
    const previewPetSpeciesBreed = document.getElementById('previewPetSpeciesBreed');
    const previewPetAge = document.getElementById('previewPetAge');
    const previewPetGender = document.getElementById('previewPetGender');
    const previewPetWeight = document.getElementById('previewPetWeight');

    // 1. Live Name Sync
    if (nameInput && previewPetName) {
        nameInput.addEventListener('input', function() {
            previewPetName.innerText = this.value.trim() || 'My Pet';
        });
    }

    // 2. Live Species & Breed Sync
    function updateSpeciesBreed() {
        const species = speciesSelect ? speciesSelect.value : 'Dog';
        const breed = breedInput ? breedInput.value : '';
        if (previewPetSpeciesBreed) {
            previewPetSpeciesBreed.innerHTML = `${species} &bull; ${breed || 'Purebred/Mixed'}`;
        }
    }
    if (speciesSelect) speciesSelect.addEventListener('change', updateSpeciesBreed);
    if (breedInput) breedInput.addEventListener('input', updateSpeciesBreed);

    // 3. Live Gender Sync
    document.querySelectorAll('input[name="gender"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (previewPetGender) previewPetGender.innerText = this.value;
        });
    });

    // 4. Live Weight Sync
    if (weightInput && previewPetWeight) {
        weightInput.addEventListener('input', function() {
            previewPetWeight.innerText = this.value.trim() || '15 kg';
        });
    }

    // 5. PetGuard Custom Calendar DatePicker & Age Calculation Engine
    const calContainer = document.getElementById('petBirthdayContainer');
    const calPopover = document.getElementById('pgCalendarPopover');
    const calDisplay = document.getElementById('petBirthdayDisplay');
    const calMonthSelect = document.getElementById('pgCalMonthSelect');
    const calYearSelect = document.getElementById('pgCalYearSelect');
    const calPrevMonth = document.getElementById('pgCalPrevMonth');
    const calNextMonth = document.getElementById('pgCalNextMonth');
    const calDaysGrid = document.getElementById('pgCalDaysGrid');
    const calTodayBtn = document.getElementById('pgCalTodayBtn');
    const calClearBtn = document.getElementById('pgCalClearBtn');
    const calPresetBtns = document.querySelectorAll('.pg-calendar-preset-btn');

    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    let selectedDateStr = birthdayInput ? birthdayInput.value : '';

    // Populate Year Dropdown (Current year down 25 years)
    if (calYearSelect) {
        calYearSelect.innerHTML = '';
        for (let y = currentYear; y >= currentYear - 25; y--) {
            const opt = document.createElement('option');
            opt.value = y;
            opt.innerText = y;
            calYearSelect.appendChild(opt);
        }
    }

    function calculateAndSetAge(dobDate) {
        const today = new Date();
        let years = today.getFullYear() - dobDate.getFullYear();
        let months = today.getMonth() - dobDate.getMonth();
        let days = today.getDate() - dobDate.getDate();

        if (days < 0) {
            months--;
        }
        if (months < 0) {
            years--;
            months += 12;
        }

        let calculatedAge = '';
        if (years > 0) {
            calculatedAge = years + (years === 1 ? ' Year' : ' Years');
            if (months > 0) {
                calculatedAge += ' ' + months + (months === 1 ? ' Month' : ' Months');
            }
        } else if (months > 0) {
            calculatedAge = months + (months === 1 ? ' Month' : ' Months');
        } else {
            calculatedAge = 'Newborn Puppy/Kitten';
        }

        if (ageInput) ageInput.value = calculatedAge;
        if (previewPetAge) previewPetAge.innerText = calculatedAge;
        
        const noteEl = document.getElementById('ageCalculationNote');
        if (noteEl) {
            const formatted = dobDate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
            noteEl.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-check me-1"></i> Age: ${calculatedAge} (DOB: ${formatted})</span>`;
        }
    }

    function renderCalendar(year, month) {
        if (!calDaysGrid) return;
        calDaysGrid.innerHTML = '';
        if (calMonthSelect) calMonthSelect.value = month;
        if (calYearSelect) calYearSelect.value = year;

        const firstDayIndex = new Date(year, month, 1).getDay();
        const lastDay = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        const todayStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

        // Empty days before 1st of month
        for (let i = 0; i < firstDayIndex; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'pg-calendar-day empty';
            calDaysGrid.appendChild(emptyDiv);
        }

        // Days of month
        for (let day = 1; day <= lastDay; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'pg-calendar-day';
            dayDiv.innerText = day;

            const thisDate = new Date(year, month, day);
            const thisDateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            if (thisDate > today) {
                dayDiv.classList.add('disabled');
            } else {
                if (thisDateStr === selectedDateStr) {
                    dayDiv.classList.add('selected');
                } else if (thisDateStr === todayStr) {
                    dayDiv.classList.add('today');
                }

                dayDiv.addEventListener('click', function(e) {
                    e.stopPropagation();
                    selectDate(thisDate);
                });
            }

            calDaysGrid.appendChild(dayDiv);
        }
    }

    function selectDate(dateObj) {
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const day = String(dateObj.getDate()).padStart(2, '0');
        const ymd = `${year}-${month}-${day}`;

        selectedDateStr = ymd;
        if (birthdayInput) birthdayInput.value = ymd;
        if (calDisplay) {
            calDisplay.value = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        }

        calculateAndSetAge(dateObj);
        renderCalendar(dateObj.getFullYear(), dateObj.getMonth());
        closeCalendar();
    }

    function openCalendar() {
        if (!calPopover) return;
        calPopover.classList.add('show');
        if (calContainer) calContainer.classList.add('is-open');
        const targetYear = selectedDateStr ? parseInt(selectedDateStr.split('-')[0]) : currentYear;
        const targetMonth = selectedDateStr ? parseInt(selectedDateStr.split('-')[1]) - 1 : currentMonth;
        renderCalendar(targetYear, targetMonth);
    }

    function closeCalendar() {
        if (!calPopover) return;
        calPopover.classList.remove('show');
        if (calContainer) calContainer.classList.remove('is-open');
    }

    function toggleCalendar() {
        if (!calPopover) return;
        if (calPopover.classList.contains('show')) {
            closeCalendar();
        } else {
            openCalendar();
        }
    }

    // Toggle Calendar on input wrap click
    const inputWrap = calContainer ? calContainer.querySelector('.pg-datepicker-input-wrap') : null;
    if (inputWrap) {
        inputWrap.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleCalendar();
        });
    }

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (calContainer && !calContainer.contains(e.target)) {
            closeCalendar();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCalendar();
        }
    });

    // Month / Year Navigation
    if (calPrevMonth) {
        calPrevMonth.addEventListener('click', function(e) {
            e.stopPropagation();
            let y = parseInt(calYearSelect.value);
            let m = parseInt(calMonthSelect.value) - 1;
            if (m < 0) { m = 11; y--; }
            renderCalendar(y, m);
        });
    }
    if (calNextMonth) {
        calNextMonth.addEventListener('click', function(e) {
            e.stopPropagation();
            let y = parseInt(calYearSelect.value);
            let m = parseInt(calMonthSelect.value) + 1;
            if (m > 11) { m = 0; y++; }
            renderCalendar(y, m);
        });
    }
    if (calMonthSelect) {
        calMonthSelect.addEventListener('change', function(e) {
            e.stopPropagation();
            renderCalendar(parseInt(calYearSelect.value), parseInt(this.value));
        });
    }
    if (calYearSelect) {
        calYearSelect.addEventListener('change', function(e) {
            e.stopPropagation();
            renderCalendar(parseInt(this.value), parseInt(calMonthSelect.value));
        });
    }

    // Presets Click
    calPresetBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const monthsAgo = parseInt(this.getAttribute('data-months'));
            const d = new Date();
            d.setMonth(d.getMonth() - monthsAgo);
            selectDate(d);
        });
    });

    // Today / Clear Buttons
    if (calTodayBtn) {
        calTodayBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            selectDate(new Date());
        });
    }
    if (calClearBtn) {
        calClearBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            selectedDateStr = '';
            if (birthdayInput) birthdayInput.value = '';
            if (calDisplay) calDisplay.value = '';
            if (calPopover) calPopover.classList.remove('show');
            const noteEl = document.getElementById('ageCalculationNote');
            if (noteEl) noteEl.innerText = 'Click to open luxury calendar or pick a life-stage.';
        });
    }

    // Direct manual age edit sync
    if (ageInput) {
        ageInput.addEventListener('input', function() {
            if (previewPetAge) previewPetAge.innerText = this.value.trim() || '2 Years';
        });
    }

    // 6. Preset Animated Avatar Selection
    presetBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            presetBtns.forEach(b => b.classList.remove('active', 'border-brand'));
            this.classList.add('active', 'border-brand');
            
            const avatarSrc = this.getAttribute('data-avatar');
            const speciesVal = this.getAttribute('data-species');
            const imgEl = this.querySelector('img');
            if (selectedPresetAvatar) selectedPresetAvatar.value = avatarSrc;
            if (petLiveAvatarPreview && imgEl) petLiveAvatarPreview.src = imgEl.src;
            if (avatarFileInput) avatarFileInput.value = ''; // clear custom upload

            // Auto-select species if matched
            if (speciesSelect && speciesVal) {
                for (let i = 0; i < speciesSelect.options.length; i++) {
                    if (speciesSelect.options[i].value.toLowerCase() === speciesVal.toLowerCase()) {
                        speciesSelect.selectedIndex = i;
                        updateSpeciesBreed();
                        break;
                    }
                }
            }
        });
    });

    // 7. Custom Avatar Image / Animation File Upload
    if (avatarFileInput && petLiveAvatarPreview) {
        avatarFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(evt) {
                petLiveAvatarPreview.src = evt.target.result;
                presetBtns.forEach(b => b.classList.remove('active', 'border-brand'));
                if (selectedPresetAvatar) selectedPresetAvatar.value = '';
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
