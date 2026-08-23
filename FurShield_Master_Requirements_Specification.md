# 🙡️ FurShield: Master System Requirements & Enterprise Architecture Specification (SRS + PRD)

**Project Name:** FurShield — Advanced Pet Care & Healthcare Ecosystem  
**Document Version:** 2.0 (Final Comprehensive Enterprise Specification)  
**System Architecture:** 4-Role Unified Pet-Centric RBAC  
**Technology Stack:** MERN (MongoDB, Express.js, React.js, Node.js) + Tailwind CSS + Vite  

---

## 📑 Table of Contents
1. [Executive Summary & Ecosystem Philosophy](#1-executive-summary---ecosystem-philosophy)
2. [Master 4-Role Permission Matrix (RBAC)](#2-master-4-role-permission-matrix-rbac)
3. [Role 1: Pet Owner Portal — Detailed Specification](#3-role-1-pet-owner-portal---detailed-specification)
4. [Role 2: Veterinarian Portal — Detailed Clinical Practice Specification](#4-role-2-veterinarian-portal---detailed-clinical-practice-specification)
5. [Role 3: Animal Shelter Portal — Detailed Rescue & Adoption Specification](#5-role-3-animal-shelter-portal---detailed-rescue---adoption-specification)
6. [Role 4: Administrator Portal — Platform Governance & Analytics](#6-role-4-administrator-portal---platform-governance---analytics)
7. [Cross-Cutting Shared Engines & Intelligent Services](#7-cross-cutting-shared-engines---intelligent-services)
8. [Master Database Architecture (24+ Relational Schemas)](#8-master-database-architecture-24-relational-schemas)
9. [End-to-End System Workflows & Lifecycle Diagrams](#9-end-to-end-system-workflows---lifecycle-diagrams)

---

## 1. Executive Summary & Ecosystem Philosophy

**FurShield** is not a basic CRUD pet website. It is an enterprise-grade **Pet Healthcare, Veterinary Practice Management, Multi-Shelter Animal Rescue, and Intelligent Care Ecosystem**.

```
Care Ecosystem Architecture:
   [01. Owner Portal]   [02. Veterinarian Portal]   [03. Animal Shelter]   [04. Administrator]
                                         |
                     ++--------------------+--------------------+
                    |                                       |
                    v                                       v 
         [PET MASTER RECORD & QR PASSPORT] <---> [HEALTH TIMELINE & DOCUMENTS VAULT]
                    |                                       |
                    v                                       v 
        [VACCINES & MEDICATION SCHEDULER]  <---> [CARE PLANNER & SCORE (0-100)]
                    |                                     |
                    v                                      v 
        [CLINICAL VITALS, RN & LABS]         <---> [1-CLICK EMERGENCY MODE]
```(
### 🌿 Central Architectural Principle: "Pet as the Master Graph"
Every module, action, and intelligent engine connects directly to the **Pet Master Record (Pet ID)**:
* **Pet Profile** ⚡ **Medical History Timeline** ⚡ **Vaccine/Med Reminders** ⚡ **Care Score (0-100)** ⚡ **Vet Consultations & Rx** ⚡ **Digital QR Passport** ⚡ **Emergency Mode Card** ⚡ **AI Assistant Context**.

---

## 2. Master 4-Role Permission Matrix (RBAC)

|Feature / Module | 👥 Pet Owner | 👨‍⛕ Veterinarian | 🏠 Animal Shelter | 🛦️ Administrator |
| :--- | :--: | :--: | :--* | :--: |
| **Pet Registration & Digital Identity** | Full (Own Pets) | Read-Only (Patients) | Full (Shelter Pets) | Full Admin Access |
|| **Medical Timeline & Document Vault** | Read / Upload | Full Write / Edit | Read / Edit (Shelter) | Read / Audit |
| **Vaccines & Medication Scheduler** | Log / Track | Prescribe / Update | Log (Shelter Animals) | Manage Standard Types |
| **Care Planner & Care Score (0-100)** | Full Management | View in Consult | Track Daily Routine | Configure Weights |
| **Digital QR Passport & Privacy Controls** | Full Control | Scan & Access | Generate for Rescue | Monitor / Revoke |
|| **Emergency Mode 1-Click Trigger** | Activate / View | Receive Emergencies | N/A | Global Monitoring |
| **Appointment Booking & Slots** | Book / Reschedule | Manage Schedule/Slots| N/A | Oversee All Bookings |
| **Clinical Consultation & Prescriptions**| View Prescriptions| Full Clinical Entry | View if Shelter Pet | Audit / Review |
| **Adoption Listings & Matching Engine** | Browse & Apply | View Medical History | Create & Manage Listings| Moderate Content |
| **Adoption Applications Workflow** | Submit & Track | N/A | Review, Interview, Approve| Dispute Resolution |
| **Product Marketplace & Cart/Orders** | Browse, Cart, Order| N/A | Order Shelter Supplies | Full Catalog & Orders |
| **AI Pet Care Assistant & Summarizer** | Full Chat Access | View Visit Summaries | General Advice | Configure & Monitor |
|| **Audit Logs & Platform Analytics** | N/A | N/A | N/A | Full Global Access |

---

## 3. Role 1: Pet Owner Portal — Detailed Specification

### 3.1 Dashboard & Health Command Center
* **Live Health Cards:** Card for each registered pet displaying photo, name, species, breed, age, weight, microchip ID, and real-time **Care Score (0-100)**.
* **Smart Alert Banners:** Instant notification banners for:
  * Upcoming Vaccinations (*e.g., "Rabies booster due in 5 days"*).
  * Medication Alarms (*e.g., "Amoxicillin 250mg dose due at 8:00 PM").
  * Vet Appointments (*e.g., "Visit with Dr. Ahmed tomorrow at 11:00 AM"*).
* **Quick Action Dock:** 🚣 *Emergency Mode*, ➕츏 *Log Daily Task*, 🔥 *Book Vet*, 🚪 *Show QR Passport*.

### 3.2 Digital Pet Passport & QR Code System
**Profile Fields:** Name, Species (*Dog, Cat, Bird, etc.*), Breed, Gender, DOB / Age, Weight, Blood Group, Microchip ID, Spayed/Neutered flag, Distinguishing marks.
* **Emergency Contacts:** Primary owner phone, alternate contact, primary clinic contact.
* **Privacy-Controlled QR Generator:**
  * Generates a tamper-proof, tokenized QR code.
  * **Configurable Visibility Options:** Owner can toggle what public scanners (e.g. groomers, pet sitters, rescue workers) see:
    * Active Public Contact & Emergency Phone
    * Allergies & Chronic Conditions
    * Current Medications & Diet Requirements
    * Confidential Clinical Notes & Invoices (hidden by default)
  * Ability to instantly revoke and re-generate QR public tokens.

### 3.3 Longitudinal Health Timeline & Medical Document Vault
* **Health Timeline:** Interactive chronological log of the pet's lifetime events (Byrth -> Vaccinations -> Clinical Visits -> Lab Tests -> Surgeries -> Weight Changes).
* **Medical Document Vault:**
  * Categorized storage: X-Rays, Blood Reports, Prescriptions, Vaccination Certificates, Insurance Documents.
  * Fields: Document Title, Category, Date Administered, Clinic/Doctor Name, Diagnostic Notes, PDF/Image attachment.

### 3.4 Smart Vaccination & Medication Management Engine
* **Vaccination Tracker:**
  * Vaccine Name, Batch Number, Dose (1st, 2nd, Booster), Administered Date, **Next Due Date**, Administering Vet.
  * **Automated Notification Schedule:** 30 days before, 7 days before, 1 day before, and Due Date.
* **Medication Adherence Scheduler:**
  * Drug Name, Dosage (*e.g. 2 tabs, 5ml*), Frequency (*Once daily, Twice daily, 8-hour intervals*), Start Date, End Date, Instructions.
  * **Action Logging:** Owner logs `[Taken]`, `[Skipped]`, or `[Missed]` with timestamps.

3## 3.5 Intelligent Care Planner & Dynamic Care Score (0–100)
* **Care Planner:**
  * Daily tasks (*Morning Walk, Evening Feeding, Water refill*).
  * Weekly tasks (*Grooming, Ear Cleaning, Bathing*).
  * Monthly tasks **Flea & Tick preventive, Deworming, Vet Checkup*).
* **Care Score Algorithm:**
  * *Vaccines up-to-date:* +30 pts
  * *Recent vet checkup (last 6 mo):* +25 pts
  * *Task completion rate (>80%):* +25 pts
  * *Profile & microchip complete:* +20 pts
  * *Penalties for overdue tasks / expired vaccines:* -10 to -30 pts.
  * Complete transparency modal explaining the breakdown.

### 3.6 Emergency Pet Mode & Geolocation 🚣
* **1-Click Emergency Fast-Card:**
  * Immediate red-alert screen displaying: Blood Group, Severe Allergies, Active Medications, Chronic Illnesses, Microchip ID.
  * Geolocation-based list of nearest 24/7 veterinary hospitals with phone numbers and map directions.
  * Shareable temporary emergency link for paramedics/vets.

### 3.7 Smart Vet Discovery & Appointment Booking
* **Discovery & Recommendation:** Matches vets based on proximity (km), rating (1-5 stars), specialization **Canine, Feline, Surgery, Dermatology*), and slot availability.
* **Booking Pipeline:**
  1. Select Pet
  2. Select Consultation Type **General, Vaccination, Emergency, Surgery, Follow-up*)
  3. Select Date & Slot
  4. Enter Symptoms / Chief Complaint
  5. Confirm Booking -> Live Status Tracking.

### 3.8 Intelligent Adoption Marketplace & Application Flow
* Browse verified shelter animals with temperament tags (*Good with kids, Calm, Energetic, House-trained*).
* **Compatibility Match Engine:** Adopter questionnaire (*Living space, Kids, Existing pets, Activity level*( compares with pet traits and outputs **Match Compatibility Score (%)**.
* **Application Tracker:** Live stages (`Submitted` -> `Under Review` -> `Interview Scheduled` -> `Approved` -> `Adopted`).

3## 3.9 Pet Marketplace & Order Lifecycle (Scope-Compliant)
* Browse categories (*Food, Health Supplies, Grooming, Toys, Accessories*i.
+ Cart management (Quantity updates, subtotal, shipping address).
+ Order Lifecycle: `Placed` -> `Processing` -> `Ready for Pickup` / `Completed` / `Cancelled`. *(Payment gateways and physical delivery are excluded as per SRS scope).*

3## 3.10 AI Pet Care Assistant & Vet-Visit Summarizer 🤭
* Context-aware chat assistant that reads pet age, breed, and health flags to give wellness, diet, and training advice.
* Strict medical disclaimer guardrails.
* **Vet-Visit Summary Generator:** Converts owner chat concerns and symptoms into a structured clinical note for the vet appointment.

---

## 4. Role 2: Veterinarian Portal — Detailed Clinical Practice Specification

### 4.1 Vet Dashboard & Daily Patient Queue
* Today's patient list sorted by appointment slots with status badges (`Pending`, `Confirmed`, `Checked-In`, `In-Consultation`, `Completed`).
+ Daily practice stats: Total appointments, pending reviews, surgeries scheduled, emergency buffer slots.

### 4.2 Clinic Profile & Slot Availability Rules
 Professional Profile: Degree/Qualifications, Medical Specialization, Years of Experience, Clinic Name, Address, Contact.
* Slot Configuration: Working days, morning/evening shifts, consultation duration (*15m, 20m, 30m*), break times, day-offs.

### 4.3 Comprehensive Appointment Pipeline
* Incoming Requests: `[Accept]`, `[Reject with Reason][, or `[Reschedule with Proposed Slots][.
* Complete Appointment Lifecycle:
  **Booked -> Confirmed -> Checked-In -> In-Consultation -> Completed**

### 4.4 Clinical Consultation Records (Electronic Health Record - EHR)
* **Authorized Patient History:** On appointment confirmation, vet gets access to the pet's longitudinal health timeline, past prescriptions, and document vault.
+ **Consultation Entry Form:**
  * **Vitals:** Weight (kg), Temperature (degrees F), Heart Rate (bpm), Body Condition Score (1-9).
  * **Clinical Findings:** Symptoms description, Physical examination observations, Differential and Final Diagnosis.
  * **Digital Prescription (Rx Pad):** Drug Name, Dosage form, Frequency, Duration (days), Special Administration Instructions.
  * **Dietary & Lifestyle Advice:** Nutritional recommendations, restricted activities.
  * **Follow-up Date:** Recommended next visit date with automated reminder scheduling for the owner.

### 4.5 Diagnostic Lab Test Request & Reports Engine
* Order diagnostic tests **CBC, Blood Chemistry, X-Ray, Urinalysis, Biopsy:) directly from consultation.
+ Lab Status Pipeline: `Requested` -> `Sample Collected` -> `Processing` -> `Completed`.
* Vet uploads report interpretation and links findings to pet health records.

---

## 5. Role 3: Animal Shelter Portal — Detailed Rescue & Adoption Specification

### 5.1 Shelter Dashboard & Live Capacity
* Real-time metrics: Total Animals in Shelter, Available for Adoption, Under Medical Quarantine, Pending Applications, Total Adopted.
* In-shelter daily tasks checklist (Feeding, medications, grooming for rescued animals).

3## 5.2 Multi-Shelter Architecture & Profile Verification
* Supports multiple independent shelters (e.g. PAWS, ACF, Edhi Rescue).
+ Organization Profile: Shelter Name, Registration/License details, Contact Person, Phone, Email, Facility Address, Operating Hours.
* Complete data isolation between shelters.

### 5.3 Rescued Animal Intake & State Machine
* **Intake Form:** Rescue Source (*Stray, Surrendered, Abandoned*), Intake Date, Estimated Age, Species, Breed, Gender, Temperament Tags, High-res Photo Gallery.
* **Animal Lifecycle State Machine:**
  **Rescued / Intake -> Medical Quarantine -> Available for Adoption -> Application Under Review -> Interview -> Approved -> Adopted**

3## 5.4 Shelter Daily Care & Medical Logs
* In-shelter routine logs: Daily feeding logs, grooming notes, deworming, vaccination schedule, and quarantine health logs.

### 5.5 End-to-End Adoption Application Management
* Review applicant questionnaires (*Living space, kids, existing pets, pet experience*).
+ Process actions: Shortlist -> Schedule Interview -> Request Reference -> `[Approve]` / `[Reject]`.
* **Adoption Finalization & Handover:**
  * Updates animal status to `Adopted`.
  * Generates digital Adoption Certificate.
  * Automatically transfers the pet record to the new Pet Owner dashboard with a freshly generated **Digital QR Passport**.

---

## 6. Role 4: Administrator Portal — Platform Governance & Analytics

### 6.1 Executive Analytics & Business Dashboard
* Platform KPIs: Total Registered Users by Role, Active Pets, Total Appointments Completed, Adoption Success Rate, Marketplace Sales Volume, Low-Stock Inventory Alerts.
+ Real-time graphical analytics and trend reports.

### 6.2 User Management & RBAC Governance
* Master user directory (Owners, Vets, Shelters, Admins).
* Controls: View Profile, `[Activate]`, `[Deactivate]`, `[Suspend]`, `[Delete]`, and Password Reset triggers.
* Review and approve newly registered Veterinarians and Animal Shelters.

### 6.3 Content & Adoption Listing Moderation
* Monitor all public adoptable listings across shelters; remove fake or inappropriate listings.
* Moderate user-submitted reviews and ratings for Vets, Shelters, and Products.

### 6.4 Product Catalog & Order Management
* Category management, product CRUD, SKU tracking, pricing, inventory stock count, and image galleries.
* Platform-wide order oversight and status updates.

### 6.5 Care Knowledge Base Management
+ Publish and edit pet care articles, species care guidelines (*Dogs, Cats, Birds*), FAQs, and seasonal health tips.

### 6.6 System Notification Broadcasting
+ Broadcast platform-wide announcements (e.g. system maintenance, seasonal health warnings).
+ Send role-targeted notifications (e.g. all Vets or all Shelters).

### 6.7 Enterprise Security & Audit Log System
* Immutable audit trail logging sensitive actions (Timestamp, User ID, Role, Action Type, Entity ID, IP Address, Status).
* RBAC resource protection (Owner A cannot access Owner B records; Vet can only access confirmed patients).

---

## 7. Cross-Cutting Shared Engines & Intelligent Services

### 7.1 Central Notification & Reminder Engine
* Event-driven triggers for:
  * Appointment confirmations, cancellations, and reschedules.
  * Vaccination due dates (30d, 7d, 1d, Due Day).
  * Medication timers and missed dose alerts.
  * Adoption application status transitions.
  * Marketplace order status updates.

### 7.2 Dynamic Care Health Score Engine (0-100)
* Real-time calculation based on vaccine adherence, medical visits, task completion, and profile completeness.

### 7.3 Privacy-Preserving Digital QR Passport
* Tokenized, owner-controlled, shareable emergency and identification profile.

### 7.4 1-Click Emergency Mode Engine
 Instant retrieval of critical medical facts, active medications, allergies, and nearest 24/7 clinics.

3## 7.5 Smart Compatibility Matching Engine
* Questionnaire algorithm calculating % compatibility between adopters and rescue animals.

### 7.6 AI Pet Care Assistant & Clinical Summarizer
* Pet-aware conversational assistant with strict medical guardrails + structured Doctor Note visit summarizer.

---

## 8. Master Database Architecture (24+ Relational Schemas)

```text
[ users ] 1--* [ user_roles ] *--1 [ roles ]
   |
   +-- 1--* [ pets ] 1--1 [ pet_passports ]
   |           |
   |           +-- 1--* [ health_records ]
   |           +-- 1--* [ vaccinations ]
   |           +-- 1--* [ medications ] 1--* [ medication_logs ]
   |           +-- 1--* [ medical_documents ]
   |           +-- 1--* [ care_tasks ] 1--* [ care_task_logs ]
   |           +-- 1--* [ care_score_history ]
   |           +-- 1--* [ emergency_events ]
   |
   +-- 1--1 [ veterinarians ] 1--* [ vet_availabilities ]
   |           |
   |           +-- 1--* [ appointments ] 1--1 [ clinical_consultations ]
   |                                       +-- 1--* [ prescriptions ]
   |                                         +-- 1--* [ lab_test_orders ]
   |
   +-- 1--1 [ shelters ] 1--* [ shelter_animals ] 1--* [ adoption_applications ]
   |
   +-- 1--* [ orders ] 1--* [ order_items ] *--1 [ products ] *--1 [ product_categories ]
   |
   +-- 1--* [ reviews_ratings ]
   +-- 1--* [ notifications ]
   +-- 1--* [ audit_logs ]
   +-- 1--* [ ai_chat_sessions ]
```

---

## 9. End-to-End System Workflows & Lifecycle Diagrams

### A. Clinical Consultation & Health Update Flow1. **Owner** books appointment for Pet (*Max*) with **Dr. Ahmed (Vet)**.
2. **Vet** confirms slot; appointment status becomes `Confirmed`.
3. During visit, **Vet** opens consultation screen, enters vitals (Temp: 101.5 F, Weight: 22kg), diagnosis (Mild Otitis), prescribes ear drops (twice daily for 7 days), and sets follow-up in 10 days.
4. On consultation save:
  * Pet's **Health Timeline** auto-updates.
  * Ear drops auto-added to Owner's **Medication Scheduler**.
  * Follow-up date schedules an automated reminder for the owner.
  * **Care Health Score** recalculates.

### B. Shelter Rescue & Adoption Flow
1. **Shelter** intakes a rescued dog **Buddy:), registers profile, health quarantine notes, and photos.
2. Once healthy, shelter updates status to `Available for Adoption`.
3. **Adopter (Pet Owner)** completes questionnaire; system shows *94% Compatibility Match*.
4. **Owner** submits adoption application.
5. **Shelter** reviews application, conducts interview, and marks `Approved`.
6. On adoption completion:
  * Pet's status transitions to `Adopted`.
  * Pet ownership automatically transfers to the Owner's dashboard.
  * New **Digital QR Passport** is instantly generated for the owner.

### C. 1-Click Emergency Trigger Flow
1. **Owner** clicks 🚣 **Emergency Mode** on Dashboard.
2. System instantly displays the **Emergency Fast-Card** (Blood group, allergies, medications, microchip).
3. Geolocation locates the 3 nearest 24/7 emergency veterinary clinics with direct call buttons and map navigation.
4. System generates a temporary, revocable emergency link for the veterinary hospital staff.
