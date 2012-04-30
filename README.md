Foresight
=========
Contributors: chrisallenlane  
Donate link: http://chris-allen-lane.com  
Tags: admin, administration, anti-spam, manage, security  
Requires at least: 2.0.2  
Tested up to: 3.3.1  
Stable tag: trunk  
License: GPLv3  

Foresight makes it easier for a Wordpress administrator to stay up-to-date
on current Wordpress exploits.


Description
-----------
Foresight is designed to make it easier for administrators to
keep track of security vulnerabilities which exist within Wordpress and
Wordpress plugins. It does this by loading a tabbed display of known
exploits into the Wordpress administrative backend. (It's available under
'Tools' -> 'Foresight' in the admin side-bar.)

Using the plugin is simple: when you log in to perform your various
administrative tasks, take a moment to browse through the known exploits.
If you see vulnerabilities in that plugins you use, take the appropriate
action. (What's "appropriate" of course, will vary based off of several
factors, but may range from doing nothing to disabling the vulnerable
plugin.)


Installation
------------
You may install this plugin as you would any other:

1. Upload it to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress

More detailed installation instructions may be found [here](http://codex.wordpress.org/Managing_Plugins).


Frequently Asked Questions
==========================

**Why didn't you include `\$my_preferred exploit tracker?`**

There are two possible reasons:

1. I'm unaware of it.
2. Your tracker is configured to disallow being loaded into an iframe.
([Packet Storm](http://packetstormsecurity.org/) is among this category.)

If you'd like to see another tracker added to this plugin,
[mailto:chris@chris-allen-lane.com](let me know). If I agree that it
should be added in, I'll do so. If not, it should be pretty easy to hack
it in yourself. Open-source FTW!


Misc
====
Know that the '1337Day' tab behaves slightly differently than the other
tabs. Rather than loading Wordpress exploits by automatically, it will
first require you to check a checkbox promising not to use the exploits
catalogued on the site for nefarious purposes. From there, you'll have
to manually search for Wordpress exploits by clicking on the 'search'
link.


Changelog
=========
**1.0**
* Initial release
