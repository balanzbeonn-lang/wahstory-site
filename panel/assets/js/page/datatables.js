"use strict";

$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data("checkboxes"),
    role = me.data("checkbox-role");

  me.change(function () {
    var all = $(
        '[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'
      ),
      checked = $(
        '[data-checkboxes="' +
          group +
          '"]:not([data-checkbox-role="dad"]):checked'
      ),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if (role == "dad") {
      if (me.is(":checked")) {
        all.prop("checked", true);
      } else {
        all.prop("checked", false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop("checked", true);
      } else {
        dad.prop("checked", false);
      }
    }
  });
});

$("#table-1").dataTable({
  columnDefs: [{ sortable: false, targets: [6, 9] }],
  order: [[8, "desc"]]
});

$("#table-2").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]]
});

$("#table-3").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-4").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-5").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-6").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-7").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-8").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
  order: [[8, "desc"]],
});

$("#table-9").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
   order: [[8, "desc"]]
});

$("#table-10").dataTable({
  columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
   order: [[8, "desc"]]
});

$("#total_views").dataTable({
  columnDefs: [{ sortable: true, targets: [0, 2, 3] }],
  order: [
    [7, "desc"]
  ],
});

$("#total_likes").dataTable({
  columnDefs: [{ sortable: true, targets: [0, 2, 3] }],
  order: [[7, "desc"]],
});
$("#total_reactions").dataTable({
  columnDefs: [{ sortable: true, targets: [0, 2, 3] }],
  order: [[7, "desc"]],
});

$("#save-stage").DataTable({
  scrollX: true,

  stateSave: true,
});

$("#tableExport").DataTable({
  dom: "Bfrtip",

  buttons: ["copy", "csv", "excel", "pdf", "print"],
});
