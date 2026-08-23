import dns from 'dns';
dns.setServers(['8.8.8.8', '8.8.4.4']); // Fix Windows SRV DNS resolution

import mongoose from 'mongoose';

export const connectDB = async () => {
  try {
    const conn = await mongoose.connect(process.env.MONGO_URI, {
      serverSelectionTimeoutMS: 5000,
    });
    console.log(`✅ MongoDB Atlas Connected: ${conn.connection.host}`);
    console.log(`📦 Database Name: ${conn.connection.name}`);
  } catch (error) {
    console.warn(`⚠️ MongoDB Connection Warning (${error.message}). API will operate in fallback mode.`);
  }
};
