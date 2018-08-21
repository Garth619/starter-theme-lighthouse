This theme is designed as a starting point to build custom wordpress themes.
Designed to be started with importing with blank.sql (in the main directory) to the database.
Pretty much everything is linked in and ready to go through functions.php and the main js files.
This theme was built for ultimate page speed scores.

Built by Joe O'Connor, if you have any questions hit me up.



Important things to note:


/* /speed/_css.php
 --------------------------------------------------------------------------------------- */

 Since we are focused on page speed, we need to inject all the css in the <head></head>.
 This file is a placeholder that will automatically get populated with our minified css
 (from the css folder and style.css) and then injected into the header. This is done by
 merge_include_css() in functions.php. This needs to be a php file just in case we are
 using php in the style.css for acf stuff.



/* /speed/_js.js
 --------------------------------------------------------------------------------------- */

 The function merge_include_js functions.php merges all of our third party js files in
 the js folder into this file and then minifies everything. Then this file is injected
 into the footer, for page speed.



/* /speed/HTMLmin.php and /speed/JSmin.php
 --------------------------------------------------------------------------------------- */

 These two files minify the html and js. Already set up to do it automatically in functions.php
 No need to mess with it.



/* Included third party js files. Delete these if not using.
 --------------------------------------------------------------------------------------- */

- modernizr-webp.js -> Checks if the browser supports .webp image files. If it supports then
  the class 'webp' to the <html> tag. If it doesn't support then it will add the class 'no-webp'.
  I am using this because webp images are much more compressed and have a smaller file size than jpg/pngs.
  Since some browsers dont support webp, we need to have a fallback image to use.
  How to use - .webp .banner { background-image: url('images/hero.webp') };
               .no-webp .banner { background-image: url('images/hero.jpg') };

- smoothScroll.min.js -> Makes scrolling stop smoothly instead of abruptly.
  How to use - No configuration needed, automatically works

- slick.min.js -> Slick carousel slider. http://kenwheeler.github.io/slick/
  How to use - Example put into main.js

- waypoints.min.js -> Triggers events (functions or add class to elements) on scroll.
  How to use - Example put into main.js

- wow.min.js -> Reveal animations on scroll
  how to use - http://mynameismatthieu.com/WOW/docs.html



/* svgs folder
 --------------------------------------------------------------------------------------- */

 Folder containing php files that include all of the code for the svg. Then we display the svg
 by doing <?php include("svgs/svgname.php"); ?> in our template files. Used to clean up the code so
 we dont have chunks of svg code in our files.



/* Fonts
 --------------------------------------------------------------------------------------- */

 Preload fonts in the header and load fonts in normally in the css. I found this to have the best
 page speed scores. Templates of how to do this are included in the header.php and style.css
 Use only woff2 font files.



/* Webp
 --------------------------------------------------------------------------------------- */

 Sometimes google lighthouse knocks you if you arent using .webp images. If you want to use these first
 convert your images to .webp format here: https://convertio.co/jpg-converter/ Then I have it set up with
 modernizr-webp.js so if the browser is compatible with webp the html will have the class of webp, and
 if not, no-webp. So just add these classes before the css element, for example:

 .webp header {
   background-image: url('images/hero-mobile.webp');
 }

 .no-webp header {
   background-image: url('images/hero-mobile.jpg');
 }



/* Blog Stuff
 --------------------------------------------------------------------------------------- */

 Instructions on how to set up the blog can be found in single.php, archive.php, and home.php.
 Start with single.php then go to archive.php and finally to home.php.



/* Main Breakpoints
 --------------------------------------------------------------------------------------- */

 Laptop: 1400px
 Tablet: 1199px
 Mobile: 700px



/* Mini responsive css framework
--------------------------------------------------------------------------------------- */

  Self explanatory framework that hides elements on different devices. Add the following classes
  to achieve this. Note, this is done by displaying block and none. If you have other display properties
  like flex and inline, it will be overwritten so you will have to do it the old school way.

  .desktop-only
  .laptop-only
  .tablet-only
  .mobile-only
  .tablet-mobile-only
  .desktop-mobile-only
  .internal-only



/* Loading Images
--------------------------------------------------------------------------------------- */

   Use data-src to load images instead of src. For background images use data-src on the div.
   A function in the main.js will take the data-src convert it into the src or the background image css.
   Used for page speed.
