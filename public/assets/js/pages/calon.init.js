var tbUsers;
$(document).ready(function () {
   tbUsers = $("#tb-data-calon").DataTable({
      dom: "<'row'<'col-sm-12 col-md-6'<'row'<'col-2'l><'col'B>>><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: ["copy", "csv", "excel", "print"],
      processing: true,
      language: table_language(),
      lengthMenu: [
         [10, 25, 50, 75, 100, -1],
         [10, 25, 50, 75, 100, "All"],
      ],
      serverSide: true,
      autoWidth: false,
      responsive: {
         details: {
            display: $.fn.dataTable.Responsive.display.modal({
               header: function (row) {
                  var data = row.data();
                  return "Detail Calon " + data.nama_calon;
               },
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
               tableClass: "table",
            }),
         },
      },
      fixedHeader: !0,
      ajax: {
         url: BASE_URL + "/dashboard/calon-all",
         data: function (req) {
            req.gender = $("#select_gender").val();
         },
      },
      order: [],
      columns: [
         {
            data: "no",
            orderable: false,
         },
         {
            data: "nama_calon",
         },
         {
            data: "gender_calon",
         },
         {
            data: "foto_calon",
         },
         {
            data: "action",
            orderable: false,
         },
      ],
   });
});

$(document)
   .off("click", ".image-link")
   .on("click", ".image-link", function (e) {
      e.preventDefault();
      $(this)
         .magnificPopup({
            type: "image",
            mainClass: "mfp-with-zoom", // this class is for CSS animation below

            zoom: {
               enabled: true, // By default it's false, so don't forget to enable it
               duration: 300, // duration of the effect, in milliseconds
               easing: "ease-in-out", // CSS transition easing function
               opener: function (openerElement) {
                  return openerElement.is("img") ? openerElement : openerElement.find("img");
               },
            },
         })
         .magnificPopup("open");
   });

$("#select_gender").change(function (event) {
   var id = $(this).val();
   var name = "gender";
   setSess(name, id).done(function (res) {
      tbUsers.ajax.reload();
   });
});

$(document)
   .off("click", "button.delete-calon")
   .on("click", "button.delete-calon", function (e) {
      e.preventDefault();
      let id = $(this).attr("data-id");
      let name = $(this).attr("data-name");
      Swal.fire({
         html:
            '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Yakin hapus data ?</h4><p class="text-muted mx-4 mb-0">Hapus data calon ' +
            name +
            ", data yang dihapus tidak bisa dikembalikan!</p></div></div>",
         showCancelButton: !0,
         confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
         confirmButtonText: "Yes, Hapus!",
         cancelButtonClass: "btn btn-danger w-xs mb-1",
         buttonsStyling: !1,
         showCloseButton: !0,
      }).then(function (t) {
         t.value &&
            $.ajax({
               type: "POST",
               url: BASE_URL + "/dashboard/calon/delete",
               data: {
                  id: id,
               },
               dataType: "json",
               success: function (res) {
                  if (res.status == 200) {
                     Swal.fire({
                        title: "Berhasil!",
                        text: res.pesan,
                        icon: "success",
                        confirmButtonClass: "btn btn-primary w-xs mt-2",
                        buttonsStyling: !1,
                     }).then(() => {
                        tbUsers.ajax.reload();
                     });
                  } else {
                     Swal.fire({
                        title: "Error",
                        text: res.pesan,
                        icon: "error",
                        confirmButtonClass: "btn btn-primary w-xs mt-2",
                        buttonsStyling: false,
                     });
                  }
               },
            });
      });
   });
// t.value && Swal.fire({ title: "Deleted!", text: "Your file has been deleted.", icon: "success", confirmButtonClass: "btn btn-primary w-xs mt-2", buttonsStyling: !1 });
