### Bloat-off: bloat removal and optimization utilities ###

Tags: bloat, optimization, utilities, admin-panel
Tested up to: 6.8.3
Requires at least: 5.5
Requires PHP: 7.4
Stable tag: 0.9.7.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

## Description ##

The basic idea is to give administrators easy access to disable typical bloat, non-utilized functions or whole modules with just a few clicks.

There are no fancy UIs, external libraries, or hidden features — just clean, fast and easy way to disable things you might not want in your project or website.

*** Functionalities for current version:

** Bloat
Gutenberg styles removal
Wordpress emojis removal
RSS feeds removal
Rreally Simple Discovery removal
Shortlink removal
REST Discovery link removal
oEmbed discovery link removal
Admin widgets in dashboard removal
Native XML sitemap removal
Admin help tabs removal
About WP sub-menu and thank you message removal
Site Health disabling/removal
Import/Export page removal

** Utilities
Comments system removal
Widgets removal (those under "Appearance")
oEmbed restriction
Self-pingbacks removal
Heartbeat interval option
Image Process Engine - force GD
Limit number of revisions
Native tags taxonomy removal
Author archive pages disabling

## Docs / Source ##

All the required information about usage can be found on the plugin settings page; each function is fully described.

Source code can be found on official GitHub repository: https://github.com/Nikodemsky/bloatoff

## Privacy ##

The plugin does not:

* track users;
* send any personal data to external services;
* use cookies.

## Installation ##

Option A:

1. Go to the "Plugins" tab in the admin panel.
2. Click on "Add plugin".
3. In the search field, type "Bloat-off".
4. Click on "Install Now" next to the plugin name.
5. Click on "Activate" next to the plugin name.

Option B:

1. Download the plugin package from the official plugin page.
2. Go to the "Plugins" tab in the admin panel.
3. Click on "Upload plugin".
4. Choose the downloaded zip package and click on "Install Now".
5. After installation click on "Activate" button next to the plugin name.

Option C:

1. Upload the entire unpacked "bloatoff-utils" folder to /wp-content/plugins/ directory.
2. Activate the plugin through "Plugins" tab in the admin panel (Plugins > Installed plugins).

## Frequently Asked Questions ##

Q. Is it 100% free?
A. Yes. There are no paywalls or hidden/premium features.

Q. Is it safe to use?
A. Most of the options should be safe to use, but please read the carefully — especially those marked with a red asterisk next to function title.

Q. How is it different from other solutions already available in the repository?
A. The end result is probably the same in most cases. The differences come down to three principles:
    1. This plugin does not add anything more than absolutely needed to actually turn things off;
    2. It will always be (or at least try to) focused on core-related, optimization features.
    3. It aims to inform users about each feature clearly, without infodumps.

Q. Where is the settings page located?
A. Under the general settings tab, or at /wp-admin/options-general.php?page=bloatoff-utils; keep in mind that the tab is only available to administrators (or super-admins) by default.

Q. Does it work on multisite installations?
A. For now, there is no network-wide configuration or dedicated page, so it works on a per-site basis. This is on the to-do list, but I can't say when it will be added and properly tested.

Q. Will you consider adding new features?
A. I'm always looking for new features to add. Feel free to suggest anything you think is worth including.

Q. Will you consider removing bloat from other plugins?
A. No, I'm keeping it core-related only. Sorry.

Q. Why aren't there features like "App Password removal"? Isn't that considered a rarely used function by the majority of users?
A. While I do think it shouldn't be enabled by default, it's more of a security-related feature and doesn't affect installation optimization.

Q. Would you consider adding jQuery migrate removal option?
A. It's disabled by default from WP versions 5.5.0  and later. If something on your website still relies on this kind of backward compatibility, you should consider updating it — removing jQuery Migrate could potentially break some functionality. However, if you still need to remove it manually, add this code to your functions.php after <?php: https://github.com/Nikodemsky/Wordpress-related/blob/main/disable-jquerymigrate.php

Q. My website went blank after removing Gutenberg styles! What should I do?
A. There's a high probability that either your theme or one of your plugins is using Gutenberg-related styles or scripts. This option is intended only for installations that do not rely on Gutenberg in any way.

Q. Why do some links redirect to developer pages rather than official documentation?
A. Some features are purely technical, and a few are quite archaic (RSD, for example, was added in version 2.0.0). Unfortunately, not everything is documented in an accessible way.

Q. What does the warning in oEmbed discovery link actually mean?
A. Some external services rely on oEmbed discovery links and require them to fetch content from your website properly. WordPress-related services don't need them and will fetch everything correctly even without those links (assuming your site is configured properly and doesn't have additional blocking rules).

Q. Why is there no option to remove the WordPress Heartbeat API altogether?
A. Too many things rely on Heartbeat, and removing it entirely is a really bad idea — most of the potential issues would come from that option.
If you still want to disable it, add this snippet to your active theme's functions.php file after <?php: https://github.com/Nikodemsky/Wordpress-related/blob/main/disable-heartbeat.php. Just keep in mind that you're doing so at your own risk, and it may break some key functionality on your website.

Q. Does the Heartbeat control change the interval for all instances?
A. Yes. It changes the global "interval" setting.

Q. Will changing the Heartbeat interval break anything on my site?
A. It may. It's best to leave it unchecked if you're not sure about this setting. Saving the option as unchecked will also reset the interval to the default value of 15 seconds.

Q. Regarding Image Process Engine - how do I check which engine I use?
A. The easiest way is to check the "Media handling" tab in the Site Health tool. In most cases, you'll see the active Image Process Engine along with more detailed information.

Q. Will old revisions be removed right away after limiting their number globally?
A. No. Revisions are only removed when you update each post or page individually..

Q. Why is there no option to remove old revisions in bulk?
A. Adding such an option would require considering many factors, like installations with limited system resources or thousands of records to clean. To be honest, I consider this outside the plugin's scope. If you need this functionality, please try plugins like "WP-Sweep" or "Optimize Database after Deleting Revisions."

Q. What is the most optimal number of revisions to keep?
A. It depends entirely on your workflow. In most cases, I would say 3–5, but some people may need to check up to 10 versions back.

Q. Will removing the "tags" taxonomy affect my position on search engines like Google or Bing?
A. Possibly, but only if you have tags that are already indexed by search engines.

Q. What about author archives — will removing those affect my position on Google/Bing?
A. Same as with tags — only if they are actually indexed by search engines.

Q. Will you consider adding import/export settings?
A. It's on the to-do list, but there's no ETA.

Q. I need help, something doesn't work!
A. If it's related to the Bloat-off plugin, please create a new thread on the WordPress support forums and provide as much information as possible regarding the issue.

Q. Does the plugin leave anything behind after uninstall?
A. No, all options saved in the database are cleared upon plugin removal.

## Changelog ##

v0.9.7.1
* Updated readme.txt
* Updated functions descriptions
* Updated translation file

v0.9.7
* Added new utility - removal of authors archive pages
* Updated some descriptions
* Updated translation file
* Updated readme.txt

v0.9.6.1
* Changed maximum values for revisions (from 999 to 99) and Heartbeat API interval (from 86400s to 3600s)
* Changed priority for last filter in Site Health optimization (from PHP_INT_MAX to 999)
* Updated readme.txt

v0.9.6
* Extended descriptions to allow sanitized translations with <br>, <strong> and </strong> html tags
* Additional styling to descriptions, for better readability
* New utility added - limit number of revisions
* New utility added - native tags taxonomy removal
* Updated form handler in js, to work with number of options
* Updated some of the descriptions to be more substantial

v0.9.5
* Core version bump
* Options page settings args update (admin/settings-page.php)
* Gutenberg Warning info update
* Required WP version bump (from 5.2 to 5.5)
* New utility added - Image Processing Engine
* XMLRPC option removed
* Added readme.txt file (WIP)
* Updated translation file

v0.9.4
* Refactored utilities/optimizations code, for better scalability.
* Added two new functions: Site Health and Import/Export removal.
* Added link to Site Health.
* Added link to RSD.
* Added link to Shortlink.
* Added link to REST discovery.
* Added link to oEmbed discovery.
* Updated translation file.
* Removed code related to jQuery migrate from the source

v0.9.3
* Added tooltips to question markings.
* Added more info link to native Wordpress widgets removal utility.
* Added more info link to Heartbeat API utility.
* Changed Description on Heartbeat API utility.
* Added more info link to oEmbed utility.
* Added more info link to Admin help tabs removal.
* For now, commented-out option to remove jQuery migrate; it's really rare to see it used anywhere nowadays.
* Added more info link to WP Emoji removal.
* Added more info link to RSS Feeds removal.
* Added more info link to Dashboard Widgets removal.

v0.9.2
* New functionalities
* New sanitization of options
* Changed wrapper of each function to html details/summary elements
* Added proper styling for warnings and gains
* Added new descriptions

v0.9.1
* Added uninstaller
* Added link to settings page