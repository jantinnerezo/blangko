# :page_facing_up: Blank Wordpress Theme

## Just another headless Wordpress CMS Theme

### Installation

In your wordpress project's composer.json file, add this under repositories:

```json
{
  "type": "vcs",

  "url": "git@github.com:jantinnerezo/blangko.git"
}
```

After that you should require it to your wordpress project's composer.json file:

```bash
composer require jantinnerezo/blangko
```

### Usage

Go to: Appearance / Themes and then activate the blangko theme and you're all good!

### Adding custom post types

:bulb: It is highly recommended to create a child theme with this theme and put your own custom codes in the your child theme to avoid losing your modifications every time you update the parent theme.

Inside inc/blangko-post-types.php, add your custom post types under blangko_post_types() function and just add another element to the array, you can use the example post type for your guide.

```php
function  blangko_post_types():  array
{
	return [
		[
			'name'  =>  'blogs',
			'plural_name'  =>  'Blogs',
			'singular_name'  =>  'Blog',
			'icon'  =>  'welcome-write-blog',
			'public'  =>  false, // Optional
			'show_in_rest'  =>  false, // Optional
			'show_in_graphql'  =>  false  // Optional
		],
		// Additional custom post types here
	];
}
```
