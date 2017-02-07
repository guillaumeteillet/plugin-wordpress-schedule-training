<?php

class scheduletraining_widget_paloit extends WP_Widget {

    function __construct()
    {
        parent::__construct('scheduletraining_widget_paloit', __('Schedule Table for Training Palo-IT', 'scheduletraining_widget_paloit_domain'), array( 'description' => __( 'Schedule Widget for Palo-IT', 'scheduletraining_widget_paloit_domain' ), ));
    }

    public function widget( $args, $instance ) {
      ?>
        <table class="ST_table_design">
          <tbody>
            <tr class="ST_table_title">
              <td class="ST_table_title_center title1">TRAINING NAME</td>
              <td class="ST_table_title_center title2 ST_display_mobile">DATES</td>
              <td class="ST_table_title_center title3"></td>
              <td class="ST_table_title_center title4 ST_display_mobile">INSTRUCTORS</td>
            </tr>
            <?php
            global $wpdb;

            $colorTable = 0;

            $list_training = $wpdb->get_results("SELECT * FROM new2015_schedule_training ORDER BY timestamp_event_start");
            foreach ( $list_training as $training )
            {
              if ($colorTable == 0) {
                  $colorTable = 1;
                  ?><tr class="ST_table_row_0"><?php
                }
              else {
                $colorTable = 0;
                ?><tr class="ST_table_row_1"><?php
              }
             ?>
                <td class="ST_table_cell"><a class="ST_table_widget_link" href="/training-register/?id=<?php echo stripslashes($training->id); ?>"><?php echo stripslashes($training->name); ?></a></td>
                <td class="ST_table_cell ST_display_mobile">
                  <?php
                  echo $training->date_event_display;
                /*  $start = stripslashes($training->timestamp_event_start);
                  $end = stripslashes($training->timestamp_event_end);

                  if ($start == $end)
                    echo date('F', $start)." ".date('j', $start).date('S', $start);
                  else
                  {
                    echo date('F', $start)." ".date('j', $start).date('S', $start);
                    echo " - ";
                    if(date('F', $end) != date('F', $start))
                      echo date('F', $end)." ";
                    echo date('j', $end).date('S', $end);
                  } */?>
                </td>
                <td class="ST_table_cell"><a class="ST_table_widget_link" href="/training-register/?id=<?php echo stripslashes($training->id); ?>"><div class="ST_register_widget_button3">REGISTER</div></a></td>
                <td class="ST_table_cell ST_display_mobile"><?php echo nl2br(stripslashes($training->instructors)); ?></td>
              </tr>
          <?php
            }
            ?>
          </tbody>
        </table>
      <?php
    }
}
?>
