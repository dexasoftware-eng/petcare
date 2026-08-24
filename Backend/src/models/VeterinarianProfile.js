import mongoose from 'mongoose';

const veterinarianProfileSchema = new mongoose.Schema(
  {
    userId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
      required: true,
      unique: true,
      index: true,
    },
    specialization: {
      type: String,
      required: [true, 'Specialization is required'],
      trim: true,
    },
    experience: {
      type: Number,
      required: [true, 'Years of experience is required'],
      min: [0, 'Experience cannot be negative'],
    },
    bio: {
      type: String,
      default: '',
      trim: true,
    },
    clinicName: {
      type: String,
      default: '',
      trim: true,
    },
    clinicAddress: {
      type: String,
      default: '',
      trim: true,
    },
  },
  {
    timestamps: true,
  }
);

export const VeterinarianProfile = mongoose.model('VeterinarianProfile', veterinarianProfileSchema);
