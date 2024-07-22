<?php
session_start();


include_once 'url.php';



?>
<!DOCTYPE html>
<html>

<head>

    <title>research</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
    <link rel="stylesheet" type="text/css" href="src/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script> -->
    <script src="src/jquery.bootstrap-duallistbox.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="css/css.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="js/jquery.redirect.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script> -->
    <script>
    if (performance.navigation.type == 2) {
        location.reload(true);
    }
    </script>
</head>


<body class="container">
    <div class="headercontent">
        <header class="d-flex flex-wrap justify-content-center p-2 mb-4 border-bottom ">
            <a href="/" class="d-flex  me-md-auto text-white text-decoration-none ">
                <span class="px-3">Home</span>
            </a>


        </header>
    </div>
    <div class="row">

        <?php


    ?>




        <div class="col">
            <h3> Anticancer </h3>

            <form id="demoform1" action="#" method="post">

                <select id="list1" multiple="multiple" size="15" name="duallistbox_demo1[]" class="demo1">


                    <script>
                    var htmls = '';
                    $.ajax({
                        url: '<?php echo ($API_url); ?>/api/drug/read.php',
                        data: {},
                        type: 'get',
                        success: function(result) {
                            // console.log(result)
                            const drugs = result.drug;
                            console.log(drugs);



                            drugs.forEach((element, index, array) => {

                                htmls += '<option value=' + element.id + '>' + element.drugname +
                                    '</option>';

                            });

                        },
                        async: false
                    });

                    document.write(htmls);
                    </script>


                </select>
                <br>
            </form>

            <script>
            var demo2 = $('.demo1').bootstrapDualListbox({

                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                filterPlaceHolder: 'Type drug name',
            });
            </script>

        </div>
        <div class="col">
            <h3>Herb</h3>

            <form id="demoform2" action="#" method="post">

                <select multiple="multiple" size="15" name="duallistbox_demo2[]" class="demo2">
                    <script>
                    var htmls2 = '';
                    $.ajax({
                        url: '<?php echo ($API_url); ?>/api/otherdrug/read.php',
                        data: {},
                        type: 'get',
                        success: function(result) {
                            // console.log(result)
                            const otherdrugs = result.otherdrug;
                            console.log(otherdrugs);



                            otherdrugs.forEach((element, index, array) => {

                                htmls2 += '<option value=' + element.id + '>' + element
                                    .otherdrugname + '</option>';

                            });

                        },
                        async: false
                    });

                    document.write(htmls2);
                    </script>



                </select>
                <br>

            </form>

            <script>
            var demo2 = $('.demo2').bootstrapDualListbox({

                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                filterPlaceHolder: 'Type herb name',

            });
            </script>

        </div>


    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-auto">

            <button id="btndata" type="button" class="btn btn-primary">Search </button>
        </div>

        <div id="list22">


        </div>

    </div>

    </div>



    <script>
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
    var demo2 = $('select[name="duallistbox_demo2[]"]').bootstrapDualListbox();
    // var drugs = [];

    var drugs = {
        drug: [],
        otherdrug: []
    };

    function getSelectValues(select) {
        console.log(select);

        var result = [];
        var options = select;
        var opt;
        var iLen = options.length
        for (var i = 0; i < iLen; i++) {
            opt = options[i];

            if (opt.selected) {
                result.push(opt.text);
            }
        }
        return result;
    }
    $("#btndata").click(function() {
        // alert($('[name="duallistbox_demo1[]"]').val());
        // alert($('[name="duallistbox_demo2[]"]').val());

        // alert( $('select[name="duallistbox_demo1[]"]  option:selected' ).text());
        // alert( $('select[name="duallistbox_demo2[]"]  option:selected' ).text());

        var drugall = $('[name="duallistbox_demo1[]"]').val();
        var otherdrugall = $('[name="duallistbox_demo2[]"]').val();

        var drugallname = $('select[name="duallistbox_demo1[]"]  option:selected').text();
        var otherdrugallname = $('select[name="duallistbox_demo2[]"]  option:selected').text();



        var el1 = $('select[name="duallistbox_demo1[]_helper2"]')[0];
        const arr_drugallname = getSelectValues(el1);

        var el = $('select[name="duallistbox_demo2[]_helper2"]')[0];
        const arr_otherdrugallname = getSelectValues(el);

        // for (let i = 0; i < drugall.length; i++) {

        //   var id = drugall[i];
        //   var namedrug = sp_drugallname[i];

        //   drugs.drug.push({
        //     "iddrug": id,
        //     "drugname": namedrug

        //   })
        // }
        for (var i in drugall) {

            var item = drugall[i];
            var otherdrugname = arr_drugallname[i];
            drugs.drug.push({
                "iddrug": item,
                "drugname": otherdrugname
            })
        }
        for (var j in otherdrugall) {

            var item = otherdrugall[j];
            var otherdrugname = arr_otherdrugallname[j];
            drugs.otherdrug.push({
                "idotherdrug": item,
                "otherdrugname": otherdrugname
            })
        }

        const drugsearch = JSON.stringify(drugs);
        // console.log(drugsearch)

        $.ajax({
            type: "POST",
            url: "<?php echo ($API_url); ?>/api/interact/read_one.php",
            dataType: 'json',
            data: JSON.stringify(drugs),
            success: function(result) {

                window.sessionStorage.setItem("result", JSON.stringify(result));
                var storedArray = JSON.parse(sessionStorage.getItem("result"));

                var re = JSON.stringify(result);

                console.log(result)

                $.redirect('<?php echo ($API_HOME); ?>/result.php', {
                    re
                }, "POST");


                // $.redirect("http://127.0.0.1/webdrug/result2.php",result); 

                // location.href = "http://127.0.0.1/webdrug/result2.php"


            },
            error: function(result) {
                // alert(JSON.stringify(result));
                // console.log(JSON.stringify(result))
            }
        });
        // console.log(JSON.stringify(drugs))
        return false;
    });
    </script>

</body>