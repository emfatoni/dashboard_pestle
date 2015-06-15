@extends('daspestle/template')

@section('isi')
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<h1 class="text-center">KEYWORD SETTINGS</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="col-md-12">
					<form>
						<div class="form-group">
							<label>PESTLE Analysis Factors:</label>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="politic">
									Politic
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="economy">
									Economy
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="social">
									Social
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="technology">
									Technology
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="legal">
									Legal
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aspek" value="environment">
									Environment
								</label>
							</div>
						</div>
						<div class="form-group">
							<label>Keyword:</label>
							<textarea class="form-control" rows="4"></textarea>
							<span>separated with comma (,)</span>
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Add</button>
							<button class="btn btn-warning">Clear</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="col-md-12">
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Factors</th>
								<th class="text-center">Keywords</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Politic</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Politic</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Economy</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Social</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Technology</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Legal</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>Environment</td>
								<td>
									<ul>
										<li>government stability</li>
										<li>corruption level</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
@endsection