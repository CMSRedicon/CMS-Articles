var gulp = require("gulp");
var ts = require("gulp-typescript");
var tsProject = ts.createProject("tsconfig.json");
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

//Sass
gulp.task('sass', function () {
    return gulp.src([
            'src/public/assets/src/sass/style.scss'
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false,
            remove: false,
        }))
        .pipe(minifyCSS({
            compatibility: 'ie8'
        }))
        .pipe(concat('style.min.css'))
        .pipe(gulp.dest('src/public/assets/output/css'));
});
//Typescript
gulp.task("ts", function () {
    return tsProject.src()
        .pipe(tsProject())
        .pipe(gulp.dest("src/public/assets/src/js"));
});
gulp.task('precompile', ['ts'], function () {
    return gulp.src([
            'src/public/assets/src/js/helpers.js',
            'src/public/assets/src/js/frontend.js',
        ])
        .pipe(uglify())
        .pipe(concat('start.js'))
        .pipe(gulp.dest("src/public/assets/output/js"));
});

gulp.task('watch', function () {
    gulp.watch('src/public/assets/src/ts/*.ts', ['precompile'])
    gulp.watch('src/public/assets/sass/style.scss', ['sass']);
});

gulp.task('default', ['precompile', 'sass', 'watch']);