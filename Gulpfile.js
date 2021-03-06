'use strict';

let gulp = require('gulp');
let babel = require('gulp-babel');
let sass = require('gulp-sass');
let concat = require('gulp-concat');

let minify = require('gulp-minify');
let watch = require('gulp-watch');

let livereload = require('gulp-livereload');

let dir = {
    app_assets: './app/Resources/',
    public_assets: './app/Resources/public/',
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/'
};

gulp.task('sass', function () {
    gulp.src([
        dir.assets + 'scss/main.scss',
        dir.public_assets + 'css/**',
        dir.npm + 'font-awesome/css/font-awesome.css',
    ])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(dir.dist + 'css'))
        .pipe(livereload());
});


gulp.task('images', function () {
    gulp.src([
        dir.assets + 'images/**'
    ])
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function () {
    gulp.src([
        dir.npm + 'bootstrap-sass/assets/fonts/**',
        dir.npm + 'font-awesome/fonts/**',
    ])
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('babel', function () {
    return gulp.src([
        dir.public_assets + 'js/**',
        dir.assets + 'scripts/**'
    ])
        .pipe(babel())
        .pipe(concat('babeled.js'))
        .pipe(gulp.dest(dir.dist + 'js'))
        .pipe(livereload());
});

gulp.task('js', ['babel'], function () {
    gulp.src([
        dir.npm + 'jquery/dist/jquery.min.js',
        dir.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
        dir.dist + 'js/babeled.js'
    ])
        .pipe(concat('main.js'))
        .pipe(minify())
        .pipe(gulp.dest(dir.dist + 'js'))
        .pipe(livereload());
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

gulp.task('watch', function() {
    livereload.listen();

    gulp.watch([
        dir.public_assets + 'js/**',
        dir.assets + 'scripts/**'
    ], ['babel', 'js']);

    gulp.watch([
        dir.assets + 'scss/**',
        dir.public_assets + 'css/**'
    ], ['sass']);

});

gulp.task('default', ['sass', 'js', 'babel', 'admin-js', 'fonts', 'images']);
