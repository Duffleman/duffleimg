/* eslint-disable no-console */
window.Dropzone.autoDiscover = false;
const myDropzone = new window.Dropzone('#mainDz');

myDropzone.on('complete', (file) => {
	const response = JSON.parse(file.xhr.response);

	copyTextToClipboard(response.url);
});

function copyTextToClipboard(text) {
	const textArea = document.createElement('textarea');

	textArea.style.position = 'fixed';
	textArea.style.top = 0;
	textArea.style.left = 0;
	textArea.style.width = '2em';
	textArea.style.height = '2em';
	textArea.style.padding = 0;
	textArea.style.border = 'none';
	textArea.style.outline = 'none';
	textArea.style.boxShadow = 'none';
	textArea.style.background = 'transparent';

	textArea.value = text;

	document.body.appendChild(textArea);

	textArea.select();

	try {
		const successful = document.execCommand('copy');

		console.info(successful);
	} catch (error) {
		console.warn(error);
	}

	document.body.removeChild(textArea);
}
