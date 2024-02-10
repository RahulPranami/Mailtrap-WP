<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://rahulpranami.co
 * @since      1.0.0
 *
 * @package    Mailtrap
 * @subpackage Mailtrap/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <div class="container">
        <?php
        $mailtrap_enabled = get_option('mailtrap_enabled');
        if ($mailtrap_enabled) {
            $tabs = ['Send Test Mail' => 'run-a-test', 'Inbox' => 'inbox', 'Account Settings' => 'account-settings'];
            // $tabs = ['Account Settings' => 'account-settings', 'Run a Test' => 'run-a-test', 'Inbox' => 'inbox'];
        } else {
            $tabs = ['Account Settings' => 'account-settings'];
        }

        ?>

        <div class="container mx-auto mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <?php $first_content = 0; ?>
                <?php foreach ($tabs as $tab_title => $tab): ?>
                    <li class="me-2" role="presentation">
                        <button
                            class="capitalize inline-block p-4 <?php echo $first_content === 0 ? 'text-blue-600 border-b-2 border-blue-600 active' : ''; ?> hover:text-gray-300"
                            id="<?php echo $tab; ?>-tab" data-tabs-target="#<?php echo $tab; ?>" type="button" role="tab"
                            aria-controls="<?php echo $tab; ?>"
                            aria-selected="<?php echo $first_content === 0 ? 'true' : 'false' ?>">
                            <?php echo $tab_title; ?>
                        </button>
                    </li>
                    <?php $first_content = 1; ?>
                <?php endforeach; ?>

            </ul>
        </div>

        <!-- Write tabbed navigateed block -->
        <div id="default-tab-content" class="container mx-auto">

            <?php $first_content = 0; ?>

            <?php foreach ($tabs as $tab_title => $tab): ?>
                <div class="<?php echo $first_content === 0 ? '' : 'hidden' ?> tab-content" id="<?php echo $tab; ?>"
                    role="tabpanel" aria-labelledby="<?php echo $tab; ?>-tab">
                    <?php if (file_exists(plugin_dir_path(__FILE__) . 'tab/' . $tab . '.php')) {
                        require_once plugin_dir_path(__FILE__) . 'tab/' . $tab . '.php';
                    } ?>

                    <?php
                     ?>
                </div>
                <?php $first_content = 1; ?>
            <?php endforeach; ?>

        </div>
        <!-- Write tabbed navigateed block -->

    </div>
</div>