==== LH Log Queries and hooks ===
Contributors: shawfactor
Donate link: https://lhero.org/portfolio/lh-log-queries/
Tags: query, log, queries, developer, developers
Requires at least: 3.5 
Tested up to: 6.0
Stable tag: trunk
License: GPLv2 or later

Decisions not options for query and hook logging

== Description ==

This plugin logs all wordpress queries in the current page request as a html comment at the end of your output.

It only does so when the get variable lh_log_queries is set. That variable has three settings.
1. queries: this logs queries only
2. hooks: this logs hooks only
3. both: this logs both hooks and filters

**Like this plugin? Please consider [leaving a 5-star review](https://wordpress.org/support/view/plugin-reviews/lh-log-queries/).**

**Love this plugin or want to help the LocalHero Project? Please consider [making a donation](https://lhero.org/portfolio/lh-log-queries/).**

== Frequently Asked Questions ==

= Why did you write this plugin? =

I wrote it as I wanted a simple, developer orientated plugin that would log bothqueries and filters without slowing my site down.

= What is something does not work?  =

LH Log Queries and hooks, and all [https://lhero.org](LocalHero) plugins are made to WordPress standards. Therefore they should work with all well coded plugins and themes. However not all plugins and themes are well coded (and this includes many popular ones). 

If something does not work properly, firstly deactivate ALL other plugins and switch to one of the themes that come with core, e.g. twentyfirteen, twentysixteen etc.

If the problem persists pleasse leave a post in the support forum: [https://wordpress.org/support/plugin/lh-first-comment-redirect/](https://wordpress.org/support/plugin/lh-log-queries/) . I look there regularly and resolve most queries.


= Will it slow my site down? =

Not at all, the code is only executed if the get variables are present.

= Can you show me an example url? =

If installed on your site the both the hook and query log would be shown (as html comments), if you used this url: https://yoursite.com/?lh_log_queries=both

= What if I need a feature that is not in the plugin?  =

Please contact me for custom work and enhancements here: [https://shawfactor.com/contact/](https://shawfactor.com/contact/)

== Installation ==


1. Upload the entire `lh-log-queries` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

**1.00 April 16, 2019**  
Initial release

**1.02 June 02, 2019**  
Variable check, no errors