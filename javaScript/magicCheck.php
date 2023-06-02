<script>
  const checkAll = document.getElementById('checkAll');
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  checkAll.addEventListener('change', function() {
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = checkAll.checked;
    });
  });
</script>
