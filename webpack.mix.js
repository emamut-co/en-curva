let mix = require('laravel-mix');

mix.autoload({
    jquery: ["$", "window.jQuery", "jQuery"],
    "popper.js/dist/umd/popper.js": ["Popper"],
  })
  .js("src/js/app.js", "dist/js")
  .sass("src/sass/app.sass", "dist/css")
  .browserSync({
    proxy: "http://localhost/wp-test/",
    open: false,
    files: ["dist/css/app.css", "dist/js/app.js", "./**/*.+(html|php)"],
  })
  .sourceMaps(true, "source-map");