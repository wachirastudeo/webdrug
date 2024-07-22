<?php

$filename = 'data2.json';

$data = file_get_contents($filename);

$dataresult = json_decode($data, true);

//loop ดึงข้อมูล 
//  $numcount = count($dataresult['interaction']);

// for($k=0;$k<$numcount;$k++){
//     $namedrug =array_keys($dataresult['interaction'])[$k];
//   $countindrug=count($dataresult['interaction'][$namedrug]);
//     for($p=0;$p<$countindrug;$p++)  {
//       $iddrug=$dataresult['interaction'][$namedrug][$p]["iddrug"];
//       $idotherdrug=$dataresult['interaction'][$namedrug][$p]["idotherdrug"];
//       echo($iddrug);
//       echo($idotherdrug);

//     }


// }

//-----
// $iddrug=$dataresult['interaction']["Busulfan"][0]["id"];


// $numdrug = count($u->interaction);

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
      var storedArray = JSON.parse(sessionStorage.getItem("result"));
      console.log(storedArray);
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
  <h2>Result</h2>
  <hr><br>

  <div class="container">
    <div class="row">

      <table class="table">
        <thead>
          <tr class="filters">
            <th>Drug
              <select id="assigned-user-filter" class="form-control">
                <option>None</option>
              
              </select>
            </th>
            <th>summary
              <select id="status-filter" class="form-control">
                <option>None</option>
              
             
              </select>
            </th>
            <th>severity
              <select id="milestone-filter" class="form-control">
                <option>None</option>
                <option>Milestone 1</option>
                <option>Milestone 2</option>
                <option>Milestone 3</option>
              </select>
            </th>
            <th>documentation
              <select id="priority-filter" class="form-control">
                <option>Any</option>
               
              </select>
            </th>
            <th>clarification
              <select id="tags-filter" class="form-control">
                <option>None</option>
              
              </select>
            </th>
          </tr>
        </thead>
      </table>


      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Result</h3>
          <div class="pull-right"></div>
        </div>





        <table id="task-list-tbl" class="table">
          <thead>
            <tr>
              <th>Drug</th>
              <th>summary</th>
              <th>severity</th>
              <th>documentation</th>
              <th>clarification</th>
              <th>reference</th>
            </tr>
          </thead>
          <!-- body -->
          <tbody>
            <?php
            $i = 1;
            // for ($j = 0; $j < $numdrug; $j++) {

            //   $interact->iddrug = $u->interaction[$i];


            // }

            $numcount = count($dataresult['interaction']);

            for ($k = 0; $k < $numcount; $k++) {
              $namedrug = array_keys($dataresult['interaction'])[$k];
              $countindrug = count($dataresult['interaction'][$namedrug]);
              for ($p = 0; $p < $countindrug; $p++) {
                $iddrug = $dataresult['interaction'][$namedrug][$p]["drugname"];
                $idotherdrug = $dataresult['interaction'][$namedrug][$p]["otherdrugname"];
              $alldrung = "-".$iddrug."<br>"."-".$idotherdrug;
                $summary = $dataresult['interaction'][$namedrug][$p]["summary"];
                $severity = $dataresult['interaction'][$namedrug][$p]["severity"];
                $documentation = $dataresult['interaction'][$namedrug][$p]["documentation"];
                $clarification = $dataresult['interaction'][$namedrug][$p]["clarification"];
                $reference = $dataresult['interaction'][$namedrug][$p]["reference"];






            ?>
                <!-- <tr id="task-1" class="task-list-row" data-task-id="1" data-assigned-user="Larry" data-status="In Progress" data-milestone="Milestone 2" data-priority="Urgent" data-tags="Tag 2"> -->
                <!-- <tr id="task-<?= $i ?>" class="task-list-row" data-task-id=<?= $i ?> data-assigned-user=<?= $user->assigned; ?> data-status="In Progress" data-milestone="<?= $user->milestone; ?>" data-priority="<?= $user->priority; ?>" data-tags="<?= $user->tags; ?>"> -->

                <tr>
        
                  <td> <?= $alldrung ; ?> </td>
                  <td> <?= $summary ; ?> </td>
                  <td> <?= $severity ; ?> </td>
                  <td> <?= $documentation ; ?> </td>
                  <td> <?= $clarification ; ?> </td>
                  <td> <?= $reference ; ?> </td>


                </tr>
            <?php

                $i++;
              }
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