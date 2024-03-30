export default {
    plugins: ["prettier-plugin-blade", "prettier-plugin-organize-attributes", "prettier-plugin-tailwindcss"],
    attributeGroups: ["$CODE_GUIDE"],
    overrides: [
        {
            "files": ["*.blade.php"],
            "options": {
                "parser": "blade"
            }
        }
    ],
    tailwindConfig: "./tailwind.config.js"
}
