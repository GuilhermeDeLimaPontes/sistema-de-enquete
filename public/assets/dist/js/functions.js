var max_fields = 10;
var contador = 1;

$("#addField").click(function () {
    if (contador < max_fields) {
        contador++;
        $("#form").append(
            '<div class="form-group mb-3"><label for="answers" class="form-label">Resposta ' +
            contador + '</label><input type="text" class="form-control @error("answers[]") is-invalid @enderror" name="answers[]" required></div>'
        );
    }
});

function copyLink()
{
  var copyText = document.getElementById("link");
  copyText.select();
  copyText.setSelectionRange(0, 99999); 
  navigator.clipboard.writeText(copyText.value);

  $(document).ready(function() {
    $("#buttonCopy").attr("class", "btn btn-success mt-2");
 });
}
