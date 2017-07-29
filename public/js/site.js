Dropzone.autoDiscover = false;
var myDropzone = new Dropzone('#mainDz', {
	paramName: 'image',
	success: function (file, response) {
		vue.addImage(response.url);
	}
});
var clipboard = new Clipboard('.btn-copy');

var vue = new Vue({
	el: '#app',

	data: {
		images: [],
	},

	methods: {
		addImage: function (img) {
			this.images.push(img);
		},
	},
});
