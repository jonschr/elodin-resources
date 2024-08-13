//* Vars
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var sassGlob = require('gulp-sass-glob');
const cleanCSS = require('gulp-clean-css');

//* Tasks
gulp.task('style', function () {
	return gulp
		.src('assets/css/ers-resources-styles.scss')
		.pipe(sassGlob())
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('assets/css/'));
});

gulp.task('prod', function () {
	return gulp
		.src('assets/css/ers-resources-styles.scss')
		.pipe(sassGlob())
		.pipe(sass().on('error', sass.logError))
		.pipe(cleanCSS({ compatibility: 'ie8' }))
		.pipe(gulp.dest('assets/css/'));
});

//* Watchers here
gulp.task('watch', function () {
	gulp.watch('assets/css/**/*.scss', gulp.series(['style']));
});

gulp.task('default', gulp.series(['watch']));
