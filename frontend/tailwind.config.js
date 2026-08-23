/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        theme: {
          orange: '#fa441d',
          orangeHover: '#e03a15',
          cream: '#fff8e5',
          creamLight: '#fffcf5',
          purple: '#940c69',
          yellow: '#fedc4f',
          salmon: '#fb5e3c',
          gray: '#f5f5f5',
          dark: '#222222',
          text: '#777777',
        }
      },
      fontFamily: {
        heading: ['DynaPuff', 'cursive', 'sans-serif'],
        body: ['Anybody', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 10px 30px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 15px 35px rgba(250, 68, 29, 0.12)',
        'modal': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      },
      borderRadius: {
        'xl2': '20px',
        'xl3': '30px',
      }
    },
  },
  plugins: [],
}
