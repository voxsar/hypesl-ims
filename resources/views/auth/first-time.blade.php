<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to Hype</title>
	<link href="{{asset('css/sequence-theme.starter-basic.css')}}" rel="stylesheet" media="all">

	<style>
		body {
			margin: 0;
			padding: 0;
		}
	</style>
	<!--[if lt IE 9]>
		<script src="scripts/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<div id="sequence" class="seq">

		<div class="seq-screen">
			<ul class="seq-canvas">

				<li class="seq-step1 seq-in" id="step1">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Hey, {{Auth::user()->name}}</h2>
					</div>
				</li>

				<li class="seq-step2" id="step2">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Sup Bitches!</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Welcome to</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Hype Sri Lanka's</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Internal Management System</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Yeah....</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">I don't know why</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">they could'nt come up with a better name either</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">But you!, {{Auth::user()->name}}</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">You and I we're special</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">You can call me Boyle</h2>
					</div>
				</li>

				<li class="seq-step3" id="step3">
					<div class="seq-content">
						<h2 data-seq class="seq-title">Oh now I get it, 'internal'</h2>
					</div>
				</li>

			</ul>
		</div>
	</div>

	<script src="{{asset('scripts/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('scripts/hammer.min.js')}}"></script>
	<script src="{{asset('scripts/sequence.min.js')}}"></script>
	<script src="{{asset('scripts/sequence-theme.starter-basic.js')}}"></script>
</body>
</html>
