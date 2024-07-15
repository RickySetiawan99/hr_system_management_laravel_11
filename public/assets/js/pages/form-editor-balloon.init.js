/*

Website: https://example.com
Contact: Example@gmail.com
File: Form editor balloon Js File
*/

var ckClassicEditor = document.querySelectorAll(".ckeditor-balloon");
if (ckClassicEditor) {
  Array.from(ckClassicEditor).forEach(function () {
    BalloonEditor.create(document.querySelector(".ckeditor-balloon")).catch(
      function (error) {
        console.error(error);
      }
    );
  });
}
