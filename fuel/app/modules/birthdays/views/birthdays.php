<!-- STYLE -->
<style>
    #module_birthdays { font-size:100%; line-height: 100%; text-align: center; font-size: 50px; }
    #module_birthdays .heading { margin-bottom: 25px; text-align: left; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_birthdays' class='h_one w_one'>
    <span class="heading">Next birthday</span>
    <?php
        echo "<strong>".$birthday['who']."</strong><br />" . $birthday['date'];
    ?>
</div>
<!-- /CODE -->
