module.exports = {
  theme: {
    extend: {
      container: {
        center: true,
        padding: "1rem",
      },
    },
  },
  variants: {},
  purge: {
    content: ["./**/*.php", "./assets/src/**/*.js"],
    options: {
      defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
      whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
      whitelist: ["prose", "container"],
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
