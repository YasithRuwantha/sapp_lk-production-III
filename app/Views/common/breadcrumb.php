<?php
if(isset($breadcrumb) && is_array($breadcrumb)){
?>
            <ol class="breadcrumb bc-colored bg-theme" id="breadcrumb">
            <?php
                foreach($breadcrumb as $bred_val)
                {
                    if(isset($bred_val['url']))
                    {
            ?>
                <li class="breadcrumb-item ">
                    <a href="<?php echo $bred_val['url']; ?>"><?php echo $bred_val['label']; ?></a>
                </li>
            <?php 
                    }else{ 
            ?>
                <li class="breadcrumb-item active"><?php echo $bred_val['label']; ?></li>
            <?php 
                    }
                } 
            ?>
            </ol>
<?php } ?>
<?php cano_get_alert(); ?>