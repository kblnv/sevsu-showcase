/** @type {import('tailwindcss').Config} */
export default {
  content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
  theme: {
    extend: {
      colors: {
        "sevsu-white": "#ffffff",
        "sevsu-blue": "#1d71b8",
        "sevsu-dark-blue": "#27348b",
        "sevsu-light-gray": "#f8f9fa",
      },
    },
  },
};
