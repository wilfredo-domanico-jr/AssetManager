import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html", // Scan your main HTML
        "./src/**/*.{vue,js,ts,jsx,tsx}", // Scan all Vue files
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
    // darkMode: "class", // optional, enables dark mode via a "dark" class
};
