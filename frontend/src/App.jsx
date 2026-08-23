import React from 'react';
import { Heart, ShieldCheck, Stethoscope, Sparkles } from 'lucide-react';

function App() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 text-white flex flex-col items-center justify-center p-6">
      <div className="max-w-2xl w-full bg-slate-800/80 backdrop-blur-md p-8 rounded-2xl border border-slate-700 shadow-2xl text-center space-y-6">
        
        <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-medium">
          <Sparkles className="w-4 h-4 animate-spin text-emerald-400" />
          <span>PetGuard Ecosystem Ready</span>
        </div>

        <h1 className="text-4xl font-bold tracking-tight bg-gradient-to-r from-white via-slate-100 to-emerald-400 bg-clip-text text-transparent">
          🐾 PetGuard Care
        </h1>

        <p className="text-slate-300 text-base leading-relaxed">
          Unified platform for <strong>Pet Owners</strong>, <strong>Veterinarians</strong>, <strong>Animal Shelters</strong>, and <strong>Administrators</strong>.
        </p>

        <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 text-left">
          <div className="p-4 bg-slate-900/60 rounded-xl border border-slate-700/60 space-y-1">
            <div className="flex items-center gap-2 text-emerald-400 font-semibold">
              <ShieldCheck className="w-5 h-5" />
              <span>Digital Passport</span>
            </div>
            <p className="text-xs text-slate-400">QR-code identity and encrypted health records.</p>
          </div>

          <div className="p-4 bg-slate-900/60 rounded-xl border border-slate-700/60 space-y-1">
            <div className="flex items-center gap-2 text-sky-400 font-semibold">
              <Stethoscope className="w-5 h-5" />
              <span>Vet Clinical</span>
            </div>
            <p className="text-xs text-slate-400">Appointments, consultations & Rx generator.</p>
          </div>

          <div className="p-4 bg-slate-900/60 rounded-xl border border-slate-700/60 space-y-1">
            <div className="flex items-center gap-2 text-rose-400 font-semibold">
              <Heart className="w-5 h-5" />
              <span>Rescue & Adopt</span>
            </div>
            <p className="text-xs text-slate-400">Shelter management & smart matching engine.</p>
          </div>
        </div>

        <div className="pt-2 text-xs text-slate-400 border-t border-slate-700/50">
          Frontend & Backend structures are synchronized & ready for development.
        </div>
      </div>
    </div>
  );
}

export default App;
