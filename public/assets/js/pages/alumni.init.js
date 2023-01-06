var tbAlumni;
var selectProdi;
const resetPWModal = new bootstrap.Modal(document.getElementById("resetPWModal"));
$(document).ready(function () {
   selectProdi = new Choices("select#select_prodi");
   if ($("select#select_fakultas").val() != "") {
      getProdi($("select#select_fakultas").val());
   }
   tbAlumni = $("#tb-data-alumni").DataTable({
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
                  return "Detail Alumni " + data.first_name;
               },
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
               tableClass: "table",
            }),
         },
      },
      fixedHeader: !0,
      ajax: {
         url: BASE_URL + "/dashboard/alumni-all",
         data: function (req) {
            req.fakultas = $("#select_fakultas").val();
            req.prodi = $("#select_prodi").val();
            req.tahun_lulus = $("#select_tahun_lulus").val();
            req.status = $("#select_status").val();
         },
      },
      order: [],
      columns: [
         {
            data: "no",
            orderable: false,
         },
         {
            data: "first_name",
         },
         {
            data: "gender",
         },
         {
            data: "phone_number",
         },
         {
            data: "tahun_lulus",
         },
         {
            data: "nama_fakultas",
         },
         {
            data: "nama_prodi",
         },
         {
            data: "image_user",
         },
         {
            data: "status",
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

$("#select_fakultas").change(function (event) {
   var id = $(this).val();
   var name = "fakultas";
   getProdi(id);
   setSess(name, id).done(function (res) {
      tbAlumni.ajax.reload();
   });
});
$("#select_prodi").change(function (event) {
   tbAlumni.ajax.reload();
});
$("#select_tahun_lulus").change(function (event) {
   var id = $(this).val();
   var name = "tahun_lulus";
   setSess(name, id).done(function (res) {
      tbAlumni.ajax.reload();
   });
});
$("#select_status").change(function (event) {
   var id = $(this).val();
   var name = "status";
   setSess(name, id).done(function (res) {
      tbAlumni.ajax.reload();
   });
});

function getProdi(id_fakultas) {
   selectProdi.destroy();
   if (id_fakultas == "") {
      let list = `<option value="" selected>Semua Prodi</option>`;
      $("select#select_prodi").html(list);
      selectProdi = new Choices("select#select_prodi");
   } else {
      $.ajax({
         type: "POST",
         url: BASE_URL + "/prodi-fakultas",
         data: {
            id_fakultas: id_fakultas,
         },
         dataType: "json",
         success: function (res) {
            if (res.status == 200) {
               $("select#select_prodi").html("");
               let list = `<option value="">Semua Prodi</option>`;
               $.each(res.data, function (i, val) {
                  list += `<option value="` + val.id_prodi + `">` + val.nama_prodi + `</option>`;
               });
               // console.log(list);
               $("select#select_prodi").html(list);
               selectProdi = new Choices("select#select_prodi");
            }
         },
      });
   }
}

$(document)
   .off("click", "button.reset-pw")
   .on("click", "button.reset-pw", function (e) {
      e.preventDefault();
      let id = $(this).attr("data-id");
      let name = $(this).attr("data-name");
      $("#resetPWModal .modal-title").html("Reset Password for " + name);
      $("#form-reset-pw input[name=user_id]").val(id);
      $("#form-reset-pw input[name=new_password]").val("");
      resetPWModal.show();
   });

$("form#form-reset-pw").submit(function (e) {
   e.preventDefault();
   var formData = $(this).serialize();
   var action = $(this).attr("action");
   var method = $(this).attr("method");
   $.ajax({
      url: action,
      data: formData,
      type: method,
      success: function (res) {
         res = JSON.parse(res);
         if (res.status == 200) {
            Swal.fire({
               title: "Yakin Reset Password?",
               text: "Reset dan ganti password untuk " + res.data.name + "!",
               icon: "warning",
               showCancelButton: !0,
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               cancelButtonClass: "btn btn-danger w-xs mt-2",
               confirmButtonText: "Ya, reset!",
               buttonsStyling: !1,
               showCloseButton: !0,
            }).then(function (t) {
               t.value &&
                  $.ajax({
                     type: method,
                     url: action,
                     data: formData + "&confirm=OK",
                     success: function (response) {
                        response = JSON.parse(response);
                        if (response.status == 200) {
                           Swal.fire({
                              title: "Sukses",
                              text: response.pesan,
                              icon: "success",
                              confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                              buttonsStyling: !1,
                           }).then(function () {
                              resetPWModal.hide();
                              tbUsers.ajax.reload();
                           });
                        } else {
                           Swal.fire({
                              title: "Error",
                              text: response.pesan,
                              icon: "error",
                              confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                              buttonsStyling: !1,
                           });
                        }
                     },
                  });
            });
         } else {
            if (res.status == 400) {
               Toastify({
                  text: "Form inputan tidak valid",
                  duration: 3000,
                  className: "bg-danger",
               }).showToast();
               var frm = Object.keys(res.pesan);
               var val = Object.values(res.pesan);
               $("form .invalid-feedback").remove();
               frm.forEach(function (el, ind) {
                  if (val[ind] != "") {
                     $("form #" + el)
                        .removeClass("is-invalid")
                        .addClass("is-invalid");
                     var app = '<div id="' + el + '-error" class="invalid-feedback" for="' + el + '">' + val[ind] + "</div>";
                     $("form #" + el)
                        .closest(".auth-pass-inputgroup")
                        .append(app);
                  } else {
                     $("form #" + el).removeClass("is-invalid");
                  }
               });
            } else {
               Swal.fire({
                  title: "Error",
                  text: res.pesan,
                  icon: "error",
                  confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                  buttonsStyling: !1,
               });
            }
         }
      },
   });
});
