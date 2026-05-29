export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Filament/**/*.php",
    "./vendor/filament/**/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        'brand-yellow': '#ffd600',
        'brand-blue': '#001f3f',
      },
    },
  },
}
