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
        imagemin      = require('gulp-imagemin');
var notifyOptions = {
  message : 'Error:: <%= error.message %> \nLine:: <%= error.line %> \nCode:: <%= error.extract %>'
};

function browserSync(done) {
	browsersync.init({
        //Domen name or main directory ( choose server or proxy )
        //server: "passagency",  //server + /sync-options = settings 
        proxy: "passagency.com", //proxy + /sync-options = settings
        notify: false,
        //port: 8080, 3000
        //open: true,
        //files: ;
	});
    done();
}

function browserSyncReload() {
  browsersync.reload();
}

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

gulp.task('watch', function() {
	gulp.watch('app/'+syntax+'/**/*.'+syntax+'', gulp.series('styles')).on( 'change', browserSyncReload );
	gulp.watch('app/'+syntax_two+'/**/*.'+syntax_two+'', gulp.series('styles_two')).on( 'change', browserSyncReload );
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], gulp.series('js')).on( 'change', browserSyncReload );
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], gulp.series('js-two')).on( 'change', browserSyncReload );
	gulp.watch(['libs/**/*.js', 'app/js/ajax.js'], gulp.series('ajax')).on( 'change', browserSyncReload );
	gulp.watch('app/img/*', gulp.series('compressim')).on( 'change', browserSyncReload );
    gulp.watch('**/*.php').on('change', browserSyncReload);
});

gulp.task('default', gulp.parallel('watch', browserSync));