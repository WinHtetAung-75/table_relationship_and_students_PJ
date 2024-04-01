/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{php,html,js}","./template/*.php",
  "./node_modules/flowbite/**/*.js"
],
  theme: {
    extend: {},
  },
  plugins: [require('flowbite/plugin')],
}
