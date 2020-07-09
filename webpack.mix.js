let mix = require('laravel-mix');

mix.setResourceRoot("../../")
  .autoload({
    jquery: ["$", "window.jQuery", "jQuery"],
    "popper.js/dist/umd/popper.js": ["Popper"],
  })
  .js("src/js/app.js", "dist/js")
  .sass("src/sass/app.sass", "dist/css")
  .browserSync({
    proxy: "http://localhost/en-curva/",
    open: false,
    files: ["dist/css/app.css", "dist/js/app.js", "./**/*.+(html|php)"],
  })
  .sourceMaps(true, "source-map");