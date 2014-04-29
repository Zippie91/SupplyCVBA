<script>
	function calcRows() {
		var total = 0;
		// Calculate row totals
		<?php $rows = 0; ?>
		<?php do { ?>
		var val = 0;
		<?php $cols = 0; ?>
		<?php do { ?>
		val += parseInt($('#<?php echo ($rows + 1) ?>_<?php echo ($cols + 1) ?>').val());
		<?php $cols++; ?>
		<?php } while($cols < $i); ?>
		total += val;
		$('#rowtotal-<?php echo ($rows + 1) ?>').text( val );
		<?php $rows++; ?>
		<?php } while ($rows < $row); ?>
		
		//Calculate column totals
		<?php $cols = 0; ?>
		<?php do { ?>
		var val = 0;
		<?php $rows = 0; ?>
		<?php do { ?>
		val += parseInt($('#<?php echo ($rows + 1) ?>_<?php echo ($cols + 1) ?>').val());
		<?php $rows++; ?>
		<?php } while($rows < $row); ?>
		$('#coltotal-<?php echo ($cols + 1) ?>').text( val );
		<?php $cols++; ?>
		<?php } while($cols < $i); ?>
		
		//Calculate set total
		$('#settotal').text( total );
		
		<?php if(isset($j)) { ?>
		var total = 0;
		//Calculate row totals for bestelling2
		<?php $rows = 0; ?>
		<?php do { ?>
		var val = 0;
		<?php $cols = 0; ?>
		<?php do { ?>
		val += parseInt($('#<?php echo ($row + $rows + 1) ?>_<?php echo ($cols + 1) ?>').val());
		<?php $cols++; ?>
		<?php } while($cols < $j); ?>
		total += val;
		$('#b2-rowtotal-<?php echo ($row + $rows + 1) ?>').text( val );
		<?php $rows++; ?>
		<?php } while ($rows < $row2); ?>
		
		//Calculate column totals for bestelling2
		<?php $cols = 0; ?>
		<?php do { ?>
		var val = 0;
		<?php $rows = 0; ?>
		<?php do { ?>
		val += parseInt($('#<?php echo ($row + $rows + 1) ?>_<?php echo ($cols + 1) ?>').val());
		<?php $rows++; ?>
		<?php } while($rows < $row2); ?>
		$('#b2-coltotal-<?php echo ($cols + 1) ?>').text( val );
		<?php $cols++; ?>
		<?php } while($cols < $j); ?>
		
		//Calculate set total for bestelling2
		$('#b2-settotal').text( total );
		<?php } ?>
	}
</script>