//Install Gulp:
//npm install --global gulp-cli *if need*
//npm install --save-dev gulp
//npm install gulp-sass --save-dev
//npm install gulp-csso gulp-cssnano gulp-autoprefixer gulp-bless gulp-concat gulp-notify gulp-removelogs gulp-uglify gulp-rename gulp-changed gulp-filesize gulp-imagemin imagemin-pngquant --save-dev

var project = 'larrock'; //Название проекта

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
    gulp.start('sass_admin', 'sass', 'javascript_admin', 'javascript_front','watch');
    //gulp.start('sass', 'sass_admin', 'javascript', 'javascript_admin', 'watch');
});

gulp.task('watch', function () {
    gulp.watch('./public_html/_assets/_admin/_css/**/*.scss', ['sass_admin']);
    gulp.watch('./resources/assets/front/_css/**/**/*.scss', ['sass']);
    gulp.watch(['./resources/assets/admin/_js/**/*.js', '!./resources/assets/admin/_js/min/*'], ['javascript_admin']);
    gulp.watch(['./resources/assets/front/_js/**/*.js', '!./resources/assets/front/_js/min/*'], ['javascript_front']);
});

gulp.task('sass', function () {
    gulp.src(['./resources/assets/front/_css/*.scss'])
        .pipe(changed('./resources/assets/front/_css/**/**/*.scss'))
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
        .pipe(concat('front.min.css'))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/_front/_css'))
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
            './public_html/_assets/bower_components/pickadate/lib/compressed/picker.js',
            './public_html/_assets/bower_components/pickadate/lib/compressed/picker.date.js',
            './public_html/_assets/bower_components/chosen/chosen.jquery.min.js',
            './public_html/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js',
            './public_html/_assets/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
            './public_html/_assets/bower_components/bootstrap3-typeahead/bootstrap3-typeahead.min.js',
            './public_html/_assets/bower_components/jquery.cookie/jquery.cookie.js',
            './public_html/_assets/bower_components/fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
            './public_html/_assets/bower_components/fancybox/source/jquery.fancybox.pack.js',
            './public_html/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.js',
            './public_html/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-media.js',
            './public_html/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.js',
            './public_html/_assets/bower_components/matchHeight/jquery.matchHeight.js',
            './public_html/_assets/bower_components/Arctext.js/js/jquery.arctext.js',
            './public_html/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js',
            './public_html/_assets/bower_components/jquery-validation/dist/additional-methods.min.js',
            './public_html/vendor/jsvalidation/js/jsvalidation.js',
            './resources/assets/front/_js/frontend.js'
        ])
        //.pipe(uglify())
        //.pipe(sourcemaps.init())
        .pipe(concat('front_core.min.js'))
        //.pipe(sourcemaps.write())
        .pipe(removeLogs())
        .pipe(notify("Js reload: <%= file.relative %>! "+ project))
        .pipe(size({showFiles : true}))
        .pipe(gulp.dest('./public_html/_assets/_front/_js'));
    //.pipe(livereload());
});

/**
 * Copy any needed files.
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {
    // Copy jQuery, Bootstrap, and FontAwesome
    //TODO
    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));
});