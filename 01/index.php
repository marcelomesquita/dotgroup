<!DOCTYPE html>
<html lang="pt_BR">
<?php
function blah($i)
{
	if ($i % 3 == 0 && $i %5 == 0) {
		return 'FIZZBUZZ';
	} elseif ($i % 5 == 0) {
		return 'BUZZ';
	} elseif ($i % 3 == 0) {
		return 'FIZZ';
	}

	return $i;
}
?>
<head>
	<meta charset="UTF-8">
	<title>01</title>
</head>

<body>
	<table>
		<?php for ($i = 0; $i < 100; $i += 10) : ?>
			<tr>
				<?php for ($j = 1; $j <= 10; $j += 1) : ?>
					<td style="text-align:center; border: 1px solid #000;"><?php echo blah($i + $j); ?></td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
</body>
</html>
