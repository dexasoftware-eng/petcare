import mongoose from 'mongoose';

const shelterProfileSchema = new mongoose.Schema(
  {
    userId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
      required: true,
      unique: true,
      index: true,
    },
    shelterName: {
      type: String,
      required: [true, 'Shelter name is required'],
      trim: true,
    },
    contactPerson: {
      type: String,
      required: [true, 'Contact person name is required'],
      trim: true,
    },
    capacity: {
      type: Number,
      default: 0,
    },
    website: {
      type: String,
      default: '',
      trim: true,
    },
  },
  {
    timestamps: true,
  }
);

export const ShelterProfile = mongoose.model('ShelterProfile', shelterProfileSchema);
