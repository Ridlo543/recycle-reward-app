/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/filament/**/*.blade.php", // pastikan untuk memasukkan path ke vendor filament
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#10B981", // warna hijau sebagai warna utama
                    50: "#E3F9F1",
                    100: "#C8F4E3",
                    200: "#93E8C7",
                    300: "#5FDCAA",
                    400: "#2BC08E",
                    500: "#10B981",
                    600: "#0C8F65",
                    700: "#086648",
                    800: "#053D2B",
                    900: "#01140F",
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
