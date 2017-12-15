<script src='<?php echo plugins_url("js/chart.js", __FILE__); ?>'></script>
<div class="wrap">
    <h2>Title Experiments Statistics <small><a href='#' onclick='return wpexproViewAll();'>View All</a></small></h2>
    <?php if (isset($id)) : ?>
        <div>
            <div class="alignleft actions bulkactions" style='width: 100%; margin-bottom: 1.5em; margin-top: 0.5em;'>
                <input id="page" type="hidden" value="<?php echo isset($id) ? $id : ''; ?>">
                <b>Show: </b>
                <select id="date" onchange="wpex_date_change(this)">
                    <option value="-1">All time</option>
                    <?php if (is_array($months)) : ?>
                        <?php foreach ($months as $month) : ?>
                            <option <?php echo(isset($_GET['ts']) && $_GET['ts'] == $month) ? 'selected="selected"' : '' ?> value="<?php echo $month; ?>"><?php echo date("M Y", $month); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php if (isset($_GET['ts'])) : ?>
                    <select id="day" onchange="wpex_day_change(this)">
                        <option value="-1">Select Day</option>
                        <?php for ($day=1; $day<=date("t", $_GET['ts']); $day++) : ?>
                            <option <?php echo(isset($_GET['d']) && $_GET['d'] == $day) ? 'selected="selected"' : '' ?> value="<?php echo $day; ?>"><?php echo $day; ?></option>
                        <?php endfor; ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($stats)): ?>
        <?php if (!$by_test_clicks): ?>
            <?php if (isset($_GET['ts'])): ?>
                <div id="message" class="updated"><p>No data found for selected time period.</p></div>
            <?php endif; ?>
            <table class="wp-list-table widefat fixed posts">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Views</th>
                        <th scope="col">Impressions</th>
                        <th scope="col">Conversion Rate</th>
                        <th scope="col" style="width: 70px;"></th>
                    </tr>
                </thead>
                <tbody id="the-list">
                    <?php $c = 0; ?>
                    <?php foreach ($stats as $stat): ?>
                        <tr class='<?php echo($c++%2 ==0 ? "alternate" : "") ?>'>
                            <td><?php echo $stat['title'] == "__WPEX_MAIN__" ? edit_post_link($page['post_title'], '', '', $page['ID']) : stripslashes($stat['title']); ?></td>
                            <td><?php echo $stat['clicks']; ?></td>
                            <td><?php echo $stat['impressions']; ?></td>
                            <?php if ($stat['impressions'] == 0): ?>
                                <td>0%</td>
                            <?php else: ?>
                                <td><?php echo(round(($stat['clicks']/$stat['impressions'])*1000)/10)."%"; ?></td>
                            <?php endif; ?>
                            <td><a onclick='return confirm("This will clear all other titles and stop the experiment. Are you sure?");' href='/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;set-title=<?php echo $stat['id']; ?>'>[set as title]</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <?php if ($by_test_clicks): ?>
            <?php if (isset($_GET['d'])): ?>
                <h3>Views/Impressions on <?php echo date("M jS Y", $_GET['ts']+(($_GET['d']-1)*86400)); ?></h3>
                <div id="titlex_legend"></div>
                <canvas id="myChart" height="150"></canvas>
                <script type="text/javascript">
                    var ctx = document.getElementById("myChart").getContext("2d");
                    var data = {
                        labels: ['<?php echo join($titles, "','"); ?> '],
                        datasets: [
                            <?php
                            $data = array();
                            foreach ($by_test_views as $id=>$_stats):
                                foreach ($_stats as $value) {
                                    $data[] = $value;
                                    break;
                                }
                            endforeach;
                            $color = $colors[0];
                            ?>
                            {
                                label: "Impressions",
                                fillColor: "rgba(<?php echo $color; ?>,0.2)",
                                strokeColor: "rgba(<?php echo $color; ?>,1)",
                                pointColor: "rgba(<?php echo $color; ?>,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(<?php echo $color; ?>,1)",
                                data: [<?php echo join($data, ","); ?>]
                            },
                            <?php
                            $data = array();
                            foreach ($by_test_clicks as $id=>$_stats):
                                foreach ($_stats as $value) {
                                    $data[] = $value;
                                    break;
                                }
                            endforeach;
                            $color = $colors[1];
                            ?>
                            {
                                label: "Views",
                                fillColor: "rgba(<?php echo $color; ?>,0.2)",
                                strokeColor: "rgba(<?php echo $color; ?>,1)",
                                pointColor: "rgba(<?php echo $color; ?>,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(<?php echo $color; ?>,1)",
                                data: [<?php echo join($data, ","); ?>],

                            },
                        ]
                    };
                    var options = {
                        responsive: true,
                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li data-id=\"<%=i%>\"><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                        multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>",
                    };

                    var myRadarChart = new Chart(ctx).Radar(data, options);
                    jQuery("#titlex_legend").html(myRadarChart.generateLegend());
                </script>
            <?php else: ?>
                <?php if (isset($_GET['imp'])):
                    $title = "Impressions";
                    $_data = $by_test_views;
                    $tmpl = "Impressions: <%= value %>";
                elseif (isset($_GET['rates'])):
                    $_data = $by_test_rates;
                    $title = "View Rates";
                    $tmpl = "<%= value %>%";
                else:
                    $_data = $by_test_clicks;
                    $title = "Views";
                    $tmpl = "Views: <%= value %>";
                endif; ?>
                <h3 style="margin-bottom: 0.5em;">Title <?php echo $title; ?> for <?php echo date("M Y", $_GET['ts']); ?></h3>
                <div id="titlex_legend"></div>
                <canvas id="myChart" height="75"></canvas>
                <ul class='wpexpro-showing'>
                    <li>
                        <?php if (isset($_GET['imp']) || isset($_GET['rates'])) :?>
                            <a href="/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;ts=<?php echo $_GET['ts']; ?>">Show Views</a>
                        <?php else : ?>
                            <span>Show Views</span>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (!isset($_GET['imp'])) :?>
                            <a href="/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;ts=<?php echo $_GET['ts']; ?>&amp;imp=1">Show Impressions</a>
                        <?php else : ?>
                            <span>Show Impressions</span>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (!isset($_GET['rates'])) :?>
                            <a href="/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;ts=<?php echo $_GET['ts']; ?>&amp;rates=1">Show Rates</a>
                        <?php else : ?>
                            <span>Show Rates</span>
                        <?php endif; ?>
                    </li>
                </ul>
                <script type="text/javascript">
                    var ctx = document.getElementById("myChart").getContext("2d");
                    var data = {
                        labels: ['<?php echo join($labels, "','"); ?> '],
                        datasets: [
                            <?php $counter=0;
                            foreach ($_data as $id=>$_stats):
                                $color = $colors[++$counter%count($colors)];
                                $data = array();
                                    foreach ($_stats as $d):
                                        $data[] = $d;
                                    endforeach;?>

                            {
                                label: "<?php echo $stats[$id]['title'] == '__WPEX_MAIN__' ? $page['post_title'] : $stats[$id]['title']; ?>",
                                fillColor: "rgba(<?php echo $color; ?>,0.2)",
                                strokeColor: "rgba(<?php echo $color; ?>,1)",
                                pointColor: "rgba(<?php echo $color; ?>,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(<?php echo $color; ?>,1)",
                                data: [<?php echo join($data, ","); ?>]
                            },
                            <?php endforeach;?>
                        ]
                    };
                    var options = {
                        responsive: true,
                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li data-id=\"<%=i%>\"><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                        multiTooltipTemplate: "<?php echo $tmpl; ?>",
                    };
                    var myLineChart = new Chart(ctx).Line(data, options);
                    var myDatasets = myLineChart.datasets.slice();
                    var myTO = null;
                    jQuery("#titlex_legend").html(myLineChart.generateLegend());
                    jQuery("#titlex_legend li").hover(function(ev) {
                        window.clearTimeout(myTO); myTO = null;
                        var $elm = jQuery(this);
                        var id = $elm.data("id");
                        myLineChart.datasets = [myDatasets[id]];
                        myLineChart.update();
                    }, function() {
                        if(!myTO) {
                            myTO = window.setTimeout(function() {
                                myLineChart.datasets = myDatasets;
                                myLineChart.update();
                                myTO = null;
                            }, 750);
                        }
                    });

                    document.getElementById("myChart").onclick = function(evt){
                        var activePoints = myLineChart.getPointsAtEvent(evt);
                        jQuery("#day").val(activePoints[0].label.replace(/[^\d]/g,'')).trigger("change");
                    };
                </script>
            <?php endif; ?>
        <?php endif; ?>
        <p class="description" style='margin-top: 1em;line-height: 1.75em;'>
            <div style="float: right;">
                <a href='/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;reset-stats=1'>Reset Page Stats</a>&nbsp;&nbsp;<a href='/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&amp;id=<?php echo $_GET['id']; ?>&amp;clear-titles=1'>Delete Alternate Titles</a><br/>
            </div>
            <b>Impressions</b> is the number of times that the title was displayed in post lists, sidebars, search results, etc.<br/>
            <b>Views</b> is the number of times that the post/page was displayed with that title.<br/>
            Views may be higher than impressions if a vistor lands on the post/page directly via a search engine, social media, etc.
        </p>
    <?php else : ?>
        <table class="wpexpro-totals">
            <tr>
                <td>
                    <h1><b data-scroll-to="<?php echo $gstats['title_count'] ?>">0</b> titles</h1>
                </td>
                <td>
                    <h1><b data-scroll-to="<?php echo $gstats['total_impressions'] ?>">0</b> impressions</h1>
                </td>
                <td>
                    <h1><b data-scroll-to="<?php echo $gstats['total_views'] ?>">0</b> views</h1>
                </td>
            </tr>
        </table>
        <h1 style="margin-top: 1em; margin-bottom: 0.5em;">
            Page Overview
            <input
                type="button"
                id="page-search-btn"
                class="button button-primary"
                value="Search"
                style='float: right; margin-left: 5px;' />
            <input
                type='text'
                id="page-search-inp"
                placeholder='Search for pages/posts'
                <?php if ($search) : ?>
                    value='<?php echo $search; ?>'
                <?php endif; ?>
                style='float: right;' />
        </h1>
        <?php if (is_array($pages)) : ?>
            <?php
            if (count($pages) == 0) :
                echo "<h1>No posts found.</h1>";
            endif;
            foreach ($pages as $_page) :
                // First, let's normalize the probabilities because it's been reported that they are over 100% sometimes
                $total_probability = 0;
                $orig_probability = 0;
                foreach ($_page['titles'] as $_title) {
                    $total_probability += intval($_title['probability']);
                    if ($_title['title'] == "__WPEX_MAIN__") {
                        $orig_probability = intval($_title['probability']);
                    }
                }

                $scaleFactor = $total_probability > 0 ? (100/$total_probability) : 1;
                $orig_probability = round($orig_probability*$scaleFactor);
                foreach ($_page['titles'] as $_idx => $_title) {
                    $_page['titles'][$_idx]['probability'] = round(intval($_title['probability'])*$scaleFactor);
                    $_page['titles'][$_idx]['increase'] = $_title['probability'] - $orig_probability;
                } ?>
                <table class="wpexpro-table">
                    <thead>
                        <tr>
                            <th>
                                <h3>
                                    <a style='text-decoration: none;' href='#' onClick="return wpexproEditPage(<?php echo $_page['ID']; ?>);"><span class="dashicons dashicons-edit"></span></a>
                                    <a href='#' onClick="return wpexproPageStats(<?php echo $_page['ID']; ?>);"><?php echo $_page['post_title']; ?></a>
                                </h3>
                            </th>
                            <th>Clicks</th>
                            <th>Impressions</th>
                            <th>Frequency</th>
                            <th>Difference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_page['titles'] as $_title) : ?>
                            <tr>
                                <?php if ($_title['title'] == '__WPEX_MAIN__') : ?>
                                    <td><?php echo $_page['post_title']; ?></td>
                                <?php else : ?>
                                    <td><?php echo $_title['title']; ?></td>
                                <?php endif; ?>
                                <td><?php echo $_title['clicks']; ?></td>
                                <td><?php echo $_title['impressions']; ?></td>
                                <td><?php echo $_title['probability']; ?>%</td>
                                <?php if ($_title['increase'] > 0) : ?>
                                    <td class='titlex-positive'>+<?php echo $_title['increase']; ?>%</td>
                                <?php elseif ($_title['increase'] == 0) : ?>
                                    <td><?php echo $_title['increase']; ?>%</td>
                                <?php else : ?>
                                    <td class='titlex-negative'><?php echo $_title['increase']; ?>%</td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
            <div class="tablenav bottom">
                <div class="tablenav-pages">
                    <span class="pagination-links">
                        <?php if ($curPage > 1) : ?>
                            <a class="prev-page" href="#" onClick="return wpexproPage(<?php echo $curPage - 1; ?>, '<?php echo $search; ?>');">
                                <span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span>
                            </a>
                        <?php else : ?>
                            <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                        <?php endif; ?>
                        <span id="table-paging" class="paging-input"><?php echo $curPage; ?> of <span class="total-pages"><?php echo $totalPages; ?></span></span>
                        <?php if ($curPage < $totalPages) : ?>
                            <a class="next-page" href="#" onClick="return wpexproPage(<?php echo $curPage + 1; ?>, '<?php echo $search; ?>');">
                                <span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span>
                            </a>
                        <?php else : ?>
                            <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    var wpex_install_root = window.location.href.replace(/^(.*)\/wp-admin\/.*$/, '$1');
    jQuery(document).ready(function() {
        jQuery("input#page-search-btn").click(function() {
            var q = jQuery.trim(jQuery("#page-search-inp").val());
            window.location = wpex_install_root +
                "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&search=" +
                escape(q);
        });
        jQuery("input#page-search-inp").keyup(function(ev) {
            if(ev.keyCode == 13) {
                jQuery("input#page-search-btn").click();
            }
        });
        jQuery("a[href^='/wp-admin/']").each(function() {
            var href = jQuery(this).attr("href");
            jQuery(this).attr("href", wpex_install_root + href);
        });
        jQuery("[data-scroll-to]").each(function() {
            var $this = jQuery(this);
            var to = $this.data("scroll-to");
            window.setTimeout(function() {
                var interval = window.setInterval(function() {
                    var cur = parseInt($this.text(), 10);
                    cur += Math.ceil(to/15);
                    cur = Math.min(cur,to);
                    $this.text(cur);
                    if(cur == to) {
                        window.clearInterval(interval);
                        $this.removeClass("scrolling");
                    }
                }, 100);
            }, 500);
        });
    });
    function wpex_page_change(elm) {
        var id = jQuery(elm).val();
        if(id != -1) {
            window.location = wpex_install_root + "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&id=" + id;
        }
    }

    function wpex_date_change(elm) {
        var id = jQuery("#page").val();
        var ts = jQuery("#date").val();
        if(id != -1 && ts != -1) {
            window.location = wpex_install_root + "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&id=" + id + "&ts=" + ts;
        }else if(id != -1) {
            window.location = wpex_install_root + "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&id=" + id;
        }
    }
    function wpex_day_change(elm) {
        var id = jQuery("#page").val();
        var ts = jQuery("#date").val();
        var d = jQuery("#day").val();
        if(id != -1 && ts != -1 && d != -1) {
            window.location = wpex_install_root + "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&id=" + id + "&ts=" + ts + "&d=" + d;
        }else if(id != -1 && ts != -1) {
            window.location = wpex_install_root + "/wp-admin/admin.php?page=title-experiments-pro/title-experiments.php-menu&id=" + id + "&ts=" + ts;
        }
    }
</script>
