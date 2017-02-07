<?php

class scheduletraining_details_widget_paloit extends WP_Widget {

    function __construct()
    {
        parent::__construct('scheduletraining_details_widget_paloit', __('Schedule Details for Training Palo-IT', 'scheduletraining_details_widget_paloit_domain'), array( 'description' => __( 'Schedule Details Widget for Palo-IT', 'scheduletraining_details_widget_paloit_domain' ), ));
    }

    public function widget( $args, $instance ) {
    ?>
      <div class="details_big_box">
      <?php
        global $wpdb;

        $colorTable = 0;

        $list_training = $wpdb->get_results("SELECT * FROM new2015_schedule_training ORDER BY timestamp_event_start");
        foreach ($list_training as $training)
        {
          if ($colorTable == 0) {
              $colorTable = 1;
              ?><div class="details_grey_box"><?php
            }
          else {
              $colorTable = 0;
              ?><div class="details_white_box"><?php
          }
          ?>
            <div class="details_content_box">
              <div class="details_content_box_header">
                <div class="details_content_box_date">

                  <?php

                /*  $start = stripslashes($training->timestamp_event_start);
                  $end = stripslashes($training->timestamp_event_end);



                  if (date('n', $start) == 7)
                    echo "June";
                  elseif (date('n', $start) == 8)
                    echo "July";
                  elseif (date('n', $start) == 9)
                    echo "Sept";
                  else
                    echo date('M', $start);
                  echo " ".date('j', $start).date('S', $start);
                  if (date('j', $start) != date('j', $end))
                    echo " - ";
                  if(date('M', $end) != date('M', $start))
                  {
                    if (date('n', $end) == 7)
                      echo "June";
                    elseif (date('n', $end) == 8)
                      echo "July";
                    elseif (date('n', $end) == 9)
                      echo "Sept";
                    else
                      echo date('M', $end);
                  }
                  if (date('j', $start) != date('j', $end))
                    echo date('j', $end).date('S', $end); */

                    echo $training->date_event_display;

                    ?>

                </div>
                <div class="details_content_box_title"><a href="/training-register/?id=<?php echo stripslashes($training->id); ?>"><?php echo stripslashes($training->name); ?></a></div>
                <div class="details_content_box_register"><a class="ST_details_widget_link" href="/training-register/?id=<?php echo stripslashes($training->id); ?>"><div class="ST_register_widget_button2">REGISTER</div></a></div>
              </div>
              <div class="details_content_box_content">
                <?php echo nl2br(stripslashes($training->description)); ?>
              </div>
              <div class="details_content_box_readmore">
                <a class="ST_details_widget_link" href="/training-register/?id=<?php echo stripslashes($training->id); ?>" style="font-size: 15px;">Read more >></a>
              </div>
              <div class="details_content_box_footer">
                <div class="details_content_box_certif"><?php echo stripslashes($training->img_certif); ?></div>
                <div class="details_content_box_teacher_pic"><?php echo stripslashes($training->img_instructor); ?></div>
                <div class="details_content_box_teacher_name"><span class="details_content_box_instructor">INSTRUCTORS</span><br/><br/><?php echo nl2br(stripslashes($training->instructors)); ?></div>
              </div>
            </div>
      <?php
          }
      ?>
      </div>
      <?php
    }
}
?>
