  
  </div><!-- end inner -->
</div><!-- end wrapper -->

    <script src="../../public/js/jquery-2.1.0.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/common-script.js"></script>
    <script src="../../public/js/jquery.slimscroll.min.js"></script>
    <script src="../../public/plugins/toggle-switch/toggles.min.js" type="text/javascript"></script>
    <?php if ($menu_tab_sub == "calendarExamen") { ?>
    <script src="../../public/plugins/calendar/fullcalendar.min.js"></script>
    <script src="../../public/plugins/calendar/external-draging-calendar.js"></script>
    <?php } ?>
    <script type="text/javascript">
      $('input[id=fileHolder]').change(function() {
      $('#excelFile').val($(this).val());
      });
    </script>
    
</body>
</html>