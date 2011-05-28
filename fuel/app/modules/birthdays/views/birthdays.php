<!-- STYLE -->
<style>
    #module_birthdays { display: table-cell; font-size:100%; line-height: 100%; width: 200px; height: 200px; text-align: left; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_birthdays' class='h_two w_one'>
    <span class="heading">Next birthday</span><br />
    <?php
        echo "<strong>".$birthday['who']."</strong> on " . $birthday['date'];
    ?>
</div>
<!-- /CODE -->
