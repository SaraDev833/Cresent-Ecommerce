const { Container } = require('postcss');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./dist/**/*.html'], 
  theme: {
    extend: {
     width:{
      'custom_width': '1120px',

     },
     spacing:{
      'custom-spacing':'-216px',
     },
     keyframes: {
      slideInLeft: {
        '0%': { opacity: '0', transform: 'translateX(-100%)' }, // Start from off-screen left
        '100%': { opacity: '1', transform: 'translateX(0)' },   // End at its final position
      },
      slideInRight: {
        '0%': { opacity: '0', transform: 'translateX(100%)' }, // Start from off-screen left
        '100%': { opacity: '1', transform: 'translateX(0)' },   // End at its final position
      },
 

    },
    animation: {
      fadeX: 'slideInLeft 0.5s ease-in-out forwards',
      slideInFromRight: 'slideInRight 0.5s ease-in-out forwards',
    },
    }
  },
  plugins: [],
}
