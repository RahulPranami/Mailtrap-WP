<form method="post" action="options.php">
  <?php settings_fields('mailtrap-settings'); ?>
  <?php do_settings_sections('mailtrap-settings'); ?>

  <table class="form-table">
    <tr>
      <th scope="row">
        <?php echo __('Enabled', 'mailtrap-for-wp') ?>
      </th>
      <td><input type="checkbox" name="mailtrap_enabled" value="1" <?php echo get_option('mailtrap_enabled') === '1' ? 'checked' : '' ?> /></td>
    </tr>
    <tr>
      <th scope="row">
        <?php echo __('Username', 'mailtrap-for-wp') ?>
      </th>
      <td><input type="text" name="mailtrap_username"
          value="<?php echo esc_attr(get_option('mailtrap_username')); ?>" /></td>
    </tr>
    <tr>
      <th scope="row">
        <?php echo __('Password', 'mailtrap-for-wp') ?>
      </th>
      <td><input type="text" name="mailtrap_password"
          value="<?php echo esc_attr(get_option('mailtrap_password')); ?>" /></td>
    </tr>
    <tr>
      <th scope="row">
        <?php echo __('Port', 'mailtrap-for-wp') ?>
      </th>
      <td>
        <select name="mailtrap_port">
          <option value="">
            <?php echo __('Select a port', 'mailtrap-for-wp') ?>
          </option>
          <?php foreach (array(25, 465, 2525) as $port): ?>
            <option value="<?php echo $port ?>" <?php echo get_option('mailtrap_port') == $port ? 'selected' : '' ?>>
              <?php echo $port ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <?php echo __('Use TLS', 'mailtrap-for-wp') ?>
      </th>
      <td><input type="checkbox" name="mailtrap_secure" value="tls" <?php echo get_option('mailtrap_secure') === 'tls' ? 'checked' : '' ?> /></td>
    </tr>
    <tr>
      <td colspan="2">
        <hr>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <?php echo __('API Token', 'mailtrap-for-wp') ?>
      </th>
      <td>
        <input type="text" name="mailtrap_api_token"
          value="<?php echo esc_attr(get_option('mailtrap_api_token')); ?>" /><br>
        <small><a href="https://mailtrap.io/public-api" target="blank">https://mailtrap.io/public-api</a></small>
      </td>
    </tr>
  </table>

  <?php submit_button(); ?>

</form>

<form class="max-w-sm mx-auto">
  <div class="mb-5">
    <label for="apikey" class="block mb-2 text-sm font-medium text-gray-900">API Key</label>
    <input type="text" id="apikey"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      placeholder="Enter your API Key" required>
  </div>
  <div class="mb-5">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
    <input type="text" id="username"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      placeholder="Enter your Username" required>
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
    <input type="password" id="password"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      placeholder="Enter your Password" required>
  </div>
  <div class="mb-5">
    <label for="dropdown" class="block mb-2 text-sm font-medium text-gray-900">Dropdown Selection</label>
    <select id="dropdown"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      <option value="">Select an Option</option>
      <option value="option1">Option 1</option>
      <option value="option2">Option 2</option>
      <option value="option3">Option 3</option>
    </select>
  </div>
  <button type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
</form>

