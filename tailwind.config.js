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
                    DEFAULT: "#10B981",
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
                "pastel-green": {
                    50: "#f2fbf2",
                    100: "#e1f8e0",
                    200: "#c4efc3",
                    300: "#94e194",
                    400: "#72d172",
                    500: "#38af39",
                    600: "#299029",
                    700: "#237224",
                    800: "#205b21",
                    900: "#1c4b1e",
                    950: "#0a290c",
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
