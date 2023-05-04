<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

	{{-- Title --}}
    <title>
        @yield('title', 'Imprimir')
    </title>

    @stack('css')
    @yield('css')

	<style type="text/css">
		@page {
		  size: A4;
		  margin: 0;
		}
		@media print {
		  body {
		  	margin: 0 auto;
		    width: 210mm;
		    height: 297mm;
		  }
		  .main-page {
		    margin: 0;
		    border: initial;
		    border-radius: initial;
		    width: initial;
		    min-height: initial;
		    box-shadow: initial;
		    background: initial;
		    page-break-after: always;
		  }
		  .invoice:not(:last-child) {
			border-bottom: 0!important;
		  }
		  .no-print {
			display: none!important;
		  }
		}

		.page-break-after-always {
			page-break-after: always!important;
		}

	</style>

	<style type="text/css">
	body{
		font-family: Arial;
	}
	.fs-10-pt {
		font-size: 10pt;
	}
	.fs-12-pt {
		font-size: 12pt;
	}
	.fs-13-pt {
		font-size: 13pt;
	}
	.fs-14-pt {
		font-size: 14pt;
	}
	.fs-16-pt {
		font-size: 16pt;
	}
	.fs-20-pt {
		font-size: 20pt;
	}
	.fw-700 {
		font-weight: 700;
	}
	.invoice {
		/*height: 92.25mm!important;*/
		height: 184.5mm!important;
	}
	.invoice:not(:last-child) {
		border-bottom: 1px solid darkgray;
	}
</style>
</head>
<body>

	<div class="no-print">
		@isset ($receipt)
			<button onclick="printBoth()">Imprimir ambas en A4</button>
			<button onclick="printEach()">Imprimir ambas por separado</button>
		@else
			<button onclick="printBoth()">Imprimir dos por hoja (en A4)</button>
			<button onclick="printEach()">Imprimir cada una por separado</button>
		@endisset
	</div>

	@yield('body')

<script type="text/javascript">

	function printBoth() {
		var divs = document.querySelectorAll('.invoice');
		for (var i = 0; i < divs.length; i++) {
		    divs[i].classList.remove('page-break-after-always');
		}
		window.print()
	}

	function printEach() {
		var divs = document.querySelectorAll('.invoice');
		for (var i = 0; i < divs.length; i++) {
		    divs[i].classList.add('page-break-after-always');
		}
		window.print()
	}

</script>
</body>
</html>
