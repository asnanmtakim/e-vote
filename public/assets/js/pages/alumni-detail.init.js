$("form#form-status").submit(function (e) {
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
               $("form .error-validation").remove();
               frm.forEach(function (el, ind) {
                  if (val[ind] != "") {
                     $("form #" + el)
                        .removeClass("is-invalid")
                        .addClass("is-invalid");
                     var app = '<div id="' + el + '-error" class="error-validation" for="' + el + '">' + val[ind] + "</div>";
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
