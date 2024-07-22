<?php

$filename = 'data.json';
$filename2 = 'data2.json';

$data = file_get_contents($filename);
$data2 = file_get_contents($filename2);

$users = json_decode($data);
$u = json_decode($data2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
  <link rel="stylesheet" type="text/css" href="css/result.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>


  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <link href="      https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css
      " rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script>
    $(document).ready(function() {

      // Assigned User Dropdown Filter
      $('#assigned-user-filter').on('change', function() {
        var assignedUser = this.value;

        if (assignedUser === 'None') {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('assigned-user') != assignedUser;
          }).show();
        } else {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('assigned-user') == assignedUser;
          }).show();
        }
      });


      // Task Status Dropdown Filter
      $('#status-filter').on('change', function() {
        var taskStatus = this.value;

        if (taskStatus === 'Any') {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('status') != taskStatus;
          }).show();
        } else {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('status') == taskStatus;
          }).show();
        }
      });



      // Task Milestone Dropdown Filter
      $('#milestone-filter').on('change', function() {
        var taskMilestone = this.value;

        if (taskMilestone === 'None') {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('milestone') != taskMilestone;
          }).show();
        } else {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('milestone') == taskMilestone;
          }).show();
        }
      });


      // Task Priority Dropdown Filter
      $('#priority-filter').on('change', function() {
        var taskPriority = this.value;

        if (taskPriority === 'Any') {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('priority') != taskPriority;
          }).show();
        } else {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('priority') == taskPriority;
          }).show();
        }
      });


      // Task Tags Dropdown Filter
      $('#tags-filter').on('change', function() {
        var taskTags = this.value;

        if (taskTags === 'None') {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('tags') != taskTags;
          }).show();
        } else {
          $('.task-list-row').hide().filter(function() {
            return $(this).data('tags') == taskTags;
          }).show();
        }
      });



      /*
      future use for a text input filter
      $('#search').on('click', function() {
          $('.box').hide().filter(function() {
              return $(this).data('order-number') == $('#search-criteria').val().trim();
          }).show();
      });*/

    });
  </script>

</head>

<body>
  <br>
  <h2>Testing Task List Filters</h2>
  <hr><br>

  <div class="container">
    <div class="row">

      <table class="table">
        <thead>
          <tr class="filters">
            <th>Assigned User
              <select id="assigned-user-filter" class="form-control">
                <option>None</option>
                <option>John</option>
                <option>Rob</option>
                <option>Larry</option>
                <option>Donald</option>
                <option>Roger</option>
              </select>
            </th>
            <th>Status
              <select id="status-filter" class="form-control">
                <option>Any</option>
                <option>Not Started</option>
                <option>In Progress</option>
                <option>Completed</option>
              </select>
            </th>
            <th>Milestone
              <select id="milestone-filter" class="form-control">
                <option>None</option>
                <option>Milestone 1</option>
                <option>Milestone 2</option>
                <option>Milestone 3</option>
              </select>
            </th>
            <th>Priority
              <select id="priority-filter" class="form-control">
                <option>Any</option>
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
                <option>Urgent</option>
              </select>
            </th>
            <th>Tags
              <select id="tags-filter" class="form-control">
                <option>None</option>
                <option>Tag 1</option>
                <option>Tag 2</option>
                <option>Tag 3</option>
              </select>
            </th>
          </tr>
        </thead>
      </table>


      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Tasks</h3>
          <div class="pull-right"></div>
        </div>





        <table id="task-list-tbl" class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Created</th>
              <th>Due Date</th>
              <th>Priority</th>
              <th>Milestone</th>
              <th>Assigned User</th>
              <th>Tags</th>
            </tr>
          </thead>
          <!-- body -->
          <tbody>
            <?php 
            $i=1;
            foreach ($users as $user) {

              ?>
              <!-- <tr id="task-1" class="task-list-row" data-task-id="1" data-assigned-user="Larry" data-status="In Progress" data-milestone="Milestone 2" data-priority="Urgent" data-tags="Tag 2"> -->

              <tr id="task-<?=$i?>" class="task-list-row" data-task-id=<?=$i ?> data-assigned-user=<?= $user->assigned; ?> data-status="In Progress" 
              data-milestone="<?= $user->milestone; ?>" data-priority="<?=$user->priority; ?>" data-tags="<?=$user->tags; ?>" >
                <td> <?= $user->title; ?> </td>
                <td> <?= $user->created; ?> </td>
                <td> <?= $user->dudate; ?> </td>
                <td> <?= $user->priority; ?> </td>
                <td> <?= $user->milestone; ?> </td>
                <td> <?= $user->assigned; ?> </td>
                <td> <?= $user->tags; ?> </td>

              </tr>
            <?php
          
          $i++;
          } ?>


          </tbody>
        </table>
      </div>
      <!-- <div>
        <table>
          <tbody>
            <tr>
              <th>Name</th>
              <th>Occupation</th>
              <th>Country</th>
            </tr>
            <?php foreach ($users as $user) { ?>
              <tr>
                <td> <?= $user->name; ?> </td>
                <td> <?= $user->occupation; ?> </td>
                <td> <?= $user->country; ?> </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div> -->
    </div>
  </div>
</body>

</html>