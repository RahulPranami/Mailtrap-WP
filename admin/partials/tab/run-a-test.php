<!-- <form id="mailtrap-settings" method="post" action="options.php" class="p-6 space-y-4"> -->
    <form id="mailtrap-settings" class="text-lg text-slate-300 p-2" hx-post="<?php echo admin_url('admin-ajax.php'); ?>"
    hx-vals='{"action": "send_test_mail"}' hx-trigger="submit" hx-target="#output">
    <?php // settings_fields('mailtrap-settings'); ?> <?php // do_settings_sections('mailtrap-settings'); ?> <?php if (isset($email_sent) && $email_sent === true): ?> <div class="notice notice-success is-dismissible">
        <p>
            <?php echo __('Your email has been sent successfully', 'mailtrap-for-wp') ?>
        </p>
        </div>
    <?php endif; ?>

    <?php settings_errors(); ?>

    <h3>Send a Test Email</h3>

    <hr>

    <div class="mb-4 flex items-center justify-between">
        <label for="to_email" class="">Email :</label>
        <input type="search" id="to_email" name="to_email" placeholder="Email..."
            class="shadow appearance-none border rounded w-96 py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" />
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Search
        </button>
    </div>

    <div id="output">
        <span class="htmx-indicator">
            Searching...
        </span>
    </div>


    <!-- </form> -->
</form>