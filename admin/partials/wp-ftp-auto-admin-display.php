<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://otho.dev
 * @since      1.0.0
 *
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/admin/partials
 */
?>

<div id="wp-ftp-auto-admin">
    <h2>WP FTP Automation</h2>
    <form action="<?php echo admin_url("admin-post.php"); ?>" method="post">
    <input type="hidden" name="action" value="schedule_job" />
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="job-id">ID</label>
                    </th>
                    <td>
                        <input id="job-id" name="job-id" type="text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="server">FTP Server</label>
                    </th>
                    <td>
                        <input id="server" name="server" type="text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="username">Username</label>
                    </th>
                    <td>
                        <input id="username" name="username" type="text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="password">Password</label>
                    </th>
                    <td>
                        <input id="password" name="password" type="password" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="server-path">Server file path</label>
                    </th>
                    <td>
                        <input id="server-path" name="server-path" type="text" />
                        <br>
                        <span class="description">folder/file.ext</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="local-filename">Local filename</label>
                    </th>
                    <td>
                        <input id="local-filename" name="local-filename" type="text" />
                        <br>
                        <span class="description">file.ext</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="datetime">Datetime (UTC)</label>
                    </th>
                    <td>
                        <input id="datetime" name="datetime" type="datetime-local" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="interval">Interval</label>
                    </th>
                    <td>
                        <select id="interval" name="interval">
                            <option selected="selected" value="once">Once</option>
                            <option value="hourly">Hourly</option>
                            <option value="twicedaily">Twice Daily</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="import">Import</label>
                    </th>
                    <td>
                        <input type="radio" name="job-type" id="import" value="ftp_import_event" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="export">Export</label>
                    </th>
                    <td>
                        <input type="radio" name="job-type" id="export" value="ftp_export_event" />
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" id="submit" name="submit" class="button-primary" />
        </p>
    </form>
</div>