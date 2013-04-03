====
 Wordpress Rss Poster
====



====
Introduction
====

I am a lazy specie. As soon as some tasks start consuming my time, I start thinking about automating them. A few days ago I realized I had a lot of rss feeds coming in my google reader if I could just summarize this treasure of fresh content and publish it on my blog I would have a lot of interesting stuff on my site.

But, I didn't want to read posts on google reader, summarize them, create new posts on wp admin and publish them one by one. So I ended up creating this project. This is similar to Google reader, you create categories, save feed links in those categories. This app, fetches fresh feeds for you, lists them and allows you to edit, select wordpress category, tags and new title and publish them to wordpress.

=====
Requirements
=====

PHP 5.1+
PDO and PDO-MYSQL Extension

===
Installation
===

- Download these source code files in either zip format or using git clone.
- You need to create two tables in your wordpress database. Open rssposting.sql and run mysql queries in file to create them.
- Now make a new folder in your blog's root directory and copy files to that folder. We assume you named this folder rss-admin. Copy downloaded files in this folder.
- Open rss-admin/protected/config/main.php, scroll down and set mysql credentials (same as your wp-config.php file credentials). Scroll down futher to the end of file and change password for admin user. Save the file.
- Browse to http://yourblogurl.com/rss-admin/ login with username **admin** and password that you set in main.php file.
- Don't worry if you see a 404, that's because there are no feeds yet. Create a category from categories menu.
- Create a link and save a feed URL, select category for link and save.
- Open feeds menu link and you should see feeds listed. Click **Edit**, edit title, comma spearated tags and content. Select category for your post and click submit. It will appear on your blog. Happy Blogging :)
