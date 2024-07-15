/*

Website: https://example.com
Contact: Example@gmail.com
File: Form editor Classic Js File
*/

// ckeditor Classic
var ckClassicEditor = document.querySelectorAll(".ckeditor-classic");
if (ckClassicEditor) {
  Array.from(ckClassicEditor).forEach(function () {
    ClassicEditor.create(document.querySelector(".ckeditor-classic")).catch(
      function (error) {
        console.error(error);
      }
    );
  });
}
