<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
	<link rel="stylesheet" href="/css/site.css">
	<title>Duffle IMG</title>
  </head>
  <body>
	<div class="container pt-4">
		<h1>Duffle IMG</h1>
		<form action="/" method="post" enctype="multipart/form-data" class="dropzone" id="mainDz">
			<div class="fallback">
				<input name="image" type="file" multiple />
				<button type="submit">Submit</button>
			</div>
		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
	<script src="/js/site.js"></script>
  </body>
</html>
