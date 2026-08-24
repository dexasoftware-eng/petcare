import { connectDB, disconnectDB } from '../config/db.js';
import { User } from '../models/User.js';
import { PasswordService } from '../services/password.service.js';
import { env } from '../config/env.js';

async function seedAdmin() {
  console.log('[Seed] Connecting to database...');
  await connectDB();

  const adminEmail = env.admin.email.trim().toLowerCase();
  const existingAdmin = await User.findOne({ email: adminEmail });

  if (existingAdmin) {
    console.log(`[Seed] Admin user '${adminEmail}' already exists. Updating credentials...`);
    existingAdmin.passwordHash = await PasswordService.hash(env.admin.password);
    existingAdmin.role = 'admin';
    existingAdmin.status = 'active';
    existingAdmin.emailVerified = true;
    await existingAdmin.save();
    console.log('[Seed] Admin user successfully updated.');
  } else {
    console.log(`[Seed] Creating new admin account for '${adminEmail}'...`);
    const passwordHash = await PasswordService.hash(env.admin.password);
    await User.create({
      name: env.admin.name,
      email: adminEmail,
      phone: '+1 (800) 555-0199',
      address: 'FurShield Headquarters, Suite 100, New York, NY',
      passwordHash,
      role: 'admin',
      status: 'active',
      emailVerified: true,
    });
    console.log('[Seed] Admin user created successfully.');
  }

  await disconnectDB();
  process.exit(0);
}

seedAdmin().catch((err) => {
  console.error('[Seed Error]:', err);
  process.exit(1);
});
