import mongoose from 'mongoose';
import { env } from './env.js';

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
