/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
        colors: {
            'primary': '#253BFF',
            'secondary': '#53B0FF',
        }
    },
  },
  plugins: [],
}

