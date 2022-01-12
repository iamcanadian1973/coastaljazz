const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-copy-watched');
require('laravel-mix-imagemin');
const TargetsPlugin = require("targets-webpack-plugin"); 

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('./dist');

mix.browserSync({
	proxy: 'http://coastaljazz.local',
	port: 3000,
	notify: false,
	open: true,
	files: [
		'front-page.php',
		'archive*.php',
		'single*.php',
		'tribe/**/*.php',
		'tribe-events/**/*.php',
		'page-templates/**/*.php',
		'template-parts/**/*.php',
		'dist/scripts/**/*.js',
		'dist/styles/**/*.css'
	],
});


mix.webpackConfig({
	stats: 'minimal',
	devtool: mix.inProduction() ? false : 'source-map',
	performance: { hints: false },
	externals: { jquery: 'jQuery' },
	plugins: [
        new TargetsPlugin({
	      useBuiltIns: "usage",
          browsers: [">0.25%",
		  "not ie 11",
		  "not op_mini all"],
        }),
	],
});

mix.autoload({
	jquery: ['$', 'window.jQuery'],
});

mix.js('assets/scripts/project.js', 'scripts').extract();

mix.sass('assets/styles/style.scss', 'styles')
	.polyfill({
		enabled: true,
		useBuiltIns: "usage",
		targets: [">0.25%",
		"not ie 11",
		"not op_mini all"]
	})
	.copyWatched('assets/images/**', 'dist/images', { base: 'assets/images' })

;


mix.scripts('assets/scripts/vendor/jquery.royalslider.custom.min.js', 'dist/scripts/jquery.royalslider.custom.min.js');
mix.scripts('assets/scripts/front-page.js', 'dist/scripts/front-page.js');

mix.scripts('assets/scripts/vendor/infinite-scroll.pkgd.min.js', 'dist/scripts/infinite-scroll.pkgd.min.js');
mix.scripts('assets/scripts/infinite-scroll.js', 'dist/scripts/infinite-scroll.js');

mix.options({
    processCssUrls: false
});

mix.sourceMaps(false, 'source-map')
	.version();
