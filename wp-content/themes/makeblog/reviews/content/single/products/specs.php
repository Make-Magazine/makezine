<?php
$specs = get_field( 'specs' );

$machine_name = get_field( 'name_of_the_machine' );
$manufacturer_url = get_field( 'manufacturer_url' );

if ( ! empty( $specs ) ):
$row_count = count($specs);
$i = 0;
?>



<table id="specs" align="left">
	<thead>
		<tr class="table-title">
			<td>
				Specs
			</td>
		</tr>
		<?php
		if( ! empty( $machine_name ) || ! empty( $manufacturer_url ) ) {
		?>
			<tr>
				<th itemprop="name" class="product">
					<?php echo get_field( 'name_of_the_machine' );?>
				</th>
				<th>
					<a target="_blank" href="<?php echo get_field( 'manufacturer_url' );?>"><?php echo get_field( 'manufacturer' );?></a>
				</th>
			</tr>
		<?php
		}
		?>
		
	</thead>
	<tbody>
		<?php
			foreach ( (array) $specs as $spec ):
				$i++;
				if( $i === $row_count ){
					$row_name = 'last-row';
				}else if( $i === 1 ){
					$row_name = 'first-row';
				}else{
					$row_name = 'sdgsdg';
				}
				printf( '<tr class="'.$row_name.'"><td class="title">%s:</td><td>%s</td></tr>', esc_html( $spec['label'] ), esc_html( $spec['description'] ) );
			endforeach;
		?>
	</tbody>
</table>
	
<?php endif; ?>
	
	
	
	
	