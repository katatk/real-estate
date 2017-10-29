  function characterCount() {
      var text_max = 300;
      document.getElementById('textarea_feedback').innerHTML = text_max + ' characters remaining';

      document.getElementById('textarea')
      var text_length = document.getElementById('textarea').value.length;
      var text_remaining = text_max - text_length;

      document.getElementById('textarea_feedback').innerHTML = text_remaining + ' characters remaining';
  };

  document.getElementById("textarea").addEventListener("keydown", characterCount);
  window.onload = characterCount();
