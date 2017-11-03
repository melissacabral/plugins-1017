<div class="wrap">
    <h1>Bitchin Announcement Bar Settings</h1>
    <p>Customize the content of ya banner</p>

    <form action="options.php" method="post">
        <?php
        //connect form to the database
        // register options group from register_setting() in the main php plugin file
        settings_fields('bitchin_ab_group');
        //Get options
        $values = get_option('bitchin_bar');
        ?>
        <label>Call To Action</label>
        <input type="text" name="bitchin_bar[text]" value="<?php echo $values['text']; ?>">
        <br>
        <label>Button Text</label>
        <input type="text" name="bitchin_bar[link_text]" value="<?php echo $values['link_text']; ?>">
        <br>
        <label>Button Link</label>
        <input type="text" name="bitchin_bar[url]" value="<?php echo $values['url']; ?>">
        <br>
        <?php submit_button('Save Announcement Bar Settings'); ?>
    </form>
</div>