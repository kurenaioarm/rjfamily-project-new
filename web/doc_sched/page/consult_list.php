<?php
require('page/webservice_login.php');
$ConsultResult = new WsAppointment();
$ListConsult = $ConsultResult->ConsultList($_SESSION['TOKEN_ENT']);
// print_r($ListConsult);
?>
<div class="content_i">
    <section class="events" id="events-section">
        <div class="content-wrapper">
            <div class="inner-container container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="section-heading">
                            <div class="filter-categories">
                                <ul class="project-filter">
                                    <li class="filter" data-filter="all"><span>Show All</span></li>
                                    <li class="filter" data-filter="<?php echo $_SESSION['STAFF']; ?>"><span>ระบุแพทย์</span></li>
                                    <li class="filter" data-filter="-99"><span>ไม่ระบุแพทย์</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-md-offset-1">
                        <div class="projects-holder">
                            <div class="event-list">
                                <ul>
                                    <?php foreach ($ListConsult->json_data as $key => $value_consult) { ?>
                                        <li class="project-item first-child mix <?php echo $value_consult->DCT ?>">
                                            <ul class="event-item <?php echo $value_consult->DCT ?>">
                                                <li>
                                                    <div class="date">
                                                        <span><?php echo $value_consult->VSTDATE ?><br> <?php echo $value_consult->VSTTIME ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h5><?php echo hn($value_consult->HN) . '<br>' . $value_consult->DSPNAME; ?></h5>
                                                    <div class="start">
                                                        <span>แพทย์ : <?php echo $value_consult->DCTNM; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="time">
                                                        <span>สถานะ : <?php echo $value_consult->OVSTOSTNM ?> <br>
                                                            <form action="?p=app_detail" method="post">
                                                                <input type="hidden" name="caLHN" value="<?php echo hn($value_consult->HN); ?>">
                                                                <input type="hidden" name="caLHNNM" value="<?php echo $value_consult->DSPNAME; ?>">
                                                                <input type="hidden" name="Consultbtn" value="1">
                                                                <button type="submit" class="btn btn-sm btn-dark">Detail</button>
                                                            </form>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <!-- <li class="project-item second-child mix design">
                                        <ul class="event-item design">
                                            <li>
                                                <div class="date">
                                                    <span>24<br>April</span>
                                                </div>
                                            </li>
                                            <li>
                                                <h4>Drink vinegar coloring2</h4>
                                                <div class="design">
                                                    <span>Design Meeting</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="time">
                                                    <span>03:00 PM - 07:00 PM<br>Tuesday</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> -->

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // navigation click actions 
        $('.scroll-link').on('click', function(event) {
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });
        // scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
        // mobile nav toggle
        $('#nav-toggle').on('click', function(event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
</script>