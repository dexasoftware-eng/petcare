<?php

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\VeterinarianProfile;
use Models\ShelterProfile;
use Models\AuditLog;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->render('auth.login', ['pageTitle' => 'Sign In — PetGuard'], 'auth');
    }

    public function login(): void
    {
        $data = $this->validate($this->request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::authenticate($data['email'], $data['password']);

        if (!$user) {
            Flash::error('Invalid email address or password combination.');
            $this->redirect('login');
        }

        if (in_array($user['status'], ['suspended', 'disabled'])) {
            Flash::error('Your account is currently ' . $user['status'] . '. Please contact support.');
            $this->redirect('login');
        }

        Auth::login($user);
        AuditLog::log('USER_LOGIN', 'users', $user['id'], ['email' => $user['email'], 'role' => $user['role']]);
        Flash::success("Welcome back, {$user['name']}!");
        match ($user['role']) {
            'admin' => $this->redirect('admin/dashboard'),
            'veterinarian' => $this->redirect('vet/dashboard'),
            'shelter' => $this->redirect('shelter/dashboard'),
            'vendor' => $this->redirect('vendor/dashboard'),
            default => $this->redirect('owner/dashboard'),
        };
    }

    public function showOwnerRegister(): void
    {
        $this->render('auth.register-owner', ['pageTitle' => 'Pet Owner Registration — Pet Guard'], 'auth');
    }

    public function registerOwner(): void
    {
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'address' => 'required|min:4',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role' => 'petowner',
            'status' => 'active',
            'email_verified' => 1
        ]);

        AuditLog::log('USER_REGISTER', 'users', $userId, ['role' => 'petowner']);

        $user = User::find($userId);
        Auth::login(User::toSafeArray($user));

        Flash::success('Account registered successfully! Welcome to Pet Guard.');
        $this->redirect('owner/dashboard');
    }

    public function showVetRegister(): void
    {
        $this->render('auth.register-vet', ['pageTitle' => 'Veterinarian Registration — Pet Guard'], 'auth');
    }

    public function registerVet(): void
    {
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'address' => 'required|min:4',
            'specialization' => 'required|min:3',
            'experience' => 'required|numeric',
            'clinic_name' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role' => 'veterinarian',
            'status' => 'active',
            'email_verified' => 1
        ]);

        VeterinarianProfile::create([
            'user_id' => $userId,
            'specialization' => $data['specialization'],
            'experience' => (int)$data['experience'],
            'clinic_name' => $data['clinic_name'],
            'clinic_address' => $data['address'],
            'bio' => $this->request->input('bio', '')
        ]);

        AuditLog::log('USER_REGISTER', 'users', $userId, ['role' => 'veterinarian']);

        $user = User::find($userId);
        Auth::login(User::toSafeArray($user));

        Flash::success('Veterinarian account created successfully!');
        $this->redirect('vet/dashboard');
    }

    public function showShelterRegister(): void
    {
        $this->render('auth.register-shelter', ['pageTitle' => 'Shelter Registration — Pet Guard'], 'auth');
    }

    public function registerShelter(): void
    {
        $data = $this->validate($this->request->all(), [
            'shelter_name' => 'required|min:2|max:150',
            'contact_person' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'address' => 'required|min:4',
            'capacity' => 'required|numeric',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['shelter_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role' => 'shelter',
            'status' => 'active',
            'email_verified' => 1
        ]);

        ShelterProfile::create([
            'user_id' => $userId,
            'shelter_name' => $data['shelter_name'],
            'contact_person' => $data['contact_person'],
            'capacity' => (int)$data['capacity']
        ]);

        AuditLog::log('SHELTER_REGISTER', 'users', $userId, ['role' => 'shelter']);

        $user = User::find($userId);
        Auth::login(User::toSafeArray($user));

        Flash::success('Animal Shelter account registered successfully!');
        $this->redirect('shelter/dashboard');
    }

    public function showVendorRegister(): void
    {
        $this->render('auth.register-vendor', ['pageTitle' => 'Vendor Store Registration — Pet Guard'], 'auth');
    }

    public function registerVendor(): void
    {
        $data = $this->validate($this->request->all(), [
            'store_name' => 'required|min:2|max:150',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'business_registration' => 'required|min:3',
            'address' => 'required|min:4',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['store_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role' => 'vendor',
            'status' => 'active',
            'email_verified' => 1
        ]);

        \Models\VendorProfile::create([
            'user_id' => $userId,
            'store_name' => $data['store_name'],
            'business_registration' => $data['business_registration'],
            'description' => $this->request->input('description', 'Verified Pet Guard merchant partner.'),
            'verification_status' => 'approved'
        ]);

        AuditLog::log('VENDOR_REGISTER', 'users', $userId, ['role' => 'vendor']);

        $user = User::find($userId);
        Auth::login(User::toSafeArray($user));

        Flash::success('Vendor Store account registered successfully!');
        $this->redirect('vendor/dashboard');
    }

    public function showForgotPassword(): void
    {
        $this->render('auth.forgot-password', ['pageTitle' => 'Forgot Password — PetGuard'], 'auth');
    }

    public function forgotPassword(): void
    {
        $data = $this->validate($this->request->all(), [
            'email' => 'required|email'
        ]);

        $user = User::findByEmail($data['email']);
        if ($user) {
            $token = bin2hex(random_bytes(24));
            $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour
            User::update($user['id'], [
                'password_reset_token' => $token,
                'password_reset_expires_at' => $expires
            ]);
            AuditLog::log('PASSWORD_RESET_REQUEST', 'users', $user['id']);
        }

        Flash::info('If that email is registered with us, a password reset link has been dispatched.');
        $this->redirect('login');
    }

    public function showResetPassword(): void
    {
        $token = $this->request->get('token');
        $this->render('auth.reset-password', [
            'pageTitle' => 'Reset Password — PetGuard',
            'token' => $token
        ], 'auth');
    }

    public function resetPassword(): void
    {
        $data = $this->validate($this->request->all(), [
            'token' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password'
        ]);

        $user = User::firstWhere('password_reset_token = :token AND password_reset_expires_at > NOW()', ['token' => $data['token']]);

        if (!$user) {
            Flash::error('Invalid or expired password reset token.');
            $this->redirect('forgot-password');
        }

        User::update($user['id'], [
            'password_hash' => password_hash($data['password'], PASSWORD_BCRYPT),
            'password_reset_token' => null,
            'password_reset_expires_at' => null
        ]);

        AuditLog::log('PASSWORD_RESET_COMPLETED', 'users', $user['id']);

        Flash::success('Your password has been successfully updated. You may now sign in.');
        $this->redirect('login');
    }

    public function logout(): void
    {
        $userId = Auth::id();
        if ($userId) {
            AuditLog::log('USER_LOGOUT', 'users', $userId);
        }
        Auth::logout();
        Flash::info('You have been signed out.');
        $this->redirect('login');
    }
}
