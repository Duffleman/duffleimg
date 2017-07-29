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
		<div id="app" class="mt-4">
			<div class="row">
				<div class="col-3" v-for="image in images">
					<div class="card">
						<img class="card-img-top screenshot" v-bind:src="image" alt="Screenshot">
						<div class="card-block">
							<a href="#" class="btn btn-primary btn-block btn-copy"  v-bind:data-clipboard-text="image">Copy URL</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
	<script src="/js/site.js"></script>
  </body>
</html>
