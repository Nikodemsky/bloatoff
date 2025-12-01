### Bloat-off: bloat removal and optimization utilities ###

Tags: bloat, optimization, utilities, admin-panel
Tested up to: 6.8.3
Requires at least: 5.5
Requires PHP: 7.4
Stable tag: 0.9.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

## Description ##

The basic idea is to give devs/admins easy access to disable typical bloat, redundant functions or whole modules with just few clicks.

The whole thing started as bunch of optimizations I have used on my projects and with time I've decided to convert those into plugin and keep my functions.php file a bit cleaner.

There's no fancy UI's, external libraries, hidden features - just clean, fast and easy way to disable things you might not want to have in your project/website.

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

All the required information about actual usage can be found on the plugin settings page; each function is described properly.

Source can be found on official Github repository: https://github.com/Nikodemsky/bloatoff

## Privacy ##

The plugin does not:

* track users;
* send any user personal data to external services;
* use cookies.

## Installation ##

Option A:

1. Go to "Plugins" tab on the admin panel.
2. Click on "Add plugin".
3. On the search input type "Bloat-off".
4. Click on "Install Now" next to the plugin name.
5. Click on "Activate" next to the plugin name.

Option B:

1. Download the plugin package from the official plugin page.
2. Go to "Plugins" tab in admin panel.
3. Click on "Upload plugin".
4. Choose downloaded zip package and click on "Install Now".
5. After installation click on "Activate" button next to the plugin name either on the installation screen or in the plugins list tab.

Option C:

1. Upload the entire unpacked "bloatoff-utils" folder to /wp-content/plugins/ directory.
2. Activate the plugin through "Plugins" tab in admin panel (Plugins > Installed plugins).

## Frequently Asked Questions ##

Q. Is it 100% free?
A. Yes. There's no paywalls or hidden/premium features.

Q. Is it safe to use?
A. Most of the options should be safe to use, but please read the descriptions, especially those marked with red asterisk next to function title.

Q. How is it different, from already available solutions in repository?
A. The final effect is probably the same in most cases; the three rules, that might be as well treated as possible differences:
    1. this plugin does not add anything more, than absolutely needed to actually set things off;
    2. it always will be (or at least try to) focused on core-related, optimization features;
    3. try to inform about the features in the best possible way, without infodumps.

Q. Where is the settings page located?
A. Under general settings tab, or /wp-admin/options-general.php?page=bloatoff-utils; keep in mind, that the tab is only available to administrators and roles above.

Q. Is it working on multisite installations?
A. As for now, there's no network-wide configuration or dedicated page, so it's per-website basis. It's on to-do list, but can't really say when it's gonna be added and properly tested.

Q. Will you consider adding new features?
A. Looking for new features is ongoing-WIP, so yeah. Feel free to point anything worth adding.

Q. Will you consider removing bloat from other plugins?
A. No. I'm keeping it core-related only, sorry.

Q. Why there's no things like "App password removal" for example? Isn't considered rarely used function by majority of users?
A. While I do think it should not be enabled by default, it's rather a security-related feature and doesn't affect installation optimization.

Q. Would you consider adding jQuery migrate removal option?
A. It's disabled by default from WP versions 5.5.0 onwards, so if there's anything on your website, that is still using this kind of backward compability, then you should consider updating the thing, that requires it - removing it could potentially brake some functionalities; but still, if you need to do so, then add this code to your functions.php after <?php: https://github.com/Nikodemsky/Wordpress-related/blob/main/disable-jquerymigrate.php

Q. My website went blank after removing Gutenberg styles! What should i do?
A. There's high probability, that either yout theme or one of your plugins is using gutenberg-related styles or scripts; this option is exclusievely intended only for installations, that does not rely on Gutenberg in any way.

Q. Why some of the links are redirecting to developer pages, rather than actual documentation?
A. Some of the things are purely technical and among them you can find archaic functions (like RSD was added in 2.0.0) and I don't really want to redirect people to articles, that may be deleted one day. If you're not sure about something, then just leave that option unchecked.

Q. What does Warning in oEmbed discovery link actually means?
A. Some of the external services actually rely on those oEmbed discovery links and requires them to fetch content from your website properly; WP-related services don't need those and will fetch everything properly even without that links (meaning, if the actual site is configured properly and don't have some additional blocking rules added).

Q. Why there's no option to actually remove WordPress Heartbeat API altogheter?
A. Too many things rely on Heartbeat and it's really bad idea to have it removed. Probably most of the potential issues would come from that option.
But if you want to, then simply add this snippet to your active theme functions.php file after <?php: https://github.com/Nikodemsky/Wordpress-related/blob/main/disable-heartbeat.php; just keep in mind, that you are doing so on your own volition and it may brake some key functionalities on your website.

Q. Does Heartbeat control changes interval for all instances?
A. Yes. It changes the global "interval" setting.

Q. Will changing Heartbeat interval may brake anything on my site?
A. It may. Best to leave it unchecked, if you're not sure about that specific function. Saving the option as unchecked will also set interval to default value of 15s.

Q. Will you consider adding import/export settings?
A. It's on my to-do list, but there's no ETA.

Q. Regarding Image Process Engine - how do i check which engine i use?
A. The easiest way would be to check the "Media handling" tab in the Site Health tool. In most cases you'll see active used Image Process Engine along with more detailed information.

Q. Will the old revisions gonna be removed right away after limiting it's number globally?
A. No. You need to update each post/page to have it's revisions removed.

Q. Why there's no option to remove old revisions by batch?
A. Adding such option would need to take into consideration many things - like installations with very limited system resources or thousands of records to clean, to be completely honest it's something, that I consider outside of the plugin functionality scope. Please try using plugins like "WP-sweep" or "Optimize Database after Deleting Revisions" if needed.

Q. Does removing "tags" taxonomy will affect my position at search engines like Google or Bing?
A. Only if you have actually any tags created and those are indexed, then it possibly may.

Q. I need help, something doesn't work!
A. If it's related to the Bloat-off plugin, then please create new thread on the Wordpress support forums and provide as much information, as possible regarding the issue.

Q. Does the plugin leaves anything behind after uninstall?
A. No, all the options saved in database are cleared upon plugin removal.

## Changelog ##

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