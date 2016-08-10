<?php

function menu_admin_pages() {
  add_menu_page('Training Schedule', 'Training Schedule', 'manage_options', 'admin_training_list', 'admin_training_list');
  add_submenu_page( 'admin_training_list', 'New Training', 'New Training', 'manage_options', 'admin_training_new', 'admin_training_new');
}

function admin_training_list() {
  global $wpdb;

  if (isset($_POST) && $_GET['action'] == 'add')
  {
    $wpdb->insert(
    'schedule_training',
    array(
      'name' => $_POST['name_training'],
      'date_event_start' => $_POST['date_training_start'],
      'date_event_end' => $_POST['date_training_end'],
      'timestamp_event_end' => strtotime($_POST['date_training_end']),
      'timestamp_event_start' => strtotime($_POST['date_training_start']),
      'instructors' => $_POST['schedule_training_instructors'],
      'description' => $_POST['schedule_training_desc'],
      'readmore' => $_POST['schedule_training_desc_hard'],
      'img_certif' => $_POST['schedule_training_image'],
      'img_instructor' => $_POST['schedule_training_image_instructor'],
      'link_register' => $_POST['link_register']
    ));
  }
  elseif (isset($_POST) && $_GET['action'] == 'edit' && isset($_GET['id']))
  {
    $wpdb->update(
    'schedule_training',
    array(
      'name' => $_POST['name_training'],
      'date_event_start' => $_POST['date_training_start'],
      'date_event_end' => $_POST['date_training_end'],
      'timestamp_event_end' => strtotime($_POST['date_training_end']),
      'timestamp_event_start' => strtotime($_POST['date_training_start']),
      'instructors' => $_POST['schedule_training_instructors'],
      'description' => $_POST['schedule_training_desc'],
      'readmore' => $_POST['schedule_training_desc_hard'],
      'img_certif' => $_POST['schedule_training_image'],
      'img_instructor' => $_POST['schedule_training_image_instructor'],
      'link_register' => $_POST['link_register']
    ),
    array( 'id' => $_GET['id'] ));
  }
  if (isset($_GET['del']))
  {
    $wpdb->delete( 'schedule_training', array('id' => $_GET['del']));
  }
  ?>
    <div class="wrap">
      <span class="ST_title_admin">Training Schedule</span>
      <a href="admin.php?page=admin_training_new" class="page-title-action">New Training</a>
      <br/><br/>
      <table class="widefat fixed" cellspacing="0">
        <thead>
          <tr>
            <td id="columnname" class="manage-column column-columnname ST_table_admin_title" scope="col">NAME OF THE EVENT</td>
            <td id="columnname" class="manage-column column-columnname ST_table_admin_title" scope="col">DATE OF THE EVENT</td>
            <td id="columnname" class="manage-column column-columnname ST_table_admin_title" scope="col" style="text-align:center;">ACTIONS</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $list_training = $wpdb->get_results("SELECT * FROM schedule_training ORDER BY timestamp_event_start");
          foreach ( $list_training as $training )
          {
            ?>
            <tr class="alternate">
                <td class="column-columnname" scope="row"><?php echo stripslashes($training->name); ?></td>
                <td class="column-columnname"><?php echo stripslashes($training->date_event_start); ?> - <?php echo stripslashes($training->date_event_end); ?></td>
                <td class="column-columnname">
                  <div style="text-align:center;">
                      <span><a href="admin.php?page=admin_training_new&edit=<?php echo $training->id; ?>">Edit</a> |</span>
                      <span><a href="admin.php?page=admin_training_toppage&del=<?php echo $training->id; ?>" onclick="return(confirm('Are you sure to delete this event ?'));">Delete</a></span>
                  </div>
                </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
}


function admin_training_new() {
  global $wpdb;
  if (isset($_GET['edit']))
  {
    $training = $wpdb->get_results("SELECT * FROM schedule_training WHERE id=".$_GET['edit']);
    $name = stripslashes($training[0]->name);
    $date_event_start= stripslashes($training[0]->date_event_start);
    $date_event_end= stripslashes($training[0]->date_event_end);
    $link_register = stripslashes($training[0]->link_register);
  }
  ?>
    <div class="wrap">
        <?php
        $edit = $_GET['edit'];
        if (isset($edit))
        {
        ?><span style="font-size:24px;">Edit Training</span><?php
        }
        else
        {
          ?><span style="font-size:24px;">New Training</span><?php
        }
        ?>
      <a href="admin.php?page=admin_training_list" class="page-title-action">Go back Training List</a><br/><br/>
      <form method="post" action="admin.php?page=admin_training_list&action=<?php if (isset($edit)) { echo "edit&id=". $_GET['edit']; } else { echo "add"; }?>">
        <br/>

        <div id="titlediv">
          <div id="titlewrap">
  		        <input type="text" name="name_training" value="<?php echo $name; ?>" size="30" placeholder="Name of the training" id="title" spellcheck="true" autocomplete="off">
          </div>
        </div><br/>

        <h3>Description Light of the event :</h3>
        <?php wp_editor(stripslashes($training[0]->description), "schedule_training_desc"); ?><br/><br/>

        <h3>Description of the event :</h3>
        <?php wp_editor(stripslashes($training[0]->readmore), "schedule_training_desc_hard"); ?><br/><br/>

        <h3>Image of the event :</h3>
        <?php wp_editor(stripslashes($training[0]->img_certif), "schedule_training_image"); ?><br/><br/>

        <h3>Image of the instructor :</h3>
        <?php wp_editor(stripslashes($training[0]->img_instructor), "schedule_training_image_instructor"); ?><br/><br/>

        <div id="titlediv">
          <div id="titlewrap">
            <input type="text" name="date_training_start" value="<?php echo $date_event_start; ?>" size="30" placeholder="Start Date for the event (eg. 23-04-2016)" id="title" spellcheck="true" class="custom_date" autocomplete="off">
          </div>
        </div><br/>

        <div id="titlediv">
          <div id="titlewrap">
            <input type="text"  name="date_training_end" value="<?php echo $date_event_end; ?>" size="30" placeholder="End Date for the event (eg. 23-04-2016)" id="title" spellcheck="true" class="custom_date" autocomplete="off">
          </div>
        </div><br/>

        <div id="titlediv">
          <div id="titlewrap">
            <input type="text" name="link_register" value="<?php echo $link_register; ?>" size="30" placeholder="Link for register" id="title" spellcheck="true" autocomplete="off">
          </div>
        </div><br/>

        <h3>Instructors :</h3>
        <?php wp_editor(stripslashes($training[0]->instructors), "schedule_training_instructors"); ?><br/><br/>
        <br />
        <input type="submit" value="Save a new training event" class="button-primary"/>
      </form>
  </div>
    <?php
}


?>
