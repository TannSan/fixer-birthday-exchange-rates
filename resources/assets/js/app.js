$('#datetimepicker').datetimepicker({
    inline: true,
    format: 'L',
    minDate: moment().subtract(1, 'year'),
    maxDate: moment(),
    date: moment()
});

$("button#btn_exchange_rate").click(function () {
    const birthday = $("#datetimepicker").datetimepicker('date');
    const birthday_short = birthday.format("YYYY-MM-DD");
    const tbody = $("tbody#rates");
    $.ajax({
        method: 'GET',
        url: '/' + birthday_short,
        headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]') }
    }).done(function (json_response) {
        if (json_response.success) {
            const empty_row = $("tr#empty-row", tbody);
            if (empty_row.length)
                empty_row.remove();

            // Search for a matching record and increment its duplicate count or create a new row
            const table_cell = $("td[data-date='" + birthday_short + "']", tbody);
            if (table_cell.length) {
                const badge = $("span.badge", table_cell);
                if (badge.length)
                    $("span.badge", table_cell).text(json_response.search_count);
                else
                    table_cell.append(' <span class="badge badge-success">' + json_response.search_count + '</span>');
            }
            else {
                // Loop through table and find the correct place to insert the new row based on the date
                let inserted = false;
                $("tbody#rates tr td:first-child").each(function () {
                    if (new Date(birthday_short).getTime() > new Date($(this).attr("data-date")).getTime()) {
                        inserted = true;
                        $(this).parent().before('<tr><td data-date="' + birthday_short + '">' + birthday.format('Do MMMM YYYY') + (json_response.search_count > 1 ? ' <span class="badge badge-success">' + json_response.search_count + '</span>' : '') + '</td><td class="text-right">' + json_response.exchange_rate + '</td></tr>');
                        return false;
                    }
                });
                if (!inserted)
                    tbody.append('<tr><td data-date="' + birthday_short + '">' + birthday.format('Do MMMM YYYY') + (json_response.search_count > 1 ? ' <span class="badge badge-success">' + json_response.search_count + '</span>' : '') + '</td><td class="text-right">' + json_response.exchange_rate + '</td></tr>');
            }

            const success_notification = new hullabaloo();
            success_notification.options.align = 'center';
            success_notification.options.width = 320;
            success_notification.send("Exchange rate retrieved!<br /><br />" + birthday.format('Do MMMM YYYY') + " - " + json_response.exchange_rate, "success");
        }
        else {
            const error_notification = new hullabaloo();
            error_notification.options.align = 'center';
            error_notification.options.width = 320;
            error_notification.send("Error: " + json_response.error.info, "danger");
        }
    });
});