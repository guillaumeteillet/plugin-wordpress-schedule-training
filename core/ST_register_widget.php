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
        $training = $wpdb->get_results("SELECT * FROM schedule_training WHERE id=".$_GET['id']);
        ?>
        <div>
          <p class="ST_register_widget_title"><?php echo $training[0]->name; ?></p>
          <div class="ST_register_widget_date">
            <?php

            $start = stripslashes($training[0]->timestamp_event_start);
            $end = stripslashes($training[0]->timestamp_event_end);

            echo date('F', $start)." ".date('d', $start).date('S', $start);
            if (date('Y', $start) != date('Y', $end))
              echo " ".date('Y', $start);
            if (date('d', $start) != date('d', $end))
              echo " - ";
            if(date('F', $end) != date('F', $start))
              echo date('F', $end)." ";
            if (date('d', $start) != date('d', $end))
              echo date('d', $end).date('S', $end);
            echo " ".date('Y', $end);
            ?>
            <a href="<?php echo $training[0]->link_register; ?>"><div class="ST_register_widget_button">REGISTER</div></a>
          </div>
          </div>
          <br/><br/>
          <?php echo nl2br(stripslashes($training[0]->readmore)); ?>
          <div class="ST_register_widget_date_center">
            <?php
            echo date('F', $start)." ".date('d', $start).date('S', $start);
            if (date('Y', $start) != date('Y', $end))
              echo " ".date('Y', $start);
            if (date('d', $start) != date('d', $end))
              echo " - ";
            if(date('F', $end) != date('F', $start))
              echo date('F', $end)." ";
            if (date('d', $start) != date('d', $end))
              echo date('d', $end).date('S', $end);
            echo " ".date('Y', $end); ?>
            <a href="<?php echo $training[0]->link_register; ?>"><div class="ST_register_widget_button">REGISTER</div></a>
          </div>
        <?php
      }
    }
}
?>
