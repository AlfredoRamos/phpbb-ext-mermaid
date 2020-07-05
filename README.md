### About

Mermaid Diagrams extension for phpBB.

[![Build Status](https://img.shields.io/travis/com/AlfredoRamos/phpbb-ext-mermaid.svg?style=flat-square)](https://travis-ci.com/AlfredoRamos/phpbb-ext-mermaid)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-mermaid.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-mermaid/releases)
[![Code Quality](https://img.shields.io/codacy/grade/6ca752c34b9d4b66b7eb1c5de12af765.svg?style=flat-square)](https://app.codacy.com/manual/AlfredoRamos/phpbb-ext-mermaid/dashboard)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-mermaid.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-mermaid/master/license.txt)

Allows you to generate diagrams and flowcharts from text in a similar manner as markdown.

It uses the [mermaid](https://github.com/mermaid-js/mermaid) library to generate the SVG markup and supports all diagrams available. You can read more about the supported syntax in the official documentation:

- [mermaid](https://mermaid-js.github.io/mermaid/)

### Features

- Posting button for the `[mermaid]` BBCode
- Generate SVG diagrams from text
- Supports all diagrams and charts available in the library, currently:
	- Flowchart
	- Sequence diagram
	- Class diagram
	- Entity relationship diagram
	- State diagram
	- Gantt diagram
	- Git graph
	- Pie chart
- Compatible with [Markdown](https://github.com/AlfredoRamos/phpbb-ext-markdown) extension
- It doesn't require extra configuration

### Requirements

- PHP 7.1.3 or greater
- phpBB 3.3 or greater

### Support

- [**Download page**](https://www.phpbb.com/community/viewtopic.php?t=2527586)
- [GitHub issues](https://github.com/AlfredoRamos/phpbb-ext-mermaid/issues)

### Donate

If you like or found my work useful and want to show some appreciation, you can consider supporting its development by giving a donation.

[![Donate with PayPal](https://alfredoramos.github.io/assets/images/donate.png)](https://alfredoramos.github.io/donate/)

[![Donate with PayPal](https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg)](https://alfredoramos.github.io/donate/)

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-mermaid/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/mermaid/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Preview

[![Flowchart](https://i.imgur.com/5jhoiqgb.png)](https://i.imgur.com/5jhoiqg.png)
[![Sequence diagram](https://i.imgur.com/QPVhPuhb.png)](https://i.imgur.com/QPVhPuh.png)
[![Gantt diagram](https://i.imgur.com/C1qOugrb.png)](https://i.imgur.com/C1qOugr.png)
[![Class diagram](https://i.imgur.com/iHEDfxQb.png)](https://i.imgur.com/iHEDfxQ.png)
[![Entity relationship diagram](https://i.imgur.com/jbZzc2Pb.png)](https://i.imgur.com/jbZzc2P.png)
[![State diagram](https://i.imgur.com/hDGmUm9b.png)](https://i.imgur.com/hDGmUm9.png)
[![Pie chart](https://i.imgur.com/WP7uiQwb.png)](https://i.imgur.com/WP7uiQw.png)

*(Click to view in full size)*

### Configuration

It doesn't require extra configuration.

### Uninstallation

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Go back to `Manage extensions` > `Mermaid Diagrams` > `Delete data` and confirm

### Upgrade

- Uninstall the extension
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/mermaid/`
- Download the new version
- Install the extension

### Credits

File `load-balancer.svg` from [Zoondicons](https://www.zondicons.com/) by [Steve Schoger](https://twitter.com/steveschoger) is licensed under [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/)
