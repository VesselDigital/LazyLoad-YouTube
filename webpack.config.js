const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		'vesseldigital/lazyload-youtube': './Blocks/YouTubeEmbed/block.js'
	},
	output: {
		path: path.join(__dirname, './Resources/js/gutenberg'),
		filename: '[name].js'
	}
}