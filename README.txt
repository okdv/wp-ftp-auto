=== WP FTP Automation ===
Contributors: okdv
Donate link: https://otho.dev
Tags: ftp, cron, automation, automate, auto, import, export, file, manager
Requires PHP: 5.6
Requires at least: 3.0.1
Tested up to: 5.8
Stable tag: 5.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Import/Export files via FTP between your WordPress environment and a remote server. One time now, one time scheduled, and recurring jobs are available. 

== Description ==

# WP FTP Automation
This plugin offers a variety of functions related to handling automated FTP actions. Import and export, run once or on a recurring schedule. Create and update multiple jobs.

## How to use
1. Download and activate the most recent version
    - See Recommended Usage for other helpful plugin types to have
1. Navigate to the FTP Automation menu button on the admin sidebar
1. Complete form
    - ***ID:** Input a unique ID for new jobs, or an existing ID to update a job
    - ***FTP Server:** A working address, no trailing slashes and no `ftp://` prefix. See [ftp_connect](https://www.php.net/manual/en/function.ftp-connect.php) for more info on connection method.
    - **Username:** Username string, if required *(must be set if Password is)*
    - **Password:** Password string, if required *(must be set if Username is)*
    - **Server file path:** If empty, it will assume the root directory of the FTP server
    - ***Local filename:** The filename *(if wanting in wp-content/uploads/wp-ftp-auto/import/filename)*, an alternative path can be specified in relation to that path *(such as  ../../other-uploads-folder/filename)*
    - ***Datetime:** Schedule time to run. Should be at least 1 minute into the future, from time of submission. UTC.
    - ***Interval:** Interval at which it should run, choose once if you do not want recurrence. Other intervals are in spec with [WP CRON Schedules](https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/). *(Must use WP 5.4 or newer in order to use weekly interval)*.
   - ***Import or Export:** Radio buttons that require you choose if this is an import, i.e. [ftp_get](https://www.php.net/manual/en/function.ftp-get.php), or an export, i.e. [ftp_put](https://www.php.net/manual/en/function.ftp-put.php).
1. Submit form, check result after job
   - This is where some plugins may be helpful
     - Vew CRON jobs to confirm if job was properly scheduled
     - PHP Error plugin to see and potential issues experienced using the plugin, as currently we do not report errors within our admin page
     - Manage files plugin to confirm the job outcome was as expected once its run, FTP Clients are a good alternative as well

## Recommended Usage
It is recommended to use plugins that provide the below functionality:
 - View/Manage CRON Jobs
 - See PHP errors
 - View/Manage files within Wordpress 
Other helpful tips: 
 - Enable auto updates

== Frequently Asked Questions == 
= Are additional plugins required? = 
* No but it would be helpful

= Will this plugin always be free? = 
* I do not plan to charge for this at any time. Sacrificially, this plugin will remain fairly basic and bare as its free. This is subject to change however.

= Can I contribute? = 
* Sure! Submit a Pull Request on the [Github Repo](https://github.com/okdv/wp-ftp-auto)!

= Question, Bug report, or Feedback: what do I do? = 
* If possible, submit an issue on the [Github Repo](https://github.com/okdv/wp-ftp-auto), otherwise the [Wordpress Plugin forum](https://wordpress.org/support/plugin/wp-ftp-auto/) works as well

== Screenshots == 
1. Coming soon!

== Changelog ==

= 1.0.0 =
* Hello world

== Upgrade Notice ==

= 1.0.0 = 
* Currently this is the only available version
