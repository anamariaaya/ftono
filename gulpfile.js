const { src, dest, watch, parallel } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

// Imagenes
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');
const svg = require('gulp-svgmin');

// Javascript
const terser = require('gulp-terser-js');

const path = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    img: 'src/img/**/*.{jpg,png}',
    svg: 'src/img/**/*.svg'
}

function css( done ) {
    src(path.scss) // Identificar el archivo .SCSS a compilar
        .pipe(sourcemaps.init())
        .pipe( plumber())
        .pipe( sass() ) // Compilarlo
        .pipe( postcss([ autoprefixer(), cssnano() ]) )
        .pipe(sourcemaps.write('.'))
        .pipe(  dest('public/build/css') );
    done();
}

function imagenes(done) {
    const opciones = {
        optimizationLevel: 3
    }
    src(path.img)
        .pipe( cache( imagemin(opciones) ) )
        .pipe( dest('public/build/img') )
    done();
}

function versionWebp( done ) {
    const opciones = {
        quality: 50
    };
    src(path.img)
        .pipe( webp(opciones) )
        .pipe( dest('public/build/img') )
    done();
}

function javascript( done ) {
    src(path.js)
        .pipe(sourcemaps.init())
        .pipe( terser() )
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'));

    done();
}

function imgSvg(){
    return src(path.svg)
        .pipe(svg())
        .pipe(dest('public/build/img'));
}

function dev( done ) {
    watch(path.scss, css);
    watch(path.js, javascript);

    done();
}

exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.imgSvg = imgSvg;
exports.dev = parallel( css, imagenes, versionWebp, javascript, imgSvg, dev);