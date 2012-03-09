/*Used by the squeezebox*/

SqueezeBox.parsers.swf = function(preset) {
	return (preset || this.url.test(/\.swf/)) ? this.url : false;
};
SqueezeBox.handlers.swf = function(url) {
	var size = this.options.size;
	return new Swiff(url, {
		id: 'sbox-swf',
		width: size.x,
		height: size.y
	});
};
window.addEvent('domready', function() {
	SqueezeBox.assign($$('a.modal'), {
		parse: 'rel'
	});
});