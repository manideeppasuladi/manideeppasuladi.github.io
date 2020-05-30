    $(function() {
        $.getJSON('projects.json', function(data) {
            $.each(data.projects, function(i, p) {
                var tblRow = "<tr>" + "<td>" + p.title + p.details + p.description + p.link + "</td>" + "</tr>"
                $(tblRow).appendTo("#userdata tbody");
            });

        });

    });