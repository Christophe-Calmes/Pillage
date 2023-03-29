<script type="text/javascript">
  let jeckyl = document.getElementById('magic');
  let magax = document.getElementById('hiddenForm');
  let open = false;
  jeckyl.addEventListener('click', function(){
    if(!open) {
      jeckyl.innerText = "Fermer le formulaire";
      magax.style.display = "block";
      open = true;
    } else {
      jeckyl.innerText = "Ouvrir le formulaire";
      magax.style.display = "none";
      open = false;
    }
    return open;
  });
</script>
