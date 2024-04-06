/** @type {import("tailwindcss").Config} */
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
      fontFamily: {
        "main-regular": ["Myriad Pro Regular", "Helvetica", "Arial", "sans-serif"],
        "main-light": ["Myriad Pro Light", "Helvetica", "Arial", "sans-serif"],
        "main-semibold": ["Myriad Pro Semibold", "Helvetica", "Arial", "sans-serif"],
        "main-bold": ["Myriad Pro Bold", "Helvetica", "Arial", "sans-serif"],
      }
    },
  },
};
