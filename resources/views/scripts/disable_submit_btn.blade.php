<script type="text/javascript">
   $('form').on('submit', function () {
      $('button[type="submit"')
      .prop('disabled', true)
      .html(`
         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde un momento...`
         );
   });
</script>
