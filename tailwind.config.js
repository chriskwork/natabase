/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './views/**/*.php',
    './public/**/*.{html,js}',
    './includes/**/*.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        // brand color
        brand: {
          navy: '#1a3a52',
          turquoise: '#0099cc',
          lightblue: '#87ceeb',
          point: '#cc3300',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        heading: ['Poppins', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
};

// npx tailwindcss -i ./src/input.css -o public/assets/css/style.css --watch
