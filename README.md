# Bloat-off: bloat removal and optimization utilities.

Pretty straight-forward tool, that provides easy-to-use controls to remove of bunch of native Wordpress bloatware, also contains few useful utilities for optimization.

### Functionalities for version 0.9.x:

**Bloat**
* Gutenberg styles removal
* Wordpress emojis removal
* RSS feeds removal
* Rreally Simple Discovery removal
* Shortlink removal
* REST Discovery link removal
* oEmbed discovery link removal
* Admin widgets in dashboard removal
* Native XML sitemap removal
* Admin help tabs removal
* About WP sub-menu and thank you message removal
* Site Health disabling/removal (new in 0.9.4)
* Import/Export page removal (new in 0.9.4)

**Utilities**
* Comments system removal
* Widgets removal (those under "Appearance")
* oEmbed restriction
* Self-pingbacks removal
* Heartbeat interval option
* Image Process Engine - force GD (new in 0.9.5)
* Limit number of revisions (new in 0.9.6)
* Native tags taxonomy removal (new in 0.9.6)
* Option to disable author archive pages (new in 0.9.7)

**To do**
* ~Possibly tab-closing and moving for both blocks~ (it would mean more js and possibly css, scrapping the idea for now)
* ~Think about the XML-RPC option, whether it should stick or not - it's security thing, rather than anything related to actual optimization~ (removed as of v0.9.5)
* ~Possibly tooltip telling to actually click on [?] next to the name of the function, or maybe information somewhere, that click is actually required to see full description of functionality (it uses native details/summary html elements)~ (done)
* ~Remove saved options on uninstall~ (done)
* ~Add translations files~ (done)
* ~Apply RSS feeds removal from header links~ (done)
* ~Find proper info source for RSD~ (done)
* ~Find proper info source on Shortlink~ (done)
* ~JS handler for Heartbeat input~ (done)
* ~Check whether on-site search disabling is worth adding as utility~ (after analyzing the case it doesn't seems like disabling it make any difference, if there's no call for search form on the frontend; this function would seem like novelty, rather than anything meaningful)
* ~Check whether disabling author archives is worth adding as utility or bloat removal~ (done, added in 0.9.7)
* Full Multisite compability (work required, no ETA)
* Better descriptions and sources to more info (WIP/ partially done)
* Possibly settings import/export
* Look for new optimization opportunities (WIP)
* Find better info source for self-pingbacks
* Find proper info source for gutenberg styles
* Add polish translation
* Check whether removing some of the default image sizes (for example: medium_large, 1536x1536, 2048x2048) does make sense as an utility option
