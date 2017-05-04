'use strict';

let gulp = require('gulp');
let babel = require('gulp-babel');
let sass = require('gulp-sass');
let concat = require('gulp-concat');
let uglify = require('gulp-uglify');

let css = require('gulp-css');
let minify = require('gulp-minify');
let watch = require('gulp-watch');
let batch = require('gulp-batch');
let runSequence = require('run-sequence');

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
        .pipe(babel())
        .pipe(concat('babeled.js'))
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('js', function () {
    return gulp.src([
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

gulp.task('default', ['sass',  'admin-js', 'fonts', 'images', 'babel-js']);

gulp.task('babel-js', function(done) {
    runSequence('babel', 'js', function() {
        console.log('Run something else');
        done();
    });
});
