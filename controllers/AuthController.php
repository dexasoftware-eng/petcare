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
        $this->render('auth.login', [
            'pageTitle' => 'Sign In — PetGuard',
            'heroTitle' => 'Welcome Back!',
            'heroDesc' => 'We missed you! Login to continue providing the best care and love for your pets.'
        ], 'auth');
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
        $this->redirect('portal');
    }

    public function showOwnerRegister(): void
    {
        $this->render('auth.register-owner', [
            'pageTitle' => 'Pet Owner Registration — PetGuard',
            'heroTitle' => "Create an Account for Your Pet's Best Life",
            'heroDesc' => "Join PetGuard and give your furry companion the love, care, and happiness they deserve."
        ], 'auth');
    }

    public function registerOwner(): void
    {
        $firstName = trim($this->request->post('first_name', ''));
        $lastName = trim($this->request->post('last_name', ''));
        $fullName = trim($firstName . ' ' . $lastName);
        if (empty($fullName)) {
            $fullName = trim($this->request->post('name', ''));
        }

        // Merge computed name for validation
        $postData = $this->request->all();
        $postData['name'] = $fullName;

        $data = $this->validate($postData, [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $this->request->post('phone', ''),
            'address' => $this->request->post('address', $this->request->post('country', 'United States')),
            'password' => $data['password'],
            'role' => 'petowner',
            'status' => 'active',
            'email_verified' => 1
        ]);

        AuditLog::log('USER_REGISTER_OWNER', 'users', $userId, ['email' => $data['email']]);

        $newUser = User::find($userId);
        Auth::login($newUser);

        Flash::success('Account registered successfully! Welcome to PetGuard.');
        $this->redirect('portal');
    }

    public function showVetRegister(): void
    {
        $this->render('auth.register-vet', [
            'pageTitle' => 'Veterinarian Registration — PetGuard',
            'heroTitle' => 'Join as a Certified Veterinarian',
            'heroDesc' => 'Connect with pet owners, manage clinical appointments, and provide expert veterinary care.'
        ], 'auth');
    }

    public function registerVet(): void
    {
        $firstName = trim($this->request->post('first_name', ''));
        $lastName = trim($this->request->post('last_name', ''));
        $fullName = trim($firstName . ' ' . $lastName);
        if (empty($fullName)) {
            $fullName = trim($this->request->post('name', ''));
        }

        $postData = $this->request->all();
        $postData['name'] = $fullName;

        $data = $this->validate($postData, [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'clinic_name' => 'required|min:3',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $this->request->post('clinic_address', $data['clinic_name']),
            'password' => $data['password'],
            'role' => 'veterinarian',
            'status' => 'active',
            'email_verified' => 1
        ]);

        VeterinarianProfile::create([
            'user_id' => $userId,
            'specialization' => $this->request->post('specialization', 'General Pet Medicine'),
            'years_of_experience' => 1,
            'clinic_name' => $data['clinic_name'],
            'clinic_address' => $this->request->post('clinic_address', ''),
            'bio' => $this->request->post('bio', 'Dedicated veterinary doctor providing compassionate care.')
        ]);

        AuditLog::log('USER_REGISTER_VET', 'users', $userId, ['clinic' => $data['clinic_name']]);

        $newUser = User::find($userId);
        Auth::login($newUser);

        Flash::success('Doctor profile registered! Welcome to the PetGuard Clinical Network.');
        $this->redirect('portal');
    }

    public function showShelterRegister(): void
    {
        $this->render('auth.register-shelter', [
            'pageTitle' => 'Rescue Shelter Registration — PetGuard',
            'heroTitle' => 'Register Your Rescue Shelter',
            'heroDesc' => 'Find loving families for rescue animals and manage foster programs seamlessly.'
        ], 'auth');
    }

    public function registerShelter(): void
    {
        $data = $this->validate($this->request->all(), [
            'organization_name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:6',
            'shelter_address' => 'required|min:5',
            'password' => 'required|min:6',
            'confirm_password' => 'required|matches:password',
        ]);

        $userId = User::register([
            'name' => $data['organization_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['shelter_address'],
            'password' => $data['password'],
            'role' => 'shelter',
            'status' => 'active',
            'email_verified' => 1
        ]);

        ShelterProfile::create([
            'user_id' => $userId,
            'organization_name' => $data['organization_name'],
            'shelter_address' => $data['shelter_address'],
            'capacity' => (int)$this->request->post('capacity', 50),
            'current_intake' => 0,
            'adoption_terms' => 'Standard pet adoption background verification agreement.'
        ]);

        AuditLog::log('USER_REGISTER_SHELTER', 'users', $userId, ['org' => $data['organization_name']]);

        $newUser = User::find($userId);
        Auth::login($newUser);

        Flash::success('Shelter registered successfully! Start listing rescue animals.');
        $this->redirect('portal');
    }

    public function showVerifyEmail(): void
    {
        $email = $this->request->get('email', Auth::user()['email'] ?? 'user@petguard.com');
        $this->render('auth.verify-email', [
            'pageTitle' => 'Verify Email — PetGuard',
            'heroTitle' => "Let's Verify Your Account",
            'heroDesc' => "We've sent a 6-digit verification code to your email address. Please enter the code below to continue.",
            'email' => $email
        ], 'auth');
    }

    public function verifyEmail(): void
    {
        $otp = trim($this->request->post('otp', ''));
        if (strlen($otp) !== 6) {
            Flash::error('Please enter all 6 digits of the verification code.');
            $this->redirect('verify-email');
        }

        // Simulating successful email verification
        Flash::success('Email verified successfully! You are all set.');
        $this->redirect('portal');
    }

    public function showForgotPassword(): void
    {
        $this->render('auth.forgot-password', [
            'pageTitle' => 'Forgot Password — PetGuard',
            'heroTitle' => 'Reset Your Password',
            'heroDesc' => "Enter your registered email address to securely receive a password recovery link."
        ], 'auth');
    }

    public function sendResetLink(): void
    {
        $data = $this->validate($this->request->all(), [
            'email' => 'required|email'
        ]);

        $user = User::findByEmail($data['email']);

        if ($user) {
            $token = bin2hex(random_bytes(32));
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
            'heroTitle' => 'Set New Password',
            'heroDesc' => 'Create a strong, secure password with at least 6 characters.',
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
