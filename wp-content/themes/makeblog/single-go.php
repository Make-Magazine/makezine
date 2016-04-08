<?php
/**
 * Single Go Page Template
 *
 * Basically, just turn this into a redirect engine.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */

header ('HTTP/1.1 301 Moved Permanently');
header ('Location: ' . make_generate_redirect_url( get_the_ID() ) );