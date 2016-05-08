/***********************************************************************
使用するパッケージの宣言
**********************************************************************/
var gulp = require('gulp');

var jade   = require('gulp-jade');
var rename = require('gulp-rename');

var sass     = require('gulp-ruby-sass');
var csscomb  = require('gulp-csscomb');
var pleeease = require('gulp-pleeease');

var plumber = require('gulp-plumber');
var notify  = require('gulp-notify');

var browserSync = require('browser-sync').create();

var imagemin  = require('gulp-imagemin');
var pngquant  = require('imagemin-pngquant');

var watch = require('gulp-watch');

var rimraf = require('rimraf');
var del    = require('del');


/***********************************************************************
パス関係の情報
**********************************************************************/
var paths = {
  jade:  ['./src/dist_root/**/*.jade'],
  sass: './src/dist_root/**/*.sass',
  png: './src/dist_root/**/*.png',
  cp: [
    './src/dist_root/**/*',
    '!./src/dist_root/**/{*.jade,*.sass,*.png}'
  ]
};

var static_path = './dist';
var wp_path = './wp_theme';

function build_path(is_dev) {
  return (is_dev) ? static_path : wp_path;
}


/***********************************************************************
ビルド用の関数
**********************************************************************/
var build_funcs = {
  jade: function(is_dev) {
    var ext = '.php';
    if (is_dev) {
      ext = '.html';
    }

    gulp.src(paths.jade)
        .pipe(jade({
          pretty: true,
          locals: {
            is_dev: is_dev
          }
        }))
        .pipe(rename({extname: ext}))
        .pipe(gulp.dest(build_path(is_dev)))
        .pipe(browserSync.stream());
  },
  sass: function(is_dev) {
    return sass('src/dist_root/**/*.sass', {
      loadPath: './src/etc/sass_imports',
      style: 'nested'
    })
    .pipe(pleeease({
      autoprefixer: ['android 2.3'],
      minifier: false,
      opacity: false,
      filter: false,
      rem: false
    }))
    .pipe(csscomb())
    .pipe(gulp.dest(build_path(is_dev)))
    .pipe(browserSync.stream());
  },
  img: function(is_dev) {
    gulp.src(paths.png)
        .pipe(imagemin({
          progressive: true,
          use: [
            pngquant()
          ]
        }))
        .pipe(gulp.dest(build_path(is_dev)));
  },
  cp: function(is_dev) {
    gulp.src(paths.cp)
        .pipe(gulp.dest(build_path(is_dev)));
  },
  clean: function(is_dev, cb) {
    if (is_dev) {
      rimraf(build_path(is_dev), cb);
    } else {
      var path = build_path(is_dev);
      del([
        path + '/**/*',
        '!' + path + '/.git'
      ]).then(function() {
        cb();
      });
    }
  },
  watch: function(is_dev) {
    var bs_option = {
      open: false,
      ghostMode: false
    };

    if (is_dev) {
      bs_option.server = build_path(is_dev);
    } else {
      bs_option.proxy = '192.168.11.2';
    }

    browserSync.init(bs_option);

    watch('./src/**/*.jade', function(event) {
      build_funcs.jade(is_dev);
    });
    watch('./src/**/*.sass', function(event) {
      build_funcs.sass(is_dev);
    });
    watch([paths.png], function(event) {
      build_funcs.img(is_dev);
    });
    watch(paths.cp, function(event) {
      build_funcs.cp(is_dev);
    });
  }
};



/***********************************************************************
静的サイト関係のタスク
**********************************************************************/
gulp.task('static_clean', function(cb) {
  build_funcs.clean(true, cb);
});

gulp.task('static_build', ['static_clean'], function() {
  var is_dev = true;

  build_funcs.jade(is_dev);
  build_funcs.sass(is_dev);
  build_funcs.img(is_dev);
  build_funcs.cp(is_dev);
});

gulp.task('static', ['static_build'], function() {
  build_funcs.watch(true);
});


/***********************************************************************
Wordpressテーマ関係のタスク
**********************************************************************/
gulp.task('wp_clean', function(cb) {
  build_funcs.clean(false, cb);
});

gulp.task('wp_build', ['wp_clean'], function() {
  var is_dev = false;

  build_funcs.jade(is_dev);
  build_funcs.sass(is_dev);
  build_funcs.img(is_dev);
  build_funcs.cp(is_dev);
});

gulp.task('wp', ['wp_build'], function() {
  build_funcs.watch(false);
});
