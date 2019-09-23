var syntax            = 'scss'; // Syntax: sass or scss;
var syntax_two        = 'sass';
    var gulp          = require('gulp'),
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		browsersync   = require('browser-sync'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		wait          = require("gulp-wait"),
		notify        = require("gulp-notify"),
		rsync         = require("gulp-rsync"),
        imagemin      = require('gulp-imagemin')

gulp.task('browser-sync', function() {
	browsersync({
		proxy: "moskow",
		notify: false
	});
});

gulp.task('styles', function() {
	return gulp.src('app/'+syntax+'/**/*.'+syntax+'')
	.pipe(wait(500))
	.pipe(sass({ outputStyle: 'nested' }).on("error", notify.onError()))
    .pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('app/css'))
	.pipe(browsersync.reload( {stream: true} ))
});

gulp.task('styles_two', function() {
	return gulp.src('app/'+syntax_two+'/**/*.'+syntax_two+'')
	.pipe(wait(500))
	.pipe(sass({ outputStyle: 'nested' }).on("error", notify.onError()))
    .pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('app/css'))
	.pipe(browsersync.reload( {stream: true} ))
});

gulp.task('js', function() {
	return gulp.src([
		'app/libs/jquery/dist/jquery.min.js',
        'app/js/ajax-form.js',
		'app/js/common.js', // Always at the end
		])
	.pipe(concat('scripts.min.js'))
    .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('app/js'))
	.pipe(browsersync.reload({ stream: true }))
});

gulp.task('js-two', function() {
	return gulp.src([
        'app/js/ajax-form.js',
		'app/js/common.js', // Always at the end
		])
	.pipe(concat('custom.min.js'))
    .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('app/js'))
	.pipe(browsersync.reload({ stream: true }))
});

gulp.task('ajax', function() {
	return gulp.src([
        'app/js/ajax.js',
		])
	.pipe(concat('ajax.min.js'))
    .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('app/js'))
	.pipe(browsersync.reload({ stream: true }))
});

gulp.task('compressim', function() {
    return gulp.src('app/img/*')
    .pipe(imagemin())
    .pipe(gulp.dest('app/img-optimize'))
});

gulp.task('watch', ['styles', 'styles_two', 'js', 'js-two', 'ajax', 'compressim', 'browser-sync'], function() {
	gulp.watch('app/'+syntax+'/**/*.'+syntax+'', ['styles']);
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], ['js']);
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], ['js-two']);
	gulp.watch(['libs/**/*.js', 'app/js/ajax.js'], ['ajax']);
	gulp.watch('app/img/*', ['compressim']);
    gulp.watch('*.php', browsersync.reload)
});

gulp.task('default', ['watch']);
