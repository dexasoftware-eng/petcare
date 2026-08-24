import mongoose from 'mongoose';
import dns from 'dns';
import { env } from './env.js';

// Configure reliable DNS servers for Windows SRV resolution
try {
  dns.setServers(['8.8.8.8', '1.1.1.1', '8.8.4.4']);
} catch (e) {
  // ignore if not supported
}

export async function connectDB() {
  try {
    const conn = await mongoose.connect(env.mongoUri, {
      serverSelectionTimeoutMS: 5000,
    });

    console.log(`[MongoDB] Connected successfully: ${conn.connection.host}`);

    mongoose.connection.on('error', (err) => {
      console.error(`[MongoDB] Runtime Connection Error: ${err.message}`);
    });

    mongoose.connection.on('disconnected', () => {
      console.warn('[MongoDB] Disconnected. Reconnecting...');
    });
  } catch (error) {
    console.error(`[MongoDB] Connection Failed: ${error.message}`);
    if (env.isProduction) {
      process.exit(1);
    }
  }
}

export async function disconnectDB() {
  await mongoose.connection.close();
  console.log('[MongoDB] Connection closed.');
}
