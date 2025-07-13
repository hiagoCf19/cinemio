/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php", // ou ajuste conforme os caminhos dos seus arquivos
    "./**/*.html",
    "./**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        midnight: '#1A1A1D',
        violetNebula: '#6A0DAD',
        galaxyBlue: '#007BFF',
        deepPurple: '#4B0082',
        cyanShine: '#00B5D8',
        snowWhite: '#FFFFFF',
        softGray: '#D3D3D3',
      },
    },
  },
  plugins: [],
}
