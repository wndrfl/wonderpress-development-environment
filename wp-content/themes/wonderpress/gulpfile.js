// Include gulp
var gulp = require( 'gulp' );

// Include Our Plugins
var sass         = require( 'gulp-sass' ),
	browserify   = require( 'browserify' ),
	concat       = require( 'gulp-concat' ),
	uglify       = require( 'gulp-uglify' ),
	cleanCSS     = require( 'gulp-clean-css' ),
	concatCss    = require( 'gulp-concat-css' ),
	rename       = require( 'gulp-rename' ),
	source       = require( 'vinyl-source-stream' ),
	buffer       = require( 'vinyl-buffer' ),
	imagemin     = require( 'gulp-imagemin' ),
	autoprefixer = require( 'gulp-autoprefixer' );

var paths = {
	'dev': {
		'images' : './src/images/src/',
		'js': './src/js/src/',
		'packages': './node_modules/',
		'scss': './src/scss/'
	},
	'production': {
		'css': './src/css/',
		'images' : './src/images/',
		'js': './src/js/'
	}
};

// Optimize images
gulp.task(
	'optimize-images',
	() =>
	gulp.src( paths.dev.images + '*' )
		.pipe(
			imagemin(
				[],
				{
					verbose: true
				}
			)
		)
		.pipe( gulp.dest( paths.production.images ) )
);

// Compile our JS
gulp.task(
	'scripts.js',
	function(){
		return browserify(
			{
				// debug: true,
				entries: [paths.dev.js + 'scripts.js']
			}
		)
		.bundle()
		.pipe( source( 'scripts.js' ) )
		.pipe( buffer() )
		.pipe( gulp.dest( paths.production.js ) )
		.pipe( uglify() )
		.pipe( rename( {suffix:'.min'} ) )
		.pipe( gulp.dest( paths.production.js ) );
	}
);

// Compile Our Sass
gulp.task(
	'styles.css',
	function() {
		return gulp.src(
			[
			paths.dev.scss + 'styles.scss'
			]
		)
		.pipe( sass() )
		.pipe(
			autoprefixer(
				{
					browsers: ['last 2 versions'],
					cascade: false
				}
			)
		)
		.pipe( concatCss( "styles.css" ) )
		.pipe( cleanCSS( {compatibility: 'ie8'} ) )
		.pipe( gulp.dest( paths.production.css ) );

	}
);

// Watch Files For Changes
gulp.task(
	'watch',
	function() {
		gulp.watch( paths.dev.html, ['html'] );
		gulp.watch( paths.dev.images + '**/*', ['optimize-images'] );
		gulp.watch( paths.dev.js + '**/*.js', ['scripts.js'] );
		gulp.watch( paths.dev.scss + '**/*.scss', ['styles.css'] );
	}
);

// Default Task
gulp.task( 'default', ['optimize-images', 'scripts.js', 'styles.css', 'watch'] );
