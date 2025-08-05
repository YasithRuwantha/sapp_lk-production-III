    <!-- Bootstrap and necessary plugins -->
    <script src="<?php echo base_url("/theme/oct/libs/jquery/dist/jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("/theme/oct/libs/popper.js/dist/umd/popper.min.js"); ?>"></script>
    <script src="<?php echo base_url("/theme/oct/libs/Bootstrap/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("/theme/oct/libs/PACE/pace.min.js"); ?>"></script>
    <script src="<?php echo base_url("/theme/oct/libs/chart.js/dist/Chart.min.js"); ?>"></script>
    <script src="<?php echo base_url("/theme/oct/libs/nicescroll/jquery.nicescroll.min.js"); ?>"></script>


    <!-- jquery-loading -->
    <script src="<?php echo base_url("/theme/oct/libs/jquery-loading/dist/jquery.loading.min.js"); ?>"></script>
    <!-- octadmin Main Script -->
    <script src="<?php echo base_url("/theme/oct/js/app.js"); ?>"></script>
    
<?php
$page_end_at=time();
$page_duration = $page_end_at-$GLOBALS["page_start_at"];
?>
<script>
// Maps 'metric2' to 'avg_page_load_time'.
gtag('config', '<?php echo $GLOBALS["ga_id"]; ?>', {
  'custom_map': {'metric2': 'avg_page_load_time'}
});

// Sends an event that passes 'avg_page_load_time' as a parameter.
gtag('event', 'load_time_metric', {'avg_page_load_time': <?php echo $page_duration; ?>});

<?php if(isset($GLOBALS["user"]['data']['user_login'])){ ?>
gtag('config', '<?php echo $GLOBALS["ga_id"]; ?>', {
   'custom_map': {
     'dimension1': 'user',
     'metric2': 'avg_page_load_time'
   }
});

gtag('event', 'foo', {'user': '<?php echo $GLOBALS["user"]['data']['user_login']; ?>', 'avg_page_load_time': <?php echo $page_duration; ?>});
<?php } ?>
</script>