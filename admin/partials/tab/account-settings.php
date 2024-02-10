<form id="mailtrap-settings" method="post" action="options.php" class="p-6 space-y-4">
  <?php settings_fields('mailtrap-settings'); ?>
  <?php do_settings_sections('mailtrap-settings'); ?>

  <?php if (isset($email_sent) && $email_sent === true): ?>
    <div class="notice notice-success is-dismissible">
      <p>
        <?php echo __('Your email has been sent successfully', 'mailtrap-for-wp') ?>
      </p>
    </div>
  <?php endif; ?>

  <?php settings_errors(); ?>

  <h3>Mailtrap Account Settings</h3>

  <hr>

  <table class="form-table">
    <tr>
      <th scope="row">
        <label for="mailtrap_enabled">
          <?php echo __('Enabled', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="checkbox" name="mailtrap_enabled" value="1" id="mailtrap_enabled" <?php echo get_option('mailtrap_enabled') === '1' ? 'checked' : '' ?> />
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_username">
          <?php echo __('Username', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="text" name="mailtrap_username" id="mailtrap_username"
          value="<?php echo esc_attr(get_option('mailtrap_username')); ?>" />
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_password">
          <?php echo __('Password', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="text" name="mailtrap_password" id="mailtrap_password"
          value="<?php echo esc_attr(get_option('mailtrap_password')); ?>" />
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_port">
          <?php echo __('Port', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <select name="mailtrap_port" id="mailtrap_port" class="">
          <option value="">
            <?php echo __('Select a port', 'mailtrap-for-wp') ?>
          </option>
          <?php foreach (array(25, 465, 587, 2525) as $port): ?>
            <option value="<?php echo $port ?>" <?php echo get_option('mailtrap_port') == $port ? 'selected' : '' ?>>
              <?php echo $port ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_secure">
          <?php echo __('Use TLS', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="checkbox" name="mailtrap_secure" id="mailtrap_secure" value="tls" <?php echo get_option('mailtrap_secure') === 'tls' ? 'checked' : '' ?> />
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <hr>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_api_token">
          <?php echo __('API Token', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="text" name="mailtrap_api_token" id="mailtrap_api_token"
          value="<?php echo esc_attr(get_option('mailtrap_api_token')); ?>" /><br>
        <small><a href="https://mailtrap.io/public-api" target="blank">https://mailtrap.io/public-api</a></small>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="mailtrap_from_email">
          <?php echo __('From Email', 'mailtrap-for-wp') ?>
        </label>
      </th>
      <td>
        <input type="text" name="mailtrap_from_email" id="mailtrap_from_email"
          value="<?php echo esc_attr(get_option('mailtrap_from_email')); ?>" />
      </td>
    </tr>
  </table>

  <?php submit_button(); ?>

</form>