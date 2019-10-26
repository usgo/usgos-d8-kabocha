The Kabocha theme was originally created by [Joshua Simons][1], and is the current usgo.org website theme. This is a modified version of that theme for Drupal 8.

This version of Kabocha does not use scripts to update frontpage or sidebar content. It will just display what is put into each of the regions and style according to what styles have been defined for that region.

[1]: http://www.emptypath.com/
[2]: https://usgo.org/news

## Features
Table-less 2-3 column variable width theme for the American Go Association.

## Regions 

```
regions:
  header: 'Header'
  main_navbar: 'Main Navigation'
  left_sidebar: 'Left sidebar'
  right_sidebar: 'Right sidebar'
  content: 'Content'
  help: 'Help'
  highlighted: 'Highlighted'
  page_top: 'Page top'
  page_bottom: 'Page bottom'
  footer: 'Footer'
  footer_links: 'Footer Links'
```

## Template Changes from Drupal 7
USGO's Kabocha theme for Drupal 8 no longer uses PHP Engine and instead uses Twig. The templates for this Kabocha version can be now found in [templates](templates).

## Site Branding
Due to changes in Drupal 8 the block which contained branding information is now contained within `page.header`, and now uses [templates/block--system-branding-block.html.twig][4] to template the site branding displayed in the header. This change was introduced in [Drupal 8.0.x][3].

[3]: https://www.drupal.org/node/2544012
[4]: templates/block--system-branding-block.html.twig

## Templates
- Main Page Template: page.html.twig
- Site Branding Template: block--system-branding-block.html.twig

## Stylesheets and Javascript
To Drupal 8 Stylesheets and Javascript considered assets and are organized via libraries. The file which manages Kabocha's libraries can be found in [kabocha.libraries.yml][5]. More information about can be found on Drupal's documentation page: [Adding stylesheets (CSS) and JavaScript (JS) to a Drupal 8 module][6].

[5]: kabocha.libraries.yml
[6]: https://www.drupal.org/docs/8/creating-custom-modules/adding-stylesheets-css-and-javascript-js-to-a-drupal-8-module
