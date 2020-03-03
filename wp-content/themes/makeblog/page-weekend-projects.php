<?php
/**
 * Template Name: Weekend Projects
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header('universal'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="col-xs-12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="col-sm-7 col-md-8">
				
					<article <?php post_class(); ?>>

						<div class="banner">

							<img src="http://cdn.makezine.com/make/facebook/weekend_project/MakeProjectsRSLanding1.png" alt="Weekend Projects" />

						</div>

						<h2 id="Section_Check_out_the_past_weekend_projects">Latest Projects</h2>

						<div class="guideList">

							<div class="column">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/10-rail-model-rocket-mega-launcher/">
											<img src="https://makezine.com/wp-content/uploads/make-images/eylPZPA32KXeFikR.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/10-rail-model-rocket-mega-launcher/">10-Rail Model Rocket Mega-Launcher</a></p>
									<p class="blurbBlurb">Make the cub scout rocket derby a blast.</p>
								</div><!--10 Rail Rocket Launcher-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/bottle-radio/">
											<img src="https://makezine.com/wp-content/uploads/make-images/IH43iswYQZNRMPWU.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/bottle-radio/">Bottle Radio</a></p>
									<p class="blurbBlurb">Explore the airwaves with this batteryless AM radio receiver.</p>
								</div><!--Bottle Radio-->
						        
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/game-show-buttons/">
											<img src="https://makezine.com/wp-content/uploads/make-images/vE5XNVvmEBnUAE2f.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/game-show-buttons/">Game Show Buttons</a></p>
									<p class="blurbBlurb">Get some trusty 555 timer ICs, and you can create a pair of game show buttons.</p>

								</div><!--Game Show Buttons-->
						        <div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/hotcold-leds/">
											<img src="https://makezine.com/wp-content/uploads/make-images/MCjiWaqjfHqqWF4X.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/hotcold-leds/">Hot/Cold LEDs</a></p>
									<p class="blurbBlurb">Explore three "hot/cold" projects with one circuit.</p>

								</div><!--Hot/Cold LEDs-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/little-big-lamp/">
											<img src="https://makezine.com/wp-content/uploads/make-images/uxdUGulRXXjcIBGv.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/little-big-lamp/">Little Big Lamp</a></p>
									<p class="blurbBlurb">Build a bright, energy-efficient lamp with LEDs and PVC.</p>
										
								</div><!--Little Big Lamp-->

							
						    		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/optical-tremolo-box/">
											<img src="https://makezine.com/wp-content/uploads/make-images/gPPW1HVe1FZNRPSG.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/optical-tremolo-box/">Optical Tremolo Box</a></p>
									<p class="blurbBlurb">Build a light-programmable effects box for your guitar.</p>

								</div><!--Optical Tremolo Box-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/projects-in-motion-control-three-types-of-motors-with-555-timers">
											<img src="https://makezine.com/wp-content/uploads/make-images/Nqqth6tOYwgTRApT.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/projects-in-motion-control-three-types-of-motors-with-555-timers">Projects in Motion</a></p>
									<p class="blurbBlurb">Using the humble 555 timer chip you can control three different types of motors.</p>
										
								</div><!--Project In Motion-->

							
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/repeat-after-me-a-mintronics-memory-game/">
											<img src="https://makezine.com/wp-content/uploads/make-images/KeXBEDVlV3lGPffR.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/repeat-after-me-a-mintronics-memory-game/">Repeat After Me</a></p>
									<p class="blurbBlurb">Turn a MAKE MintDuino and Mintronics Survival Pack into a fun memory game.</p>

								</div><!--Repeat After Me: A Mintronics Memory Game-->

						    	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/solar-joule-bracelet/">
											<img src="https://makezine.com/wp-content/uploads/make-images/hWWZjP5uA1TPxrDm.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/solar-joule-bracelet/">Solar Joule Bracelet</a></p>
									<p class="blurbBlurb">Wearable fashion technology that glows!</p>

								</div><!--Solar Joule Bracelet-->
						    
							<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/talking-booby-trap/">
											<img src="https://makezine.com/wp-content/uploads/make-images/3jHpiQwdwXP4Y14p.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/talking-booby-trap/">Talking Booby Trap</a></p>
									<p class="blurbBlurb">Stop snoops with this sneaky gizmo!</p>
								</div><!--Talking Booby Trap-->

							</div>
							
							<div class="columnLast">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/beam-solar-chariots/">
											<img src="https://makezine.com/wp-content/uploads/make-images/JiK6cRUqbpqkqMIE.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/beam-solar-chariots/">BEAM Solar Chariots</a></p>
									<p class="blurbBlurb">Build a fun solar-powered roller or symet BEAM bot.</p>
									
								</div><!--BEAM Solar Chariots-->
						        
						        <div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/covert-listening-book-2/">
											<img src="https://makezine.com/wp-content/uploads/make-images/cqW2OWQFeUGhZagW.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/covert-listening-book-2/">Covert Listening Book</a></p>
									<p class="blurbBlurb">Make a wireless "bug" and hide it inside a hollowed-out book.</p>

								</div><!--Covert Listening Book-->
						            
						        	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/extreme-led-throwies/">
											<img src="https://makezine.com/wp-content/uploads/make-images/Ea1cO1HAUFmYHghF.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/extreme-led-throwies/">Extreme LED Throwies</a></p>
									<p class="blurbBlurb">Learn about and build simple glowing circuits!</p>
								</div><!--Extreme LED Throwies-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/infrared-string-bass/">
											<img src="https://makezine.com/wp-content/uploads/make-images/itWIyE2KhZfvBdkC.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/infrared-string-bass/">Infrared String Bass</a></p>
									<p class="blurbBlurb">Build an optical guitar using the LM386 amp.</p>
								</div><!--Infrared String Bass-->
						        
						        
						        		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/mini-rover-redux/">
											<img src="https://makezine.com/wp-content/uploads/make-images/GqKmam4KtLRqfT5r.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/mini-rover-redux/">Mini Rover Redux</a></p>
									<p class="blurbBlurb">Mod a remote-controlled toy and see what it sees.</p>
								</div><!--Mini Rover Redux-->
						        

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/monkey-couch-guardian/">
											<img src="https://makezine.com/wp-content/uploads/make-images/11CM4gQFKRymK3ah.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/monkey-couch-guardian/">Monkey Couch Guardian</a></p>
									<p class="blurbBlurb">Make an obnoxious device to discourage animals from jumping on beds and couches.</p>
								</div><!--Monkey Couch Guardian-->
						        
						        		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/monobox-powered-speaker/">
											<img src="https://makezine.com/wp-content/uploads/make-images/fVQxlqNTOvTVKtu3.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/monobox-powered-speaker/">MonoBox Powered Speaker</a></p>
									<p class="blurbBlurb">Build a powered speaker and amplify your portable music player.</p>

								</div><!--Mono Box Powered Speaker-->
						        
						        	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/pir-sensor-arduino-alarm/">
											<img src="https://makezine.com/wp-content/uploads/make-images/iSOGQVmBVaSCIygQ.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/pir-sensor-arduino-alarm/">PIR Sensor Arduino Alarm</a></p>
									<p class="blurbBlurb">Build a basic alarm buzzer using a PIR sensor and an Arduino.</p>

								</div><!--PIR Sensor Arduino Alarm-->
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/sun-logger/">
											<img src="https://makezine.com/wp-content/uploads/make-images/YIRAt1ETqxxARgNS.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/sun-logger/">Sun Logger</a></p>
									<p class="blurbBlurb">Build a data logger to gather information about sunlight.</p>
								</div><!--Sun Logger-->  
						        
						        
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/a-touchless-3d-tracking-interface/">
											<img src="https://makezine.com/wp-content/uploads/make-images/LNr1tjTZTTvni2pj.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/a-touchless-3d-tracking-interface/">A Touchless 3D Tracking Interface</a></p>
									<p class="blurbBlurb">Create a touchless 3D tracking interface with Arduino.</p>

								</div><!--A Touchless 3D Tracking Interface-->

							</div>
							
							<div class="clearer"></div>

						</div>


						<h2 id="Section_Check_out_the_past_weekend_projects">Check out all of the weekend projects</h2>

						<div class="guideList">

							<div class="column">
							
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/add-volume-jack/">
											<img src="https://makezine.com/wp-content/uploads/make-images/sWI1o1IkMWmLejfp.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/add-volume-jack/">Add Volume, Jack</a></p>
									<p class="blurbBlurb">Plug in and turn up any sound-making battery toy.</p>
									
								</div><!--Add Volume, Jack-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/alarm-bag/">
											<img src="https://makezine.com/wp-content/uploads/make-images/mbTsspJNM2AKFH3B.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/alarm-bag/">Alarm Bag</a></p>
									<p class="blurbBlurb">Add an anti-theft alarm to your messenger bag!</p>
									
								</div><!--Alarm Bag-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/aircraft-band-receiver/">
											<img src="https://makezine.com/wp-content/uploads/make-images/kHAfSuvIMxxjMond.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/aircraft-band-receiver/">Aircraft Band Receiver</a></p>
									<p class="blurbBlurb">Modify an ordinary AM/FM radio to eavesdrop on air traffic control.</p>
										
									</div><!--Aircraft Band Receiver-->
									
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/floating-glow-display/">
											<img src="https://makezine.com/wp-content/uploads/make-images/YUsQEdDM3pRQoUui.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a style="word-spacing:-2px;" href="https://makezine.com/projects/floating-glow-display/">Floating Glow Display</a></p>
									<p class="blurbBlurb">Glowing sign uses an LED and internal reflection for a fascinating visual effect.</p>
										
								</div><!--Floating Glow Display-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href=" https://makezine.com/projects/light-theremin/">
											<img src="https://makezine.com/wp-content/uploads/make-images/ufIy5xsGjFveYJiL.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href=" https://makezine.com/projects/light-theremin/">Light Theremin</a></p>
									<p class="blurbBlurb">Use the ever-popular 555 timer chip to create an instrument of the retro-future!</p>
									
								</div><!--Light Theremin-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/the-luna-mod-looper/">
											<img src="https://makezine.com/wp-content/uploads/make-images/EFqhQZP5Y1OwGRTw.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/the-luna-mod-looper/ ">The Luna Mod Looper</a></p>
									<p class="blurbBlurb">A simple handheld synth and looper box that generates intriguing sonic rhythms.</p>
									
								</div><!--Luna Mod Looper-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/make-23/mystery-electronic-switches-2/">
											<img src="https://makezine.com/wp-content/uploads/make-images/ViPhGR2Ewrc1RTcJ.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/make-23/mystery-electronic-switches-2/">Mystery Electronic Switches</a></p>
									<p class="blurbBlurb">This prank gadget frustrates people, but only you know...</p>
									
								</div><!--Mystery Electronic Switches -->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/simple-laser-communicator/">
											<img src="https://makezine.com/wp-content/uploads/make-images/ewn1TNGXX6WFQeUy.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/simple-laser-communicator/">Simple Laser Communicator</a></p>
									<p class="blurbBlurb">Talk in secret over your own private laser beam link.</p>
									
								</div><!--Simple Laser Communicator -->
								
							</div>
							
							<div class="columnLast">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/Project/solar-tv-remote/">
											<img src="https://makezine.com/wp-content/uploads/make-images/aNxnuvWNVFOnSGke.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/Project/solar-tv-remote/">Solar TV Remote</a></p>
									<p class="blurbBlurb">Juice your flipper with sunlight.</p>
									
								</div><!--Solar TV Remote-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/solar-usb-charger">
											<img src="https://makezine.com/wp-content/uploads/make-images/hqAmaWobYLXmrSrk.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/solar-usb-charger/">Solar USB Charger</a></p>
									<p class="blurbBlurb">A simple-to-make charger that safely recharges many USB devices using solar power.</p>
									
								</div><!--Solar USB Charger-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/treasure-finder/">
											<img src="https://makezine.com/wp-content/uploads/make-images/A5eJBRZ6aFhcLlWu.jpg" alt="treasure Finder" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/treasure-finder/">Treasure Finder</a></p>
									<p class="blurbBlurb">Build a metal detector for a fraction of the cost.</p>
									
								</div><!--Treasure Finder-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/usb-webcam-microscope/">
											<img src="https://makezine.com/wp-content/uploads/make-images/rv3pBY21Hb3AJVOF.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/usb-webcam-microscope/">USB Webcam Microscope</a></p>
									<p class="blurbBlurb">Convert a webcam into a fun USB microscope.</p>
									
								</div><!--USB Webcam Microscope-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/wearable-light-organ/">
											<img src="https://makezine.com/wp-content/uploads/make-images/hIEpEOliFpbfJaIy.jpg" alt="Wearable Light Organ" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/wearable-light-organ/">Wearable Light Organ</a></p>
									<p class="blurbBlurb">Turn a few common components into a wearable dance floor light show!</p>
									
								</div><!--Wearable Light Organ-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/whack-a-mole-game/">
											<img src="https://makezine.com/wp-content/uploads/make-images/OlU3itB2CKUqMUDa.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/whack-a-mole-game/">Whack-a-Mole Game</a></p>
									<p class="blurbBlurb">555 timer chips create a mini version of the "Whack-a-Mole" arcade game.</p>
									
								</div><!--Whack-a-Mole Game-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="https://makezine.com/projects/555-timer-ball-whacker/">
											<img src="https://makezine.com/wp-content/uploads/make-images/1FH6EIMFyik3ZgTM.jpg" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="https://makezine.com/projects/555-timer-ball-whacker/">555 Timer Ball Whacker</a></p>
									<p class="blurbBlurb">A wooden arm swats at objects when they draw near.</p>
								</div><!--555 Timer Ball Whacker-->
								
							</div>
							
							<div class="clearer"></div>

						<div class="clearer"></div>
							
						</div>

						
					
					</article>
					
					<?php endwhile; ?>

					<div class="comments">
						<?php comments_template(); ?>
					</div>
					<!--<div id="contextly"></div>-->
					
					<?php endif; ?>
				</div>
				
				<?php get_sidebar(); ?>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>