<?php
/**
 * This is the main class for Title Experiemnts
 */

class TitleEx
{
    protected $wpph;
    public function __construct($wpph)
    {
        global $wpdb;
        $this->wpph = $wpph;
    
        if ($this->wpph->check_license()) {
            //Admin CSS
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
        }
        if ($this->get_option("wpex_use_js", false)) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        }
        add_action('admin_menu', array($this, 'add_menu'));
        add_action('wp', array($this, 'do_freeze'));
    }

    // copied from wpex.class.php
    public function get_option($key, $default = null)
    {
        if (function_exists("apcs_exists")) {
            //if apc is around, use that to cache our get_option calls
            if (apc_exists($key)) {
                $return = apc_fetch($key);
                return $return === false ? $default : $return;
            } else {
                $option = get_option($key, $default);
                apc_store($key, $option, 7200); //keep it around for 2h (probably could be persistant - but oh well)
                return $option;
            }
        } else {
            return get_option($key, $default);
        }
    }
    
    public function enqueue()
    {
        wp_enqueue_script('titleex', plugins_url('js/titleexpro.js', __FILE__), array("jquery"), '0.9.7');
        wp_enqueue_script('jquery.cookie.min.js', plugins_url('js/jquery.cookie.js', __FILE__), array("jquery"), "1.4.1");
    }

    public function admin_enqueue()
    {
        wp_enqueue_style('titleex', plugins_url('css/titleex.css', __FILE__));
    }

    // This is called from the WpEx Class
    public function should_run_experiment()
    {
        // Only worry about using the sample size here if we aren't using JS
        $sample_size = $this->get_option("wpex_sample_size", 1);
        if (!$this->get_option("wpex_use_js", false)) {
            if ($sample_size < 1 && (mt_rand(0, 100)/100) > $sample_size) {
                return false;
            }
        }
        // this doesn't mean that it will run neccessary... just that we want to
        // deliever the HTML markup
        return true;
    }

    // This is called from WpEx Class and should return
    // extra arguments that are needed in the js span tag
    // right now, we only need the sample size
    public function extra_js_attrs($title, $id, $ajax, $viewed)
    {
        $sample_size = $this->get_option("wpex_sample_size", 1);
        return "data-wpex-sample-size='$sample_size'";
    }
    
    public function do_freeze()
    {
        global $wpdb, $wpex;
        // looks for posts that haven't been modified since the freeze_after timestamp
        $freeze_after = get_option("wpex_freeze_after", "-1");
        if ($freeze_after != "-1") {
            $last_freeze = get_option("wpex_last_freeze", 0);
            $now = current_time("timestamp");
            if (($now - 60*60) > $last_freeze) {
                update_option("wpex_last_freeze", $now);
                $date = date("Y-m-d H:i:s", strtotime($freeze_after, $now));
                $sql = "select ID, post_date from ".$wpdb->prefix."posts WHERE ID in (select post_id FROM ".$wpex->titles_tbl.") AND post_date < '$date';";
                $posts = $wpdb->get_results($sql, ARRAY_A);
                foreach ($posts as $post) {
                    //find the best title
                    $sql = "SELECT title FROM ".$wpex->titles_tbl." WHERE post_id=".$post['ID']." ORDER BY probability DESC LIMIT 1;";
                    $title = $wpdb->get_row($sql, ARRAY_A, 0);

                    if ($title && isset($title['title']) && strlen($title['title']) && $title['title'] != "__WPEX_MAIN__") {
                        $wpdb->update($wpdb->prefix."posts", array('post_title' => stripslashes($title['title'])), array('ID' => $post['ID']));
                    }

                    // remove the past titles
                    $sql = "DELETE FROM ".$wpex->titles_tbl." WHERE post_id=".$post['ID'].";";
                    $wpdb->query($sql);

                    // remove the stats
                    $sql = "DELETE FROM ".$wpex->stats_tbl." WHERE post_id=".$post['ID'].";";
                    $wpdb->query($sql);
                }
            }
        }
    }

    public function add_menu()
    {
        $menuslug = $this->wpph->slug."-menu";
        if ($this->wpph->check_license()) {
            add_menu_page('Title Experiments', 'Title Experiments', 'edit_posts', $menuslug, array($this, "stats"), 'dashicons-editor-ul');
        } else {
            add_menu_page('Title Experiments', 'Title Experiments', 'edit_posts', $menuslug, array($this, "license_redirect"), 'dashicons-editor-ul');
        }
    }

    public function license_redirect()
    {
        $redirect_to = $this->wpph->pages['license'];
        $this->wpph->flash("A valid license key is required to use this plugin. Please enter your's below.");
        include 'redirect.php';
    }

    public function settings()
    {
        $freeze_after = get_option("wpex_freeze_after", -1);
        $sample_size = get_option("wpex_sample_size", 1);
        include 'titlex-general-settings.php';
    }

    public function save_settings($data)
    {
        if (isset($data['freeze_after'])) {
            update_option("wpex_freeze_after", $_REQUEST['freeze_after']);
        }
        if (isset($data['sample_size'])) {
            update_option("wpex_sample_size", $_REQUEST['sample_size']);
        }
    }
    
    public function stats()
    {
        global $wpdb, $wpex;
        $sql = "select ID, post_title, post_status, (SELECT COUNT(*) FROM ".$wpex->titles_tbl." WHERE post_id=wp.ID) as title_count FROM ".$wpdb->prefix."posts wp WHERE post_status!='inherit' AND ID in (SELECT post_id FROM ".$wpex->titles_tbl." GROUP BY post_id HAVING COUNT(*) > 0);";
        $pages = $wpdb->get_results($sql, ARRAY_A);
        
        if (isset($_GET['id']) && preg_match('/^\d+$/', $_GET['id'])) {
            $id = $_GET['id']; // this is guarenteed to be an int above
            if (isset($_GET['reset-stats'])) {
                $wpdb->query("UPDATE " . $wpex->titles_tbl ." SET clicks=0,impressions=0,stats='' WHERE post_id=".$id);
                $wpdb->delete($wpex->stats_tbl, array("post_id"=>$_GET['id']));
                $this->wpph->flash("Title statistics for the page have been cleared.");
                $redirect_to = admin_url('admin.php?page=title-experiments-pro/title-experiments.php-menu&id='.$id);
                include 'redirect.php';
            } elseif (isset($_GET['clear-titles'])) {
                $wpdb->delete($wpex->titles_tbl, array("post_id"=>$id));
                $wpdb->delete($wpex->stats_tbl, array("post_id"=>$id));
                $this->wpph->flash("Alternate titles for the page have been cleared.");
                $redirect_to = admin_url('admin.php?page=title-experiments-pro/title-experiments.php-menu');
                include 'redirect.php';
            } elseif (isset($_GET['set-title']) && preg_match('/^\d+$/', $_GET['set-title'])) {
                $safe_title_id = $_GET['set-title'];
                //find the best title
                $sql = "SELECT title FROM ".$wpex->titles_tbl." WHERE post_id=".$id." AND id=".$safe_title_id;
                $title = $wpdb->get_row($sql, ARRAY_A, 0);

                if ($title && isset($title['title']) && strlen($title['title']) && $title['title'] != "__WPEX_MAIN__") {
                    $wpdb->update($wpdb->prefix."posts", array('post_title' => stripslashes($title['title'])), array('ID' => $id));
                }

                // remove the past titles
                $sql = "DELETE FROM ".$wpex->titles_tbl." WHERE post_id=".$id.";";
                $wpdb->query($sql);

                // remove the stats
                $sql = "DELETE FROM ".$wpex->stats_tbl." WHERE post_id=".$id.";";
                $wpdb->query($sql);

                $this->wpph->flash("The title has been set for the page.");
                $redirect_to = admin_url('admin.php?page=title-experiments-pro/title-experiments.php-menu');
                include 'redirect.php';
            }

            $sql = "select ID, post_title, post_date FROM ".$wpdb->prefix."posts WHERE ID='".$id."';";
            $page = $wpdb->get_row($sql, ARRAY_A, 0);

            $months = array();
            $post_date = strtotime($page['post_date']);
            $start = mktime(0, 0, 0, date("n", $post_date), 1, date("Y", $post_date));
            $now = current_time("timestamp");
            while (1) {
                array_unshift($months, $start);
                $start = strtotime("+1 month", $start);
                if ($start > $now) {
                    break;
                }
            }

            $sql = "SELECT * FROM ".$wpex->titles_tbl." WHERE post_id='".$id."' ORDER BY id;";
            $_stats = $wpdb->get_results($sql, ARRAY_A);
            $stats = array();
            $titles = array();
            foreach ($_stats as $s) {
                $stats[$s['id']] = $s;
                $titles[] = $s['title'] == '__WPEX_MAIN__' ? $page['post_title'] : $s['title'];
            }

            if (isset($_GET['ts'])) {
                if (isset($_GET['d'])) {
                    if (preg_match('/^\d+$/', $_GET['ts']) && preg_match('/^\d+$/', $_GET['d'])) {
                        $start_ts = $_GET['ts'] + (($_GET['d'] - 1) * 86400);
                    } else {
                        $start_ts = $now;
                    }
                    $end_ts = $start_ts + 86400; //one day later
                } else {
                    $start_ts = preg_match('/^\d+$/', $_GET['ts']) ? $_GET['ts'] : $now;
                    $end_ts = min(strtotime("next month", $start_ts), strtotime("+2 days midnight"));
                }
                $days = array();
                $labels = array();
                for ($d=$start_ts; $d < $end_ts; $d += 86400) {
                    $days[$d] = 0;
                    $labels[] = date("jS", $d);
                }

                $sql = "SELECT * FROM ".$wpex->stats_tbl." WHERE ts>=$start_ts AND ts<$end_ts AND post_id='".$id."' ORDER BY title_id;";
                $detailed_stats = $wpdb->get_results($sql, ARRAY_A);
                $by_test_clicks = array();
                $by_test_views = array();
                $by_test_rates = array();
                foreach ($detailed_stats as $stat_row) {
                    if (!isset($by_test_clicks[$stat_row['title_id']])) {
                        $by_test_clicks[$stat_row['title_id']] = $days;
                        $by_test_views[$stat_row['title_id']] = $days;
                        $by_test_rates[$stat_row['title_id']] = $days;
                    }
                    $by_test_clicks[$stat_row['title_id']][$stat_row['ts']] = $stat_row['clicks'];
                    $by_test_views[$stat_row['title_id']][$stat_row['ts']] = $stat_row['impressions'];
                    $by_test_rates[$stat_row['title_id']][$stat_row['ts']] = $stat_row['impressions'] > 0 ? round(($stat_row['clicks']/$stat_row['impressions'])*100) : "0";
                }
            }

            $colors = array(
                "220,220,220", "151,187,205", "208,16, 64", "5,155,155"
            );
        } else {
            $sql = "SELECT COUNT(*) as c, SUM(clicks) as tv, SUM(impressions) as ti FROM " . $wpex->titles_tbl .", ".$wpdb->prefix."posts wpp WHERE post_id=wpp.ID AND enabled AND wpp.post_status != 'inherit';";
            $res = $wpdb->get_row($sql, ARRAY_A);
            
            $gstats    = array(
                "title_count" => $res['c'],
                "total_impressions" => $res['ti'],
                "total_views" => $res['tv']
            );
        }

        include 'stats.php';
    }
}
