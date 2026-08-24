import app from './app.js';
import { connectDB, disconnectDB } from './config/db.js';
import { env } from './config/env.js';

async function startServer() {
  await connectDB();

  const server = app.listen(env.port, () => {
    console.log(`[FurShield API] Server running in ${env.nodeEnv} mode on port ${env.port}`);
    console.log(`[FurShield API] Accepting client origin: ${env.clientUrl}`);
  });

  const handleShutdown = (signal) => {
    console.log(`\n[FurShield API] Received ${signal}. Gracefully shutting down...`);
    server.close(async () => {
      await disconnectDB();
      console.log('[FurShield API] HTTP server and database connections closed. Exiting process.');
      process.exit(0);
    });
  };

  process.on('SIGTERM', () => handleShutdown('SIGTERM'));
  process.on('SIGINT', () => handleShutdown('SIGINT'));

  process.on('unhandledRejection', (err) => {
    console.error('[Unhandled Rejection Error]:', err);
  });

  process.on('uncaughtException', (err) => {
    console.error('[Uncaught Exception Error]:', err);
    process.exit(1);
  });
}

startServer();
