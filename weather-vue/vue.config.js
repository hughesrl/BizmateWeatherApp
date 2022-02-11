const path = require('path');

module.exports = {
	transpileDependencies: [
		'vuetify'
	],
	outputDir: '../public',

	chainWebpack: config => {
		config.resolve.alias.set('@', path.join(__dirname, './src'));
	},


	indexPath: process.env.NODE_ENV === 'production'
	    ? '../resources/views/index.blade.php'
	    : 'index.html'
}
