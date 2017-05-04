'use strict';

var gulp = require('gulp');
var babel = require('gulp-babel');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var css = require('gulp-css');
var minify = require('gulp-minify');
var watch = require('gulp-watch');
var batch = require('gulp-batch');


var dir = {
    app_assets: './app/Resources/',
    public_assets: './app/Resources/public/',
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/'
};

gulp.task('sass', function () {
    gulp.src([
        dir.assets + 'scss/main.scss',
        dir.public_assets + 'css/**'
    ])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(dir.dist + 'css'));
});


gulp.task('images', function () {
    gulp.src([
        dir.assets + 'images/**'
    ])
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function () {
    gulp.src([
        dir.npm + 'bootstrap-sass/assets/fonts/**'
    ])
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('babel', function () {
    gulp.src([
        dir.public_assets + 'js/**',
        dir.assets + 'scripts/**'
    ])
        .pipe(babel({ presets: ['babel-preset-es2015', 'babel-preset-stage-2'].map(require.resolve) }))
        .pipe(concat('babeled.js'))
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('js', function () {
    gulp.src([
        dir.npm + 'jquery/dist/jquery.min.js',
        dir.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
        dir.dist + 'js/babeled.js'
    ])
        .pipe(concat('main.js'))
        .pipe(minify())
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('admin-js', function () {
    gulp.src([
        dir.npm + 'jquery/dist/jquery.min.js',
        dir.npm + 'chart.js/dist/Chart.js',
        dir.app_assets + 'admin/js/**'
    ])
        .pipe(concat('admin.js'))
        .pipe(minify())
        .pipe(gulp.dest(dir.dist + 'js'))
});

gulp.task('default', ['sass', 'babel', 'js', 'admin-js', 'fonts', 'images']);
