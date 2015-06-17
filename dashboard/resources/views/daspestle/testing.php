@extends('daspestle/template')

@section('isi')
<div class="row">
	<h1 class="text-center">TESTING</h1>
</div>
<div class="row">
	<form>
		<div class="form-group">
			<label class="control-label">URL</label>
			<input type="text" class="form-control">
			<br>
			<button class="btn btn-primary">Get It!</button>
		</div>
		<div class="form-group">
			<label class="control-label">Content</label>
			<textarea class="form-control" rows="10">{{$hasil['text']}}</textarea>
		</div>
	</form>
	<br>
	<div class="col-md-12">
		<p class="lead">Sentence Extractor</p>
		<ul>
			<li>Kalimat 1</li>
		</ul>
	</div>
</div>
@endsection