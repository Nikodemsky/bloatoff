# Bloat-off: bloat removal and optimization utilities.

Pretty straight-forward tool, that provides easy-to-use controls to remove of bunch of native Wordpress bloatware, also contains few useful utilities for optimization.

### Functionalities for version 0.9:

**Bloat**
* Gutenberg styles removal
* Wordpress emojis removal
* RSS feeds removal
* Rreally Simple Discovery removal
* Shortlink removal
* REST Discovery link removal
* oEmbed discovery link removal
* jQuery migrate removal (legacy option)
* Admin widgets in dashboard removal
* Native XML sitemap removal
* Admin help tabs removal
* About WP sub-menu and thank you message removal

**Utilities**
* Comments system removal
* Widgets removal (those under "Appearance")
* oEmbed restriction
* XML-RPC removal (or more like switching-off)
* Self-pingbacks removal
* Heartbeat interval option

**To do**
* Check how it works on multisite installations
* Better descriptions and sources to more info
* Possibly tab-closing and moving for both blocks
* Settings import/export via json perhaps
* Reference to original sources in scripts, that have actually been copied and modified over
* Think about the XML-RPC option, whether it should stick or not - it's security thing, rather than anything related to actual optimization
* Possibly tooltip telling to actually click on [?] next to the name of the function, or maybe information somewhere, that click is actually required to see full description of functionality (it uses native details/summary html elements)
* Look for new optimization opportunities
* Remove saved options on uninstall
