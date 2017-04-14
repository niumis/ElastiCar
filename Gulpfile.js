'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var css = require('gulp-css');
var minify = require('gulp-minify');
var watch = require('gulp-watch');
var batch = require('gulp-batch');


var dir = {
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/'
};


gulp.task('sass', function () {
    gulp.src(dir.assets + 'style/main.scss')
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

gulp.task('js', function () {
    gulp.src([
        dir.npm + 'jquery/dist/jquery.min.js',
        dir.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
    ])
        .pipe(concat('main.js'))
        .pipe(minify())
        .pipe(gulp.dest(dir.dist + 'js'))
});

gulp.task('admin-js', function () {
    gulp.src([
        dir.npm + 'jquery/dist/jquery.min.js',
    ])
        .pipe(concat('admin.js'))
        .pipe(minify())
        .pipe(gulp.dest(dir.dist + 'js'))
});

gulp.task('default', ['sass', 'js', 'admin-js', 'fonts', 'images']);
