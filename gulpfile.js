//Install Gulp:
//npm install -g npm  *if need*
//npm install --global gulp *if need*
//npm install gulp --save-dev
//npm install gulp-sass --save-dev
//npm install gulp-csso gulp-autoprefixer gulp-bless gulp-concat gulp-notify gulp-removelogs gulp-uglify gulp-rename gulp-changed gulp-filesize gulp-imagemin imagemin-pngquant --save-dev

var project = 'larrock'; //Название проекта

var gulp = require('gulp');
var sass = require('gulp-sass');
var csso = require('gulp-csso');
var autoprefixer = require('gulp-autoprefixer');
var bless = require('gulp-bless');
var concat = require('gulp-concat');
//var sourcemaps = require('gulp-sourcemaps');
var notify = require("gulp-notify");
var removeLogs = require('gulp-removelogs');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
//var gulpFilter = require('gulp-filter');
var changed = require('gulp-changed');
var size = require('gulp-filesize');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');

gulp.task('default', function() {
    gulp.start('sass_admin', 'javascript_admin', 'watch');
    //gulp.start('sass', 'sass_admin', 'javascript', 'javascript_admin', 'watch');
});

gulp.task('watch', function () {
    gulp.watch('./resources/assets/admin/_css/**/*.scss', ['sass_admin']);
    gulp.watch(['./resources/assets/admin/_js/**/*.js', '!./resources/assets/admin/_js/min/*'], ['javascript_admin']);
});

gulp.task('sass_admin', function () {
    gulp.src(['./resources/assets/admin/_css/*.scss',
            '!./resources/assets/admin/_css/print.scss',
            '!./resources/assets/admin/_css/style.scss'])
        .pipe(changed('./resources/assets/admin/_css/**/*.scss'))
        .pipe(sass.sync().on('error', sass.logError))
        //.pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: true
        }))
        .pipe(bless())
        .pipe(csso())
        //.pipe(sourcemaps.write('./maps'))
        .pipe(rename({suffix: '.min'} ))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_admin/_css'))
        .pipe(removeLogs())
        .pipe(notify("Scss reload: <%= file.relative %>! "+ project));
});

gulp.task('javascript_admin', function() {
    return gulp.src([
            './resources/assets/admin/_js/plugins/metisMenu/jquery.metisMenu.js',
            './resources/assets/admin/_js/plugins/bootstrap.file-input.js',
            './resources/assets/admin/_js/core/inspinia.js',
            './resources/assets/admin/_js/core/jquery.bootpag.min.js',
            './resources/assets/admin/_js/plugins/datapicker/pickadate.min.js',
            './resources/assets/admin/_js/plugins/chosen/chosen.jquery.js',
            './resources/assets/admin/_js/plugins/noty/jquery.noty.packaged.min.js',
            './resources/assets/admin/_js/core/bootstrap3-typeahead.js',
            './resources/assets/admin/_js/core/validation',
            './resources/assets/admin/_js/plugins/cookie/jquery.cookie.js',
            './resources/assets/admin/_js/core/jquery.liteuploader.js',
            './resources/assets/admin/_js/core/upload_image.js',
            './resources/assets/admin/_js/core/upload_image2.js',
            './resources/assets/admin/_js/backend.js'
        ])
        //.pipe(uglify())
        //.pipe(sourcemaps.init())
        .pipe(concat('back_core.js'))
        //.pipe(sourcemaps.write())
        .pipe(removeLogs())
        .pipe(notify("Js reload: <%= file.relative %>! "+ project))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_admin/_js'));
    //.pipe(livereload());
});