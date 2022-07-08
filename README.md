# test-register-block
Example related to a bug report for WP Core 5.9 and later (tested on 6.0 as well) about script/style dependencies no longer working as expected.

This is a sample child theme, that can be used together with most default themes. I chose the 3rd most popular download - "hello-elementor", for a full plug-and-play experience you can use that for testing, so you don't have to edit anything in the code.

When you have 2 blocks, that require 2 different JS files, and you only use 1 of the on your page, all of the CSS gets loaded on frontend, regardless if block is used or not.

Styles are also loaded on pages without any of the custom blocks used.

The expected behaivour would be when you add block 1 to have block 1 and component 1 styles loaded, and no styles for block 2 and component 2. However all of them are loaded. Even when none of the custom blocks are used. Prior to 5.9 - only the blocks used on the page were loaded.


