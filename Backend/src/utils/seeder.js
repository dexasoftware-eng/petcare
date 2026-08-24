import dns from 'dns';
dns.setServers(['8.8.8.8', '8.8.4.4']); // Fix Windows SRV DNS resolution

import dotenv from 'dotenv';
import mongoose from 'mongoose';
import { Category } from '../models/Category.js';
import { Product } from '../models/Product.js';
import { Service } from '../models/Service.js';
import { Team } from '../models/Team.js';
import { Blog } from '../models/Blog.js';

dotenv.config();

const initialCategories = [
  { title: "Cat Supplies", slug: "cat-supplies", img: "/assets/img/food-categorie-1.png", count: 24 },
  { title: "Dog Supplies", slug: "dog-supplies", img: "/assets/img/food-categorie-2.png", count: 38 },
  { title: "Animal Feed", slug: "animal-feed", img: "/assets/img/food-categorie-3.png", count: 19 },
  { title: "Accessories", slug: "accessories", img: "/assets/img/food-categorie-4.png", count: 42 },
  { title: "Horse Care", slug: "horse-care", img: "/assets/img/food-categorie-5.png", count: 15 }
];

const initialProducts = [
  {
    name: "Procan Adult Dog Food",
    slug: "procan-adult-dog-food",
    category: "Animal Feed",
    price: 32.00,
    oldPrice: null,
    rating: 5,
    discount: null,
    img: "/assets/img/food-1.png",
    description: "Premium nutrition for adult dogs with balanced protein and essential vitamins.",
    sku: "PF-1001",
    inStock: true
  },
  {
    name: "Best Organic Feeds",
    slug: "best-organic-feeds",
    category: "Animal Feed",
    price: 22.00,
    oldPrice: 32.00,
    rating: 5,
    discount: "-24%",
    img: "/assets/img/food-2.png",
    description: "100% natural organic ingredients for complete vitality and digestion.",
    sku: "PF-1002",
    inStock: true
  },
  {
    name: "Green Papaya Fruit",
    slug: "green-papaya-fruit",
    category: "Animal Feed",
    price: 32.00,
    oldPrice: null,
    rating: 5,
    discount: null,
    img: "/assets/img/food-3.png",
    description: "Enriched dietary supplement suitable for small animals and birds.",
    sku: "PF-1003",
    inStock: true
  },
  {
    name: "KMR Pwdr 12oz",
    slug: "kmr-pwdr-12oz",
    category: "Animal Feed",
    price: 22.00,
    oldPrice: 32.00,
    rating: 5,
    discount: "-24%",
    img: "/assets/img/food-4.png",
    description: "Kitten milk replacer powder matching mother's milk protein ratio.",
    sku: "PF-1004",
    inStock: true
  },
  {
    name: "Cattle Feed",
    slug: "cattle-feed",
    category: "Animal Feed",
    price: 22.00,
    oldPrice: 32.00,
    rating: 5,
    discount: "-24%",
    img: "/assets/img/food-5.png",
    description: "Fortified high-fiber pellets for farm livestock and cattle.",
    sku: "PF-1005",
    inStock: true
  },
  {
    name: "Healthy Dog Food Roaster Chicken",
    slug: "healthy-dog-food-roaster-chicken",
    category: "Animal Feed",
    price: 22.00,
    oldPrice: 32.00,
    rating: 5,
    discount: "up to 14% off",
    img: "/assets/img/food-6.png",
    description: "Slow roasted chicken formula with carrots, peas, and omega-3 fatty acids.",
    sku: "PF-1006",
    inStock: true,
    isDealOfWeek: true
  },
  {
    name: "Brown Sandwich",
    slug: "brown-sandwich",
    category: "Cat Supplies",
    price: 10.50,
    oldPrice: null,
    rating: 4,
    discount: null,
    img: "/assets/img/food-shop-1.png",
    description: "Wholesome natural crunchy treats for playful pets.",
    sku: "PF-1007",
    inStock: true
  },
  {
    name: "Banana Leaves",
    slug: "banana-leaves",
    category: "Accessories",
    price: 12.60,
    oldPrice: null,
    rating: 5,
    discount: null,
    img: "/assets/img/food-shop-2.png",
    description: "Comfortable organic habitat bedding and fiber enrichment.",
    sku: "PF-1008",
    inStock: true
  },
  {
    name: "Fresh Salmon Bites",
    slug: "fresh-salmon-bites",
    category: "Cat Supplies",
    price: 18.00,
    oldPrice: 25.00,
    rating: 5,
    discount: "-28%",
    img: "/assets/img/food-shop-3.png",
    description: "Wild caught salmon treats loaded with DHA and protein.",
    sku: "PF-1009",
    inStock: true
  }
];

const initialServices = [
  {
    title: "Pet Grooming",
    slug: "pet-grooming",
    icon: "/assets/img/welcome-to-1.png",
    accentColor: "#940c69",
    shortDesc: "Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.",
    fullDesc: "Complete hygienic care and styling for your furry friends, including soothing organic baths, deshedding, nail trimming, ear cleaning, and customized haircut.",
    features: [
      "Full body organic shampoo and blow dry",
      "Sanitary trim and customized breed styling",
      "Paw massage and nail clipping",
      "Ear cleaning and breath freshening"
    ],
    price: "$45.00 / session"
  },
  {
    title: "Dog Walking",
    slug: "dog-walking",
    icon: "/assets/img/welcome-to-2.png",
    accentColor: "#940c69",
    shortDesc: "Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiu incididunt ut labore et.",
    fullDesc: "Daily energetic walks tailored to your dog's fitness level with GPS tracking, real-time photo updates, and fun social interaction.",
    features: [
      "30, 45, or 60 minute energetic neighborhood walks",
      "GPS tracking report and potty updates",
      "Hydration and post-walk paw cleaning",
      "One-on-one or small matched group walks"
    ],
    price: "$25.00 / walk"
  },
  {
    title: "Dog Boarding Services",
    slug: "dog-boarding",
    icon: "/assets/img/welcome-to-3.png",
    accentColor: "#fa441d",
    shortDesc: "Safe, cozy home-away-from-home boarding with climate-controlled suites.",
    fullDesc: "Overnight luxury boarding with 24/7 attentive supervision, comfortable bedding, fun playtime schedules, and constant care.",
    features: [
      "Private climate controlled luxury suites",
      "Multiple outdoor exercise and play sessions daily",
      "Custom feeding schedules & medication administration",
      "Nightly tuck-in treats and webcams"
    ],
    price: "$55.00 / night"
  },
  {
    title: "Cat Boarding Services",
    slug: "cat-boarding",
    icon: "/assets/img/welcome-to-4.png",
    accentColor: "#fedc4f",
    shortDesc: "Peaceful, stress-free multi-level cat condos with scratch posts and playtime.",
    fullDesc: "Specially separated feline facilities with multi-tier climbing trees, relaxing music, and individualized TLC.",
    features: [
      "Quiet dog-free feline sanctuary zone",
      "Multi-story play condos with climbing towers",
      "Daily brush & gentle cuddle sessions",
      "Daily photo updates to parents"
    ],
    price: "$40.00 / night"
  },
  {
    title: "Veterinary Service",
    slug: "veterinary-service",
    icon: "/assets/img/welcome-to-5.png",
    accentColor: "#fb5e3c",
    shortDesc: "Comprehensive clinical examinations, vaccinations, and preventive healthcare.",
    fullDesc: "Certified veterinarian care encompassing comprehensive wellness evaluations, digital diagnostics, core vaccinations, and dental care.",
    features: [
      "Comprehensive head-to-tail physical exam",
      "Vaccination updates & parasite prevention",
      "Nutritional guidance and wellness testing",
      "In-house diagnostic laboratory"
    ],
    price: "$60.00 / visit"
  },
  {
    title: "Service at a Resort",
    slug: "spa-resort",
    icon: "/assets/img/welcome-to-6.png",
    accentColor: "#940c69",
    shortDesc: "Indulgent hydrotherapy, mud baths, and luxury relaxation for active pets.",
    fullDesc: "Premium wellness treatments designed to soothe joint tension, rejuvenate dry coats, and provide the ultimate pampering.",
    features: [
      "Aromatherapy hydrobath & bubble massage",
      "Dead sea mineral mud coat treatment",
      "Blueberry facial scrub & paw balm",
      "Relaxing lounge session with treats"
    ],
    price: "$75.00 / session"
  }
];

const initialTeam = [
  {
    name: "Gorjona Hiller",
    role: "Veterinary Assistant",
    img: "/assets/img/team-1.jpg",
    bio: "Passionate about animal wellness with 8+ years experience in clinical assistance, behavioral rehabilitation, and gentle grooming.",
    phone: "+021 01283492",
    email: "gorjona@domain.com",
    skills: [
      { label: "Canine Behavior & Training", percentage: 95 },
      { label: "Clinical Care & Nutrition", percentage: 90 },
      { label: "Emergency First Aid", percentage: 98 }
    ]
  },
  {
    name: "Willimes Domson",
    role: "Veterinary Assistant",
    img: "/assets/img/team-2.jpg",
    bio: "Certified canine behaviorist specializing in puppy enrichment, social adaptation, and attentive day care management.",
    phone: "+021 01283493",
    email: "willimes@domain.com",
    skills: [
      { label: "Puppy Socialization", percentage: 92 },
      { label: "Nutritional Formulations", percentage: 88 },
      { label: "Day Care Safety", percentage: 96 }
    ]
  },
  {
    name: "Thomas Walkar",
    role: "Veterinary Assistant",
    img: "/assets/img/team-3.jpg",
    bio: "Senior veterinary tech with specialized expertise in nutrition planning, feline care, and post-surgery rehabilitation.",
    phone: "+021 01283494",
    email: "thomas@domain.com",
    skills: [
      { label: "Feline Sanctuary Care", percentage: 94 },
      { label: "Geriatric Pet Wellness", percentage: 91 },
      { label: "Hydrotherapy", percentage: 89 }
    ]
  }
];

const initialBlogs = [
  {
    title: "The Best High Fiber Dog Food",
    slug: "the-best-high-fiber-dog-food",
    category: "Animal Care",
    date: { day: "23", monthYear: "May,2023" },
    author: "Willimes Domson",
    authorImg: "/assets/img/man.jpg",
    img: "/assets/img/blog-1.jpg",
    excerpt: "Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiuincididunut labore et.",
    content: "Dietary fiber plays a pivotal role in maintaining your dog's gastrointestinal health, supporting regular bowel movements, and regulating body weight. Discover the top veterinarian-approved high-fiber dog foods and how to safely introduce dietary adjustments for optimal canine vitality."
  },
  {
    title: "The Basic Necessities of Proper Pet Care",
    slug: "the-basic-necessities-of-proper-pet-care",
    category: "Animal Care",
    date: { day: "23", monthYear: "May,2023" },
    author: "Willimes Domson",
    authorImg: "/assets/img/man.jpg",
    img: "/assets/img/blog-2.jpg",
    excerpt: "Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiuincididunut labore et.",
    content: "Caring for a pet goes far beyond just providing food and water. This foundational guide covers essential preventative healthcare, mental stimulation, grooming habits, and safety essentials for happier and healthier companions."
  },
  {
    title: "Pets need care and attention",
    slug: "pets-need-care-and-attention",
    category: "Animal Care",
    date: { day: "23", monthYear: "May,2023" },
    author: "Willimes Domson",
    authorImg: "/assets/img/man.jpg",
    img: "/assets/img/blog-3.jpg",
    excerpt: "Lorem ipsum dolor sit amet ur adipiscing elit, sed do eiuincididunut labore et.",
    content: "Understanding your pet's subtle body language, stress indicators, and affection cues is essential to building an unbreakable bond. Explore effective strategies to make your pets feel cherished, secure, and mentally stimulated."
  }
];

const seedDatabase = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Connected to MongoDB for seeding...');

    // Clear existing collections
    await Category.deleteMany();
    await Product.deleteMany();
    await Service.deleteMany();
    await Team.deleteMany();
    await Blog.deleteMany();

    // Insert initial datasets
    await Category.insertMany(initialCategories);
    await Product.insertMany(initialProducts);
    await Service.insertMany(initialServices);
    await Team.insertMany(initialTeam);
    await Blog.insertMany(initialBlogs);

    console.log('🎉 Database Seeded Successfully with complete dynamic pet care data!');
    process.exit(0);
  } catch (error) {
    console.error('❌ Seeding failed:', error);
    process.exit(1);
  }
};

seedDatabase();
