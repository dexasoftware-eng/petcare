<?php

namespace Controllers;

use Core\Controller;
use Helpers\Flash;
use Models\Inquiry;
use Models\AuditLog;

class ContactController extends Controller
{
    public function show(): void
    {
        $this->render('pages.contact', [
            'pageTitle' => 'Contact PetGuard — 24/7 Care & Inquiries'
        ]);
    }

    public function submit(): void
    {
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'message' => 'required|min:5'
        ]);

        $inquiryId = Inquiry::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $this->request->post('phone', ''),
            'service' => $this->request->post('service', 'General Inquiry'),
            'message' => $data['message'],
            'status' => 'new'
        ]);

        AuditLog::log('INQUIRY_SUBMITTED', 'inquiries', $inquiryId, ['email' => $data['email']]);

        Flash::success('Thank you for reaching out! Our clinical care coordinators will respond shortly.');
        $this->redirect('contact');
    }
}
