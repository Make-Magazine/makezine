<?php 

add_filter( 'the_content', 'make_featured_maker', 4 );

function make_featured_maker($content) {

	global $post;

	$featured_maker_id = get_post_meta( $post->ID, 'FeauturedID', true );

	if ( empty( $featured_maker_id ) )
		return $content;

	$exhibits = $featured_maker_id;

	$url = 'http://makezine.com/cs/blank/json/e/'.$exhibits;

	$contents = wpcom_vip_file_get_contents( $url );

	if ( empty( $contents ) || is_wp_error( $contents ) )
		return $content;

	$json_output = json_decode($contents);

	$make = $json_output;

	$exhibits = $make->exhibits;

		foreach ($exhibits as $exhibit) {

			$content .= '<div class="maker">
						<h3>Maker Faire Project Profile</h3>
							<div class="row">
								<div class="col-md-2">';

					if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
						$content .= '<img src="'.wpcom_vip_get_resized_remote_image_url( esc_url_raw( $make->exhibits[0]->photo ), 130, 130 ) . '" class="thumbnail profile" alt="'. esc_attr( $make->exhibits[0]->Name ).'" />';
					} else {
						$content .= '<img src="http://faire.smrtdsgn.com/timthumb/thumb.php?src='.urlencode( esc_url_raw( $make->exhibits[0]->photo ) ).'&amp;h=130&amp;w=130&amp;zc=1" class="thumbnail profile" style="max-width:150px;" />';
					}

					$content .= '</div>';	
					
					$content .= '<div class="col-md-5" style="width:438px;">';

						$content .= '<h4><a class="noborder" href="' . esc_url( 'http://makerfaire.com/pub/e/'.$make->exhibits[0]->cs_rid ) .'">'.esc_html( $make->exhibits[0]->Name ).'</a></h4>';

						$more = ' <a class="" href="' . esc_url( 'http://makezine.com/pub/e/'.$make->exhibits[0]->cs_rid ) .'">Read more &rarr;</a>';

						$content .= '<p>'.wp_trim_words( esc_html($make->exhibits[0]->descfull_u), 100, $more ).'</p>';

						$dude = $make->exhibits[0]->p[0];

						if (isset($dude->url)) {

							$content .= '<ul class="inline">';

								$content .= '<li class=""><a class="btn btn-mini" target="_blank" href="'.esc_url($make->exhibits[0]->url).'">Project Website</a></li>';

								$request_url = $make->exhibits[0]->video;

								$mystring = $request_url;
								$findme = 'youtu';
								$pos = strpos($mystring, $findme);

								if (!empty($make->exhibits[0]->video) && ($pos !== false)) {

									$content .= '<li class=""><a href="#video" role="button" class="btn btn-mini" data-toggle="modal">Video</a>';
									//$content .= '<li class=""><a data-controls-modal="my-modal" class="noborder" href="#modal">Video</a></li>';
									$content .= '<div class="modal" id="video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
      															<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																				<h3>'.esc_html( $make->exhibits[0]->Name ).'</h3>
																			</div>
																			<div class="modal-body">
																			<div>
																		</div>
																	</div>';
			
											if ((!empty($request_url)) && ($pos !== false)) {

												$feedURL = 'http://www.youtube.com/oembed?url='. urlencode(esc_url_raw($request_url)) .'&amp;format=xml';

												$contents = wpcom_vip_file_get_contents( $feedURL );

												if ( empty( $contents ) || is_wp_error( $contents ) )
													continue;

												$sxml = new SimpleXMLElement($contents) or die("feed not loading");
												$content .= '<div class="thumbnail">';
												$content .= $sxml->html[0];
												$content .= '</div>';
											}
											$content .= '</div>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
												<button class="btn btn-primary">Save changes</button>
											</div>
										</div>';


								}

								else {
									$content .= '<li class=""><a href="'.$make->exhibits[0]->video.'" target="_blank" role="button" class="btn btn-mini">Video</a>';
								}

								$content .= '<li class=""><a class="btn btn-mini" target="_blank"  href="' . esc_url( 'http://makerfaire.com/pub/e/' . $make->exhibits[0]->cs_rid ) . '">Maker Faire Page</a></ul>';

							$content .= '</ul>';
							
						}

					$content .= '</div>
						</div>
					</div>';
		}

	return $content;
}