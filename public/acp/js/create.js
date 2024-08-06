var quarters_count = 0;
var cases_count = 0;

function applyPacking() {
    var counter = quarters_count;
    if (quarters_count <= 20) {
        $('#truck2').css('display', 'none');
        $('#truck3').css('display', 'none');
    } else if (quarters_count <= 40) {
        $('#truck2').css('display', 'block');
        $('#truck3').css('display', 'none');
    } else if (quarters_count <= 60) {
        $('#truck2').css('display', 'block');
        $('#truck3').css('display', 'block');
    }
    for (var c = 0; c < 5; c++) {
        for (var r = 0; r < 12; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', 'white');
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 0; r < 4 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#54B0D6');
            counter--;
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 4; r < 8 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#54B0D6');
            counter--;
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 8; r < 12 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#54B0D6');
            counter--;
        }
    }
}

/*

function applyPacking() {
    var counter = quarters_count;

    for (var c = 0; c < 5; c++) {
        for (var r = 0; r < 12; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', 'white');
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 0; r < 4 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#f1b44d');
            counter--;
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 4; r < 8 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#f1b44d');
            counter--;
        }
    }
    for (var c = 0; c < 5 && counter > 0; c++) {
        for (var r = 8; r < 12 && counter > 0; r++) {
            var cell = $('td[truck-row="' + r + '"][truck-col="' + c + '"]');
            cell.css('background-color', '#f1b44d');
            counter--;
        }
    }
}

*/
function oneRoom(e) {
    var checked = false;
    checked = $(e.target).prop('checked');
    if (checked)
        quarters_count += 4;
    else
        quarters_count -= 4;

    applyPacking();
}

function halfRoom(e) {
    var checked = false;
    checked = $(e.target).prop('checked');
    if (checked) {
        quarters_count += 2;
    } else {
        quarters_count -= 2;
    }


    applyPacking();
}

function quarterRoom(e) {
    var checked = false;
    checked = $(e.target).prop('checked');

    if (checked)
        quarters_count += 1;
    else
        quarters_count -= 1;

    applyPacking();
}

function onCasesChange(args) {
    var count = parseInt($(args.target).val());
    var ones = 0, remainder = 0, halfs = 0, quarters = 0, total = 0;
    ones = Math.floor(count / 30);
    remainder = count % 30;
    halfs = Math.floor(remainder / 15);
    remainder = remainder % 15;
    quarters = Math.floor(remainder / 7);
    remainder = remainder % 7;
    if (remainder > 0)
        quarters++;
    total = ones * 4 + halfs * 2 + quarters;
    quarters_count = quarters_count - cases_count + total;
    applyPacking();
    cases_count = total;
}


$(document).ready(function () {

    var count = 0, cases_text = "", cases = 0, cases_ones = 0, cases_halfs = 0;
    var cases_remainder = 0, cases_quarters = 0, cases_total = 0;

    /*$('input[name="bedroom"]').click(function (e) {
        if ($(this).prop("checked") == true) {
            halfRoom(e)
        }
    });*/

    $('input[name="load[bedroom]"]').click(halfRoom);
    $('input[name="load[bedroom_eka"]').click(halfRoom);
    $('input[name="load[kidroom]"]').click(halfRoom);
    $('input[name="load[dinnerroom]"]').click(quarterRoom);
    $('input[name="load[neesh]"]').click(quarterRoom);
    $('input[name="load[bofue]"]').click(quarterRoom);
    $('input[name="load[antreh]"]').click(oneRoom);
    $('input[name="load[salon]"]').click(oneRoom);
    $('input[name="load[living]"]').click(oneRoom);
    $('input[name="load[rokna]"]').click(oneRoom);
    $('input[name="load[kitchen]"]').click(halfRoom);
    $('input[name="load[office]"]').click(quarterRoom);
    $('input[name="load[library]"]').click(quarterRoom);
    $('input[name="load[fridge]"]').click(quarterRoom);
    $('input[name="load[deep_freezer]"]').click(quarterRoom);
    $('input[name="load[wacher]"]').click(quarterRoom);
    $('input[name="load[cocker]"]').click(quarterRoom);
    $('input[name="load[dish_wacher]"]').click(quarterRoom);
    $('input[name="load[condiner]"]').click(quarterRoom);
    $('input[name="load[nagaf]"]').click(quarterRoom);
    $('input[name="load[martb]"]').click(quarterRoom);
    $('input[name="load[shoser]"]').click(quarterRoom);
    $('input[name="load[cases]"]').change(onCasesChange);

    if ($('input[name="load[bedroom]"]').prop('checked'))
        count += 2;
    if ($('input[name="load[kidroom]"]').prop('checked'))
        count += 2;
    if ($('input[name="load[dinnerroom]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[neesh]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[bofue]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[antreh]"]').prop('checked'))
        count += 4;
    if ($('input[name="load[salon]"]').prop('checked'))
        count += 4;
    if ($('input[name="load[living]"]').prop('checked'))
        count += 4;
    if ($('input[name="load[rokna]"]').prop('checked'))
        count += 4;
    if ($('input[name="load[kitchen]"]').prop('checked'))
        count += 2;
    if ($('input[name="load[office]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[library]"]').prop('checked'))
        count += 1;
    cases_text = $('input[name="load[cases]"]').val();
    if (cases_text == '')
        cases = 0; else
        cases = parseInt(cases_text);
    cases_ones = Math.floor(cases / 30);
    cases_remainder = cases % 30;
    cases_halfs = Math.floor(cases_remainder / 15);
    cases_remainder = cases_remainder % 15;
    cases_quarters = Math.floor(cases_remainder / 7);
    cases_remainder = cases_remainder % 7;
    if (cases_remainder > 0)
        cases_quarters++;
    cases_total = cases_ones * 4 + cases_halfs * 2 + cases_quarters;
    count += cases_total;
    if ($('input[name="load[fridge]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[deep_freezer]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[wacher]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[cocker]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[dish_wacher]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[heater]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[tv]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[condiner]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[microwave]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[nagaf]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[carpet]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[martb]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[tables]"]').prop('checked'))
        count += 1;
    if ($('input[name="load[shoser]"]').prop('checked'))
        count += 1;


    console.log(count);
    quarters_count = count;
    applyPacking();

});


$("#switch2").click(function () {
    if ($(this).is(':checked')) {
        $(".car").removeAttr("disabled");
        $(".car").show();
    } else {
        $(".car").attr("disabled");
        $(".car").hide();

    }
});


$("#switch1").click(function () {
    if ($(this).is(':checked')) {
        $(".room").removeAttr("disabled");
        $(".room").show();
    } else {
        $(".room").attr("disabled");
        $(".room").hide();
    }
});

$("#switch7").click(function () {
    if ($(this).is(':checked')) {
        $(".winch_up").removeAttr("disabled");
        $(".winch_up").show();
    } else {
        $(".winch_up").attr("disabled");
        $(".winch_up").hide();
    }
});

$("#switch8").click( function () {
    if ($(this).is(':checked')) {
        $(".winch_down").removeAttr("disabled");
        $(".winch_down").show();
    } else {
        $(".winch_down").attr("disabled");
        $(".winch_down").hide();
    }
});
