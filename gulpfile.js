//Install Gulp:
//npm install --global gulp-cli *if need*
//npm install --save-dev gulp
//npm install gulp-sass --save-dev
//npm install gulp-csso gulp-cssnano gulp-autoprefixer gulp-bless gulp-concat gulp-notify gulp-removelogs gulp-uglify gulp-rename gulp-changed gulp-filesize gulp-imagemin imagemin-pngquant --save-dev

var project = 'tbkhv'; //Название проекта

var gulp = require('gulp');
var sass = require('gulp-sass');
//var csso = require('gulp-csso');
var nano = require('gulp-cssnano');
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
    gulp.start('sass_admin', 'sass_tbkhv', 'javascript_admin', 'javascript_front','watch');
    //gulp.start('sass', 'sass_admin', 'javascript', 'javascript_admin', 'watch');
});

gulp.task('watch', function () {
    gulp.watch('./public_html/_assets/_admin/_css/**/*.scss', ['sass_admin']);
    gulp.watch('./public_html/_assets/tbkhv/_css/**/**/*.scss', ['sass_tbkhv']);
    gulp.watch(['./resources/assets/admin/_js/**/*.js', '!./resources/assets/admin/_js/min/*'], ['javascript_admin']);
    gulp.watch(['./resources/assets/tbkhv/_js/**/*.js', '!./resources/assets/tbkhv/_js/min/*'], ['javascript_front']);
});

gulp.task('sass_tbkhv', function () {
    gulp.src(['./public_html/_assets/tbkhv/_css/**/*.scss'])
        .pipe(changed('./public_html/_assets/tbkhv/_css/**/**/*.scss'))
        .pipe(sass.sync().on('error', sass.logError))
        //.pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: true
        }))
        .pipe(bless())
        .pipe(nano())
        //.pipe(sourcemaps.write('./maps'))
        .pipe(rename({suffix: '.min'} ))
        .pipe(concat('tbkhv.min.css'))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/tbkhv/_css/min'))
        .pipe(removeLogs())
        .pipe(notify("Scss reload: <%= file.relative %>! "+ project));
});

gulp.task('sass_admin', function () {
    gulp.src(['./public_html/_assets/_admin/_css/*.scss',
            '!./public_html/_assets/_admin/_css/inspinia.scss'])
        .pipe(changed('./public_html/_assets/_admin/_css/**/*.scss'))
        .pipe(sass.sync().on('error', sass.logError))
        //.pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: true
        }))
        .pipe(bless())
        .pipe(nano())
        //.pipe(sourcemaps.write('./maps'))
        .pipe(rename({suffix: '.min'} ))
        .pipe(concat('admin.min.css'))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/_admin/_css/min'))
        .pipe(removeLogs())
        .pipe(notify("Scss reload: <%= file.relative %>! "+ project));
});

gulp.task('javascript_admin', function() {
    return gulp.src([
            './public_html/_assets/bower_components/pickadate/lib/compressed/picker.js',
            './public_html/_assets/bower_components/pickadate/lib/compressed/picker.date.js',
            './public_html/_assets/bower_components/chosen/chosen.jquery.min.js',
            './public_html/_assets/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
            './public_html/_assets/bower_components/bootstrap3-typeahead/bootstrap3-typeahead.min.js',
            './public_html/_assets/bower_components/jquery.cookie/jquery.cookie.js',
            './resources/assets/admin/_js/backend.js',
            './resources/assets/admin/_js/plugin_images.js',
            './resources/assets/admin/_js/plugin_files.js'
        ])
        //.pipe(uglify())
        //.pipe(sourcemaps.init())
        .pipe(concat('back_core.min.js'))
        //.pipe(sourcemaps.write())
        .pipe(removeLogs())
        .pipe(notify("Js reload: <%= file.relative %>! "+ project))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/_admin/_js'));
    //.pipe(livereload());
});

gulp.task('javascript_front', function() {
    return gulp.src([
            //'./public_html/_assets/bower_components/pickadate/lib/compressed/picker.js',
            //'./public_html/_assets/bower_components/pickadate/lib/compressed/picker.date.js',
            //'./public_html/_assets/bower_components/chosen/chosen.jquery.min.js',
            './public_html/_assets/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
            //'./public_html/_assets/bower_components/bootstrap3-typeahead/bootstrap3-typeahead.min.js',
            './public_html/_assets/bower_components/jquery.cookie/jquery.cookie.js',
            './public_html/_assets/bower_components/jquery.spinner/dist/js/jquery.spinner.min.js',
            './resources/assets/tbkhv/_js/frontend.js'
        ])
        //.pipe(uglify())
        //.pipe(sourcemaps.init())
        .pipe(concat('front_core.min.js'))
        //.pipe(sourcemaps.write())
        .pipe(removeLogs())
        .pipe(notify("Js reload: <%= file.relative %>! "+ project))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/tbkhv/_js'));
    //.pipe(livereload());
});