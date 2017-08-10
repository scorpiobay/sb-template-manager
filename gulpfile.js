var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var copy = require('gulp-copy');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var clean = require('gulp-clean');
var maps = require('gulp-sourcemaps');
var babel = require("gulp-babel");


function swallowError (error) {

  // If you want details of the error in the console
  console.log(error.toString())

  this.emit('end')
}

var sassPaths = [
  'bower_components/foundation-sites/scss',
  'bower_components/motion-ui/src'
];

function swallowError (error) {

  // If you want details of the error in the console
  console.log(error.toString());

  this.emit('end');
}

gulp.task('sass', function() {
  return gulp.src('scss/app.scss')
    .pipe(maps.init())
    .on('error', swallowError)
    .pipe(sass({ 
      includePaths: sassPaths ,
      outputStyle: 'compressed'
  })).on('error', swallowError)
    .pipe(maps.write('.'))
    .pipe(gulp.dest('css'));
});

gulp.task('copy-bower', function () {
   return gulp.src(['bower_components/jquery/dist/jquery.min.js','bower_components/motion-ui/dist/motion-ui.min.js','bower_components/what-input/dist/what-input.min.js', 'bower_components/foundation-sites/dist/js/foundation.min.js'])
        .pipe(gulp.dest('js'));
});

gulp.task('lint', function (){
    return gulp.src('js/transpile/**/*.js')
        .pipe(jshint())
        .on('error', swallowError)
        .pipe(jshint.reporter('default'));
});
gulp.task("transpile", function(){
   return gulp.src('js/custom/**/*.js')
        .pipe(babel({presets: ['es2015']}))
        .on('error', swallowError)
        .pipe(concat('dist.js'))
        .pipe(gulp.dest('js/transpiled'))
});
gulp.task("concat-uglify", function (){
    return gulp.src([ 'js/jquery.min.js','js/foundation.min.js','js/what-input.min.js','js/motion-ui.min.js','js/transpiled/dist.js'])
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js'));
});

gulp.task('clean', function (){
   return gulp.src(['js/foundation.min.js', 'js/motion-ui.min.js', 'js/what-input.min.js','js/custom/dist.js' ,'js/app.js','css/app.css','css/app.css.map'], {read: false})
        .pipe(clean());
});

gulp.task('watch', function () {
  gulp.watch('js/transpile/**/*.js',['transpile','concat-uglify', 'lint']);
  gulp.watch('scss/**/*.{scss,sass}', ['sass']);
  gulp.watch('gulpfile.js');
});

gulp.task('build', ["copy-bower","sass"]);

gulp.task('runwatch', ["sass",'transpile', "concat-uglify","lint"]);

gulp.task('default', ["runwatch","watch"]);

