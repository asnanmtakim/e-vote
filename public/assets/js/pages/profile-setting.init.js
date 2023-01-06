// document.querySelector("#profile-foreground-img-file-input") &&
//    document.querySelector("#profile-foreground-img-file-input").addEventListener("change", function () {
//       var o = document.querySelector(".profile-wid-img"),
//          e = document.querySelector(".profile-foreground-img-file-input").files[0],
//          i = new FileReader();
//       i.addEventListener(
//          "load",
//          function () {
//             o.src = i.result;
//          },
//          !1
//       ),
//          e && i.readAsDataURL(e);
//    });

// document.querySelector("#profile-img-file-input") &&
//    document.querySelector("#profile-img-file-input").addEventListener("change", function () {
//       var o = document.querySelector(".user-profile-image"),
//          e = document.querySelector(".profile-img-file-input").files[0],
//          i = new FileReader();
//       i.addEventListener(
//          "load",
//          function () {
//             o.src = i.result;
//          },
//          !1
//       ),
//          e && i.readAsDataURL(e);
//    });
function new_link() {
   count++;
   var o = document.createElement("div"),
      e =
         '<div class="row"><div class="col-lg-12"><div class="mb-3"><label for="organisasi" class="form-label">Nama Organisasi atau Perusahaan</label><input type="text" class="form-control" id="organisasi" name="organisasi[]" placeholder="Nama Organisasi atau Perusahaan"></div></div><div class="col-lg-5"><div class="mb-3"><label for="jabatan" class="form-label">Jabatan</label><input type="text" class="form-control" id="jabatan" name="jabatan[]" placeholder="Jabatan"></div></div><div class="col-lg-7"><div class="mb-3"><label class="form-label">Periode</label><div class="row"><div class="col"><input type="text" class="form-control periode-pengalaman" id="tahun1" name="tahun1[]" placeholder="Periode Awal"></div><div class="col-1 align-self-center text-center">-</div><div class="col"><input type="text" class="form-control periode-pengalaman" id="tahun2" name="tahun2[]" placeholder="Periode Akhir"></div></div></div></div><div class="col-lg-12"><div class="mb-3"><label for="deskripsi" class="form-label">Deskripsi</label><textarea class="form-control" id="deskripsi" name="deskripsi[]" rows="3" placeholder="Deskripsi"></textarea></div></div><div class="hstack gap-2 justify-content-end"><a class="btn btn-success" href="javascript:deleteEl(' +
         (o.id = count) +
         ')">Delete</a></div></div>',
      e = ((o.innerHTML = document.getElementById("newForm").innerHTML + e), document.getElementById("newlink").appendChild(o), document.querySelectorAll("[data-trigger]"));
   Array.from(e).forEach(function (o) {
      new Choices(o, { placeholderValue: "This is a placeholder set in the config", searchPlaceholderValue: "This is a search placeholder", searchEnabled: !1 });
   });
   $(".periode-pengalaman").flatpickr({
      plugins: [
         new monthSelectPlugin({
            shorthand: true, //defaults to false
            dateFormat: "F Y", //defaults to "F Y"
            altFormat: "F Y", //defaults to "F Y"
         }),
      ],
   });
}
function deleteEl(o) {
   o = (d = document).getElementById(o);
   d.getElementById("newlink").removeChild(o);
}

$(".periode-pengalaman").flatpickr({
   plugins: [
      new monthSelectPlugin({
         shorthand: true, //defaults to false
         dateFormat: "F Y", //defaults to "F Y"
         altFormat: "F Y", //defaults to "F Y"
      }),
   ],
});

ClassicEditor.create(document.querySelector("#biografi"), {
   toolbar: ["bold", "italic", "link", "undo", "redo", "numberedList", "bulletedList"],
}).catch((error) => {
   console.log(error);
});

$("select#fakultas").on("change", function () {
   let value = $(this).val();
   getProdi(value);
});

var selectProdi;
function getProdi(id_fakultas, id_prodi = null) {
   selectProdi.destroy();
   $.ajax({
      type: "POST",
      url: BASE_URL + "/prodi-fakultas",
      data: {
         id_fakultas: id_fakultas,
      },
      dataType: "json",
      success: function (res) {
         if (res.status == 200) {
            $("select#prodi").html("");
            let list = `<option value="">--Pilih Prodi--</option>`;
            $.each(res.data, function (i, val) {
               let selected = "";
               if (id_prodi != null) {
                  if (id_prodi == val.id_prodi) {
                     selected = "selected";
                  } else {
                     selected = "";
                  }
               }
               list += `<option value="` + val.id_prodi + `" ` + selected + `>` + val.nama_prodi + `</option>`;
            });
            // console.log(list);
            $("select#prodi").html(list);
            selectProdi = new Choices("select#prodi");
         }
      },
   });
}

$("select#provinsi").on("change", function () {
   let value = $(this).val();
   getKota(value);
});
$("select#kota").on("change", function () {
   let value = $(this).val();
   console.log(value);
   getKecamatan(value);
});
$("select#kecamatan").on("change", function () {
   let value = $(this).val();
   getDesa(value);
});

var wilayah;
var selectKota;
var selectKecamatan;
var selectDesa;
function getKota(id_prov, id_kota = null) {
   selectKota.destroy();
   selectKecamatan.destroy();
   selectDesa.destroy();
   $("select#kecamatan").html('<option value="">--Pilih Kecamatan--</option>');
   $("select#desa").html('<option value="">--Pilih Desa/Kelurahan--</option>');
   selectKecamatan = new Choices("select#kecamatan");
   selectDesa = new Choices("select#desa");
   ajaxWilayah(id_prov, id_kota, function () {
      $("select#kota").html(wilayah);
      selectKota = new Choices("select#kota");
   });
}

function getKecamatan(id_kota, id_kec = null) {
   selectKecamatan.destroy();
   selectDesa.destroy();
   $("select#desa").html('<option value="">--Pilih Desa/Kelurahan--</option>');
   selectDesa = new Choices("select#desa");
   ajaxWilayah(id_kota, id_kec, function () {
      $("select#kecamatan").html(wilayah);
      selectKecamatan = new Choices("select#kecamatan");
   });
}

function getDesa(id_kec, id_desa = null) {
   selectDesa.destroy();
   ajaxWilayah(id_kec, id_desa, function () {
      $("select#desa").html(wilayah);
      selectDesa = new Choices("select#desa");
   });
}

function ajaxWilayah(id, id_left = null, callback) {
   $.ajax({
      type: "POST",
      url: BASE_URL + "/wilayah-ajax",
      data: {
         id: id,
      },
      dataType: "json",
      success: function (res) {
         if (res.status == 200) {
            let list = `<option value="">--Pilih ` + res.data.wil + `--</option>`;
            $.each(res.data.wilayah, function (i, val) {
               let selected = "";
               if (id_left != null) {
                  if (id_left == val.kode) {
                     selected = "selected";
                  } else {
                     selected = "";
                  }
               }
               list += `<option value="` + val.kode + `" ` + selected + `>` + val.nama + `</option>`;
            });
            wilayah = list;
            callback();
         }
      },
   });
}

var image_user;
var image_cover;
var myModal = new bootstrap.Modal(document.getElementById("cropImage"));
var myModal2 = new bootstrap.Modal(document.getElementById("cropImage2"));
var image = document.getElementById("image-crop-upload");
var image2 = document.getElementById("image2-crop-upload");
var cropper = null;
var cropper2 = null;

// image user
$("#image_user").change(function (event) {
   var files = event.target.files;

   var done = function (url) {
      image.src = url;
      myModal.show();
   };

   if (files && files.length > 0) {
      reader = new FileReader();
      reader.onload = function (event) {
         done(reader.result);
      };
      reader.readAsDataURL(files[0]);
   }
});

const myModalEl = document.getElementById("cropImage");
myModalEl.addEventListener("shown.bs.modal", function () {
   cropper = new Cropper(image, {
      aspectRatio: 1 / 1,
      viewMode: 1,
      preview: ".preview-cropper",
   });
});
myModalEl.addEventListener("hidden.bs.modal", function () {
   cropper.destroy();
   cropper = null;
});

$("#crop-save").click(function () {
   canvas = cropper.getCroppedCanvas({
      width: 325,
      height: 325,
   });

   $("#user-profile-image").attr("src", canvas.toDataURL());
   image_user = canvas.toDataURL();
   $("#loading-ajax").show();
   myModal.hide();
   $.ajax({
      type: "POST",
      url: BASE_URL + "/dashboard/profile/edit-image-user",
      data: {
         image_user: image_user,
      },
      dataType: "json",
      success: function (res) {
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
      },
      complete: function () {
         $("#loading-ajax").hide();
      },
   });
});

// image cover
$("#image_cover").change(function (event) {
   var files = event.target.files;

   var done = function (url) {
      image2.src = url;
      myModal2.show();
   };

   if (files && files.length > 0) {
      reader = new FileReader();
      reader.onload = function (event) {
         done(reader.result);
      };
      reader.readAsDataURL(files[0]);
   }
});

const myModalEl2 = document.getElementById("cropImage2");
myModalEl2.addEventListener("shown.bs.modal", function () {
   cropper2 = new Cropper(image2, {
      aspectRatio: 5 / 2,
      viewMode: 1,
      preview: ".preview-cropper2",
   });
});
myModalEl2.addEventListener("hidden.bs.modal", function () {
   cropper2.destroy();
   cropper2 = null;
});

$("#crop-save2").click(function () {
   canvas = cropper2.getCroppedCanvas({
      width: 1000,
      height: 400,
   });

   $("#cover-img").attr("src", canvas.toDataURL());
   image_cover = canvas.toDataURL();
   myModal2.hide();
   $.ajax({
      type: "POST",
      url: BASE_URL + "/dashboard/profile/edit-image-cover",
      data: {
         image_cover: image_cover,
      },
      dataType: "json",
      success: function (res) {
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
      },
      complete: function () {
         $("#loading-ajax").hide();
      },
   });
});

$("form#form-portfolio").submit(function (e) {
   e.preventDefault();
   var formData = $(this).serialize();
   $.ajax({
      url: $(this).attr("action"),
      data: formData,
      type: $(this).attr("method"),
      success: function (res) {
         res = JSON.parse(res);
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
                        .closest(".form-group")
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

$("form#form-personal").submit(function (e) {
   e.preventDefault();
   var formData = $(this).serialize();
   $.ajax({
      url: $(this).attr("action"),
      data: formData,
      type: $(this).attr("method"),
      success: function (res) {
         res = JSON.parse(res);
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
                        .closest(".form-group")
                        .append(app);
                     $("form #" + el)
                        .closest(".input-group")
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

$("form#form-pengalaman").submit(function (e) {
   e.preventDefault();
   var formData = $(this).serialize();
   $.ajax({
      url: $(this).attr("action"),
      data: formData,
      type: $(this).attr("method"),
      success: function (res) {
         res = JSON.parse(res);
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
                        .closest(".form-group")
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

$("form#form-password").submit(function (e) {
   e.preventDefault();
   var formData = $(this).serialize();
   $.ajax({
      url: $(this).attr("action"),
      data: formData,
      type: $(this).attr("method"),
      success: function (res) {
         res = JSON.parse(res);
         if (res.status == 200) {
            Swal.fire({
               title: "Sukses",
               text: res.pesan,
               icon: "success",
               confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
               buttonsStyling: !1,
            }).then(function () {
               location.reload();
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
