const rand = () => Math.random(0).toString(36).substr(2);
const token = (length) => (rand() + rand() + rand() + rand()).substr(0, length);

function getToken() {
   $("#username").val(token(6));
}

var image_user;
var myModal = new bootstrap.Modal(document.getElementById("cropImage"));
var image = document.getElementById("image-crop-upload");
var cropper = null;

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

   $("#image-user-show").attr("src", canvas.toDataURL());
   myModal.hide();
   image_user = canvas.toDataURL();
});

$(document).ready(function () {
   $("form").submit(function (e) {
      e.preventDefault();
      var formData = $(this).serialize() + "&image_user=" + image_user;
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
                  confirmButtonClass: "btn btn-info",
                  buttonsStyling: false,
               }).then(function () {
                  location.href = "/dashboard/pemilih";
               });
            } else {
               if (res.status == 400) {
                  var frm = Object.keys(res.pesan);
                  var val = Object.values(res.pesan);
                  $("form .invalid-feedback").remove();
                  $("form .error-validation").remove();
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
                        if (el == "gender") {
                           var app = '<div id="' + el + '-error" class="error-validation" for="' + el + '">' + val[ind] + "</div>";
                           $("form #gender-form").closest(".form-group").append(app);
                        }
                     } else {
                        $("form #" + el).removeClass("is-invalid");
                     }
                  });
               } else {
                  Swal.fire({
                     title: "Error",
                     text: res.pesan,
                     icon: "error",
                     confirmButtonClass: "btn btn-danger",
                     buttonsStyling: false,
                  });
               }
            }
         },
      });
      return false;
   });
});
