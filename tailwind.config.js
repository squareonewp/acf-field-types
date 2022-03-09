module.exports = {
  mode: 'jit',
  prefix: 'sq-',
  important: true,
  purge: {
    content: [
      './src/**/*.php',
      './resources/**/*.{php,vue,js}',
    ],
  },

  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {},
    },

    container: {
      center: true,
    },
  },
  variants: {
    extend: {},
  },
};
