<?php
	if(isset($_POST['veri']))
	{
		$veri = base64_decode($_POST['veri']);
		file_put_contents('sonuc.xml', $veri);
		exit();
	}

	$host = "localhost";
	$port = 44444;
	$veri = base64_encode(file_get_contents('imza.xml'));
	// $data1 = base64_decode($_POST['binary']);
	$rapor = 'false';
	$seriimza = 'false';
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#submit').click(function() {
				$.ajax({
					type: "POST",
					url: 'http://<?php echo $host; ?>:<?php echo $port; ?>',
					data: '<?php echo $veri; ?>,<?php echo $rapor; ?>,<?php echo $seriimza; ?>',
					success: function(cevap) {
						if(cevap != 'false')
						{
							$.ajax({
								type: "POST",
								url: 'index.php',
								data: {veri:cevap},
								success: function(cevap) {
									console.log("başarılı...");
								}
							});
						}
						else console.log("hata oluştu !");
					}
				});
			});
		});
	</script>

</head>

<body>
	<button id="submit">Test</button>
</body>

</html>