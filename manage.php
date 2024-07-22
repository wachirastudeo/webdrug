<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggeding'])) {
    header('Location: login.php');
    exit;
}
include_once 'url.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <link rel='stylesheet' href='jquery-ui.css'>
    <script src='https://code.jquery.com/jquery-1.12.4.js'></script>
    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/css.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>Management <?php echo ($API_url); ?></title>

    <script>
    $(function() {
        $.widget("custom.combobox", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .attr("placeholder", "Enter Anticancer")
                    .attr("id", "cm")


                    .addClass(
                        "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left"
                    )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });





                    },

                    autocompletechange: "_removeIfInvalid"

                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");

                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    var ids = $(this).val();

                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            value2: ids,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .attr("title", value + " didn't match any item")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#js__apply_now").combobox();

    });
    </script>
    <script>
    $(function() {
        $.widget("custom.combobox", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .attr("placeholder", "Enter Herb")
                    .attr("id", "cm2")


                    .addClass(
                        "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left"
                    )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });





                    },

                    autocompletechange: "_removeIfInvalid"

                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");

                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    var ids = $(this).val();

                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            value2: ids,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .attr("title", value + " didn't match any item")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#js__apply_now2").combobox();

    });
    </script>
    <script>
    $(function() {
        $.widget("custom.combobox", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .attr("placeholder", "Enter Anticancer")
                    .attr("id", "cm3")


                    .addClass(
                        "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left"
                    )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });





                    },

                    autocompletechange: "_removeIfInvalid"

                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");

                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    var ids = $(this).val();

                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            value2: ids,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .attr("title", value + " didn't match any item")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#js__apply_now3").combobox();

    });
    </script>
    <script>
    $(function() {
        $.widget("custom.combobox", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .attr("placeholder", "Enter Herb")
                    .attr("id", "cm4")


                    .addClass(
                        "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left"
                    )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });





                    },

                    autocompletechange: "_removeIfInvalid"

                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");

                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    var ids = $(this).val();

                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            value2: ids,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .attr("title", value + " didn't match any item")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#js__apply_now4").combobox();

    });
    </script>


    <script>
    var idAnticancer = "0";
    var idHerb = "0";
    var idAnticancer2 = "0";
    var idHerb2 = "0";



    var drugname = "";
    var otherdrugname = "";
    var drugnameEdit = "";
    var otherdrugnameEdit = "";

    var idinteract = "";

    var summary = "";
    var severity = "";
    var documentation = "";
    var clarification = "";
    var reference = "";

    $(document).ready(function() {

        $("#btn_update_Ant").hide();
        $("#btn_update_Herb").hide();

        $("#btn_insert_all").hide();
        $("#btn_delete_all").hide();
        $("#btn_edit_all").hide();
        $("#btn_cancle_all").hide();

        $("#btn_update_all").hide();
        $("#textinsert").hide();



        $(".drugAdd").hide();
        $(".drugEdit").hide();

        $(".herbAdd").hide();
        $(".herbEdit").hide();

        $(".intAdd").hide();
        $(".intEdit").hide();



        $("#btn_delete_Ant").click(function() {
            var id = {
                "id": idAnticancer
            };

            console.log(id)

            $.confirm({
                title: 'Are you sure ?',
                content: 'Are you sure delete',
                type: 'red',
                buttons: {
                    ok: {
                        text: "yes",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function() {
                            console.log('the user clicked confirm');
                            $.ajax({
                                type: "POST",
                                url: "<?php echo ($API_url); ?>/drug/delete.php",
                                data: id,
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.message;
                                    console.log(drugs);
                                    // Ajax call completed successfully-

                                }

                            });
                            $.ajax({
                                type: "POST",
                                url: "<?php echo ($API_url); ?>/api/interact/deletedrug.php",
                                data: JSON.stringify(id),
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.message;
                                    console.log(drugs);
                                    // Ajax call completed successfully-

                                }

                            });
                            location.reload();

                        }
                    },
                    cancel: function() {
                        console.log('the user clicked cancel');
                    }
                }
            });

        });


        $("#btn_delete_Herb").click(function() {
            var id = {
                "id": idHerb
            };
            console.log(id)

            $.confirm({
                title: 'Are you sure ?',
                content: 'Are you sure delete',
                type: 'red',
                buttons: {
                    ok: {
                        text: "yes",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function() {
                            console.log('the user clicked confirm');
                            $.ajax({
                                type: "POST",
                                url: "<?php echo ($API_url); ?>/api/otherdrug/delete.php",
                                data: JSON.stringify(id),
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.message;
                                    console.log(drugs);
                                    // Ajax call completed successfully-

                                }

                            });
                            $.ajax({
                                type: "POST",
                                url: "<?php echo ($API_url); ?>/drugapi/api/interact/deleteherb.php",
                                data: JSON.stringify(id),
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.message;
                                    console.log(drugs);
                                    // Ajax call completed successfully-

                                }

                            });
                            location.reload();

                        }
                    },
                    cancel: function() {
                        console.log('the user clicked cancel');
                    }
                }
            });


        });


        $("#btn_delete_all").click(function() {
            var id = {
                "id": idinteract
            };

            console.log(id)

            $.confirm({
                title: 'Are you sure ?',
                content: 'Are you sure delete',
                type: 'red',
                buttons: {
                    ok: {
                        text: "yes",
                        btnClass: 'btn-danger',
                        keys: ['enter'],
                        action: function() {
                            console.log('the user clicked confirm');
                            $.ajax({
                                type: "POST",
                                url: "<?php echo ($API_url); ?>/api/interact/delete.php",
                                data: JSON.stringify(id),
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.message;
                                    console.log(drugs);
                                    // Ajax call completed successfully-
                                    location.reload();

                                }

                            });
                        }
                    },
                    cancel: function() {
                        console.log('the user clicked cancel');
                    }
                }
            });


        });

        $("#inline-form-anticancer").on('change', function() {
            drugname = this.value;


        });
        $("#inline-form-herb").on('change', function() {
            otherdrugname = this.value;
            console.log(otherdrugname)

        });
        $("#inline-form-anticancer2").on('change', function() {
            drugnameEdit = this.value;
            console.log(drugnameEdit);

        });

        $("#inline-form-herb2").on('change', function() {
            otherdrugnameEdit = this.value;
            console.log(otherdrugnameEdit);

        });

        $("#summary").on('change', function() {
            summary = this.value;
        });
        $("#severity").on('change', function() {
            severity = this.value;
        });
        $("#documentation").on('change', function() {
            documentation = this.value;
        });
        $("#clarification").on('change', function() {
            clarification = this.value;
        });
        $("#reference").on('change', function() {
            reference = this.value;
        });


        $("#btn_cancle_Ant").click(function() {
            $("#cm").val("");

            $("#btn_update_Ant").hide();
            $("#btn_edit_Ant").show();
            $("#inline-form-anticancer2").attr('disabled', 'disabled');

            $("#inline-form-anticancer2").val("");

        });
        $("#btn_cancle_Herb").click(function() {
            $("#cm2").val("");

            $("#btn_update_Herb").hide();
            $("#btn_edit_Herb").show();
            $("#inline-form-herb2").attr('disabled', 'disabled');

            $("#inline-form-herb2").val("");

        });

        $("#btn_edit_Ant").click(function() {
            $("#inline-form-anticancer2").removeAttr('disabled');
            $("#btn_edit_Ant").hide();
            $("#btn_update_Ant").show();
        });

        $("#btn_edit_Herb").click(function() {
            $("#inline-form-herb2").removeAttr('disabled');
            $("#btn_edit_Herb").hide();
            $("#btn_update_Herb").show();
        });


        $("#btn_edit_all").click(function() {
            $("#btn_edit_all").hide();
            $("#btn_update_all").show();
            $("#btn_cancle_all").show();

            $("#summary").removeAttr('disabled');
            $("#severity").removeAttr('disabled');
            $("#documentation").removeAttr('disabled');
            $("#clarification").removeAttr('disabled');
            $("#reference").removeAttr('disabled');

        });

        $("#btn_cancle_all").click(function() {

            $("#btn_edit_all").show();
            $("#btn_update_all").hide();
            $("#btn_insert_all").hide();
            $("#summary").attr('disabled', 'disabled');
            $("#severity").attr('disabled', 'disabled');
            $("#documentation").attr('disabled', 'disabled');
            $("#clarification").attr('disabled', 'disabled');
            $("#reference").attr('disabled', 'disabled');

            $("#btn_edit_all").show();

            $("#textinsert").hide();
            $("#btn_cancle_all").hide();


        });

        $("#btn_update_all").click(function() {

            $("#btn_edit_all").show();
            $("#btn_update_all").hide();
            $("#btn_cancle_all").hide();
            $("#summary").attr('disabled', 'disabled');
            $("#severity").attr('disabled', 'disabled');
            $("#documentation").attr('disabled', 'disabled');
            $("#clarification").attr('disabled', 'disabled');
            $("#reference").attr('disabled', 'disabled');

            var interact = {
                "id": idinteract,
                "summary": summary,
                "severity": severity,
                "severity": severity,
                "documentation": documentation,
                "clarification": clarification,
                "reference": reference



            };

            console.log(interact)
            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/interact/update.php",
                data: JSON.stringify(interact),
                success: function(result) {
                    // console.log(result)
                    const drugs = result.message;
                    console.log(drugs);
                    $(".intEdit").fadeTo(2000, 500).slideUp(500, function() {
                        $(".intEdit").slideUp(500);
                        location.reload();
                    });
                    // Ajax call completed successfully-
                    // alert("Form update Successfully");
                },
                error: function(result) {

                    // Some error in ajax call

                }
            });


        });
        $("#btn_update_Ant").click(function() {

            var drugname = {
                "id": idAnticancer,
                "drugname": drugnameEdit

            };

            console.log(drugname);

            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/drug/update.php",
                data: JSON.stringify(drugname),
                success: function(result) {
                    // console.log(result)
                    const drugs = result.message;
                    console.log(drugs);

                    // Ajax call completed successfully-
                    // alert("Form update Successfully");
                    $("#cm").val("");
                    $("#inline-form-anticancer2").val("");

                    $("#btn_update_Ant").hide();
                    $("#btn_edit_Ant").show();
                    $("#inline-form-anticancer2").attr('disabled', 'disabled');

                    $("#inline-form-anticancer2").val("");
                    $(".drugEdit").fadeTo(2000, 500).slideUp(500, function() {
                        $(".drugEdit").slideUp(500);
                        location.reload();
                    });


                },
                error: function(result) {

                    // Some error in ajax call

                }
            });
        });


        $("#btn_update_Herb").click(function() {

            var otherdrugname = {
                "id": idHerb,
                "otherdrugname": otherdrugnameEdit

            };

            console.log(otherdrugname);

            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/otherdrug/update.php",
                data: JSON.stringify(otherdrugname),
                success: function(result) {
                    // console.log(result)
                    const otherdrugs = result.message;
                    console.log(otherdrugs);
                    // Ajax call completed successfully-
                    // alert("Form update Successfully");
                    $("#cm2").val("");


                    $("#btn_update_Herb").hide();
                    $("#btn_edit_Herb").show();
                    $("#inline-form-herb2").attr('disabled', 'disabled');

                    $("#inline-form-herb2").val("");
                    $(".herbEdit").fadeTo(2000, 500).slideUp(400, function() {
                        $(".herbEdit").slideUp(400);
                        location.reload();
                    });
                },
                error: function(result) {

                    // Some error in ajax call

                }
            });
        });

        $("#btn_serach_all").click(function() {
            idinteract = "";
            summary = "";
            severity = "";
            documentation = "";
            clarification = "";
            reference = "";
            $("#summary").text("");
            $("#severity").text("");
            $("#documentation").text("");
            $("#clarification").text("");
            $("#reference").text("");

            var interact = {
                "iddrug": idAnticancer2,
                "idotherdrug": idHerb2

            };
            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/interact/read2.php",
                data: JSON.stringify(interact),
                success: function(result) {
                    console.log(result)

                    const interact = result.data;

                    if (result.data.interact[0] == null) {
                        console.log("new")
                        $("#textinsert").fadeIn();
                        $("#btn_edit_all").hide();
                        $("#btn_insert_all").show();

                        $("#btn_delete_all").hide();
                        $("#summary").removeAttr('disabled');
                        $("#severity").removeAttr('disabled');
                        $("#documentation").removeAttr('disabled');
                        $("#clarification").removeAttr('disabled');
                        $("#reference").removeAttr('disabled');

                        $("#summary").focus();


                    } else {
                        var dataall = interact.interact[0];

                        $("#btn_delete_all").show();
                        $("#btn_edit_all").show();

                        summary = dataall['summary'];
                        severity = dataall['severity'];
                        documentation = dataall['documentation'];
                        clarification = dataall['clarification'];
                        reference = dataall['reference'];
                        idinteract = dataall['id'];
                        console.log(dataall);
                        // alert("Form update Successfully");
                        $("#summary").text(summary);
                        $("#severity").text(severity);
                        $("#documentation").text(documentation);
                        $("#clarification").text(clarification);
                        $("#reference").text(reference);
                    }
                },
                error: function(result) {
                    // Some error in ajax call
                    console.log(result)
                }
            });
        });


        $('#cm').on('change', function() {
            $('#inline-form-anticancer2').val(this.value);
            $("#inline-form-anticancer2").attr('disabled', 'disabled');

            $("#btn_update_Ant").hide();
            $("#btn_edit_Ant").show();

        }).change();
        $('#cm').on('autocompleteselect', function(e, ui) {
            $("#inline-form-anticancer2").attr('disabled', 'disabled');

            $("#btn_update_Ant").hide();
            $("#btn_edit_Ant").show();
            $('#inline-form-anticancer2').val(ui.item.value);
            idAnticancer = ui.item.value2;
            console.log(idAnticancer)

        });

        $('#cm2').on('change', function() {
            $('#inline-form-herb2').val(this.value);
            $("#inline-form-herb2").attr('disabled', 'disabled');
            $("#btn_edit_Herb").show();
            $("#btn_update_Herb").hide();

        }).change();
        $('#cm2').on('autocompleteselect', function(e, ui) {
            $("#inline-form-herb2").attr('disabled', 'disabled');

            $('#inline-form-herb2').val(ui.item.value);
            $("#btn_edit_Herb").show();
            $("#btn_update_Herb").hide();
            idHerb = ui.item.value2;
            console.log(idHerb)

        });


        $('#cm3').on('change', function() {


        }).change();
        $('#cm3').on('autocompleteselect', function(e, ui) {


            idAnticancer2 = ui.item.value2;
            console.log(idAnticancer2)

        });
        $('#cm4').on('change', function() {


        }).change();
        $('#cm4').on('autocompleteselect', function(e, ui) {


            idHerb2 = ui.item.value2;
            console.log(idHerb2)

        });


        $("#btnInsertAnt").click(function() {
            var drug = {
                "drugname": drugname
            };
            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/drug/create.php",
                data: drug,
                success: function(data) {
                    // Ajax call completed successfully-

                    $("#inline-form-anticancer").val("");
                    $(".drugAdd").fadeTo(2000, 500).slideUp(400, function() {
                        $(".drugAdd").slideUp(400);
                        location.reload();
                    });

                },
                error: function(data) {
                    // Some error in ajax call
                    alert("some Error");
                }
            });
        });

        $("#btn_insert_all").click(function() {
            var interact = {

                "iddrug": idAnticancer2,
                "idotherdrug": idHerb2,
                "summary": summary,
                "severity": severity,
                "documentation": documentation,
                "clarification": clarification,
                "reference": reference

            };
            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/interact/create.php",
                data: JSON.stringify(interact),
                success: function(data) {
                    // Ajax call completed successfully-

                    $(".intAdd").fadeTo(2000, 500).slideUp(400, function() {
                        $(".intAdd").slideUp(400);
                        location.reload();
                    });

                },
                error: function(data) {
                    // Some error in ajax call

                }
            });
        });

        $("#btnInsertHerb").click(function() {
            var otherdrug = {
                "otherdrugname": otherdrugname
            };
            console.log(otherdrug)
            $.ajax({
                type: "POST",
                url: "<?php echo ($API_url); ?>/api/otherdrug/create.php",
                data: JSON.stringify(otherdrug),
                success: function(data) {
                    // Ajax call completed successfully-

                    $(".herbAdd").fadeTo(2000, 500).slideUp(400, function() {
                        $(".herbAdd").slideUp(400);
                        $("#inline-form-herb").val("");
                        location.reload();
                    });



                },
                error: function(data) {
                    console.log(data.message)
                    // Some error in ajax call
                    alert("some Error");
                }
            });
        });
    });
    </script>
</head>

<body class="container">
    <div class="headercontent">
        <header class="d-flex flex-wrap justify-content-end p-2 mb-4 border-bottom ">

            <a href="/webdrug/research.php" class="d-flex   text-white text-decoration-none ">
                <span class="px-3">View Research</span>
            </a>

        </header>
    </div>

    <div class="container">
        <h3 class="d-flex justify-content-center ">Management</h3>

        <div class="row justify-content-center align-items-center h-100 my-3">
            <div class="col-sm-8 ">
                <h5 class="d-flex ">Manage Anticancer </h5>
                <div>New Anticancer</div>
                <form class="row py-2" id="insertAnticancer">

                    <div class="col-9">

                        <input type="text" class="form-control" id="inline-form-anticancer" placeholder="Anticancer"
                            name="drugname">
                    </div>

                    <div class="col-3">
                        <button type="button" id="btnInsertAnt" class="btn btn-primary">Insert Anticancer</button>
                    </div>
                </form>
                <div class="col py-2">Edit Anticancer</div>


                <div class="col-11 py-2">
                    <div class="ui-widget">

                        <select class="form-select" id="js__apply_now">
                            <script>
                            var htmls = '';
                            $.ajax({
                                url: '<?php echo ($API_url); ?>/api/drug/read.php',
                                data: {},
                                type: 'get',
                                success: function(result) {
                                    // console.log(result)
                                    const drugs = result.drug;

                                    drugs.forEach((element, index, array) => {

                                        htmls += '<option value=' + element.id + ' id=' + element
                                            .id + '>' + element.drugname + '</option>';

                                    });

                                },
                                async: false
                            });

                            document.write(htmls);
                            </script>

                        </select>
                    </div>

                </div>
                <form class="row  py-2" id="formAnticancer">

                    <div class="col-8">
                        <div id="tagsname"></div>

                        <input type="text" class="form-control" id="inline-form-anticancer2"
                            placeholder="select Anticancer" disabled=true>
                    </div>

                    <div class="col-4">
                        <button id="btn_edit_Ant" type="button" class="btn btn-primary">Edit</button>
                        <button id="btn_update_Ant" type="button" class="btn btn-primary">Save</button>

                        <button type="button" id="btn_cancle_Ant" class="btn btn-secondary">Cancle</button>
                        <button type="button" id="btn_delete_Ant" class="btn btn-danger">Delete</button>
                    </div>
                </form>
                <div class="alert alert-success drugAdd">
                    <strong>Success!</strong> add new data success.
                </div>
                <div class="alert alert-success drugEdit">
                    <strong>Success!</strong> Update new data success.
                </div>
            </div>



        </div>
        <div class="row justify-content-center align-items-center h-100 my-5">
            <div class="col-sm-8 ">
                <h5 class="d-flex">Manage herb</h5>

                <div>New Herb</div>

                <form class="row py-2" id="formHerb">
                    <div class="col-9">

                        <input type="text" class="form-control" id="inline-form-herb" placeholder="Herb"
                            name="otherdrugname">
                    </div>

                    <div class="col-3">
                        <button type="button" id="btnInsertHerb" class="btn btn-primary">Insert Herb</button>
                    </div>
                </form>
                <div class="col py-2">Edit Herb</div>
                <div class="col-12 py-2">
                    <div class="ui-widget">

                        <div class="ui-widget">

                            <select class="form-select" id="js__apply_now2">
                                <script>
                                var htmls = '';
                                $.ajax({
                                    url: '<?php echo ($API_url); ?>/api/otherdrug/read.php',
                                    data: {},
                                    type: 'get',
                                    success: function(result) {
                                        // console.log(result)
                                        const otherdrug = result.otherdrug;
                                        console.log(otherdrug);



                                        otherdrug.forEach((element, index, array) => {

                                            htmls += '<option value=' + element.id + ' id=' +
                                                element.id + '>' + element.otherdrugname +
                                                '</option>';

                                        });

                                    },
                                    async: false
                                });

                                document.write(htmls);
                                </script>

                            </select>
                        </div>

                    </div>
                    <form class="row  py-2" id="formHerb">

                        <div class="col-8">

                            <input type="text" class="form-control" id="inline-form-herb2" placeholder="Herb"
                                disabled=true>
                        </div>

                        <div class="col-4">
                            <button id="btn_edit_Herb" type="button" class="btn btn-primary">Edit</button>
                            <button id="btn_update_Herb" type="button" class="btn btn-primary">Save</button>

                            <button type="button" id="btn_cancle_Herb" class="btn btn-secondary">Cancle</button>
                            <button type="button" id="btn_delete_Herb" class="btn btn-danger">Delete</button>

                        </div>
                    </form>



                </div>
                <div class="alert alert-success herbAdd">
                    <strong>Success!</strong> add new data success.
                </div>
                <div class="alert alert-success herbEdit">
                    <strong>Success!</strong> Update new data success.
                </div>
            </div>
            <div class="row justify-content-center align-items-center h-100 my-5">
                <div class="col-sm-8 ">

                    <h5 class="d-flex">Manage Anticancer and Herb</h5>
                    <div class="row">
                        <div class="col-8">
                            <div class="ui-widget">
                                <span> Anticancer</span>
                                <select class="form-select" id="js__apply_now3">
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

                                                htmls += '<option value=' + element.id + ' id=' +
                                                    element.id + '>' + element.drugname +
                                                    '</option>';
                                            });

                                        },
                                        async: false
                                    });

                                    document.write(htmls);
                                    </script>

                                </select>
                            </div>

                            <div class="col py-2 ">
                                <div class="ui-widget">
                                    <span> Herb</span>
                                    <select class="form-select" id="js__apply_now4">
                                        <script>
                                        var htmls = '';
                                        $.ajax({
                                            url: '<?php echo ($API_url); ?>/api/otherdrug/read.php',
                                            data: {},
                                            type: 'get',
                                            success: function(result) {
                                                // console.log(result)
                                                const otherdrug = result.otherdrug;
                                                console.log(otherdrug);



                                                otherdrug.forEach((element, index, array) => {

                                                    htmls += '<option value=' + element.id +
                                                        ' id=' + element.id + '>' + element
                                                        .otherdrugname + '</option>';

                                                });

                                            },
                                            async: false
                                        });

                                        document.write(htmls);
                                        </script>

                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="col-4 ">
                            <div class="d-flex  justify-content-center align-items-center " style="height:150px;">

                                <button id="btn_serach_all" type="button" class="btn btn-primary  ">Search</button>
                            </div>

                        </div>
                    </div>

                    <form class="w-100 py-2" id="formAnticancer">

                        <div class="col">
                            <div class="alert alert-success intAdd">
                                <strong>Success!</strong> add new data success.
                            </div>
                            <div class="alert alert-success intEdit">
                                <strong>Success!</strong> Update new data success.
                            </div>
                            <div class="p-2 mb-2  text-white" id="textinsert">Add New record</div>
                            <div class="mb-3">
                                <label for="summary" class="form-label">summary</label>
                                <textarea name="summary" class="form-control" id="summary" cols="20" rows="2"
                                    aria-describedby="summary" disabled></textarea>

                            </div>
                            <div class="mb-3">
                                <label for="severity" class="form-label">severity</label>
                                <textarea name="severity" class="form-control" id="severity" cols="20" rows="2"
                                    aria-describedby="severity" disabled></textarea>

                            </div>
                            <div class="mb-3">
                                <label for="documentation" class="form-label">documentation</label>
                                <textarea name="documentation" class="form-control" id="documentation" cols="20"
                                    rows="2" aria-describedby="documentation" disabled></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="clarification" class="form-label">clarification</label>
                                <textarea name="clarification" class="form-control" id="clarification" cols="20"
                                    rows="2" aria-describedby="clarification" disabled></textarea>

                            </div>
                            <div class="mb-3">
                                <label for="reference" class="form-label">reference</label>
                                <textarea name="reference" class="form-control" id="reference" cols="20" rows="2"
                                    aria-describedby="reference" disabled></textarea>
                            </div>
                            <div class="text-center ">

                                <button id="btn_edit_all" type="button" class="btn btn-primary">Edit</button>
                                <button id="btn_update_all" type="button" class="btn btn-primary">Save</button>
                                <button id="btn_insert_all" type="button" class="btn btn-primary">Save</button>
                                <button type="button" id="btn_cancle_all" class="btn btn-secondary">Cancle</button>
                                <button type="button" id="btn_delete_all" class="btn btn-danger">Delete</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>



</body>

</html>