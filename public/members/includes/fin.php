<?php

    echo "<script>";
    foreach ($members as $member) {
        echo "devs.push(" . json_encode($member) . ");";
    }
    echo "console.log(devs);";
    echo "</script>";

?>

<script>
    // cache elements
    let body  = $('body');
    let left  = $('.left');
    let right = $('.right');

    // generate member list
    let list = "<h5><code class='text-success'>Members:</code></h5>";
    list += "<ul class='list-group'>";
    devs.forEach(function(dev, index) {
        list += "<li class='list-group-item member' data-index='" + index.toString() + "' style='cursor: pointer;'>" + (index + 1).toString() + ". " + dev.first_name + " " + dev.last_name + "</li>"
    });
    list += "</ul>";
    left.html(list);

    // handle member list-item click
    left.delegate('.member', 'click', function() {
        if(!$(this).hasClass('active')) {
            let parent = $(this).parent();
            parent.find('.list-group-item.active').removeClass('active');
            $(this).addClass('active');
            showMemberInfo($(this).attr('data-index'));
        }
    });

    // show member information
    function showMemberInfo(index) {
        let info = "";
        if(index >= devs.length)
            info += "<div class='alert alert-danger'>MEMBER NOT FOUND</div>";
        else {
            let dev = devs[index];
            info += "<div align='center'>";
            info += "<div style='position: relative; width: 150px; height: 150px; overflow: hidden; border-radius: 50%'>";
            info += "<img src='" + dev.github.avatar + "' style='position: absolute; left: 0; right: 0; width: 100%;'>";
            info += "</div>";

            info += "<h2 class='mt-3'>" + dev.first_name + " " + dev.last_name + "</h2>";
            info += "<h5>@" + dev.github.username + "</h5>";
            info += "</div>";

            info += "<table class='table table-hover table-bordered mt-3'>";
            info += "<tr>";
            info += "<th style='width: 30%;'>First Name</th>";
            info += "<td>" + dev.first_name + "</td>";
            info += "</tr>";
            info += "<tr>";
            info += "<th>Middle Name</th>";
            info += "<td>" + dev.middle_name + "</td>";
            info += "</tr>";
            info += "<tr>";
            info += "<th>Last Name</th>";
            info += "<td>" + dev.last_name + "</td>";
            info += "</tr>";
            info += "<tr>";
            info += "<th>Gender</th>";
            info += "<td>" + dev.gender + "</td>";
            info += "</tr>";
            info += "<tr>";
            info += "<th>Birthday</th>";
            info += "<td>" + dev.birth_date + "</td>";
            info += "</tr>";
            info += "</table>";

        }
        right.html(info);
    }

    // add theme class to body
    function addTheme() {
        if(localStorage.und3rgroundTheme != null) {
            body.removeClass('dark-mode');
            body.removeClass('light-mode');
            body.addClass(localStorage.und3rgroundTheme);
            if(localStorage.und3rgroundTheme === 'dark-mode')
                switchDarkMode[0].checked = true;
        }
    }

    let switchDarkMode = $('.switch-dark-mode');
    switchDarkMode.on('change', function() {
        if($(this)[0].checked)
            localStorage.und3rgroundTheme = 'dark-mode';
        else
            localStorage.und3rgroundTheme = 'light-mode';
        addTheme();
    });

    addTheme();
</script>
