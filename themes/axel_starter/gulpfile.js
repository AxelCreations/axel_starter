'use strict';

const { src, dest, watch } = require('gulp');

const ts = require('gulp-typescript');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass')(require('sass'));

const compileSass = () => {
  return src(['node_modules/bootstrap/scss/bootstrap.scss', 'src/sass/*.scss'])
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(dest('assets/css'));
};

const compileTS = () => {
  const tsProject = ts.createProject('tsconfig.json');

  return src(['node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'src/ts/*.ts'])
    .pipe(tsProject())
    .pipe(uglify())
    .pipe(dest('assets/js'));
};

exports.css = compileSass;

exports.watch = () => {
  watch('src/sass/**/*.scss', compileSass);
  watch('src/ts/**/*.ts', compileTS);
}
