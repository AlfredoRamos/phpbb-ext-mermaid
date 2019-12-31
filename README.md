### About

Mermaid Diagrams extension for phpBB.

[![Build Status](https://img.shields.io/travis/com/AlfredoRamos/phpbb-ext-mermaid.svg?style=flat-square)](https://travis-ci.com/AlfredoRamos/phpbb-ext-mermaid)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-mermaid.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-mermaid/releases)
[![Code Quality](https://img.shields.io/codacy/grade/9a33e76aa58540f2bc1ce04738d3309b.svg?style=flat-square)](https://app.codacy.com/app/AlfredoRamos/phpbb-ext-mermaid)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-mermaid.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-mermaid/master/license.txt)

### Dependencies

- PHP 7.1.3 or greater
- phpBB 3.3 or greater

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-mermaid/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/mermaid/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Usage

Generate diagrams and flowcharts from text in a similar manner as markdown.

It uses the [mermaid](https://github.com/knsv/mermaid) library to generate the SVG markup and supports all diagrams available, which currently are:

- Flowchart
- Sequence diagram
- Class diagram
- State diagram
- Gantt diagram
- Git graph
- Pie chart

You can read more about the supported syntax in the official documentation:

- [mermaid](https://mermaidjs.github.io)

### Preview

[![Flowchart](https://i.imgur.com/5jhoiqgb.png)](https://i.imgur.com/5jhoiqg.png)
[![Sequence diagram](https://i.imgur.com/QPVhPuhb.png)](https://i.imgur.com/QPVhPuh.png)
[![Gantt diagram](https://i.imgur.com/C1qOugrb.png)](https://i.imgur.com/C1qOugr.png)
[![Class diagram](https://i.imgur.com/iHEDfxQb.png)](https://i.imgur.com/iHEDfxQ.png)
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
