<?php

class scheduletraining_register_widget_paloit extends WP_Widget {

    function __construct()
    {
        parent::__construct('scheduletraining_register_widget_paloit', __('Schedule Register for Training Palo-IT', 'scheduletraining_register_widget_paloit_domain'), array( 'description' => __( 'Schedule Register Widget for Palo-IT', 'scheduletraining_register_widget_paloit_domain' ), ));
    }

    public function widget( $args, $instance ) {
      global $wpdb;

      if(isset($_GET['id']))
      {
        $training = $wpdb->get_results("SELECT * FROM new2015_schedule_training WHERE id=".$_GET['id']);
        $start = stripslashes($training[0]->timestamp_event_start);
        $end = stripslashes($training[0]->timestamp_event_end);
        ?>
        <div>
          <div class="ST_icon_box_register_training"><?php echo stripslashes($training[0]->icon_area); ?></div>
          <div class="ST_main_page_register">
            <div class="ST_area_left">
              <div class="ST_area_left_box">
                <p class="ST_area_left_box_title">Training Info</p>
                <div class="ST_light_color ST_padding_left_20">
                  <table style="border:0px; margin:0px;">
                    <tbody>
                      <tr>
                        <td style="width:140px; border:0px;"><span style="font-weight:bold;">Category :</span></td>
                        <td style="border:0px;"><?php echo $training[0]->category; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
                <div class="ST_padding_left_20">
                  <table style="border:0px; margin:0px;">
                    <tbody>
                      <tr>
                        <td style="width:140px; border:0px;"><span style="font-weight:bold;">Pricing :</span></td>
                        <td style="border:0px;"><?php echo $training[0]->pricing; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="ST_light_color ST_padding_left_20">
                  <table style="border:0px; margin:0px;">
                    <tbody>
                      <tr>
                        <td style="width:140px; border:0px;"><span style="font-weight:bold;">Date :</span></td>
                        <td style="border:0px;"><?php
                              echo date('F', $start)." ".date('j', $start).date('S', $start);
                              if (date('j', $start) != date('j', $end))
                                echo " - ";
                              if(date('F', $end) != date('F', $start))
                                echo date('F', $end)." ";
                              if (date('j', $start) != date('j', $end))
                                echo date('j', $end).date('S', $end); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="ST_padding_left_20">
                  <table style="border:0px; margin:0px;">
                    <tbody>
                      <tr>
                        <td style="width:140px; border:0px;"><span style="font-weight:bold;">Time :</span></td>
                        <td style="border:0px;"><?php echo $training[0]->time_event; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="ST_light_color ST_padding_left_20">
                  <table style="border:0px; margin:0px;">
                    <tbody>
                      <tr>
                        <td style="width:140px; border:0px;"><span style="font-weight:bold;">Lunch :</span></td>
                        <td style=" border:0px;"><?php echo $training[0]->lunch; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="ST_icon_list">
                  <div style="width: 33%; line-height: initial;" class="ST_icon_why_us"><img src="http://sg.palo-it.com/wp-content/uploads/sites/6/2016/08/repeat.png" style="width:90px;"/><br/>Free Repeat<br/>Session</div>
                  <div style="width: 33%; line-height: initial;" class="ST_icon_why_us"><img src="http://sg.palo-it.com/wp-content/uploads/sites/6/2016/08/time.png" style="width:80px;"/><br/>1 hour<br/>Coaching</div>
                  <div style="width: 34%; line-height: initial;" class="ST_icon_why_us"><img src="http://sg.palo-it.com/wp-content/uploads/sites/6/2016/09/10off-150x94.png" style="width:62px;"/><br/>Regular Customer:<br/>10% off</div>
                </div>
                <div class="ST_why_US_box"><p class="ST_why_US">Why Us ?</p></div>
              </div>
              <div class="ST_area_left_training_profile">
                <p class="ST_area_left_box_title">Instructor’s Profile</p>
                <?php echo stripslashes($training[0]->trainersprofile); ?>
              </div>
            </div>
            <div class="ST_area_center"></div>
            <div class="ST_area_right">
              <p class="ST_register_widget_title"><?php echo $training[0]->name; ?></p>

              <?php echo stripslashes($training[0]->readmore); ?>
            </div>
          </div>
        </div>
          <div class="ST_register_widget_date_center">
            <?php
            echo date('F', $start)." ".date('j', $start).date('S', $start);
            if (date('j', $start) != date('j', $end))
              echo " - ";
            if(date('F', $end) != date('F', $start))
              echo date('F', $end)." ";
            if (date('j', $start) != date('j', $end))
              echo date('j', $end).date('S', $end); ?>
            <a href="<?php echo $training[0]->link_register; ?>"><br><br><div class="ST_register_widget_button">REGISTER</div></a>
            <br/>
            <p style="font-size:15px;">Need more information? Email us at eventsg@palo-it.com</p>
          </div>
        <?php
      }
    }
}
?>
